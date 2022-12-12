<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ReportAdministrator extends Component
{
    public function render()
    {
        return view('livewire.report-administrator')
            ->extends('layouts.livewire');
    }
}
