<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\MasterPengelolaan;
use App\Models\TipePengelolaan;
use Livewire\Component;

class AddPengelolaanAdministrator extends Component
{
    public $datapengelolaan = [
        'id' => '',
        'nama' => ''
    ];

    public $itemlist;

    public $itemselected;

    public $tipepengelolaan;

    public function render()
    {

        return view('livewire.add-pengelolaan-administrator')
            ->extends('layouts.livewire');
    }

    public function generateID()
    {
        $jumlahdata = MasterPengelolaan::count();
        $strlen = strlen($jumlahdata);
        $idloop = '';
        $id = '';

        if ($strlen == 0) {
            $id = 'PL-000001';
        } else {
            for ($i = 0; $i < 6 - $strlen; $i++) {
                $idloop .= '0';
            }
            $id = 'PL-' . $idloop . ($jumlahdata + 1);
        }
        return $id;
    }

    public function goToView($route, $param = null)
    {
        if ($param == null) {
            return redirect(route($route));
        } else {
            return redirect(route($route, [$param]));
        }
    }

    public function mount()
    {
        $idpengelolaan = $this->generateID();
        $itemlist = Item::get();
        $jenispengelolaan = TipePengelolaan::get();

        $this->datapengelolaan['id'] = $idpengelolaan;
        $this->itemlist = $itemlist;
        $this->tipepengelolaan = $jenispengelolaan;
    }
}
