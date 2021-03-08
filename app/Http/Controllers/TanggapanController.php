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
        // $data = $request->all();
        // dd ($data);
        // dd ($data);
        $pengaduan = Pengaduan::find($request->pengaduan_id);

    	$data = $pengaduan->tanggapan()->updateOrCreate(['pengaduan_id' => $request->pengaduan_id], [
    		'user_id' => Auth::id(),
            'tanggal' => date('y-m-d'),
    		'isi_tanggapan' => $request->isi_tanggapan,
    	]);

    	$pengaduan->save();

    	return back();


    }

    public function selesai($id)
    {
        $data = Pengaduan::find($id);
        $data->update([
            'status' => 'selesai',
        ]);

        return back();
    }


}
