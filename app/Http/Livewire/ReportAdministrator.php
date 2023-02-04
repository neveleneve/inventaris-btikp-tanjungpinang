<?php

namespace App\Http\Livewire;

use App\Models\TipePengelolaan;
use Livewire\Component;

class ReportAdministrator extends Component
{
    public $bulan = [
        'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember',
    ];
    public $state = [
        'jenis' => 0,
        'jangka' => 0,
        'bulan' => 0,
        'tahun' => 0,
    ];
    public $statecheck = [
        'jenis' => 0,
        'jangka' => 0,
        'bulan' => 0,
        'tahun' => 0,
    ];
    public function render()
    {
        $this->buttonstate();
        $tipe = TipePengelolaan::get();
        return view('livewire.report-administrator', [
            'tipe' => $tipe
        ])->extends('layouts.livewire');
    }

    public function buttonstate()
    {
        if ($this->state['jenis'] == 0) {
            $this->statecheck['jenis'] = 0;
        } else {
            $this->statecheck['jenis'] = 1;
        }
        if ($this->state['jangka'] == 0) {
            $this->statecheck['jangka'] = 0;
        } else {
            $this->statecheck['jangka'] = 1;
        }
        if ($this->state['jangka'] == 2) {
            $this->statecheck['bulan'] = 1;
        } else {
            if ($this->state['bulan'] == 0) {
                $this->statecheck['bulan'] = 0;
            } else {
                $this->statecheck['bulan'] = 1;
            }
        }
        if ($this->state['tahun'] == 0) {
            $this->statecheck['tahun'] = 0;
        } else {
            $this->statecheck['tahun'] = 1;
        }
        if (array_sum($this->statecheck) != 4) {
            return 'disabled';
        } else {
            return null;
        }
    }

    public function cetak()
    {
        $this->emit('cetak', $this->state);
    }
}
