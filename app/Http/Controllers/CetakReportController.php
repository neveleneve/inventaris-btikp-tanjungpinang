<?php

namespace App\Http\Controllers;

use App\Models\Pengelolaan;
use Illuminate\Http\Request;
use PDF;

class CetakReportController extends Controller
{
    public function cetak(Request $request)
    {
        // dd($request->all());
        if ($request['jangkax'] == 2) {
            $datapengelolaan = Pengelolaan::whereYear('created_at', $request['tahunx'])
                ->get();
        } else {
            $datapengelolaan = Pengelolaan::whereYear('created_at', $request['tahunx'])
                ->whereMonth('created_at', $request['bulanx'])
                ->get();
        }
        dd($datapengelolaan);
        return PDF::loadView('print-pengelolaan', [
            'data' => $datapengelolaan
        ])->setPaper(
            'a4',
            'potrait'
        )->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true])
            ->stream('LaporanPengelolaan-' . $datamaster['id_pengelolaan'] . '-' . now()->format('dmY') . '.pdf');
    }
}
