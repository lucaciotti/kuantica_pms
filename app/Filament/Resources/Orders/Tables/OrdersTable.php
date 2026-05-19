<?php

namespace App\Filament\Resources\Orders\Tables;

use Auth;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\RecordActionsPosition;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Kirschbaum\Commentions\Filament\Actions\CommentsAction;
use Kirschbaum\Commentions\Filament\Actions\CommentsTableAction;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        if (Auth::user()->hasRole('user')) {
            if (Auth::user()->department_id){
                $table->modifyQueryUsing(fn(Builder $query) => $query->where('department_id', Auth::user()->department_id));
            }
        }
        return $table
            ->groups([
                Group::make('state')->label('Stato')
                    ->collapsible(),
                Group::make('department.name')->label('Reparto')
                    ->collapsible(),
                Group::make('date')->label('Data Consegna')
                    ->collapsible(),
            ])
            ->defaultGroup('state')
            // ->collapsedGroupsByDefault()
            // ->groupingSettingsInDropdownOnDesktop()
            ->columns([
                TextColumn::make('state')->label('Stato')
                    ->badge()
                    ->sortable()
                    ->alignCenter()
                    ->searchable(),
                TextColumn::make('department.name')->label('Reparto')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->sortable(),
                TextColumn::make('date')->label('Data Consegna')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('type_production')->label('Magazzino')
                ->sortable()
                    ->searchable(),
                TextColumn::make('customer.description')->label('Codice Cliente')
                ->sortable()
                    ->searchable(),
                TextColumn::make('product.code')->label('Codice Prodotto')
                ->sortable()
                    ->searchable(),
            TextColumn::make('batch_code')->label('Lotto')
                ->sortable()
                ->searchable(),
                TextColumn::make('qty')->label('Qta')
                    ->numeric()
                    ->sortable(),
                // TextColumn::make('qty_end')->label('Qta Finale')
                //     ->numeric()
                //     ->sortable(),
                TextColumn::make('qty_res')->label('Qta Residua')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                CommentsAction::make()->hiddenLabel(true)->tooltip('Commenti')
                    ->mentionables(User::all()),
                EditAction::make()->hiddenLabel(true)->tooltip('Modifica')->color('warning'),
            ])->recordActionsPosition(RecordActionsPosition::BeforeColumns)
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
            // ->infinite();
    }
}
