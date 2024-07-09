<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BrandResource\Pages;
use App\Filament\Resources\BrandResource\RelationManagers;
use App\Models\Brand;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
class BrandResource extends Resource
{
    protected static ?string $model = Brand::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make('New Brand')->schema([
                    TextInput::make('name')->required()->maxLength(50)->rules('required|string')
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (string $operation,string $state,Set $set){
                        if($operation === 'edit')return;
                          $set('slug',str::slug($state));
                    }),
                    TextInput::make('slug')->required()->unique(ignoreRecord: true)->rules('required'),
                    Toggle::make('active'),
                    Hidden::make('vendor_id')->default(auth()->guard('vendor')->id())
                ])->columns(2),


            ])->columns(2);
    }

    public static function table(Table $table): Table
    {

        return $table
            ->columns([
               TextColumn::make('name')->searchable()->sortable()->toggleable()->sortable(),
               TextColumn::make('slug')->searchable()->sortable()->toggleable()->sortable(),
               ToggleColumn::make('active'),
               TextColumn::make('created_at')->label('Created')->date('Y-m-d')->sortable()->searchable()->toggleable()
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBrands::route('/'),
            'create' => Pages\CreateBrand::route('/create'),
            'edit' => Pages\EditBrand::route('/{record}/edit'),
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        if (auth()->guard('vendor')->check()) {
            $query->where('vendor_id', auth()->guard('vendor')->id());
        }
        return $query;
    }

}
