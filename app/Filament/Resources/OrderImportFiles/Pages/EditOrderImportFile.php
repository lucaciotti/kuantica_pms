<?php

namespace App\Filament\Resources\OrderImportFiles\Pages;

use App\Filament\Resources\OrderImportFiles\OrderImportFileResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOrderImportFile extends EditRecord
{
    protected static string $resource = OrderImportFileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
