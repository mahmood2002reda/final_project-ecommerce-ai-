<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Filament\Resources\ProductResource\RelationManagers\DiscountRelationManager;
use App\Filament\Resources\ProductResource\RelationManagers\ProductImagesRelationManager;
use App\Filament\Resources\ProductResource\RelationManagers\ProductOptionsRelationManager;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Filament\Tables\Actions\Action;
class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Tabs::make('New Product')
                ->schema([
                    Tab::make('Main')
                        ->schema([
                            Group::make()->schema([
                                Section::make()
                                    ->schema([
                                        TextInput::make('name')
                                            ->required()
                                            ->maxLength(50)
                                            ->rules('required|string')
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(function (string $operation, string $state, Set $set) {
                                                if ($operation === 'edit') {
                                                    return;
                                                }
                                                $set('slug', str::slug($state));
                                            }),
                                        TextInput::make('slug')->required()->unique(ignoreRecord: true)->rules('required'),
                                        Select::make('brand_id')
                                        ->options(auth()->guard('vendor')->user()->brands->where('active',1)->pluck('name','id'))
                                        ->searchable()->preload()
                                        ,
                                        Select::make('categories')
                                               ->relationship('categories','name')
                                               ->searchable()->preload()->multiple(),
                                        Toggle::make('active'),
                                        Toggle::make('trending'),
                                    ])
                                    ->columns(2),
                            ]),
                        ])
                        ->columnSpanFull(),
                    Tab::make('Content')->schema([
                        Group::make()->schema([
                            Section::make()
                                ->schema([TextInput::make('small_description')->required()->maxLength(100)->rules('required'),
                                 MarkdownEditor::make('description')])
                                ->columns(1),
                        ]),
                    ]),
                    Tab::make('Meta')->schema([
                        Group::make()->schema([
                            Section::make()
                                ->schema([TextInput::make('meta_title')->nullable(), TextInput::make('meta_keyword')->nullable(),
                                TextInput::make('meta_description')->nullable()])
                                ->columns(1),
                        ]),
                    ]),
                    Tab::make('Price')->schema([
                        Group::make()->schema([
                            Section::make()
                                ->schema([TextInput::make('original_price')->required()->rules('required')->integer(),
                                TextInput::make('sku')->label('Code')->nullable()])
                                ->columns(2),

                        ]),
                    ]),

                ])
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->toggleable()->sortable(),
                TextColumn::make('slug')->searchable()->toggleable()->sortable(),
                TextColumn::make('original_price')->label('price')->searchable()->toggleable(),
                TextColumn::make('brand.name')->badge()->searchable()->toggleable(),
                ToggleColumn::make('active'),
                ToggleColumn::make('trending'),
                TextColumn::make('created_at')->label('Created')->date('Y-m-d')->sortable()->searchable()->toggleable()
            ])
            ->filters([
                TernaryFilter::make('trending')->label('products')->placeholder('All products')->trueLabel('Trending')->falseLabel('In Trending'),
                Tables\Filters\TrashedFilter::make()

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                ])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make(), Tables\Actions\ForceDeleteBulkAction::make(), Tables\Actions\RestoreBulkAction::make()])]);
    }

    public static function getRelations(): array
    {
        return [
                ProductImagesRelationManager::class,
                ProductOptionsRelationManager::class,
                DiscountRelationManager::class,
            ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    // public static function getEloquentQuery(): Builder
    // {
    //     return parent::getEloquentQuery()->withoutGlobalScopes([SoftDeletingScope::class]);
    // }
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery()->withoutGlobalScopes([SoftDeletingScope::class]);
        if (auth()->guard('vendor')->check()) {
            $query->whereIn('brand_id', auth()->guard('vendor')->user()->brands->where('active',1)->pluck('id'));
        }
        return $query;
    }
}
