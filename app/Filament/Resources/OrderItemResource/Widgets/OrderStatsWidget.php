<?php

namespace App\Filament\Resources\OrderItemResource\Widgets;

use App\Models\Orderitem;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrderStatsWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    protected function getStats(): array
    {
        return [
            Stat::make('All Orders', Orderitem::whereHas('product',function($q){
                $q->whereIn('brand_id', auth()->guard('vendor')->user()->brands->pluck('id'));
            })->count())
            ->chart([7, 4, 20, 15, 18, 12, 25])
            ->description('+ increase')
            ->descriptionIcon('heroicon-o-shopping-cart')
            ->color('gray'),
            Stat::make('Pending Orders', Orderitem::whereHas('order',function($q){
                $q->where('status_message','Pending');
            })
            ->whereHas('product',function($q){
                $q->whereIn('brand_id', auth()->guard('vendor')->user()->brands->pluck('id'));
            })->count())
            ->chart([7, 20, 30, 18, 15, 19, 6])
            ->description('+ decrease')
            ->descriptionIcon('heroicon-o-shopping-cart')
            ->color('danger'),
            Stat::make('Completed Orders', Orderitem::whereHas('order',function($q){
                $q->where('status_message','Completed');
            })
            ->whereHas('product',function($q){
                $q->whereIn('brand_id', auth()->guard('vendor')->user()->brands->pluck('id'));
            })->count())
            ->chart([7, 4, 20, 15, 20, 15, 40])
            ->description('+ increase')
            ->descriptionIcon('heroicon-o-shopping-cart')
            ->color('success'),
        ];
    }
}
