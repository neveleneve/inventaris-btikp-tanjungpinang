<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ItemAdministrator extends Component
{
    public function render()
    {
        return view('livewire.item-administrator')
        ->extends('layouts.livewire');
    }
}
