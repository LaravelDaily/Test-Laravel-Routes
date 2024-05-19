<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SlabResource\Pages;
use App\Models\Slab;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;


class SlabResource extends Resource
{
    protected static ?string $model = Slab::class;

    protected static ?string $slug = 'slabs';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function form(Form $form): Form
    {
        return $form->schema(components: [
            Hidden::make('user_id')->default(Auth::user()->id),

            Placeholder::make('created_at')->label('Created Date')
                ->content(fn(?Slab $record): string => $record?->created_at?->diffForHumans() ?? '-')
                ->hidden(),

            Placeholder::make('updated_at')->label('Last Modified Date')
                ->content(fn(?Slab $record): string => $record?->updated_at?->diffForHumans() ?? '-')
                ->hidden(),


            Section::make('')
                ->description('Name is required')
                ->schema([
                    TextInput::make('name')->label('Name')
                        ->required()
                        ->datalist([
                            'Calacatta Gold',
                            'Dekton Laurent',
                            'Dekton Kelya',
                        ]),

                ])->columnSpan(1)->columns(1),

            Section::make('')
                ->description('All fields are required in MM | M² is calculated automatically')
                ->schema([
                    TextInput::make('thickness')->label('Dikte')
                        ->required()
                        ->integer(),

                    TextInput::make('width')->label('Width')
                        ->required()
                        ->integer(),

                    TextInput::make('length')->label('Length')
                        ->required()
                        ->integer(),

                    TextInput::make('quantity')->label('Quantity')
                        ->required()
                        ->live()
                        ->integer(),

                    textInput::make('square_meters')->label('M²')
                        ->visible(fn(?Slab $record): string => $record ?
                            number_format((($record->width / 1000) * ($record->length / 1000)) * $record->quantity,
                                2,
                                '.',
                                '') : '0')
                        ->readOnly(),

                ])->columnSpan(1)->columns(5),

            Section::make('')
                ->description('All fields are optional')
                ->schema([
                    TextInput::make('order_number')->label('Order Number'),

                    Select::make('brand')->label('Brand')
                        ->options([
                            'Cosentino'   => 'Cosentino',
                            'Caesarstone' => 'Caesarstone',
                            'Diresco'     => 'Diresco',
                            'Compac'      => 'Compac',
                            'TheSize'     => 'TheSize',
                            'Porcelanosa' => 'Porcelanosa',
                            'Levantina'   => 'Levantina',
                            'Laminam'     => 'Laminam',
                            'Other'       => 'Other',
                        ]),

                    Select::make('supplier')->label('Supplier')
                        ->options([
                            'Cosentino'   => 'Cosentino',
                            'Caesarstone' => 'Caesarstone',
                            'Diresco'     => 'Diresco',
                            'Compac'      => 'Compac',
                            'Other'       => 'Other',
                        ]),

                    TextInput::make('price')->label('Price')
                        ->mask(RawJs::make('$money($input)'))
                        ->prefix('€')
                        ->stripCharacters(',')
                        ->numeric(),

                ])->columnSpan(1)->columns(4),

            Section::make('')
                ->description('All fields are optional')
                ->schema([
                    Select::make('type_stone')->label('Type of Stone')
                        ->options([
                            'Composite' => 'Composite',
                            'Granite'   => 'Granite',
                            'Marble'    => 'Marble',
                            'Quartz'    => 'Quartz',
                            'Quartzite' => 'Quartzite',
                            'Onyx'      => 'Onyx',
                            'Soapstone' => 'Soapstone',
                            'porcelain' => 'Porcelain',
                            'Ceramic'   => 'Ceramic',
                            'Dekton'    => 'Dekton',
                            'Neolith'   => 'Neolith'
                        ]),

                    Select::make('finishing')->label('Afwerking')
                        ->options([
                            'Geschuurd' => 'Geschuurd',
                            'Gezoet'    => 'Gezoet',
                            'Gepolijst' => 'Gepolijst'
                        ]),

                    Select::make('warehouse_position')->label('Location')
                        ->options([
                            'A1' => 'A1',
                            'A2' => 'A2',
                            'A3' => 'A3',
                            'A4' => 'A4',
                            'B1' => 'B1',
                            'B2' => 'B2',
                            'B3' => 'B3',
                            'B4' => 'B4',
                            'C1' => 'C1',
                            'C2' => 'C2',
                            'C3' => 'C3',
                            'C4' => 'C4',
                            'D1' => 'D1',
                            'D2' => 'D2',
                            'D3' => 'D3',
                            'D4' => 'D4'
                        ]),

                ])->columnSpan(1)->columns(3),

            /*Section::make('')
                ->description('')
                ->schema([
                    Select::make('brand')->label('Brand')
                        ->options([
                            'Cosentino'   => 'Cosentino',
                            'Caesarstone' => 'Caesarstone',
                            'Diresco'     => 'Diresco',
                            'Compac'      => 'Compac',
                            'TheSize'     => 'TheSize',
                            'Porcelanosa' => 'Porcelanosa',
                            'Levantina'   => 'Levantina',
                            'Laminam'     => 'Laminam',
                            'Other'       => 'Other',
                        ]),

                    Select::make('supplier')->label('Supplier')
                        ->options([
                            'Cosentino'   => 'Cosentino',
                            'Caesarstone' => 'Caesarstone',
                            'Diresco'     => 'Diresco',
                            'Compac'      => 'Compac',
                            'Other'       => 'Other',
                        ]),

                    TextInput::make('price')->label('Price'),
                ])->columnSpan(1)->columns(3),*/

            Section::make('')
                ->description('Description is optional')
                ->schema([
                    Textarea::make('description')
                        ->columnSpanFull(),

                ])->columnSpan(1)->columns(1),

            Fieldset::make('Photo is Optional')
                ->schema([
                    FileUpload::make('image')->label('Photo')
                        ->disk('public')
                        ->image()
                        ->directory('slabs')
                        ->imageEditor()
                        ->acceptedFileTypes(['image/*'])
                        ->visibility('public'),

                ])->columnSpan(1)->columns(1)

        ]);

    }

    public static function table(Table $table): Table
    {
        return $table->columns([

            ImageColumn::make('image')->label('Photo'),

            TextColumn::make('name')->searchable()->Label('Name'),

            TextColumn::make('order_number')->label('Order Number'),

            TextColumn::make('finishing')->label('Afwerking'),

            TextColumn::make('thickness')->label('Dikte (mm)'),

            TextColumn::make('quantity')->sortable()->label('Quantity'),

            TextColumn::make('square_meters')->sortable()->label('M²')
                ->default(fn(?Slab $record): string => $record ?
                    number_format((($record->width / 1000) * ($record->length / 1000)) * $record->quantity,
                        2,
                        '.',
                        '') : '0'),

            TextColumn::make('type_stone')->label('Type'),

            TextColumn::make('warehouse_position')->label('Location'),
        ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
                RestoreAction::make(),
                ForceDeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListSlab::route('/'),
            'create' => Pages\CreateSlab::route('/create'),
            'edit'   => Pages\EditSlab::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScopes([SoftDeletingScope::class,]);
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['user']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'user.name'];
    }

    public static function getGlobalSearchResultDetails(
        Model $record
    ): array{
        $details = [];

        if($record->user){
            $details['User'] = $record->user->name;
        }

        return $details;
    }
}
