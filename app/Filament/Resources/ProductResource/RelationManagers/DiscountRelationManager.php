<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DiscountRelationManager extends RelationManager
{
    protected static string $relationship = 'discount';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Offer')->schema([
                        TextInput::make('offer_price')->label('Offer Price')->numeric()->rules('min:-9999.00'),

                    ]),                ])->columnSpanFull(),
                Group::make()->schema([
                    Section::make('Offer Date')->schema([
                        DateTimePicker::make('special_price_start'),
                        DateTimePicker::make('special_price_end'),
                    ])->columns(2),

                ])->columnSpanFull(),

            ])->columns(2);
    }

    public function table(Table $table): Table
    {
        return $table

            ->columns([
                Tables\Columns\TextColumn::make('product.name')->label('Product')->searchable()->toggleable()->sortable(),
                Tables\Columns\TextColumn::make('offer_price')->label('Offer Price')->searchable()->toggleable()->sortable(),
                TextColumn::make('special_price_start')->label('Start Offer')->searchable()->toggleable()->sortable(),
                TextColumn::make('special_price_end')->label('End Offer')->searchable()->toggleable()->sortable(),
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
