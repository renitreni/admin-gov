<?php

namespace App\Livewire;

use App\Models\Rescue;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;

class RescueAlert extends Widget
{
    protected int|string|array $columnSpan = 2;

    protected static string $view = 'livewire.rescue-alert';

    #[On('rescueBanner')]
    public function rescueBanner()
    {
        Log::info('Notification Recevied ' . now() . ' ' . json_encode(auth()->user()));
    }

    protected function getViewData(): array
    {
        return [
            'rescueCount' => Rescue::query()->where('rescue_status', 'pending')->count(),
        ];
    }
}
