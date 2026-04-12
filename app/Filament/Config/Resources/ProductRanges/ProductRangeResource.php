<?php

namespace App\Filament\Config\Resources\ProductRanges;

use App\Filament\Config\Resources\ProductRanges\Pages\CreateProductRange;
use App\Filament\Config\Resources\ProductRanges\Pages\EditProductRange;
use App\Filament\Config\Resources\ProductRanges\Pages\ListProductRanges;
use App\Filament\Config\Resources\ProductRanges\Schemas\ProductRangeForm;
use App\Filament\Config\Resources\ProductRanges\Tables\ProductRangesTable;
use App\Models\ProductRange;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ProductRangeResource extends Resource
{
    protected static ?string $model = ProductRange::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::InboxStack;

    protected static string | UnitEnum | null $navigationGroup = 'Anagrafiche';
    protected static ?string $recordTitleAttribute = 'code';
    protected static ?string $modelLabel = 'gruppo prodotto';
    protected static ?string $pluralModelLabel = 'gruppo prodotti';
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return ProductRangeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductRangesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProductRanges::route('/'),
            // 'create' => CreateProductRange::route('/create'),
            // 'edit' => EditProductRange::route('/{record}/edit'),
        ];
    }
}
