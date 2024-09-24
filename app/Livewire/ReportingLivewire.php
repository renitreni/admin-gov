<?php

namespace App\Livewire;

use App\Models\Worker;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class ReportingLivewire extends Component
{
    public $open;

    public $pin;

    public $passport;

    public $dateReport;

    public $worker;

    public function mount()
    {
        if (app()->environment('local')) {
            $worker = Worker::query()->first();
            $this->passport = $worker->passport_number;
            $this->pin = $worker->pin;
        }
        $this->dateReport = now()->format('Y-m-d');
        $this->open = 0;
    }

    public function render()
    {
        return view('livewire.reporting-livewire')->layout('layouts.guest');
    }

    public function showPanel()
    {
        $this->validate([
            'passport' => 'required',
            'pin' => 'required',
        ]);

        $this->worker = Cache::rememberForever('report-'.$this->passport.$this->pin, function () {
            return Worker::with('agency')
                ->where('passport_number', $this->passport)
                ->where('pin', $this->pin)
                ->first();
        });

        if (empty($this->worker)) {
            $this->addError('authentication', 'Details does not exist!');
        } else {
            $this->open = 1;
        }

        // "id" => 1
        // "worker_uuid" => "d140f6e8-9f6b-44a0-a60b-278282535696"
        // "first_name" => "Obie"
        // "last_name" => "Kiehn"
        // "middle_name" => "Altenwerth"
        // "pin" => "1649"
        // "suffix_name" => null
        // "passport_number" => "FCTHPSYG3ZP"
        // "passport_expiry_date" => "2031-11-19"
        // "visa_type" => "worker"
        // "visa_number" => "POCAQH80"
        // "visa_expiry_date" => "2025-11-28"
        // "national_id_number" => "KOQACQDWVY1"
        // "residency_address" => """
        //   547 Pacocha Plains Suite 313
    
        //   Buckridgefort, WY 77773-4039
        //   """
        // "emergency_contact_name" => "Domenica Kris"
        // "emergency_contact_phone" => "(831) 362-3617"
        // "emergency_contact_relationship" => "relative"
        // "created_at" => "2024-09-24 07:23:31"
        // "updated_at" => "2024-09-24 07:23:31"
        // "deleted_at" => null
    }

    public function cancelPanel()
    {
        $this->open = 0;
        $this->worker = null;
    }
}
