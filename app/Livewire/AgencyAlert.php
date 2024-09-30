<?php

namespace App\Livewire;

use App\Models\Agency;
use Filament\Widgets\Widget;

class AgencyAlert extends Widget
{
    protected int|string|array $columnSpan = 2;

    protected static string $view = 'livewire.agency-alert';

    protected function getViewData(): array
    {
        return [
            'agencyBanned' => Agency::query()->where('agency_status', 'banned')->count(),
        ];
    }
}
