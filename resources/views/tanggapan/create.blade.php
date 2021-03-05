@extends('layouts.app')
@section('title', 'Buat Tanggapan')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Tanggapan</div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="isi_laporan">Isi Laporan</label>
                                        <textarea name="" disabled id="" cols="30" rows="10"
                                            class="form-control">{{ $data->isi_laporan }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
