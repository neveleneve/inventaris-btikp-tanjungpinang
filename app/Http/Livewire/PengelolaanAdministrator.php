<?php

namespace App\Http\Livewire;

use App\Models\MasterPengelolaan;
use Illuminate\Pagination\Paginator;
use Livewire\Component;

class PengelolaanAdministrator extends Component
{
    public $pengelolaan;
    public function render()
    {
        return view('livewire.pengelolaan-administrator')
            ->extends('layouts.livewire');
    }

    public function setPage($url)
    {
        $this->currentPage = explode('page=', $url)[1];
        Paginator::currentPageResolver(function () {
            return $this->currentPage;
        });
    }
    public function mount()
    {
        $pengelolaan = MasterPengelolaan::orderBy('id')->get();
        $this->pengelolaan = $pengelolaan;
    }
}
