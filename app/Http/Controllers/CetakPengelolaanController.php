<?php

namespace App\Http\Controllers;

use App\Models\MasterPengelolaan;
use App\Models\Pengelolaan;
use Illuminate\Http\Request;
use PDF;

class CetakPengelolaanController extends Controller
{
    public function cetak($id)
    {
        $datamaster = MasterPengelolaan::where('id_pengelolaan', $id)->firstOrFail();
        $datakelola = Pengelolaan::where('id_pengelolaan', $id)->get();
        return PDF::loadView('print-pengelolaan', [
            'id' => $id,
            'master' => $datamaster,
            'kelola' => $datakelola,
        ])
            ->setPaper(
                'a4',
                'potrait'
            )
            ->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true])
            ->stream('LaporanPengelolaan-' . $datamaster['id_pengelolaan'] . '-' . now()->format('dmY') . '.pdf');
    }
}
