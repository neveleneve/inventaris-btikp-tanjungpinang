<?php

namespace App\Http\Livewire;

use App\Models\MasterPengelolaan;
use Illuminate\Pagination\Paginator;
use Livewire\Component;

class PengelolaanAdministrator extends Component
{
    public $pengelolaan;

    public $inputdata = [
        'id_pengelolaan' => '',
        'nama_penanggung_jawab' => '',
        'pengelolaan' => [],
    ];

    public function render()
    {
        return view('livewire.pengelolaan-administrator')
            ->extends('layouts.livewire');
    }

    public function goToView($route, $param = null)
    {
        if ($param == null) {
            return redirect(route($route));
        } else {
            return redirect(route($route, [$param]));
        }
    }

    public function cleartext()
    {
        // 
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
