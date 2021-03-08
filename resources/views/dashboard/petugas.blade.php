<table class="table text-center">
    <thead>
        <tr>
            <th>No</th>
            <th>Pelapor</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data['pengaduan'] as $key => $pengaduan)
            <tr>
                <td scope="row">{{ $key + 1 }}</td>
                <td>{{ $pengaduan->user->name }}</td>
                <td>
                    @if ($pengaduan->status == 'dikirim')
                        <span class="badge bg-danger">Belum Ditanggapi</span>
                    @elseif($pengaduan->status == 'proses')
                        <span class="badge bg-warning">Proses</span>
                    @else
                        <span class="badge bg-success">Selesai</span>
                    @endif
                </td>
                <form id="proses-{{$pengaduan->id}}" action="{{route('proses.pengaduan',$pengaduan->id)}}" method="post">
                    @csrf
                </form>
                <form id="selesai-{{$pengaduan->id}}" action="{{route('selesai',$pengaduan->id)}}" method="post">
                    @csrf
                </form>
                <td>
                    @if ($pengaduan->status == 'proses')
                        <button disabled="disabled" class="btn btn-warning btn-sm">Proses</button>
                        <a onclick="document.getElementById('selesai-{{$pengaduan->id}}').submit();" class="btn btn-success btn-sm">Selesai</a>
                    @elseif($pengaduan->status == 'selesai')
                        <button disabled="disabled" class="btn btn-warning btn-sm">Proses</button>
                        <button disabled="disabled" class="btn btn-success btn-sm">Selesai</button>
                    @else
                        <a onclick="document.getElementById('proses-{{$pengaduan->id}}').submit();" class="btn btn-warning btn-sm">Proses</a>
                        <button disabled="disabled" class="btn btn-success btn-sm">Selesai</button>
                    @endif
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                        data-target="#detail-{{ $pengaduan->id }}">
                        Detail
                    </button>
                    @role('admin')
                        <a href="{{route('cetak',$pengaduan->id)}}" target="_blamk" class="btn btn-secondary text-light btn-sm">Cetak</a>
                    @endrole
                </td>
                {{-- Modal Detail --}}
                <div class="modal fade" id="detail-{{ $pengaduan->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-info">
                                <h5 class="modal-title">Detail Pengaduan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="font-weight-bold">Isi Laporan</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="font-weight-bold">Foto</p>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6 flex-column  ">

                                        <div class="col-md-12">
                                            <p>{{ $pengaduan->isi_laporan }}</p>
                                        </div>
                                        <div class="col-md-12 ">
                                            <label class="font-weight-bold">Tanggapan</label>
                                            <form action="{{route('store.tanggapan')}}" method="POST" id="formcreate-{{$pengaduan->id}}">
                                                @csrf
                                                    <input type="hidden" name="pengaduan_id" value="{{$pengaduan->id}}">
                                                @if (isset($pengaduan->tanggapan->isi_tanggapan))
                                                    @if ($pengaduan->status == 'selesai')
                                                        <textarea disabled cols="30" rows="10" class="form-control">{{$pengaduan->tanggapan->isi_tanggapan}}</textarea>
                                                    @else
                                                        <textarea name="isi_tanggapan" cols="30" rows="10" class="form-control">{{$pengaduan->tanggapan->isi_tanggapan}}</textarea>
                                                    @endif
                                                @else
                                                    @if ($pengaduan->status == 'dikirim')
                                                        <textarea disabled placeholder="Buat Tanggapan Disini"  cols="30" rows="10" class="form-control"></textarea>
                                                    @else
                                                        <textarea placeholder="Buat Tanggapan Disini" name="isi_tanggapan"  cols="30" rows="10" class="form-control"></textarea>
                                                    @endif
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-md-6 align-items-start">
                                        @if (isset($pengaduan->foto))
                                            <img class="img-fluid" style="height: 50vh;width:auto;" src="{{ asset($pengaduan->foto) }}" alt="Foto Rusak">
                                        @else
                                            <p>Foto Tidak Ada</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                @if ($pengaduan->status == 'dikirim' || $pengaduan->status == 'selesai' )
                                    <button disabled="disabled" class="btn btn-info">Tanggapi</button>
                                @else
                                    <a onclick="document.getElementById('formcreate-{{$pengaduan->id}}').submit();" class="btn btn-info">Tanggapi</a>
                                    {{-- <a href="#" onclick="event.preventDefault(); document.getElementById('formcreate').submit();">Tanggapi</a> --}}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </tr>
        @endforeach

    </tbody>
</table>
