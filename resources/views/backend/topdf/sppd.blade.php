@extends('backend.topdf.layout')
@section('content')
<style>
    .page { width: 100%; height: 100%; }
    .sppd tr td{
        border-left:none
    }
    .sppd tr td{
        border-top:1px solid #000;
        padding:6px
    }
    .sppds tr td{
        border-top:1px solid #000;
        padding-bottom:35px
    }
    .sppd tr td:last-child{
        border-bottom:1px solid #000;
    }
    .sppd tr td ol{
        margin:0 0 0 20px;padding:0
    }
    .sppd tr td.no{
       vertical-align:top;
       padding-right:5px
    }
    .sppd tr td.tengah{
        border-right:1px solid #000
    }
</style>
<div class="page">

<img src="" style="width:100%" alt="">
<br>
<br>
<br> <br>
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
    <td>:</td>
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
<tr><td class="no" style="width:2%">1</td><td style="width:48%" class="tengah">Pejabat yang memberikan Perintah</td><td style="width:50%"></td></tr>
<tr><td class="no">2</td><td class="tengah">Nama pegawai yang diperintah</td><td></td></tr>
<tr><td class="no">3</td><td class="tengah"><ol style="list-style-type: lower-alpha;">
<li>Pangkat dan Golongan menurut PP NO. 6 Tahun 1997</li>
<li>Jabatan</li>
<li>Tingkat perjalanan menurut peraturan Perjalanan</li>
</ol>
</td>
<td></td></tr>
<tr><td class="no">4</td><td class="tengah">Maksud perjalanan</td><td></td></tr>
<tr><td class="no">5</td><td class="tengah">Alat angkutan yang digunakan</td><td></td></tr>
<tr><td class="no">6</td><td class="tengah"><ol style="list-style-type: lower-alpha;">
<li>Tempat Berangkat</li>
<li>Tempat Tujuan</li>
</ol>
</td>
<td></td>
</tr>
<tr><td class="no">7</td><td class="tengah"><ol style="list-style-type: lower-alpha;">
<li>Lamanya perjalanan pinas</li>
<li>Tanggal berangkat</li>
<li>Tanggal harus kembali</li>
</ol>
</td>
<td></td>
</tr>
<tr><td class="no">8</td><td class="tengah">Pengikut</td><td></td></tr>
<tr><td class="no">9</td><td class="tengah">Pembayaran<ol style="list-style-type: lower-alpha;">
<li>Instansi</li>
<li>Mata Anggaran</li>
</ol>
</td>
<td></td>
</tr>
<tr><td class="no" style="border-bottom:1px solid #000">10</td><td style="border-bottom:1px solid #000" class="tengah">Keterangan Lain-lain</td><td></td></tr>

</table>

<br> <br>
<table style="width:290px;" align="right">
<tr>
    <td>Ditetapkan di Bengkalis<br>Pada tanggal 2 november 2023
    <p style="margin-top:7px">SEKRETARIS DINAS KOMUNIKASI INFORMATIKA DAN STATISTIK KABUPATEN BENGKALIS</p>
<br>
<br>
<br>

<span>Nama Pegawai</span><br>
        Pangkat Gologngan<br>
        NIP. 45455454545
</td>
</tr>

</table>
</div>
<div class="page">
<table style="width:300px;" align="right">
<tr>
    <td style="width:4%">I.</td>
    <td style="width:46%">SPPD No.</td>
    <td style="width:50%">:</td>
</tr>
<tr>
    <td></td>
    <td>Berangkat dari (tempat keduduukan)</td>
    <td style="vertical-align:top">:</td>
</tr>
<tr>
    <td></td>
    <td>Pada tanggal</td>
    <td>:</td>
</tr>
<tr>
    <td></td>
    <td>Ke</td>
    <td>:</td>
</tr>
</table>
<br>
<br>

<table style="width:100%;border-collapse:collapse" class="sppds">
<tr>
    <td style="width:2%;vertical-align:top;padding-top:20px;padding-right:10px">II.</td>
    <td style="width:20%;">Tiba di<br>Pada tanggal<br>Kepala</td>
    <td style="width:30%;padding-top:20px">:<br>:<br>:<br><br></td>
    <td style="width:20%;padding-top:20px">Berangkat Dari<br>Ke<br>Pada tanggal<br>Kepala</td>
    <td style="width:28%;padding-top:0">: dsfdsf<br>: dsfsf<br>:<br></td>
</tr>
<tr>
    <td style="width:2%;vertical-align:top;padding-top:20px;padding-right:10px">III.</td>
    <td style="width:20%;">Tiba di<br>Pada tanggal<br>Kepala</td>
    <td style="width:30%;padding-top:20px">:<br>:<br>:<br><br></td>
    <td style="width:20%;padding-top:20px">Berangkat Dari<br>Ke<br>Pada tanggal<br>Kepala</td>
    <td style="width:28%;padding-top:0">: dsfdsf<br>: dsfsf<br>:<br></td>
</tr>
<tr>
    <td style="width:2%;vertical-align:top;padding-top:20px;padding-right:10px;border-bottom:1px solid #000">IV.</td>
    <td style="width:20%;border-bottom:1px solid #000">Tiba di<br>Pada tanggal<br>Kepala</td>
    <td style="width:30%;padding-top:20px;border-bottom:1px solid #000">:<br>:<br>:<br><br></td>
    <td style="width:20%;padding-top:20px;border-bottom:1px solid #000">Berangkat Dari<br>Ke<br>Pada tanggal<br>Kepala</td>
    <td style="width:28%;padding-top:0;border-bottom:1px solid #000">: dsfdsf<br>: dsfsf<br>:<br></td>
</tr>


</table>

<br>
<table style="width:450px;" align="right">
<tr>
    <td style="width:2%">V.</td>
    <td style="width:20%">Tiba di</td>
    <td style="width:78%">:</td>
</tr>
<tr>
    <td style="width:2%"></td>
    <td style="width:20%">Pada tanggal</td>
    <td style="width:78%">:</td>
</tr>
<tr>
<td></td>

    <td colspan="2" style="padding-right:40px">
    Telah diperiksa, dengan keterangan bahwa perjalanan Tersebut di atas benar dilakukan atas perintahnya dan semata-mata untuk kepentingan jabatan dalam waktu yang sesingkat-singkatnya.
    </td>
</tr>
</table>
<br>
<table style="width:290px;" align="right">
<tr>
    <td>
    <p style="margin-top:7px">SEKRETARIS DINAS KOMUNIKASI INFORMATIKA DAN STATISTIK KABUPATEN BENGKALIS</p>
<br>
<br>
<br>

<span >NAMA PEGAWAI</span><br>
        Pangkat Gologngan<br>
        NIP. 45455454545
</td>
</tr>

</table>
<br>
<style>
    .bot tr td {
border-top:1px solid #000
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
        <p style="text-align:justify">Pejabat yang berwenang menerbitkan SPPD, pegawai yang melakukan perjalan dinas, para pejabat yang mengesahkan tanggal berangkat/tiba serta Bendaharawan bertanggung jawab berdasarkan peraturan-peraturan Keuangan Negara, apabila negara mendapat rugi akibat kesalahan, kealpaannya.</p>
    </td>
</tr>
</table>
</div>
@endsection