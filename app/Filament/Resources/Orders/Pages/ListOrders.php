<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Enums\OrderStatus;
use App\Filament\Resources\Orders\OrderResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $tabs = [];

        // 'All' Tab
        $tabs['all'] = Tab::make();

        // Generate Tabs from Enum Cases
        foreach (OrderStatus::cases() as $status) {
            $tabs[Str::slug($status->value)] = Tab::make($status->getLabel())
                ->modifyQueryUsing(fn(Builder $query) => $query->where('state', $status));
        }

        return $tabs;
    }
}
