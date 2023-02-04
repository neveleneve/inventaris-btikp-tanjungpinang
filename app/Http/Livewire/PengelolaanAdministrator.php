<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\MasterPengelolaan;
use App\Models\Pengelolaan;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PengelolaanAdministrator extends Component
{
    public $pengelolaan;

    public $selectdeleted = [
        'id' => 0,
        'nama' => '',
    ];

    public $pencarian;

    public function render()
    {
        $this->generateData($this->pencarian);
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

    public function setPage($url)
    {
        $this->currentPage = explode('page=', $url)[1];
        Paginator::currentPageResolver(function () {
            return $this->currentPage;
        });
    }

    public function generateData($search)
    {
        if ($search == null || $search == '') {
            $pengelolaan = MasterPengelolaan::orderBy('id')->get();
            # code...
        } else {
            $pengelolaan = MasterPengelolaan::where('nama_penanggung_jawab', 'LIKE', '%' . $search . '%')
                ->orWhere('id_pengelolaan', 'LIKE', '%' . $search . '%')
                ->orderBy('id')
                ->get();
        }
        $this->pengelolaan = $pengelolaan;
    }

    public function selectitem($id)
    {
        $item = MasterPengelolaan::where('id', $id)->get();
        $this->selectdeleted = [
            'id' => $item[0]['id'],
            'nama' => $item[0]['id_pengelolaan'],
        ];
    }

    public function cleartext()
    {
        $this->selectdeleted = [
            'id' => 0,
            'nama' => '',
        ];
    }

    public function delete($id)
    {
        $datamaster = MasterPengelolaan::where('id', $id)->get();
        $idpengelolaan = $datamaster[0]['id_pengelolaan'];
        $datapengelolaan = DB::table('pengelolaans')
            ->join('tipe_pengelolaans', 'pengelolaans.id_tipe_pengelolaan', '=', 'tipe_pengelolaans.id')
            ->select([
                'pengelolaans.id_item',
                'pengelolaans.jumlah',
                'tipe_pengelolaans.tipe',
            ])
            ->where('pengelolaans.id_pengelolaan', $idpengelolaan)
            ->get();
        foreach ($datapengelolaan as $value) {
            if ($value->tipe == '+') {
                Item::where('id', $value->id_item)->decrement('jumlah', $value->jumlah);
            } else {
                Item::where('id', $value->id_item)->increment('jumlah', $value->jumlah);
            }
        }

        MasterPengelolaan::where('id', $id)->delete();
        Pengelolaan::where('id_pengelolaan', $idpengelolaan)->delete();
        $this->cleartext();
        $this->alert('Data berhasil dihapus.', 'success', 1, 'alertremove');
    }

    public function alert($message, $color, $alertpage = [0, 1], $idname = '')
    {
        session()->flash('message', $message);
        session()->flash('color', $color);
        if ($alertpage == 1) {
            $this->emit($idname);
        }
    }

    public function cetak($id)
    {
        $this->emit('cetak', $id);
        // return redirect(route('pengelolaancetak', ['id' => $id]));
    }
}
