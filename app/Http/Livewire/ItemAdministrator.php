<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\JenisItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class ItemAdministrator extends Component
{
    public $pencarian;

    public $inputdata = [
        'nama' => '',
        'id_jenis_item' => ''
    ];

    public $viewdata = [
        'id' => null,
        'id_jenis_item' => '',
        'nama' => '',
        'jumlah' => '',
        'pengelolaan' => []
    ];

    public $customMessages = [
        'required' => 'Bagian :attribute harus diisi!',
        'integer' => 'Bagian :attribute harus diisi dengan angka atau digit!'
    ];

    public function render()
    {
        if ($this->pencarian == null || $this->pencarian == '') {
            $data = DB::table('items')
                ->join('jenis_items', 'items.id_jenis_item', '=', 'jenis_items.id')
                ->select([
                    'items.*',
                    'jenis_items.nama as jenis'
                ])
                ->get();
        } else {
            $data = DB::table('items')
                ->join('jenis_items', 'items.id_jenis_item', '=', 'jenis_items.id')
                ->select([
                    'items.*',
                    'jenis_items.nama as jenis'
                ])
                ->where('items.nama', 'LIKE', '%' . $this->pencarian . '%')
                ->get();
        }
        $jenisitem = JenisItem::get();
        return view('livewire.item-administrator', [
            'items' => $data,
            'jenisitems' => $jenisitem,
        ])->extends('layouts.livewire');
    }

    public function store()
    {
        $validasi = Validator::make(
            $this->inputdata,
            [
                'nama'   => 'required',
                'id_jenis_item'   => 'required',
            ],
            $this->customMessages
        );

        if ($validasi->fails()) {
            session()->flash('message', 'Data gagal ditambah. Silahkan ulangi!');
            session()->flash('color', 'danger');
            $this->emit('alertremove');
        } else {
            Item::insert([
                'id_jenis_item' => $this->inputdata['id_jenis_item'],
                'nama'   => $this->inputdata['nama'],
                'jumlah' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            $this->cleartext();
            session()->flash('message', 'Data berhasil ditambah.');
            session()->flash('color', 'success');
            $this->emit('alertremove');
        }
    }

    public function cleartext()
    {
        $this->inputdata['nama'] = '';
        $this->viewdata = [
            'id' => null,
            'nama' => '',
            'jumlah' => '',
            'pengelolaan' => []
        ];
    }

    public function viewitem($id)
    {
        $item = Item::where('id', $id)->get();
        $this->viewdata = [
            'id' => $id,
            'id_jenis_item' => $item[0]['id_jenis_item'],
            'nama' => $item[0]['nama'],
            'jumlah' => $item[0]['jumlah'],
            'pengelolaan' => []
        ];
    }
}
