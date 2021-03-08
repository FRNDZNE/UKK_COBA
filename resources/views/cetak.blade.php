<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak</title>
    <style>
        body{
            display: flex;
            flex-direction: column;

        }
        .text-center{
            text-align: center;
        }

        .foto{
            margin-top: 20px;
            margin-bottom: 20px;
        }

        img.laporan{
            width: 20rem;
            height: auto;
        }


    </style>
</head>
<body>
    <h1 class="text-center">Pengaduan Masyarakat</h1><br>
    <table width="100%">
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td>{{$pengaduan->user->nik}}</td>
            {{-- Tanggapan --}}
            <td>Di Tanggapi Oleh</td>
            <td>:</td>
            <td>{{$pengaduan->tanggapan->user->name}}</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{$pengaduan->user->name}}</td>
            {{-- Tanggal Ditanggapi --}}
            <td>Pada Tanggal</td>
            <td>:</td>
            <td>{{date('d, F Y', strtotime($pengaduan->tanggapan->tanggal))}}</td>
        </tr>
        <tr>
            <td>No Telepon</td>
            <td>:</td>
            <td>{{$pengaduan->user->telp}}</td>
        </tr>
        <tr>
            <td>Tanggal Pengaduan</td>
            <td>:</td>
            <td>{{date('d, F Y', strtotime($pengaduan->tanggal))}}</td>
        </tr>
    </table>
    <div class="foto">
        <img class="laporan" src="{{asset($pengaduan->foto)}}" alt="">
    </div>
    <table width="100%" border="1">
        <thead>
            <tr>
                <th width="50%">Isi Laporan</th>
                <th width="50%">Tanggapan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$pengaduan->isi_laporan}}</td>
                <td>{{$pengaduan->tanggapan->isi_tanggapan}}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
