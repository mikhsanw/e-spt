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
        border: 1px solid #000;
        padding: 6px
    }

    .sppds tr td {
        border-top: 1px solid #000;
        padding: 2px;
        padding-bottom: 70px;
        line-height: 16px;
    }
    .sppds tr.nopb td {
        border-top: 1px solid #000;
        padding: 6px;
    }
    .sppds{
        border: 1px solid #000;
    }
    .sppds .tengah{
        border-right: 1px solid #000;
        
    }
    .sppds tr.offatas td{
        border-top: 0px;
        padding-bottom: 6px;
    }
    .sppds tr.offbawah td{
        border-bottom: 0px;
        padding-bottom: 6px;
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
    .bot tr td {
            border-top: 1px solid #000
        }
    .footer {
    position: fixed;
    left: 0;
    bottom: -40px;
    width: 100%;
    color: rgb(0, 0, 0);
    text-align: center;
    }

    ul {
        margin-top: 5px;
        margin-left: -20px;
    }
    hr {
        max-width: 90%;
        margin: 0px;
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
    <center>
        <span style="border-bottom:1px solid #000">SURAT PERJALANAN DINAS</span> (SPD)
    </center>
    <br>
    <table style="width:100%;border-collapse:collapse;" class="sppd">
        <tr>
            <td class="no" style="width:2%">1.</td>
            <td style="width:48%;vertical-align:top" class="tengah">Pengguna Anggaran</td>
            <td style="width:50%" colspan="2">KEPALA {{Str::upper($kop->nama)}} KABUPATEN BENGKALIS</td>
        </tr>
        <tr>
            <td class="no">2.</td>
            <td class="tengah" style="vertical-align:top">Nama/NIP pegawai yang melaksanakan perjalanan dinas</td>
            <td colspan="2">{{$pegawai->nama_pegawai}} <br>-</td>
        </tr>
        <tr>
            <td class="no">3.</td>
            <td class="tengah" style="vertical-align:top;">
                <ol style="list-style-type: lower-alpha;">
                    <li>Pangkat dan Golongan</li>
                    <li>Jabatan/Instansi</li>
                    <li>Tingkat biaya perjalanan dinas</li>
                </ol>
            </td>
            <td style="vertical-align:top;" colspan="2">
            <ol style="list-style-type: lower-alpha;">
                <li>{{$pegawai->pangkat}}</li>
                <li>{{$pegawai->jabatan}} {{$pegawai->nama_bidang != 'Kantor' ? ($pegawai->nama_bidang!='Sekretariat' ? 'Bidang '.$pegawai->nama_bidang: $pegawai->nama_bidang) : '' }}</li>
                <li>Tingkat {{$pegawai->tingkat}}</li>
            </ol>
            </td>
        </tr>
        <tr>
            <td class="no">4.</td>
            <td class="tengah">Maksud perjalanan dinas</td>
            <td colspan="2">{{$data->maksud_perjalanan}}</td>
        </tr>
        <tr>
            <td class="no">5.</td>
            <td class="tengah">Alat angkut yang dipergunakan</td>
            <td colspan="2">
                <ol style="list-style-type: lower-alpha;">
                @foreach(json_decode($pegawai->angkutan) as $r) 
                    <li>{{$r}}{{!$loop->last ?',':''}} </li>
                @endforeach
                </ol>
            </td>
        </tr>
        <tr>
            <td class="no">6.</td>
            <td class="tengah">
                <ol style="list-style-type: lower-alpha;">
                    <li>Tempat Berangkat</li>
                    <li>Tempat Tujuan</li>
                </ol>
            </td>
            <td colspan="2">
                <ol style="list-style-type: lower-alpha;">
                    <li>{{$pegawai->tempat_berangkat}}</li>
                    <li>{{$pegawai->tempat_tujuan}}</li>
                </ol>
            </td>
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
            <td style="vertical-align:top" colspan="2">
                <ol style="list-style-type: lower-alpha;">
                    <li>{{Help::lamahari($pegawai->tanggal_berangkat,$pegawai->tanggal_kembali)}} ({{config('master.angka_indo.'.Help::lamahari($pegawai->tanggal_berangkat,$pegawai->tanggal_kembali))}}) hari</li>
                    <li>{{Help::tglindo($pegawai->tanggal_berangkat)}}</li>
                    <li>{{Help::tglindo($pegawai->tanggal_kembali)}}</li>
                </ol>
            </td>
        </tr>
        <tr>
            <td class="no">8.</td>
            <td class="tengah">Pengikut : <span style="display: inline-block;margin-left: 40px;"></span>Nama</td>
            <td class="tengah" style="text-align:center">Tanggal Lahir</td>
            <td style="text-align:center">Keterangan</td>
        </tr>
        <tr>
            <td class="no"></td>
            <td class="tengah">
                @for($i=1;$i<=5;$i++)
                    {{$i}}.<br>
                @endfor
            </td>
            <td class="tengah"></td>
            <td></td>
        </tr>
        <tr>
            <td class="no">9.</td>
            <td class="tengah"  style="vertical-align:top">
                Pembayaran
                <ol style="list-style-type: lower-alpha;">
                    <li>Instansi</li>
                    <br>
                    <li>Mata Anggaran</li>
                </ol>
            </td>
            <td style="vertical-align:top" colspan="2">
            <br>
                <ol style="list-style-type: lower-alpha;">
                    <li>{{Str::upper($kop->nama)}} KABUPATEN BENGKALIS</li>
                    <li>{{$data->kegiatan->kode_rekening}}</li>
                </ol>
            </td>
        </tr>
        <tr>
            <td class="no" style="border-bottom:1px solid #000">10.</td>
            <td style="border-bottom:1px solid #000" class="tengah">Keterangan Lain-lain</td>
            <td colspan="2"></td>
        </tr>

    </table>

    <table style="width:300px;" align="right">
        <tr>
            <td>Ditetapkan di Bengkalis<br>Pada tanggal {{Help::tglindo($data->tanggal_penetapan)}}
                <p style="margin-top:7px">PENGGUNA ANGGARAN <br> {{Str::upper($kop->nama)}} KABUPATEN BENGKALIS</p>
                <br>
                <br>

                <span><u>{{Str::upper($data->pegawai->nama)}}<u></span><br>
                {{Str::upper($data->pegawai->pangkat)}}<br>
                NIP. {{Str::upper($data->pegawai->nip)}}
            </td>
        </tr>

    </table>
</div>
<div class="page">

    <table style="width:103%;border-collapse:collapse" class="sppds">
        <tr class="offbawah">
            <td style="width:1%;vertical-align:top;"></td>
            <td style="width:22%;vertical-align:top;"></td>
            <td style="width:21%;" class="tengah"></td>
            <td width="width:1%;" style="vertical-align:top;">I.</td>
            <td style="width:25%;">Berangkat Dari<br>(tempat kedudukan)<br>Ke<br>Pada tanggal</td>
            <td style="width:33%;vertical-align:top;">: {{$pegawai->tempat_berangkat}} <br><br>: {{$pegawai->tempat_tujuan}} <br>: {{Help::tglindo($data->tanggal_berangkat)}}</td>
        </tr>
        <tr class="offatas">
            <td style="vertical-align:top;"></td>
            <td style="vertical-align:top;"></td>
            <td style="" class="tengah"></td>
            <td width="" style="vertical-align:top;"></td>
            <td style="" colspan="2">PEJABAT PELAKSANA TEKNIS KEGIATAN {{strtoupper($pegawai->nama_bidang != 'Kantor' ? ($pegawai->nama_bidang!='Sekretariat' ? 'Bidang '.$pegawai->nama_bidang: $pegawai->nama_bidang) : '' )}} <br><br><br><br><u>{{strtoupper($kepalabidang->nama)}}</u><br>NIP. {{$kepalabidang->nip}}</td>
            
        </tr>
        <tr>
            <td style="vertical-align:top;">II.</td>
            <td style="vertical-align:top;">Tiba di<br>Pada tanggal<br></td>
            <td style="" class="tengah">: {{$pegawai->tempat_tujuan}}<br>: {{Help::tglindo($data->tanggal_kembali)}}<br><br></td>
            <td width="" style="vertical-align:top;"></td>
            <td style="padding-bottom: 100px;">Berangkat Dari<br>Ke<br>Pada tanggal</td>
            <td style="vertical-align:top;">: {{$pegawai->tempat_berangkat}} <br>: {{$pegawai->tempat_tujuan}} <br>: {{Help::tglindo($data->tanggal_berangkat)}}</td>
        </tr>
        <tr>
            <td style="vertical-align:top;">III.</td>
            <td style="vertical-align:top;">Tiba di<br>Pada tanggal<br>Kepala<br></td>
            <td style="" class="tengah">:<br>:<br>:<br><br></td>
            <td></td>
            <td style="">Berangkat Dari<br>Ke<br>Pada tanggal<br>Kepala</td>
            <td style="vertical-align:top;">: <br>: <br>:<br>:</td>
        </tr>
        <tr>
            <td style="vertical-align:top;">IV.
            </td>
            <td style="vertical-align:top;">Tiba di<br>Pada tanggal<br>Kepala<br></td>
            <td style="" class="tengah">:<br>:<br>:<br><br></td>
            <td></td>
            <td style="">Berangkat Dari<br>Ke<br>Pada tanggal<br>Kepala</td>
            <td style="vertical-align:top;">:<br>: <br>:<br>:</td>
        </tr>
        <tr>
            <td style="vertical-align:top;">V.
            </td>
            <td style="vertical-align:top;">Tiba di<br>Pada tanggal<br>Kepala<br></td>
            <td style="" class="tengah">:<br>:<br>:<br><br></td>
            <td></td>
            <td style="">Berangkat Dari<br>Ke<br>Pada tanggal<br>Kepala</td>
            <td style="vertical-align:top;">:<br>: <br>:<br>:</td>
        </tr>
        <tr class="nopb">
            <td style="vertical-align:top;">VI.
            </td>
            <td style="vertical-align:top;">Tiba di<br>(tempat kedudukan)<br>Pada tanggal<br></td>
            <td style="" class="tengah">: Bengkalis<br><br>:<br><br></td>
            <td></td>
            <td colspan="2" style=";text-align:justify">Telah diperiksa, dengan keterangan bahwa perjalanan tersebut diatas benar dilakukan atas perintahnya dan semata-mata untuk kepentingan jabatan dalam waktu sesingkat-singkatnya.</td>
        </tr>
        <tr class="nopb">
            <td style="vertical-align:top;">VII.
            </td>
            <td colspan="5" style="">CATATAN LAIN-LAIN</td>
        </tr>
        <tr class="nopb">
            <td style="vertical-align:top;">VIII.
            </td>
            <td colspan="5" style="text-align:justify">
                PERHATIAN
                <br>
                <span>Pejabat yang berwenang menerbitkan SPD, pegawai yang melakukan perjalan
                    dinas, para pejabat yang mengesahkan tanggal berangkat/tiba serta Bendaharawan bertanggung jawab
                    berdasarkan peraturan-peraturan Keuangan Negara, apabila negara mendapat rugi akibat kesalahan,
                    kealpaannya.</span>
            </td>
        </tr>


    </table>

    <table style="width:300px;" align="right">
        <tr>
            <td>
                <p style="margin-top:7px">PENGGUNA ANGGARAN <br> {{Str::upper($kop->nama)}} KABUPATEN BENGKALIS</p>
                <br>
                <br>
                <span><u>{{Str::upper($data->pegawai->nama)}}<u></span><br>
                {{Str::upper($data->pegawai->pangkat)}}<br>
                NIP. {{Str::upper($data->pegawai->nip)}}
            </td>
        </tr>

    </table>
</div>
<div class="footer">
    <table width="100%">
        <tr>
            <td width="100%">
                <b>Catatan</b><hr>
                <ul>
                    <li style="font-size: xx-small;">UU ITE Nomor 11 Tahun 2008 Pasal 5 Ayat (1); <br>"Informasi Elektronik dan/atau Dokumen Elektronik dan/atau hasil cetaknya merupakan alat bukti hukum yang sah*</li>
                    <li style="font-size: xx-small;">Dokumen ini telah ditandatangani secara elektronik menggunakan sertifikat elektronik yang diterbitkan BSrE;</li>
                    <li style="font-size: xx-small;">Surat ini dapat dibuktikan keasliannya die-surat. bengkaliskab. go.id dengan scan Qr-Code.</li>
                </ul>
            </td>
            <td style="width: 15%; text-align: end;">
                <img src="data:image/png;base64, {!! $qrcode !!}">
            </td>
        </tr>
        </table>
</div>
@endsection