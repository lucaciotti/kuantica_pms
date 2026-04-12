<?php

namespace App\Filament\Config\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')->label('Codice Prodotto')
                ->sortable()
                    ->searchable(),
                TextColumn::make('description')->label('Descrizione Prodotto')
                ->sortable()
                    ->searchable(),
                TextColumn::make('unit')->label('UM Principale')
                ->sortable()
                    ->searchable(),
                TextColumn::make('unit1')->label('UM 1')
                ->sortable()
                    ->searchable(),
                TextColumn::make('unit2')->label('UM 2')
                ->sortable()
                    ->searchable(),
                TextColumn::make('unit3')->label('UM 3')
                ->sortable()
                    ->searchable(),
                TextColumn::make('fatt1')->label('Fatt.Conv. UM 1')
                ->sortable()
                    ->numeric()
                    ->sortable(),
                TextColumn::make('fatt2')->label('Fatt.Conv. UM 2')
                ->sortable()
                    ->numeric()
                    ->sortable(),
                TextColumn::make('fatt3')->label('Fatt.Conv. UM 3')
                ->sortable()
                    ->numeric()
                    ->sortable(),
                TextColumn::make('productRange.name')->label('Gamma Prodotto')
                ->sortable()
                    ->searchable(),
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
