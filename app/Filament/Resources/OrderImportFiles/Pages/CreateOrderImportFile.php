<?php

namespace App\Filament\Resources\OrderImportFiles\Pages;

use App\Filament\Resources\OrderImportFiles\OrderImportFileResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOrderImportFile extends CreateRecord
{
    protected static string $resource = OrderImportFileResource::class;
}
