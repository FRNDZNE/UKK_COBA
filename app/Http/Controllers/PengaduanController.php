<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\User;
use App\Models\Tanggapan;
use Auth;
use File;
use PDF;

class PengaduanController extends Controller
{
    public function create()
    {
        $data = User::where('id', Auth::id())->first();
        // return $data;
        return view('pengaduan.create')->with([
            'user' => $data,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'isi_laporan' => 'required',
        ]);

        $pengaduan = new Pengaduan;
        $pengaduan->user_id = Auth::id();
        $pengaduan->tanggal = date('y-m-d');
        $pengaduan->isi_laporan = $request->isi_laporan;
        $pengaduan->status = 'dikirim';
        // Foto
        $file = $request->file('foto');

        if ($file != null) {
            $nama_foto = md5(date('dmyhis'));
            //ekstensi
            $ext = $file->getClientOriginalExtension();
            //tujuan upload
            $upload = public_path() . '/foto_laporan';
            //upload
            $simpan = $nama_foto . '.' . $ext;
            $file->move($upload, $simpan);
            $pengaduan->foto = "/foto_laporan/" . $simpan;
        } else {
            $pengaduan->foto = null;
        }

        $pengaduan->save();
        return redirect()->route('index.masyarakat');
    }


    public function edit($id)
    {
        $data = Pengaduan::where('id', $id)->with('user')->first();
        return view('pengaduan.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Pengaduan::where('id', $id)->with('user')->first();
        // return $data;

        $file_name = $data->foto;
        if ($request->foto) {
            if ($request->hasFile('foto')) {
                File::delete(public_path($data->foto));
            }
            // return 'foto dihapus';
            $file = $request->file('foto');
            // dd($file);
            //nama file
            $nama_foto = md5(date('dmyhis'));
            //ekstensi
            $ext = $file->getClientOriginalExtension();
            //tujuan upload
            $upload = public_path() . '/foto_laporan';
            //upload
            $simpan = $nama_foto . '.' . $ext;
            $file->move($upload, $simpan);
            // $data->foto = "/foto_laporan/" . $simpan;
            $file_name = "/foto_laporan/" . $simpan;
        }
        $data->update([
            'isi_laporan' => $request->isi_laporan,
            'foto' => $file_name,
        ]);

        return redirect()->route('index.masyarakat');
    }
    public function destroy($id)
    {
        $data = Pengaduan::find($id);
        if ($data->foto) {
            File::delete(public_path($data->foto));
        }

        $data->delete();
        return back();
    }

    public function cetak($id)
    {
        $pengaduan = Pengaduan::where('id',$id)->first();
        $pdf = PDF::loadview('cetak',['pengaduan'=> $pengaduan])->setPaper('a4' , 'portrait');
        return $pdf->stream('cetak');
    }
}
