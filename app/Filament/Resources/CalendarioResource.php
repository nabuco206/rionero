<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CalendarioResource\Pages;
use App\Models\Calendario;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CalendarioResource extends Resource
{
    protected static ?string $model = Calendario::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('id_proyecto')
                ->label('Proyecto')
                ->relationship('proyecto', 'nombre')
                ->preload()
                ->required(),
            Forms\Components\Toggle::make('estado')->label('Activo'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('id'),
            Tables\Columns\TextColumn::make('proyecto.nombre')->label('Proyecto'),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCalendarios::route('/'),
            'create' => Pages\CreateCalendario::route('/create'),
            'edit' => Pages\EditCalendario::route('/{record}/edit'),
        ];
    }
}
