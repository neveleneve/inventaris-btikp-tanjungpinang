<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\JenisItem;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class ItemViewAdministrator extends Component
{
    public $dataview = [
        'id',
        'id_jenis_item',
        'nama',
        'satuan',
        'jumlah',
    ];

    public $datapengelolaan = [];

    public $customMessages = [
        'required' => 'Bagian :attribute harus diisi!',
        'integer' => 'Bagian :attribute harus diisi dengan angka atau digit!'
    ];

    public function render()
    {
        $jenisitem = JenisItem::get();
        return view('livewire.item-view-administrator', [
            'jenisitem' => $jenisitem,
        ])->extends('layouts.livewire');
    }

    public function alert($message, $color, $alertpage = [0, 1], $idname = '')
    {
        session()->flash('message', $message);
        session()->flash('color', $color);
        if ($alertpage == 1) {
            $this->emit($idname);
        }
    }

    public function mount($id)
    {
        $datax  = DB::table('items')->join('jenis_items', 'items.id_jenis_item', '=', 'jenis_items.id')->select([
            'items.*',
            'jenis_items.nama as jenis',
        ])->where('items.id', $id)->get();
        foreach ($datax as $key) {
            $this->dataview = [
                'id' => $key->id,
                'id_jenis_item' => $key->id_jenis_item,
                'nama' => $key->nama,
                'satuan' => $key->satuan,
                'jumlah' => $key->jumlah,
            ];
        }
        $datapengelolaans = DB::table('pengelolaans')
            ->join('tipe_pengelolaans', 'pengelolaans.id_tipe_pengelolaan', '=', 'tipe_pengelolaans.id')
            ->select([
                'pengelolaans.*',
                'tipe_pengelolaans.nama',
                'tipe_pengelolaans.tipe',
            ])->where('pengelolaans.id_item', $id)->get();
        foreach ($datapengelolaans as $key => $value) {
            $this->datapengelolaan[$key] = [
                'id_pengelolaan' => $value->id_pengelolaan,
                'nama' => $value->nama,
                'jumlah' => $value->jumlah,
                'tipe' => $value->tipe,
            ];
        }
    }

    public function update()
    {
        $validasi = Validator::make(
            $this->dataview,
            [
                'nama'   => 'required',
                'satuan'   => 'required',
                'id_jenis_item'   => 'required',
            ],
            $this->customMessages
        );

        if ($validasi->fails()) {
            $this->alert('Data gagal diperbarui. Silahkan ulangi!', 'danger', 1, 'alertremove');
        } else {
            Item::where('id', $this->dataview['id'])->update([
                'id_jenis_item' => $this->dataview['id_jenis_item'],
                'nama'   => $this->dataview['nama'],
                'satuan' => $this->dataview['satuan']
            ]);
            $this->alert('Data berhasil diperbarui.', 'success', 1, 'alertremove');
        }
    }

    public function setPage($url)
    {
        $this->currentPage = explode('page=', $url)[1];
        Paginator::currentPageResolver(function () {
            return $this->currentPage;
        });
    }
}
