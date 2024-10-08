<?php

namespace App\Livewire;

use App\Models\Reporting;
use App\Models\Rescue;
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

    public $rescueDescription;

    public function mount()
    {
        if (app()->environment('local')) {
            $worker = Worker::query()->first();
            $this->passport = $worker->passport_number;
            $this->pin = $worker->pin;
        }
        $this->dateReport = now()->format('Y-m-d');
        $this->open = 0;

        if (session('panel')) {
            $this->open = 1;
            $this->worker = session('panel');
            $this->js('window.getGeo()');
        }
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
            session(['panel' => $this->worker]);
            $this->open = 1;
            $this->js('window.getGeo()');
        }
    }

    public function cancelPanel()
    {
        $this->open = 0;
        $this->worker = null;
        session()->forget('panel');
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

        session()->forget('panel');
        session()->flash('status', 'Thank you! Report submitted!');
        $this->redirect('/reporting');
    }

    public function showRescuePanel()
    {
        $this->open = 2;
    }

    public function submitRescue()
    {

        $this->validate([
            'rescueDescription' => 'required',
        ]);

        $reporting = new Rescue;
        $reporting->passport = $this->passport;
        $reporting->rescue_status = 'rescue';
        $reporting->rescue_description = $this->rescueDescription;
        $reporting->location = $this->location;
        $reporting->save();

        session()->forget('panel');
        session()->flash('status', 'Rescue has been submitted! Wait for response.');
        $this->redirect('/reporting');
    }
}
