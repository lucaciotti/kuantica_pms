<?php

namespace App\Filament\Resources\OrderImportFiles;

use App\Filament\Resources\OrderImportFiles\Pages\CreateOrderImportFile;
use App\Filament\Resources\OrderImportFiles\Pages\EditOrderImportFile;
use App\Filament\Resources\OrderImportFiles\Pages\ListOrderImportFiles;
use App\Filament\Resources\OrderImportFiles\Schemas\OrderImportFileForm;
use App\Filament\Resources\OrderImportFiles\Tables\OrderImportFilesTable;
use App\Models\OrderImportFile;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use UnitEnum;

class OrderImportFileResource extends Resource
{
    protected static ?string $model = OrderImportFile::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentArrowUp;

    protected static string | UnitEnum | null $navigationGroup = 'Import Pianificazione Produzione';
    protected static ?string $recordTitleAttribute = 'filename';
    protected static ?string $modelLabel = 'Import';
    protected static ?string $pluralModelLabel = 'Import XLS';

    public static function form(Schema $schema): Schema
    {
        return OrderImportFileForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OrderImportFilesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }


    public static function getPages(): array
    {
        return [
            'index' => ListOrderImportFiles::route('/'),
            'create' => CreateOrderImportFile::route('/create'),
            'edit' => EditOrderImportFile::route('/{record}/edit'),
        ];
    }
}
