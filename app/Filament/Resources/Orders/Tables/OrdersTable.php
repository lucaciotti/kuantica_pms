<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('state')->label('Stato')
                    ->badge()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('date')->label('Data Produzione')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('type_production')->label('Tipo')
                ->sortable()
                    ->searchable(),
                TextColumn::make('product.code')->label('Codice Prodotto')
                ->sortable()
                    ->searchable(),
                TextColumn::make('department.name')->label('Reparto')
                ->searchable()
                    ->sortable(),
                TextColumn::make('customer.description')->label('Codice Cliente')
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
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
