<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RescueResource\Pages;
use App\Models\Rescue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RescueResource extends Resource
{
    protected static ?string $model = Rescue::class;

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationIcon = 'heroicon-o-shield-exclamation';

    public static function canCreate(): bool
    {
        return false;
    }
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('passport')->disabled(),
                TextInput::make('rescue_description')->disabled(),
                TextInput::make('location')->disabled(),
                Select::make('rescue_status')->options([
                    'rescue' => 'Rescue',
                    'resolved' => 'Resolved',
                    'pedning' => 'Pending',
                ]),
                Textarea::make('rescue_remarks')->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('passport'),
                TextColumn::make('rescue_status'),
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
            'index' => Pages\ListRescues::route('/'),
            'create' => Pages\CreateRescue::route('/create'),
            'edit' => Pages\EditRescue::route('/{record}/edit'),
        ];
    }
}
