<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArchivoResource\Pages;
use App\Filament\Resources\ArchivoResource\RelationManagers;
use App\Models\Archivo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ArchivoResource extends Resource
{
    protected static ?string $model = Archivo::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')->required(),
                Forms\Components\TextInput::make('path')->required(),
                Forms\Components\Select::make('id_tipo')
                    ->label('Tipo de Archivo')
                    ->options(\App\Models\Tipo::where('tipo', 1)->pluck('gls_tipo', 'id'))
                    ->required(),
                Forms\Components\Toggle::make('estado')->label('Activo'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')->searchable(),
                Tables\Columns\TextColumn::make('path')->limit(30),
                Tables\Columns\IconColumn::make('estado')->boolean()->label('Activo'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListArchivos::route('/'),
            'create' => Pages\CreateArchivo::route('/create'),
            'edit' => Pages\EditArchivo::route('/{record}/edit'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
}
