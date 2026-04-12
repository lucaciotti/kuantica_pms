<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('state')
                    ->default('string'),
                DatePicker::make('date'),
                TextInput::make('qty')
                    ->numeric(),
                TextInput::make('qty_end')
                    ->numeric(),
                TextInput::make('qty_res')
                    ->numeric(),
                TextInput::make('batch_code'),
                TextInput::make('type_production'),
                Textarea::make('note')
                    ->columnSpanFull(),
                Select::make('product_id')
                    ->relationship('product', 'id'),
                TextInput::make('department_id')
                    ->numeric(),
                Select::make('customer_id')
                    ->relationship('customer', 'id'),
            ]);
    }
}
