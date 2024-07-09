<?php

namespace App\Filament\Resources\ProductResource\Widgets;

use App\Models\Product;
use Filament\Widgets\ChartWidget;

class TrendingProductChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        $trending=Product::where('trending',1)->whereHas('brand',function ($query) {
            $query->where('vendor_id',auth()->guard('vendor')->id());
        })->count();
        $intrending=Product::where('trending',0)->whereHas('brand',function ($query) {
            $query->where('vendor_id',auth()->guard('vendor')->id());
        })->count();

        return [
            'datasets' => [
                [
                    'label' => 'Trending Products',
                    'data' => [$trending,$intrending],
                    'backgroundColor'=> [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',

                      ],
                ],

            ],
            'labels' => ['Trending','In Trending'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
