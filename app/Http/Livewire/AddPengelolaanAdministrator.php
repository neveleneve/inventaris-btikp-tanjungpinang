<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\MasterPengelolaan;
use App\Models\Pengelolaan;
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

  public $inputerror = [
    'nama' => '',
    'item' => '',
  ];

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

  public function kembali()
  {
    return redirect(route('pengelolaan'));
  }

  public function jenisPengelolaan($id)
  {
    $nama = '';
    if ($id == 0) {
      $nama = 'Belum dipilih';
    } else {
      $jenis = TipePengelolaan::where('id', $id)->get();
      $nama = $jenis[0]['nama'];
    }
    return $nama;
  }

  public function store()
  {
    // cek master
    if ($this->datapengelolaan['nama'] == null || $this->datapengelolaan['nama'] == '') {
      $this->inputerror['nama'] = 0;
    } else {
      $this->inputerror['nama'] = 1;
    }

    // cek item
    if (count($this->itemselected) > 0) {
      foreach ($this->itemselected as $value) {
        if ($value['jenis'] == 0 || $value['jumlah'] == 0) {
          $this->inputerror['item'] = 0;
          break;
        } else {
          $this->inputerror['item'] = 1;
        }
      }
    } else {
      $this->inputerror['item'] = 0;
    }

    if ($this->inputerror['nama'] == 1 && $this->inputerror['item'] == 1) {
      $idpengelolaan = $this->datapengelolaan['id'];
      MasterPengelolaan::insert([
        'id_pengelolaan' => $idpengelolaan,
        'nama_penanggung_jawab' => $this->datapengelolaan['nama'],
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]);

      foreach ($this->itemselected as $value) {
        $jenispengelolaan = TipePengelolaan::where('id', $value['jenis'])->get();
        $tipe = $jenispengelolaan[0]['tipe'];
        if ($tipe == '+') {
          Item::where('id', $value['id'])->increment('jumlah', $value['jumlah']);
        } elseif ($tipe == '-') {
          Item::where('id', $value['id'])->decrement('jumlah', $value['jumlah']);
        }
        Pengelolaan::insert([
          'id_pengelolaan' => $idpengelolaan,
          'id_item' => $value['id'],
          'id_tipe_pengelolaan' => $value['jenis'],
          'jumlah' => $value['jumlah'],
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),
        ]);
      }
      return redirect(route('pengelolaan'))->with([
        'message' => 'Berhasil menambah data pengelolaan',
        'color' => 'success',
      ]);
    }
  }
}
