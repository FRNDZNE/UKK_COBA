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
                <td>
                    @if ($pengaduan->status == 'dikirim')
                        <form action="{{ route('proses.pengaduan', $pengaduan->id) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-warning btn-sm">Proses</button>
                        </form>
                    @else
                        <button disabled="disabled" class="btn btn-warning btn-sm">Proses</button>
                    @endif
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                        data-target="#detail-{{ $pengaduan->id }}">
                        Detail
                    </button>
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
                                    <div class="col-md-6">
                                        <p>{{ $pengaduan->isi_laporan }}</p>
                                    </div>
                                    {{-- <div class="col-md-6">
                                        <img class="img-fluid" style="width: 20%" src="{{ asset($pengaduan->foto) }}"
                                            alt="Foto Tidak Ada Atau Rusak">
                                    </div> --}}
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="font-weight-bold">Tanggapan</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <form action="{{route('store.tanggapan')}}" method="POST" id="formcreate">
                                            @csrf
                                                <input type="hidden" name="pengaduan_id" value="{{$pengaduan->id}}">
                                            @if (isset($pengaduan->tanggapan->isi_tanggapan))
                                            <textarea name="isi_tanggapan" id="" cols="30" rows="10" class="form-control">{{$pengaduan->tanggapan->isi_tanggapan}}</textarea>
                                            @else
                                                <textarea placeholder="Buat Tanggapan Disini" name="isi_tanggapan"  id="" cols="30" rows="10" class="form-control"></textarea>
                                            @endif
                                        </form>
                                    </div>
                                    <div class="col-md-6">
                                        @if (isset($pengaduan->foto))
                                            <img class="img-fluid" src="{{ asset($pengaduan->foto) }}" alt="">
                                        @else
                                            <p>Foto Tidak Ada</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <a onclick="document.getElementById('formcreate').submit();" class="btn btn-info">Tanggapi</a>
                            </div>
                        </div>
                    </div>
                </div>
            </tr>
        @endforeach

    </tbody>
</table>
