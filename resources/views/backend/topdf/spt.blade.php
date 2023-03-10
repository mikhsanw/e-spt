@extends('backend.topdf.layout')
@section('content')


<style>
    body {
        font-face:arial
    }
    .v-top {
        vertical-align:top;
    }
    .inline {
        display:inline-table
    }
    .col1 {
        display:inline-block;
        width:25%
    }
    .col2 {
        display:inline-block;
        width:68%
    }
    .rowcol {
        width:100%;padding-bottom:2px
    }
    p {margin:0;padding:0}
</style>
<!-- <img src="{{$kop->file->url_stream.'?t='.time() ?? '#'}}" style="width:100%" alt="">
<br>
<br> -->
<center>
    <span style="border-bottom:2px solid #000">SURAT PERINTAH TUGAS</span><br>
    <span>NOMOR : </span>
</center>

<table style="width:100%;margin-top:30px">
<tr>
    <td style="width:20%;">Dasar <span style="float:right">:</span></td>
    <td style="width:80%">
        <ol style="padding:0 20px;margin:0;">
     
        </ol>
    </td>
</tr>
<br>
<tr>
    <td colspan="2" align="center">MEMERINTAHKAN</td>
</tr>
<br>
<tr>
    <td class="v-top">Kepada <span style="float:right">:</span></td>
    <td class="v-top">
    <ol style="padding:3px 0 0 20px;margin:0;display:block">
    @foreach($pegawai as $r)
            <li style="padding-bottom:10px">
             <div class="rowcol"><div class="col1" >Nama</div><div class="col2">: {{$r->nama_pegawai}}</div></div>
             <div class="rowcol"><div class="col1" >NIP</div><div class="col2">: {{$r->nip}}</div></div>
             <div class="rowcol"><div class="col1" >Pangkat / Golongan</div><div class="col2">: {{$r->pangkat}} / {{$r->golongan}}</div></div>
             <div class="rowcol"><div class="col1" style="vertical-align:top" >Jabatan</div><div class="col2">:{{$r->jabatan}} {{$r->nama_bidang}}</div></div>
             <div class="rowcol"><div class="col1" >Unit Kerja</div><div class="col2">: {{$r->opd}}</div></div>
          
            </li>
        @endforeach
        </ol>
    </td>
</tr>
<tr>
    <td class="v-top">Untuk <span style="float:right">:</span></td>
    <td class="v-top">
    <ol style="padding:3px 0 0 20px;margin:0;display:block">
            <li >
            {{$data->maksud_perjalanan}}
            </li>
            <li>
            Lama perjalanan Dinas {{Help::lamahari($data->tanggal_berangkat,$data->tanggal_kembali)}} ( {{config('master.angka_indo.'.Help::lamahari($data->tanggal_berangkat,$data->tanggal_kembali))}} ) hari mulai tanggal {{Help::durasitanggal($data->tanggal_berangkat,$data->tanggal_kembali)}}.
            </li>
            <li>
            Setelah melaksanakan tugas paling lama 5 ( Lima ) hari menyampaikan laporan tertulis kepada pimpinan.
            </li>
        <li>Biaya Pelaksanaan perjalanan dinas ini dibebankan pada {{$pegawai->first()->opd}}.
        </li>
        </ol>
    </td>
</tr>

</table>
<br>
<br>
<br>
<table style="width:250px;" align="right">
<tr>
    <td>Bengkalis, {{$data->tanggal_penetapan ? Help::tglindo($data->tanggal_penetapan) : 'Belum ditetapkan'}}
        <p style="margin-top:5px">KEPALA {{Str::upper($pegawai->first()->opd)}}</p>
        <br>
        <br>
        <br>
       
        <span>{{$ttd->pegawai->nama}}</span><br>
        {{$ttd->pegawai->pangkat}} / {{$ttd->pegawai->golongan}}<br>
        NIP. {{$ttd->pegawai->nip}}
    </td>
</tr>
</table>
@endsection