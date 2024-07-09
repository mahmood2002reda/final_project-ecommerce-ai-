<?php

namespace App\Filament\Resources\BrandResource\Widgets;

use App\Models\Brand;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BrandStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('All Brands', Brand::where('vendor_id',auth()->guard('vendor')->id())->count())
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->description('+ increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('info'),
            Stat::make('Active Brands', Brand::where('vendor_id',auth()->guard('vendor')->id())->where('active',1)->count())
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->description('+ increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success'),
            Stat::make('In Active Brands', Brand::where('vendor_id',auth()->guard('vendor')->id())->where('active',0)->count())
            ->chart([7, 20, 25, 30, 20, 25, 17])
            ->description('- decrease')
            ->descriptionIcon('heroicon-m-arrow-trending-down')
            ->color('danger'),
        ];
    }
}
