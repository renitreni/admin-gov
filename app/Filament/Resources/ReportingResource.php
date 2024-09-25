<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportingResource\Pages;
use App\Models\Reporting;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ReportingResource extends Resource
{
    protected static ?string $model = Reporting::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('passport')->readOnly(),
                TextInput::make('report_date')->readOnly(),
                TextInput::make('report_description')->readOnly(),
                TextInput::make('location')->readOnly(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('passport')->sortable()->searchable(),
                TextColumn::make('report_date')->sortable()->searchable(),
                TextColumn::make('location')->sortable()->searchable(),
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
            'index' => Pages\ListReportings::route('/'),
            'edit' => Pages\EditReporting::route('/{record}/edit'),
        ];
    }
}
