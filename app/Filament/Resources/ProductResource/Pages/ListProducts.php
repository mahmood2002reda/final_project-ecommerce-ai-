<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Components\Tab;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    public function getTabs(): array
    {


        foreach (auth()->guard('vendor')->user()->brands as $brand) {
            $tabs['All Brands']=Tab::make()->icon('heroicon-o-inbox');
            $tabs[$brand->name] = Tab::make()->modifyQueryUsing(fn(Builder $query) => $query->where('brand_id', $brand->id));
        }

        return $tabs;
    }
}
