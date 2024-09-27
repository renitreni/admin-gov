<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkerResource\Pages;
use App\Models\Worker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class WorkerResource extends Resource
{
    protected static ?string $model = Worker::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('first_name')->required(),
                TextInput::make('last_name')->required(),
                TextInput::make('middle_name')->required(),
                TextInput::make('suffix_name'),
                TextInput::make('passport_number')->required()->unique(ignoreRecord: true),
                TextInput::make('passport_expiry_date')->required(),
                TextInput::make('visa_type'),
                TextInput::make('visa_number'),
                TextInput::make('visa_expiry_date'),
                TextInput::make('national_id_number'),
                TextInput::make('residency_address'),
                TextInput::make('emergency_contact_name'),
                TextInput::make('emergency_contact_phone'),
                TextInput::make('emergency_contact_relationship'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('fullname')->sortable(['first_name', 'last_name'])->searchable(['first_name', 'last_name']),
                TextColumn::make('passport_number')->sortable()->searchable(),
                TextColumn::make('national_id_number')->sortable()->searchable(),
                TextColumn::make('agency.agency_name')->sortable()->searchable(),
                TextColumn::make('agency.agency_status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'warning' => 'warning',
                        'good' => 'success',
                        'banned' => 'danger',
                    })
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
            'index' => Pages\ListWorkers::route('/'),
            'create' => Pages\CreateWorker::route('/create'),
            'edit' => Pages\EditWorker::route('/{record}/edit'),
        ];
    }
}
