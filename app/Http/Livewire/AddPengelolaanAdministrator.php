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

    public $itemselected = [];

    public $checkboxselectedstate;

    public $tipepengelolaan;

    public $search;

    public function render()
    {
        $this->itemGenerate($this->search);
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

        $jenispengelolaan = TipePengelolaan::get();

        $this->generateItemState();
        $this->datapengelolaan['id'] = $idpengelolaan;
        $this->tipepengelolaan = $jenispengelolaan;
    }

    public function generateItemState()
    {
        $itemlist = Item::get();
        foreach ($itemlist as $value) {
            $this->checkboxselectedstate[$value['id']] = [
                'enable' => 0,
            ];
        }
    }

    public function checkedItem($id)
    {
        $state = $this->checkboxselectedstate[$id]['enable'];
        if ($state == 1) {
            $this->checkboxselectedstate[$id]['enable'] = 0;
            unset($this->itemselected[$id]);
        } else {
            $getdata = Item::where('id', $id)->get();
            $this->itemselected[$id] = [
                'id' => $id,
                'nama' => $getdata[0]['nama'],
                'jenis' => 0,
                'jumlah' => 0,
            ];
            $this->checkboxselectedstate[$id]['enable'] = 1;
        }
    }

    public function itemGenerate($search = null)
    {
        if ($search != null || $search != '') {
            $this->itemlist = Item::where('nama', 'LIKE', '%' . $search . '%')->get();
        } else {
            $this->itemlist = Item::get();
        }
    }
}
