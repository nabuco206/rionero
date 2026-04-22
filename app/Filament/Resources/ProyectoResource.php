<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProyectoResource\Pages;
use App\Filament\Resources\ProyectoResource\RelationManagers;
use App\Models\Proyecto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProyectoResource extends Resource
{
    protected static ?string $model = Proyecto::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('codigo')->required()->numeric(),
                Forms\Components\TextInput::make('nombre')->required(),
                Forms\Components\Select::make('id_comuna')
                    ->label('Comuna')
                    ->options(\App\Models\Comuna::where('estado', true)->pluck('gls_comuna', 'id')->toArray())
                    ->preload()
                    ->required()
                    ->native(false),
                Forms\Components\Select::make('status')
    ->options([
        'draft' => 'Draft',
        'reviewing' => 'Reviewing',
        'published' => 'Published',
    ])
    ->native(false),
                Forms\Components\TextInput::make('supervisor_1'),
                Forms\Components\TextInput::make('supervisor_2'),
                Forms\Components\TextInput::make('nmro_beneficiarios')->numeric(),
                Forms\Components\DatePicker::make('fecha'),
                Forms\Components\Select::make('id_programa')
                    ->label('Programa')
                    ->relationship('programa', 'gls_programa')
                    ->preload()
                    ->required(),
                Forms\Components\Toggle::make('estado')->label('Activo'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('codigo')->sortable(),
                Tables\Columns\TextColumn::make('nombre')->searchable(),
                Tables\Columns\TextColumn::make('comuna.gls_comuna')->label('Comuna'),
                Tables\Columns\TextColumn::make('supervisor_1'),
                Tables\Columns\TextColumn::make('supervisor_2'),
                Tables\Columns\TextColumn::make('nmro_beneficiarios'),
                Tables\Columns\TextColumn::make('fecha')->date(),
                Tables\Columns\TextColumn::make('programa.gls_programa')->label('Programa'),
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
            'index' => Pages\ListProyectos::route('/'),
            'create' => Pages\CreateProyecto::route('/create'),
            'edit' => Pages\EditProyecto::route('/{record}/edit'),
        ];
    }
}
