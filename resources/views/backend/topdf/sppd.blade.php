@extends('backend.topdf.layout')
@section('content')
<style>
    .page {
        width: 100%;
        height: 100%;
    }

    .sppd tr td {
        border-left: none
    }

    .sppd tr td {
        border-top: 1px solid #000;
        padding: 6px
    }

    .sppds tr td {
        border-top: 1px solid #000;
        padding-bottom: 35px
    }

    .sppd tr td:last-child {
        border-bottom: 1px solid #000;
    }

    .sppd tr td ol {
        margin: 0 0 0 20px;
        padding: 0
    }

    .sppd tr td.no {
        vertical-align: top;
        padding-right: 5px
    }

    .sppd tr td.tengah {
        border-right: 1px solid #000
    }
</style>
<div class="page">

    <img src="{{$kop->file->url_stream.'?t='.time() ?? '#'}}" style="width:100%" alt="">
    <br>
    <br>
    <table style="width:250px;" align="right">
        <tr>
            <td style="width:50%">Lembar ke </td>
            <td>:</td>
        </tr>
        <tr>
            <td style="width:50%">Kode No</td>
            <td>:</td>
        </tr>
        <tr>
            <td>Nomor</td>
            <td>: {{$pegawai->no_sppd??''}}</td>
        </tr>
    </table>
    <br>
    <br>
    <center>
        <span style="border-bottom:2px solid #000">SURAT PERINTAH PERJALANAN DINAS</span><br>
        <span>(SPPD)</span>
    </center>
    <br>
    <br>
    <table style="width:100%;border-collapse:collapse" class="sppd">
        <tr>
            <td class="no" style="width:2%">1.</td>
            <td style="width:48%;vertical-align:top" class="tengah">Pejabat yang memberikan Perintah</td>
            <td style="width:50%">KEPALA {{Str::upper($kop->nama)}}</td>
        </tr>
        <tr>
            <td class="no">2.</td>
            <td class="tengah" style="vertical-align:top">Nama pegawai yang diperintah</td>
            <td>{{$pegawai->nama_pegawai}}</td>
        </tr>
        <tr>
            <td class="no">3.</td>
            <td class="tengah">
                <ol style="list-style-type: lower-alpha;">
                    <li>Pangkat dan Golongan menurut PP NO. 6 Tahun 1997</li>
                    <li>Jabatan</li>
                    <li>Tingkat perjalanan menurut peraturan Perjalanan</li>
                </ol>
            </td>
            <td style="vertical-align:top;">{{$pegawai->pangkat}}<br><br>{{$pegawai->jabatan}} {{$pegawai->nama_bidang != 'Kantor' ? ($pegawai->nama_bidang!='Sekretariat' ? 'Bidang '.$pegawai->nama_bidang: $pegawai->nama_bidang) : '' }}<br><p style="margin-top:5px">{{$pegawai->tingkat}}</p></td>
        </tr>
        <tr>
            <td class="no">4.</td>
            <td class="tengah">Maksud perjalanan</td>
            <td>{{$data->maksud_perjalanan}}</td>
        </tr>
        <tr>
            <td class="no">5.</td>
            <td class="tengah">Alat angkutan yang digunakan</td>
            <td>@foreach(json_decode($pegawai->angkutan) as $r) {{$r}}{{!$loop->last ?',':''}} @endforeach</td>
        </tr>
        <tr>
            <td class="no">6.</td>
            <td class="tengah">
                <ol style="list-style-type: lower-alpha;">
                    <li>Tempat Berangkat</li>
                    <li>Tempat Tujuan</li>
                </ol>
            </td>
            <td >{{$pegawai->tempat_berangkat}}<br>{{$pegawai->tempat_tujuan}}</td>
        </tr>
        <tr>
            <td class="no">7.</td>
            <td class="tengah">
                <ol style="list-style-type: lower-alpha;">
                    <li>Lamanya perjalanan pinas</li>
                    <li>Tanggal berangkat</li>
                    <li>Tanggal harus kembali</li>
                </ol>
            </td>
            <td style="vertical-align:top">{{Help::lamahari($pegawai->tanggal_berangkat,$pegawai->tanggal_kembali)}} ({{config('master.angka_indo.'.Help::lamahari($pegawai->tanggal_berangkat,$pegawai->tanggal_kembali))}}) hari<br>
            {{Help::tglindo($pegawai->tanggal_berangkat)}}<br>
            {{Help::tglindo($pegawai->tanggal_kembali)}}

        </td>
        </tr>
        <tr>
            <td class="no">8.</td>
            <td class="tengah">Pengikut</td>
            <td>-</td>
        </tr>
        <tr>
            <td class="no">9.</td>
            <td class="tengah">Pembayaran<ol style="list-style-type: lower-alpha;">
                    <li>Instansi</li>
                    <li>Mata Anggaran</li>
                </ol>
            </td>
            <td style="vertical-align:top"><br>{{$kop->nama}}<br>{{$data->kegiatan->kode_rekening}}</td>
        </tr>
        <tr>
            <td class="no" style="border-bottom:1px solid #000">10.</td>
            <td style="border-bottom:1px solid #000" class="tengah">Keterangan Lain-lain</td>
            <td></td>
        </tr>

    </table>

    <br> <br>
    <table style="width:290px;" align="right">
        <tr>
            <td>Ditetapkan di Bengkalis<br>Pada tanggal {{Help::tglindo($data->tanggal_penetapan)}}
                <p style="margin-top:7px">{{$data->pegawai->jabatan->nama == 'Kepala Dinas'? 'KEPALA': Str::upper($data->pegawai->jabatan->nama)}} {{Str::upper($kop->nama)}}</p>
                <br>
                <br>

                <span>{{Str::upper($data->pegawai->nama)}}</span><br>
                {{Str::upper($data->pegawai->pangkat)}}<br>
                NIP. {{Str::upper($data->pegawai->nip)}}
            </td>
        </tr>

    </table>
