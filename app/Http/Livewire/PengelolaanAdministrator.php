<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PengelolaanAdministrator extends Component
{
    public function render()
    {
        return view('livewire.pengelolaan-administrator')
            ->extends('layouts.livewire');
    }
}
