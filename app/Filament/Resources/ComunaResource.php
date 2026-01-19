<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComunaResource\Pages;
use App\Filament\Resources\ComunaResource\RelationManagers;
use App\Models\Comuna;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ComunaResource extends Resource
{
    protected static ?string $model = Comuna::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('gls_comuna')->required(),
                Forms\Components\Toggle::make('estado')->label('Activo'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('gls_comuna')->searchable(),
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
            'index' => Pages\ListComunas::route('/'),
            'create' => Pages\CreateComuna::route('/create'),
            'edit' => Pages\EditComuna::route('/{record}/edit'),
        ];
    }
}
