<div id="lihat">
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <tr>
                    <td>Nomor SPT</td>
                    <td>: Belum ada</td>
                </tr>
                <tr>
                    <td>Tanggal Berangkat</td>
                    <td>: {{Help::tglindo($data->tanggal_berangkat)}}</td>
                </tr>
                <tr>
                    <td>Tanggal Kembali</td>
                    <td>: {{Help::tglindo($data->tanggal_kembali)}}</td>
                </tr>
                <tr>
                    <td>Tempat Tujuan</td>
                    <td>: {{$data->tempat_tujuan}}</td>
                </tr>
                <tr>
                    <td>Maksud Perjalanan</td>
                    <td>: {!!$data->maksud_perjalanan!!}</td>
                </tr>
            </table>
            <p>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home"
                            type="button" role="tab" aria-controls="home" aria-selected="true">Nota Dinas</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button"
                            role="tab" aria-controls="profile" aria-selected="false">SPT</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#contact" type="button"
                            role="tab" aria-controls="contact" aria-selected="false">SPPD</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        @foreach($data->file_notadinas as $key => $file)
                        <object data="{{asset($file->url_stream)}}" type="application/pdf"
                            style="background: transparent url({{asset('backend/img/loading.gif')}}) no-repeat center; width: 100%;height: 700px">
                            File PDF tidak dapat ditampilkan, silahkan download file
                        </object>
                        @endforeach
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    @if($data->file_spt)
                    <object data="{{url($data->file_spt->url_stream)}}" type="application/pdf"
                        style="background: transparent url({{asset('backend/img/loading.gif')}}) no-repeat center; width: 100%;height: 700px">
                        File PDF tidak dapat ditampilkan, silahkan download file

                    </object>
                    @else
                    <object data="{{url('sptkeluar/viewspt/'.$data->id)}}" type="application/pdf"
                        style="background: transparent url({{asset('backend/img/loading.gif')}}) no-repeat center; width: 100%;height: 700px">
                        File PDF tidak dapat ditampilkan, silahkan download file

                    </object>
                    @endif
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="sppdview" style="display:none">
                            <button class="btn btn-danger btn-xs float-end pull-right my-3"
                                onclick="$('.listsppd').show();$('.sppdview').hide()" type="button"> <i
                                    class="fas fa-close"></i> Tutup</button>
                                <div class="sppd"></div>
                        </div>

                        <table class="table table-hover listsppd">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Bidang</th>
                                    <th>Jabatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pegawai as $k=>$p)
                                <tr>
                                    <td>{{$k+1}}</td>
                                    <td>{{$p->nip}}</td>
                                    <td>{{$p->nama_pegawai}}</td>
                                    <td>{{$p->nama_bidang}}</td>
                                    <td>{{$p->jabatan}}</td>
                                    <td><button onclick="$('.listsppd').hide();$('.sppdview').show();lihatsppd(`{{$sptpegawai->getfilepegawai($data->id,$p->id_pegawai)->file_sppd?url($sptpegawai->getfilepegawai($data->id,$p->id_pegawai)->file_sppd->url_stream):'sptkeluar/viewsppd/'.$data->id.'/'.$p->id_pegawai}}`)"
                                            class="btn btn-info btn-sm" type="button"> <i class="fa fa-eye"
                                                aria-hidden="true"></i> lihat</button></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </p>
        </div>
    </div>
</div>
<style>
    .custom-modal-footer {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: end;
        -ms-flex-pack: end;
        justify-content: flex-end;
        padding: 1rem;
        border-top: 0 solid #dee2e6;
        border-bottom-right-radius: 3px;
        border-bottom-left-radius: 3px;
    }

</style>
<script src="{{ URL::asset('resources/vendor/jquery/jquery.enc.js') }}"></script>
<script src="{{ URL::asset('resources/vendor/jquery/jquery.form.js') }}"></script>
<script src="{{ URL::asset(config('master.aplikasi.author').'/js/ajax_progress.js') }}"></script>
<script src="{{ URL::asset(config('master.aplikasi.author').'/'.$halaman->kode.'/'.\Auth::id().'/ajax.js') }}"></script>
<script type="text/javascript">
    $('.modal-title').html('<span class="fa fa-edit"></span> Lihat {{$halaman->nama}}');
    function lihatsppd(val){
        console.log(val)
        
        $('.sppd').html(`
                <object data="`+val+`" type="application/pdf"
                                style="background: transparent url({{asset('backend/img/loading.gif')}}) no-repeat center; width: 100%;height: 700px;">
                                File PDF tidak dapat ditampilkan, silahkan download file
                </object>
           `);
    }
</script>
