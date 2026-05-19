<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\Page;

class OrderDepartmentList extends ListRecords
{
    protected static string $resource = OrderResource::class;

    // protected string $view = 'filament.resources.orders.pages.order-department-list';
}
