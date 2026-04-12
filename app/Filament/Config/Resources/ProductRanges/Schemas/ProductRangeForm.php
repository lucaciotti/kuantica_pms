<?php

namespace App\Filament\Config\Resources\ProductRanges\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProductRangeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')->label('Codice Gruppo')
                    ->required(),
                TextInput::make('description')->label('Descrizione'),
            ]);
    }
}
