<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\User;
use Auth;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        $form = $schema
            // ->columns(1)
            ->components([
                Fieldset::make('')->columnSpan(2)
                    ->schema([
                        Select::make('state')->label('Stato')
                            ->options(OrderStatus::class)->hiddenOn('create'),
                        Select::make('department_id')->label('Reparto')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->relationship('department', 'name')
                            ->columnSpan(fn(string $operation) => $operation === 'create' ? 2 : 1),
                    ]),
                Fieldset::make('')->columnSpan(2)
                    ->schema([
                        Select::make('product_id')->label('Codice Prodotto')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->relationship('product', 'code')
                            ->createOptionForm([
                                TextInput::make('code')->label('Codice Prodotto')
                                    ->required(),
                                TextInput::make('description')->label('Descrizione Prodotto'),
                                TextInput::make('unit')->label('UM Principale'),
                                TextInput::make('unit1')->label('UM 1'),
                                TextInput::make('unit2')->label('UM 2'),
                                TextInput::make('unit3')->label('UM 3'),
                                TextInput::make('fatt1')->label('Fatt.Conv. UM 1')
                                    ->numeric(),
                                TextInput::make('fatt2')->label('Fatt.Conv. UM 2')
                                    ->numeric(),
                                TextInput::make('fatt3')->label('Fatt.Conv. UM 3')
                                    ->numeric(),
                                Select::make('product_range_id')->label('Gamma Prodotto')
                                    ->relationship('productRange', 'code')
                                    ->searchable()
                                    ->preload()
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->required()
                                            ->maxLength(255),
                                    ]),
                            ]),
                        DatePicker::make('date')->required()->label('Data Consegna'),
                    ]),
                Fieldset::make('')->columns(fn(string $operation) => $operation === 'create' ? 2 : 3)->columnSpan(2)
                    ->schema([
                        TextInput::make('batch_code')->label('Lotto'),
                        TextInput::make('qty')->label('Qta')
                            ->required()
                            ->numeric(),
                        // TextInput::make('qty_end')->label('Qta Finale')
                        //     ->numeric(),
                        TextInput::make('qty_res')->label('Qta Residua')
                            ->numeric()->hiddenOn('create'),
                    ]),
                Fieldset::make('')->columnSpan(2)
                    ->schema([
                        TextInput::make('type_production')->required()->label('Magazzino'),
                        Select::make('customer_id')
                            ->searchable()
                            ->preload()
                            ->relationship('customer', 'description')
                            ->createOptionForm([
                                TextInput::make('code')->label('Codice Cliente')
                                    ->required(),
                                TextInput::make('description')->label('Ragione Sociale'),
                            ]),
                    ]),
                Textarea::make('note')->label('Note')
                    ->columnSpanFull(),
                Actions::make([
                    Action::make('Inizio Lavorazione')
                        ->label(fn(Get $get) => $get('state') == OrderStatus::SOSPENDED ? 'Riprendi Lavorazione' : 'Inizio Lavorazione')
                        ->icon('heroicon-m-clock')
                        ->color('success')
                        ->requiresConfirmation()
                        ->hidden(fn(Get $get) => $get('state') != OrderStatus::QUEUE && $get('state') != OrderStatus::PARTIALED && $get('state') != OrderStatus::SOSPENDED)
                        ->action(function (Set $set, Get $get, Order $record) {
                            $record->state = OrderStatus::PROCESSING;
                            $record->comment('ORDINE In Lavorazione', Auth::user());
                            $record->save();
                            return redirect(request()->header('Referer'));
                        }),
                    Action::make('Sospendi Lavorazione')
                        ->icon('heroicon-m-x-circle')
                        ->color('warning')
                        ->requiresConfirmation()
                        ->visible(fn(Get $get) => $get('state') != OrderStatus::QUEUE && $get('state') != OrderStatus::PARTIALED && $get('state') != OrderStatus::SOSPENDED && !$get('state')?->isFinalized())
                        ->schema([
                            Textarea::make('motivo')->label('Motivazione')->required(),
                        ])
                        ->action(function (array $data, Set $set, Get $get, Order $record) {
                            if (!empty($data['motivo'])) {
                                $admins = User::whereHas('roles', function ($query) {
                                    $query->where('name', 'admin')->orWhere('name', 'super_admin');
                                })->get();
                                foreach ($admins as $admin) {
                                    $record->subscribe($admin);
                                }
                                $record->comment('ORDINE SOSPESO: ' . $data['motivo'], Auth::user());
                            }
                            $record->state = OrderStatus::SOSPENDED;
                            $record->save();
                            return redirect(request()->header('Referer'));
                        }),
                    Action::make('Fine Lavorazione')
                        ->icon('heroicon-m-check')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->hidden(fn(Get $get) => $get('state') == OrderStatus::QUEUE || $get('state') == OrderStatus::PARTIALED || $get('state')?->isFinalized() || $get('state') == OrderStatus::SOSPENDED)
                        ->schema([
                            TextInput::make('quantity')->label('Quantità')
                                ->required()
                                ->numeric(),
                        ])
                        ->action(function (array $data, Set $set, Get $get, Order $record, EditRecord $livewire, $action) {
                            $qtaRes = $get('qty_res') ? $get('qty_res') : $get('qty');
                            if ($data['quantity'] > $qtaRes) {
                                Notification::make()
                                    ->danger()
                                    ->title('ATTENZIONE!')
                                    ->body('La Qta finale prodotta non può essere maggiore della Qta Residua.')
                                    ->send();

                                // 2. Abort the action
                                $action->cancel();
                            }
                            if ($data['quantity'] < $qtaRes) {
                                $record->state = OrderStatus::PARTIALED;
                                $record->comment('ORDINE Lavorazione Paziale', Auth::user());
                                $record->qty_end = $data['quantity'];
                                $record->qty_res = $qtaRes - $data['quantity'];
                                $record->save();
                                return redirect(request()->header('Referer'));
                            } else {
                                $record->state = OrderStatus::ENDED;
                                $record->comment('ORDINE Lavorazione Finita', Auth::user());
                                $record->qty_end = $data['quantity'];
                                $record->qty_res = $qtaRes - $data['quantity'];
                                $record->save();
                                return redirect(request()->header('Referer'));
                            }
                        }),
                ])->columnSpan(2)->fullWidth()->hiddenOn('create'),
            ]);

        if (Auth::user() && !Auth::user()->hasRole('admin') && !Auth::user()->hasRole('super_admin')) {
            foreach ($form->getComponents() as $childComponent) {
                // if ($childComponent->getName() !== 'note') {
                    $childComponent->disabled();
                // }
            }
        }

        return $form;
    }
}
