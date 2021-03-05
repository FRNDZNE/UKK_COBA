@extends('layouts.app')
@section('title' , 'Buat Pengaduan')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Buat Laporan</div>
                    <div class="card-body">
                        <form action="{{route('store.pengaduan')}}" enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nik">NIK</label>
                                        <input type="number" value="{{$user->nik}}" id="nik" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col md-6">
                                    <div class="form-group">
                                        <label for="foto">Foto</label>
                                        <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="isi">Isi Laporan</label>
                                        <textarea required name="isi_laporan" id="isi" cols="30" rows="10" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row float-right">
                                <div class="col-md-12 ">
                                    <a href="{{route('index.masyarakat')}}" class="btn btn-secondary">Kembali</a>
                                    <button type="submit" class="btn btn-primary">Buat Laporan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

