<?php

namespace App\Livewire;

use App\Models\Rescue;
use Filament\Widgets\Widget;

class RescueAlert extends Widget
{
    protected int|string|array $columnSpan = 2;

    protected static string $view = 'livewire.rescue-alert';

    protected function getViewData(): array
    {
        return [
            'rescueCount' => Rescue::query()->where('rescue_status', 'rescue')->count(),
        ];
    }
}
