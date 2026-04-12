<?php

namespace App\Providers\Filament;

use App\Providers\Filament\Core\Traits\HasCorePanel;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class ConfigPanelProvider extends PanelProvider
{
    use HasCorePanel;
    
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('config')
            ->path('config')
            ->discoverResources(in: app_path('Filament/Config/Resources'), for: 'App\Filament\Config\Resources')
            ->discoverPages(in: app_path('Filament/Config/Pages'), for: 'App\Filament\Config\Pages')
            ->pages([
                // Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Config/Widgets'), for: 'App\Filament\Config\Widgets')
            ->widgets([
                // AccountWidget::class,
                // FilamentInfoWidget::class,
            ]);
    }
}
