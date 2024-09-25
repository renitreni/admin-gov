<?php

namespace App\Livewire;

use App\Models\Agency;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Good Agencies', Agency::where('agency_status', 'good')->count())
                ->description('Active Agencies')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
            Stat::make('Warning Agencies', Agency::where('agency_status', 'warning')->count())
                ->description('Agencies with offenses')
                ->descriptionIcon('heroicon-m-face-frown'),
            Stat::make('Banned Agencies', Agency::where('agency_status', 'banned')->count())
                ->description('Agencies that has been blocked')
                ->descriptionIcon('heroicon-m-arrow-trending-down'),
        ];
    }
}
