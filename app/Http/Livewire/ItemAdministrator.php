<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\JenisItem;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class ItemAdministrator extends Component
{

    use WithPagination;

    public $pencarian;

    public $inputdata = [
        'nama' => '',
        'satuan' => '',
        'id_jenis_item' => ''
    ];

    public $deletedata = [
        'id' => '',
        'nama' => '',
    ];

    public $customMessages = [
        'required' => 'Bagian :attribute harus diisi!',
        'integer' => 'Bagian :attribute harus diisi dengan angka atau digit!'
    ];

    public function setPage($url)
    {
        $this->currentPage = explode('page=', $url)[1];
        Paginator::currentPageResolver(function () {
            return $this->currentPage;
        });
    }

    public function goToView($id)
    {
        return redirect(route('itemview', ['id' => $id]));
    }

    public function render()
    {
        if ($this->pencarian == null || $this->pencarian == '') {
            $data = DB::table('items')
                ->join('jenis_items', 'items.id_jenis_item', '=', 'jenis_items.id')
                ->select([
                    'items.*',
                    'jenis_items.nama as jenis'
                ])
                // ->orderBy('items.created_at')
                ->paginate(10);
        } else {
            $data = DB::table('items')
                ->join('jenis_items', 'items.id_jenis_item', '=', 'jenis_items.id')
                ->select([
                    'items.*',
                    'jenis_items.nama as jenis'
                ])
                ->where('items.nama', 'LIKE', '%' . $this->pencarian . '%')
                // ->orderBy('items.created_at')
                ->paginate(10);
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
                'satuan'   => 'required',
                'id_jenis_item'   => 'required',
            ],
            $this->customMessages
        );

        if ($validasi->fails()) {
            $this->alert('Data gagal ditambah. Silahkan ulangi!', 'danger', 1, 'alertremove');
        } else {
            Item::insert([
                'id_jenis_item' => $this->inputdata['id_jenis_item'],
                'nama'   => $this->inputdata['nama'],
                'satuan' => $this->inputdata['satuan'],
                'jumlah' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            $this->cleartext();
            $this->alert('Data berhasil ditambah.', 'success', 1, 'alertremove');
        }
    }

    public function alert($message, $color, $alertpage = [0, 1], $idname = '')
    {
        session()->flash('message', $message);
        session()->flash('color', $color);
        if ($alertpage == 1) {
            $this->emit($idname);
        }
    }

    public function cleartext()
    {
        $this->inputdata = [
            'nama' => '',
            'satuan' => '',
            'id_jenis_item' => ''
        ];

        $this->viewdata = [
            'id' => null,
            'id_jenis_item' => '',
            'nama' => '',
            'satuan' => '',
            'jumlah' => ''
        ];

        $this->pengelolaan = [
            'id_pengelolaan' => '',
            'tipe' => '',
            'jumlah' => '',
        ];

        $this->deletedata = [
            'id' => '',
            'nama' => '',
        ];
    }

    public function viewitem($id)
    {
        $this->cleartext();
        $item = Item::where('id', $id)->get();
        $this->deletedata = [
            'id' => $id,
            'nama' => $item[0]['nama'],
        ];
    }

    public function delete($id)
    {
        Item::where('id', $id)->delete();
        $this->cleartext();
        $this->alert('Data berhasil dihapus.', 'success', 1, 'alertremove');
    }
}
