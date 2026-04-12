<?php

namespace App\Filament\Config\Resources\Products\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
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
            ]);
    }
}
