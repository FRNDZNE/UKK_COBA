<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->hasRole(['admin', 'petugas'])) {
            $data['pengaduan'] = Pengaduan::all();
            // $data['tanggapan'] = Tanggapan::with(['user', 'pengaduan'])->get();
        } else {
            // $data['pengaduan'] = Pengaduan::where('user_id', Auth::id())->with(['user', 'tanggapan' => fn ($q) => $q->with('user')])->get();
            $data['pengaduan'] = Pengaduan::where('user_id',Auth::id())->get();
        }
        // return $data;
        return view('home', compact('data'));
    }
}
