<?php

namespace App\Filament\Resources\OrderImportFiles\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OrderImportFileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('filename')
                    ->required(),
                TextInput::make('path')
                    ->required(),
                TextInput::make('status')
                    ->required(),
                DatePicker::make('date_upload')
                    ->required(),
                DatePicker::make('date_last_import'),
            ]);
    }
}
