<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DashboardAdministrator extends Component
{
    public $dataset;

    public $label;

    public $penjualan;

    public $year;

    public function render()
    {
        // ubah untuk data inventaris
        if ($this->year == null) {
            $this->year = date('Y');
        }

        $tahun = $this->year;

        if ($tahun == 2022) {
            $this->penjualan = [34, 12, 82, 12, 44, 98, 18, 45, 12, 100, 10, 0];
        } else {
            $this->penjualan = [12, 82, 12, 44, 98, 18, 45, 12, 100, 10, 0, 34];
        }

        $this->label = [
            'Jan ' . $tahun,
            'Feb ' . $tahun,
            'Mar ' . $tahun,
            'Apr ' . $tahun,
            'Mei ' . $tahun,
            'Jun ' . $tahun,
            'Jul ' . $tahun,
            'Agu ' . $tahun,
            'Sep ' . $tahun,
            'Okt ' . $tahun,
            'Nov ' . $tahun,
            'Des ' . $tahun
        ];

        $this->dataset = [
            [
                'label' => 'Data Penjualan',
                'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
                'borderColor' => 'rgba(255, 99, 132, 1)',
                'borderWidth' => '1',
                'data' => $this->penjualan,
            ]
        ];

        $dataset = $this->dataset;
        $label = $this->label;

        return view('livewire.dashboard-administrator', compact('dataset', 'label'))
            ->extends('layouts.livewire');
    }

    public function load()
    {
        // ubah untuk data inventaris
        if ($this->year == null) {
            $this->year = date('Y');
        }

        $tahun = $this->year;

        if ($tahun == 2022) {
            $this->penjualan = [34, 12, 82, 12, 44, 98, 18, 45, 12, 100, 10, 0];
        } else {
            $this->penjualan = [12, 82, 12, 44, 98, 18, 45, 12, 100, 10, 0, 34];
        }

        $this->label = [
            'Jan ' . $tahun,
            'Feb ' . $tahun,
            'Mar ' . $tahun,
            'Apr ' . $tahun,
            'Mei ' . $tahun,
            'Jun ' . $tahun,
            'Jul ' . $tahun,
            'Agu ' . $tahun,
            'Sep ' . $tahun,
            'Okt ' . $tahun,
            'Nov ' . $tahun,
            'Des ' . $tahun
        ];

        $this->dataset = [
            [
                'label' => 'Data Penjualan',
                'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
                'borderColor' => 'rgba(255, 99, 132, 1)',
                'borderWidth' => '1',
                'data' => $this->penjualan,
            ]
        ];

        $dataset = $this->dataset;
        $label = $this->label;

        $this->emit('updateChart', [
            'labels' => $this->label,
            'datasets' => $this->dataset
        ]);
    }
}
