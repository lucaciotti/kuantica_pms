<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Enums\OrderStatus;
use App\Models\Order;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('state')->label('Stato')
                    ->options(OrderStatus::class),
                DatePicker::make('date')->label('Data Consegna'),
                TextInput::make('type_production')->label('Magazzino'),
                Select::make('customer_id')
                    ->searchable()
                    ->preload()
                    ->relationship('customer', 'description'),
                Select::make('product_id')->label('Codice Prodotto')
                    ->searchable()
                    ->preload()
                    ->relationship('product', 'code'),
                TextInput::make('batch_code')->label('Lotto'),
                TextInput::make('qty')->label('Qta')
                    ->numeric(),
                // TextInput::make('qty_end')->label('Qta Finale')
                //     ->numeric(),
                TextInput::make('qty_res')->label('Qta Residua')
                    ->numeric(),
                Select::make('department_id')->label('Reparto')
                    ->searchable()
                    ->preload()
                    ->relationship('department', 'name'),
                Textarea::make('note')->label('Note')
                    ->columnSpanFull(),
                Actions::make([
                    Action::make('Inizio Lavorazione')
                        ->icon('heroicon-m-clock')
                        ->color('success')
                        ->requiresConfirmation()
                        ->disabled(fn(Get $get) => $get('state') != OrderStatus::QUEUE && $get('state') != OrderStatus::PARTIALED)
                        ->action(function (Set $set, Get $get , Order $record) {
                            $record->state = OrderStatus::PROCESSING;
                            $record->save();
                            return redirect(request()->header('Referer'));
                        }),
                    Action::make('Fine Lavorazione')
                        ->icon('heroicon-m-clock')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->disabled(fn(Get $get) => $get('state') == OrderStatus::QUEUE || $get('state') == OrderStatus::PARTIALED || $get('state')?->isFinalized())
                        ->schema([
                            TextInput::make('quantity')->label('Quantità')
                                ->required()
                                ->numeric(),
                        ])
                        ->action(function (array $data, Set $set, Get $get, Order $record, EditRecord $livewire, $action) {
                            if ($data['quantity'] > $get('qty_res')){
                                Notification::make()
                                    ->danger()
                                    ->title('ATTENZIONE!')
                                    ->body('La Qta finale prodotta non può essere maggiore della Qta Residua.')
                                    ->send();

                                // 2. Abort the action
                                $action->cancel();
                            }
                            if ($data['quantity']< $get('qty_res')){
                                $record->state = OrderStatus::PARTIALED;
                                $record->qty_end = $data['quantity'];
                                $record->qty_res = $record->qty_res - $data['quantity'];
                                $record->save();
                                return redirect(request()->header('Referer'));
                            } else {
                                $record->state = OrderStatus::ENDED;
                                $record->qty_end = $data['quantity'];
                                $record->qty_res = $record->qty_res - $data['quantity'];
                                $record->save();
                                return redirect(request()->header('Referer'));
                            }
                        }),
                ])->columnSpan(2)->fullWidth(),
            ]);
    }
}
