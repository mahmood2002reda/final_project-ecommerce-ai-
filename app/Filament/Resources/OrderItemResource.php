<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderItemResource\Pages;
use App\Filament\Resources\OrderItemResource\RelationManagers;
use App\Models\OrderItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderItemResource extends Resource
{
    protected static ?string $model = OrderItem::class;
    protected static ?string $label = 'Orders';
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }
    public static function canCreate(): bool
    {
        return false;
    }



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
               TextColumn::make('product.name')->searchable()->toggleable()->sortable(),
               TextColumn::make('ProductOption.color.color')->searchable()->toggleable()->sortable(),
               TextColumn::make('ProductOption.size.size')->searchable()->toggleable()->sortable(),
               TextColumn::make('quantity')->searchable()->toggleable()->sortable(),
               TextColumn::make('price'),
               TextColumn::make('order.fullname')->label('Order Owner')->searchable()->toggleable()->sortable(),
               TextColumn::make('order.status_message')->label('Order Status')->searchable()->toggleable()
               ->sortable()->badge(),
               TextColumn::make('order.address')->label('Order Address')->searchable()->toggleable()->sortable(),
               TextColumn::make('order.phone')->label('Owner Phone')->searchable()->toggleable()->sortable(),


            ])
            ->filters([
                //
            ])
            ->actions([
                //Tables\Actions\EditAction::make(),
                 Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListOrderItems::route('/'),
           // 'create' => Pages\CreateOrderItem::route('/create'),
            'edit' => Pages\EditOrderItem::route('/{record}/edit'),
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery()->withoutGlobalScopes([SoftDeletingScope::class]);
        if (auth()->guard('vendor')->check()) {
            $query->whereHas('product',function($q){
                $q->whereIn('brand_id', auth()->guard('vendor')->user()->brands->where('active',1)->pluck('id'));
            });
        }
        return $query;
    }
}
