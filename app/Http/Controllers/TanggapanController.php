<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tanggapan;
use App\Models\Pengaduan;
use App\Models\User;
use Auth;

class TanggapanController extends Controller
{
    public function proses($id)
    {
        $data = Pengaduan::where('id', $id)->first();
        $data->update([
            'status' => 'proses',
        ]);

        return back();
    }

    public function store_tanggapan(Request $request)
    {
        Tanggapan::updateOrCreate([
            'user_id' => Auth::id(),
            'pengaduan_id' => $request->pengaduan_id,
            'isi_tanggapan' => $request->isi_tanggapan,
        ]);

        Pengaduan::updateOrCreate([
            'status' => 'selesai',
        ]);

        return back();

    }


}