</div>
<div class="page">
    <table style="width:300px;" align="right">
        <tr>
            <td style="width:4%">I.</td>
            <td style="width:46%">SPPD No.</td>
            <td style="width:50%">: {{$pegawai->no_sppd??''}}</td>
        </tr>
        <tr>
            <td></td>
            <td>Berangkat dari (tempat kedudukan)</td>
            <td style="vertical-align:top">: {{$data->tempat_berangkat}}</td>
        </tr>
        <tr>
            <td></td>
            <td>Pada tanggal</td>
            <td>: {{Help::tglindo($data->tanggal_berangkat)}}</td>
        </tr>
        <tr>
            <td></td>
            <td>Ke</td>
            <td>: {{$data->tempat_tujuan}}</td>
        </tr>
    </table>
    <br>
    <br>

    <table style="width:100%;border-collapse:collapse" class="sppds">
        <tr>
            <td style="width:2%;vertical-align:top;padding-top:20px;padding-right:10px">II.</td>
            <td style="width:20%;">Tiba di<br>Pada tanggal<br>Kepala</td>
            <td style="width:30%;padding-top:20px">: {{$pegawai->tempat_tujuan}}<br>: {{Help::tglindo($data->tanggal_kembali)}}<br>:<br><br></td>
            <td style="width:20%;padding-top:20px">Berangkat Dari<br>Ke<br>Pada tanggal<br>Kepala</td>
            <td style="width:28%;padding-top:0">: {{$pegawai->tempat_berangkat}} <br>: {{$pegawai->tempat_tujuan}} <br>: {{Help::tglindo($data->tanggal_berangkat)}}</td>
        </tr>
        <tr>
            <td style="width:2%;vertical-align:top;padding-top:20px;padding-right:10px">III.</td>
            <td style="width:20%;">Tiba di<br>Pada tanggal<br>Kepala</td>
            <td style="width:30%;padding-top:20px">:<br>:<br>:<br><br></td>
            <td style="width:20%;padding-top:20px">Berangkat Dari<br>Ke<br>Pada tanggal<br>Kepala</td>
            <td style="width:28%;padding-top:0">: <br>: <br>:<br></td>
        </tr>
        <tr>
            <td style="width:2%;vertical-align:top;padding-top:20px;padding-right:10px;border-bottom:1px solid #000">IV.
            </td>
            <td style="width:20%;border-bottom:1px solid #000">Tiba di<br>Pada tanggal<br>Kepala</td>
            <td style="width:30%;padding-top:20px;border-bottom:1px solid #000">:<br>:<br>:<br><br></td>
            <td style="width:20%;padding-top:20px;border-bottom:1px solid #000">Berangkat Dari<br>Ke<br>Pada
                tanggal<br>Kepala</td>
            <td style="width:28%;padding-top:0;border-bottom:1px solid #000">:<br>: <br>:<br></td>
        </tr>


    </table>

    <br>
    <table style="width:450px;" align="right">
        <tr>
            <td style="width:2%">V.</td>
            <td style="width:25%">Tiba di</td>
            <td style="width:73%">: {{$data->tempat_berangkat}}</td>
        </tr>
        <tr>
            <td style="width:2%"></td>
            <td style="width:25%">Pada tanggal</td>
            <td style="width:73%">: {{Help::tglindo($data->tanggal_kembali)}}</td>
        </tr>
        <tr>
            <td></td>

            <td colspan="2" style="padding-right:40px">
                Telah diperiksa, dengan keterangan bahwa perjalanan Tersebut di atas benar dilakukan atas perintahnya
                dan semata-mata untuk kepentingan jabatan dalam waktu yang sesingkat-singkatnya.
            </td>
        </tr>
    </table>
    <br>
    <table style="width:290px;" align="right">
        <tr>
            <td>
                <p style="margin-top:7px">{{$data->pegawai->jabatan->nama == 'Kepala Dinas'? 'KEPALA': Str::upper($data->pegawai->jabatan->nama)}} {{Str::upper($kop->nama)}}</p>
                <br>
                <br>

                <span>{{Str::upper($data->pegawai->nama)}}</span><br>
                {{Str::upper($data->pegawai->pangkat)}}<br>
                NIP. {{Str::upper($data->pegawai->nip)}}
            </td>
        </tr>

    </table>
    <br>
    <style>
        .bot tr td {
            border-top: 1px solid #000
        }
    </style>
    <table style="width:100%;border-collapse:collapse" class="bot">
        <tr>
            <td style="width:5%">VI.</td>
            <td style="width:95%">CATATAN LAIN-LAIN</td>
        </tr>
        <tr>
            <td style="vertical-align:top">VII.</td>
            <td>PERHATIAN
                <br>
                <p style="text-align:justify">Pejabat yang berwenang menerbitkan SPPD, pegawai yang melakukan perjalan
                    dinas, para pejabat yang mengesahkan tanggal berangkat/tiba serta Bendaharawan bertanggung jawab
                    berdasarkan peraturan-peraturan Keuangan Negara, apabila negara mendapat rugi akibat kesalahan,
                    kealpaannya.</p>
            </td>
        </tr>
    </table>
</div>
@endsection