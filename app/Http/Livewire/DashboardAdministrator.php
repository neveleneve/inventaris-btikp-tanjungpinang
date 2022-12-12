<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DashboardAdministrator extends Component
{
    public function render()
    {
        return view('livewire.dashboard-administrator')
            ->extends('layouts.livewire');
    }
}
