<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\MasterPengelolaan;
use App\Models\Pengelolaan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class PengelolaanViewAdministrator extends Component
{
    public $ids;

    public $master;

    public $pengelolaan;

    public $items;

    public $search;

    public function render()
    {
        // $this->itemGenerate($this->search);
        return view('livewire.pengelolaan-view-administrator')
            ->extends('layouts.livewire');
    }

    public function mount()
    {
        $masterdetailing = [];
        $this->ids = Route::current()->parameter('id');
        $datamaster = MasterPengelolaan::where('id', $this->ids)->get();
        $datapengelolaan = DB::table('pengelolaans')
            ->join('items', 'pengelolaans.id_item', '=', 'items.id')
            ->join('tipe_pengelolaans', 'pengelolaans.id_tipe_pengelolaan', '=', 'tipe_pengelolaans.id')
            ->select([
                'pengelolaans.id',
                'pengelolaans.jumlah',
                'items.nama as nama_item',
                'items.satuan',
                'tipe_pengelolaans.nama as nama_pengelolaan',
                'tipe_pengelolaans.tipe',
            ])
            ->where('pengelolaans.id_pengelolaan', $datamaster[0]['id_pengelolaan'])
            ->get();
        // $dataitem =;

        $masterdetailing = [
            'id' => $datamaster[0]['id_pengelolaan'],
            'nama' => ucwords($datamaster[0]['nama_penanggung_jawab']),
        ];

        $this->master = $masterdetailing;
        $this->pengelolaan = $datapengelolaan;
        // $this->items = $dataitem;
    }

    public function goToView($route, $param = null)
    {
        if ($param == null) {
            return redirect(route($route));
        } else {
            return redirect(route($route, [$param]));
        }
    }

    // if needed
    public function itemGenerate($search = null)
    {
        if ($search != null || $search != '') {
            $this->items = Item::where('nama', 'LIKE', '%' . $search . '%')->get();
        } else {
            $this->items = Item::get();
        }
    }
}
