<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

//


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-m-user';

    /*public static function canViewAny(): bool
    {
        return auth()->user() && auth()->user()->hasAnyRole(['super_admin', 'admin']);
    }*/


    public static function form(Form $form): Form
    {

        return $form
            ->schema([


                        Section::make('User Information')
                            ->description('Please, fill in the details below.')
                            ->schema([
                                TextInput::make('name')->label('Name')
                                    ->required()
                                    ->autocomplete('name'),

                                TextInput::make('email')->label('Email')
                                    ->required()
                                    ->autocomplete('email'),


                            ])->columnSpan(1)->columns(1),

                        Section::make('Please, fill in the details below.')
                            ->description('Please, fill in the details below.')
                            ->schema([

                                Select::make('roles')
                                    ->preload()
                                    ->relationship('roles', 'name')
                                    ->label('Access Level')
                                    ->required(),

                                TextInput::make('password')->label('Password')
                                    ->password()
                                    ->revealable()
                                //                            ->required()

                            ])->columnSpan(1)->columns(1),


            ]);


    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(components: array(
                /*Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->primary(),*/
                TextColumn::make('name')
                    ->icon('heroicon-m-user')
                    ->iconColor('primary')
                    ->sortable()
                    ->searchable()
                    ->label('Name'),

                TextColumn::make('email')
                    ->icon('heroicon-m-envelope')
                    ->iconColor('primary')
                    ->fontFamily('mono')
                    ->sortable()
                    ->searchable()
                    ->label('Email'),

                /**
                 * Cria uma coluna na tabela para exibir os papéis (roles) do usuário.
                 * @method label 'Roles' Define o rótulo da coluna.
                 * @method make  'roles' Cria uma nova coluna de texto com o nome 'roles'.
                 * @method name  'roles.name' Define o nome da coluna que será usada para buscar os dados.
                 * Neste caso, 'roles.name' indica que estamos buscando o nome do papel (role) na relação 'roles'.
                 */
                TextColumn::make('roles')->label('Access Level')
                    ->name('roles.name')
                    ->color('access_level')
                    ->sortable()
                    ->searchable()
                    ->badge(),

            ))
            ->filters([
                //
            ])
            ->actions([
                EditAction::make()
                /*->using(function (Model $record, array $data): Model {
                    // Busca o nome do papel pelo ID
                    $roleName = Role::find($data['role_id'])->name;

                    // Remove todos os papéis atuais do usuário e atribui o novo papel
                    $record->syncRoles([$roleName]);

                    // Atualiza o campo 'model_type' na tabela pivot para 'App\Models\User'
                    DB::table('model_has_roles')
                        ->where('model_id', $record->id)
                        ->update(['model_type' => 'App\Models\User']);

                    return $record;
                })*/,
                DeleteAction::make(),

            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [

        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit'   => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
