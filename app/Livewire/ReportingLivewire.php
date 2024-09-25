<?php

namespace App\Livewire;

use App\Models\Reporting;
use App\Models\Worker;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class ReportingLivewire extends Component
{
    public $open;

    public $pin;

    public $passport;

    public $worker;

    public $location;

    public $reportDescription;

    public $dateReport;

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
            $this->js('window.getGeo()');
        }
    }

    public function cancelPanel()
    {
        $this->open = 0;
        $this->worker = null;
    }

    public function submitReport()
    {
        $this->validate([
            'reportDescription' => 'required',
        ]);

        $reporting = new Reporting;
        $reporting->passport = $this->passport;
        $reporting->report_date = $this->dateReport;
        $reporting->report_description = $this->reportDescription;
        $reporting->location = $this->location;
        $reporting->save();

        session()->flash('status', 'Thank you! Report submitted!');
        $this->redirect('/reporting');
    }
}
