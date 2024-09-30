<?php

namespace App\Filament\Resources\RescueResource\Pages;

use App\Filament\Resources\RescueResource;
use App\Livewire\AgencyAlert;
use App\Livewire\RescueAlert;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRescues extends ListRecords
{
    protected static string $resource = RescueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            AgencyAlert::class,
            RescueAlert::class
        ];
    }
}
