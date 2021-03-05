@extends('layouts.app')
@section('title' , 'Dashboard')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @role(['admin' , 'petugas'])
            <div class="row mb-5">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            Jumlah Laporan
                        </div>
                        <div class="card-body">
                            <h1 class="text-center">{{count($data['pengaduan'])}}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            Belum Ditanggapi
                        </div>
                        <div class="card-body">
                            <h1 class="text-center">{{count($data['pengaduan']->where('status' , 'dikirim'))}}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            Dalam Proses
                        </div>
                        <div class="card-body">
                            <h1 class="text-center">{{count($data['pengaduan']->where('status' , 'proses'))}}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            Sudah Ditanggapi
                        </div>
                        <div class="card-body">
                            <h1 class="text-center">{{count($data['pengaduan']->where('status' , 'selesai'))}}</h1>
                        </div>
                    </div>
                </div>

            </div>
            @endrole
            @role('masyarakat')
            <div class="row mb-5">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            Jumlah Laporan
                        </div>
                        <div class="card-body">
                            <h1 class="text-center">{{count($data['pengaduan'])}}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            Belum Ditanggapi
                        </div>
                        <div class="card-body">
                            <h1 class="text-center">{{count($data['pengaduan']->where('status','dikirim'))}}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            Dalam Proses
                        </div>
                        <div class="card-body">
                            <h1 class="text-center">{{count($data['pengaduan']->where('status','proses'))}}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            Sudah Ditanggapi
                        </div>
                        <div class="card-body">
                            <h1 class="text-center">{{count($data['pengaduan']->where('status','selesai'))}}</h1>
                        </div>
                    </div>
                </div>
            </div>
            @endrole
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @role(['admin' , 'petugas'])
                        @include('dashboard.petugas')
                    @endrole
                    @role('masyarakat')
                        @include('dashboard.masyarakat')
                    @endrole
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
