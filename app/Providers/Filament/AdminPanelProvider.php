<?php

namespace App\Providers\Filament;

use Althinect\FilamentSpatieRolesPermissions\FilamentSpatieRolesPermissionsPlugin;
use App\Filament\Pages\AdvancedPage;
use App\Filament\Pages\MaybankPaymentPage;
use App\Filament\Pages\GamesKeyPage;
use App\Filament\Pages\GatewayPage;
use App\Filament\Pages\LayoutCssCustom;
use App\Filament\Pages\SettingMailPage;
use App\Filament\Pages\SettingSpin;
use App\Filament\Resources\AffiliateWithdrawResource;
use App\Filament\Resources\BannerResource;
use App\Filament\Resources\CategoryResource;
use App\Filament\Resources\DepositResource;
use App\Filament\Resources\GameResource;
use App\Filament\Resources\MissionResource;
use App\Filament\Resources\OrderResource;
use App\Filament\Resources\ProviderResource;
use App\Filament\Resources\SettingResource;
use App\Filament\Resources\UserResource;
use App\Filament\Resources\VipResource;
use App\Filament\Resources\WalletResource;
use App\Filament\Resources\WithdrawalResource;
use App\Http\Middleware\CheckAdmin;
use App\Livewire\AdminWidgets;
use App\Livewire\WalletOverview;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Filament\Pages\DashboardAdmin;

class AdminPanelProvider extends PanelProvider
{
    /**
     * @param Panel $panel
     * @return Panel
     */
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('ticbet')
            ->login()
            ->colors([
                'danger' => Color::Red,
                'gray' => Color::Slate,
                'info' => Color::Blue,
                'primary' => Color::Emerald,
                'success' => Color::Emerald,
                'warning' => Color::Orange,
            ])
            ->darkMode(true)
            ->font('Roboto Condensed')
            ->brandLogo(fn () => view('filament.components.logo'))
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                DashboardAdmin::class,
            ])
            ->globalSearchKeyBindings(['command+k', 'ctrl+k'])
            ->sidebarCollapsibleOnDesktop()
            ->collapsibleNavigationGroups(true)
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                WalletOverview::class,
                AdminWidgets::class,
            ])
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                return $builder->groups([
                    NavigationGroup::make()
                        ->items([
                            NavigationItem::make('settings')
                                ->icon('heroicon-o-cog')
                                ->label(fn (): string => 'Configurações')
                                ->url(fn (): string => SettingResource::getUrl())
                                ->isActiveWhen(fn () => request()->routeIs('filament.pages.settings'))
                                ->visible(fn(): bool => auth()->user()->hasRole('admin')),
                            NavigationItem::make('gateway')
                                ->icon('heroicon-o-credit-card')
                                ->label(fn (): string => 'Gateway de Pagamentos')
                                ->url(fn (): string => GatewayPage::getUrl())
                                ->isActiveWhen(fn () => request()->routeIs('filament.pages.gateway-page'))
                                ->visible(fn(): bool => auth()->user()->hasRole('admin')),
                            NavigationItem::make('games-key')
                                ->icon('heroicon-o-key')
                                ->label(fn (): string => 'API de jogos')
                                ->url(fn (): string => GamesKeyPage::getUrl())
                                ->isActiveWhen(fn () => request()->routeIs('filament.pages.games-key-page'))
                                ->visible(fn(): bool => auth()->user()->hasRole('admin')),
                            NavigationItem::make('dashboard')
                                ->icon('heroicon-o-chart-bar')
                                ->label(fn (): string => __('filament-panels::pages/dashboard.title'))
                                ->url(fn (): string => DashboardAdmin::getUrl())
                                ->isActiveWhen(fn () => request()->routeIs('filament.pages.settings')),
                            NavigationItem::make('setting-mail')
                                ->icon('heroicon-o-mail')
                                ->label(fn (): string => 'Definições de Email')
                                ->url(fn (): string => SettingMailPage::getUrl())
                                ->isActiveWhen(fn () => request()->routeIs('filament.pages.setting-mail-page'))
                                ->visible(fn(): bool => auth()->user()->hasRole('admin')),
                            ...BannerResource::getNavigationItems(),
                            NavigationItem::make('custom-layout')
                                ->icon('heroicon-o-paint-brush')
                                ->label(fn (): string => 'Customização')
                                ->url(fn (): string => LayoutCssCustom::getUrl())
                                ->isActiveWhen(fn () => request()->routeIs('filament.pages.layout-css-custom'))
                                ->visible(fn(): bool => auth()->user()->hasRole('admin'))
                        ])
                ]);
            })
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
                CheckAdmin::class,
            ])
            ->plugin(FilamentSpatieRolesPermissionsPlugin::make())
            ;
    }
}
