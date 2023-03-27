<div id="arsip">
    {!! Form::open(array('class' => 'form account-form', 'method' => 'post', 'files' => 'true')) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h4 class="box-title">Arsip File</h4>  
                    <small class="text-danger"> (file berisi dokumen yang telah ditandatangani)</small>
                </div>
                <div class="box-body">
                    <div class="b-1 p-4">
                        <div class="form-group row">
                            <label class="col-form-label col-md-3">SPT</label>
                            <div class="col-md-9">
                                @if($data->arsip_spt)
                                <object data="{{asset($data->arsip_spt->url_stream)}}" type="application/pdf"
                                    style="background: transparent url({{asset('backend/img/loading.gif')}}) no-repeat center; width: 100%;height: 400px">
                                    File PDF tidak dapat ditampilkan, silahkan download file <a href="{{asset($data->arsip_spt->url_download)}}" class="btn btn-primary" target="_blank">Download</a>
                                </object>
                                @else
                                <div class="custom-file">
                                    {!! Form::file('arsip_spt', array('id' => 'arsip_spt', 'class' => 'form-control')) !!}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="b-1 p-4">
                        @foreach($data->spt_pegawai as $item)
                        <div class="form-group row">
                            <label class="col-form-label col-md-3">SPPD <small>({{$item->pegawai->nama}})</small></label>
                            <div class="col-md-9">
                                @if($item->arsip_sppd)
                                <object data="{{asset($item->arsip_sppd->url_stream)}}" type="application/pdf"
                                    style="background: transparent url({{asset('backend/img/loading.gif')}}) no-repeat center; width: 100%;height: 400px">
                                    File PDF tidak dapat ditampilkan, silahkan download file <a href="{{asset($item->arsip_sppd->url_download)}}" class="btn btn-primary" target="_blank">Download</a>
                                </object>
                                @else
                                <div class="custom-file">
                                    {!! Form::file('arsip_sppd[]', array('id' => 'arsip_sppd', 'class' => 'form-control')) !!}
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
   
        {!! Form::hidden('table-list', 'datatable', array('id' => 'table-list')) !!}
        {!! Form::hidden('id', $data->id, array('id' => 'id')) !!}
        <div class="custom-modal-footer">
            <button class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fa fa-ban"></i> Tutup</button>
            &nbsp;&nbsp;<button type="submit" class="btn btn-sm btn-primary btn-logo"><i class="fa fa-save"></i> Simpan</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>
<div class="row">
	<div class="col-md-12">
        <span class="pesan"></span>
        <div id="output"></div>
        <div class="progress">
            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                <div id="statustxt">0%</div>
            </div>
        </div>
	</div>
</div>
<style>
    .select2-container {
        z-index: 9999 !important;
    }
    .modal-lg{
        max-width: 45% !important;
    }
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
    $('.modal-title').html('<span class="fa fa-edit"></span> Tambah Arsip');
</script>
