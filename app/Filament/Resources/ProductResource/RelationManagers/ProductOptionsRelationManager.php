<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductOptionsRelationManager extends RelationManager
{
    protected static string $relationship = 'productOptions';
    protected static ?string $label = 'Options';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
               Group::make()->schema([
                Section::make('New Option')->schema([
                    Select::make('size_id')->label('Size')
                    ->searchable()->preload()
                    ->options(Size::where('active',1)->pluck('size','id')),
                    Select::make('color_id')->label('Color')
                    ->searchable()->preload()
                    ->options(Color::where('active',1)->pluck('color','id')),
                    TextInput::make('extra_price')->numeric()->required()->label('Extra Price')
                    ->live(onBlur: true)
                    ->afterStateUpdated(function($operation,$state,Set $set,Get $get){
                        $original_price=Product::find( $this->getOwnerRecord()->getKey())->original_price;
                        $set('selling_price',$state+$original_price);
                    }),

                    TextInput::make('quantity')->numeric()->default(0),
                    TextInput::make('selling_price')->numeric()->label('Selling Price')->columnSpanFull(),
                ])->columns(2),

               ])->columnSpanFull()
                ]);
    }

    public function table(Table $table): Table
    {
        return $table

            ->columns([
               TextColumn::make('product.name')->searchable()->sortable()->toggleable(),
               TextColumn::make('color.color')->searchable()->sortable()->toggleable(),
               TextColumn::make('size.size')->searchable()->sortable()->toggleable(),
               TextColumn::make('quantity')->searchable()->sortable()->toggleable(),
               TextColumn::make('extra_price')->label('Extra Price')->searchable()->sortable()->toggleable(),
               TextColumn::make('selling_price')->label('Selling Price')->searchable()->sortable()->toggleable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
