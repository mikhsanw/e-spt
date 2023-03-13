{!! Form::open(array('id' => 'frmOji', 'route' => [$halaman->kode.'.update', $data->id], 'class' => 'form account-form', 'method' => 'PUT', 'files' => 'true')) !!}
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h4 class="box-title">Dokumen Pendukung</h4>  
                <small class="text-danger"> (Nota Dinas, Dll)</small>
            </div>
            <div class="box-body">
                <div class="add_0 b-1 p-4">
                    @foreach($data->perihal_notadinas as $key => $val)
                    <div class="form-group row">
                        <label class="col-form-label col-md-3">Dasar {{$key+1}}</label>
                        <div class="col-md-9">
                        <object data="{{asset($data->file_notadinas[$key]->url_stream)}}" type="application/pdf"
                            style="background: transparent url({{asset('backend/img/loading.gif')}}) no-repeat center; width: 100%;height: 700px">
                            File PDF tidak dapat ditampilkan, silahkan download file

                        </object>
                            
                            {!! Form::textarea('perihal_notadinas[]', $val, array('id' => 'perihal_notadinas', 'class' => 'form-control', 'style' => 'height:100px')) !!}
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="dasar"></div>
                <input type="hidden" value="0" id="total_add">
                <input type="hidden" value="" name="hapusnodin" id="hapusnodin">
                <div class="text-right p-3">
                    <button type="button" class="waves-effect waves-light btn btn-default btn-flat mb-5" onclick="add()">Tambah</button>
                    <button type="button" class="waves-effect waves-light btn btn-default btn-flat mb-5 removeall" onclick="removeall()">Hapus Semua</button>
                </div>
            </div>
        </div>
        <div class="box">
            <div class="box-header">
                <h4 class="box-title">SPT & SPPD</h4>  
                <small class="text-danger"> (Wajib Diisi)</small>
            </div>
            <div class="box-body">
                <div class="form-group row">
                    <label class="col-form-label col-md-3">Maksud Perjalanan</label>
                    <div class="col-md-9">
                        {!! Form::textarea('maksud_perjalanan',  $data->maksud_perjalanan, array('id' => 'maksud_perjalanan', 'class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-3">Tanggal Berangkat</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            {!! Form::text('tanggal', date('d-m-Y', strtotime(str_replace('-', '/', $data->tanggal_berangkat))).' - '.date('d-m-Y', strtotime(str_replace('-', '/', $data->tanggal_kembali))), array('id' => 'tanggal', 'class' => 'form-control pull-right', 'autocomplete' => 'off')) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-3">Pegawai yang ditugaskan</label>
                    <div class="col-md-9">
                        <select multiple="multiple" name="pegawai_id[]" id="pegawai_id" class="form-control pegawai_id select2" style="width:100%">
                            @foreach($pegawai as $item)
                                <option value="{{$item->id}}" {{ (array_search($item->id,$datapegawai)!==false)?'selected':'' }}>{{$item->nama}} ( {{$item->jabatan->nama.' '.($item->bidang?'di Bidang '.$item->bidang->nama:'')}} )</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-3">Angkutan</label>
                    <div class="col-md-9">
                        {!! Form::select('angkutan[]', config('master.angkutan'), $data->angkutan, array('id' => 'angkutan', 'class' => 'selectpicker', 'multiple' => 'multiple','style' => 'width:100%')) !!}
                    </div>
                </div>
                <div class="form-group" style="margin-top: 50px;">
                    <div class="row">
                        <div class="col-6">
                            <label>Tempat Berangkat</label>
                            {!! Form::text('tempat_berangkat', $data->tempat_berangkat, array('id' => 'tempat_berangkat', 'class' => 'form-control', 'autocomplete' => 'off')) !!}
                        </div>
                        <div class="col-6">
                            <label>Tempat Tujuan</label>
                            {!! Form::text('tempat_tujuan', $data->tempat_tujuan, array('id' => 'tempat_tujuan', 'class' => 'form-control', 'autocomplete' => 'off')) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <label>Kegiatan</label>
                            {!! Form::select('kegiatan_id', $kegiatan, $data->kegiatan_id, array('id' => 'kegiatan_id', 'class' => 'form-control kegiatan_id select2', 'placeholder'=>'', 'onchange'=>'myChangeFunction(this)', 'style' => 'width:100%')) !!}
                        </div>
                        <div class="col-6">
                            <label>Nomor Rekening</label>
                            <p><input id="rekening" type='text' value='{{$data->kegiatan->kode_rekening}}' class='form-control rekening' readonly></p>
                        </div>
                    </div>
                </div>
                <div class="form-group row" style="margin-top: 50px;">
                    <label class="col-form-label col-md-3">Pejabat Penandatangan</label>
                    <div class="col-md-9">
                        <select name="penandatangan_id" id="penandatangan_id" class="form-control penandatangan_id select2" style="width:100%">
                            @foreach($penandatangan as $item)
                                <option value="{{$item->id}}">{{$item->nama}} ( {{$item->jabatan->nama.' '.($item->bidang?'di Bidang '.$item->bidang->nama:'')}} )</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
	{!! Form::hidden('table-list', 'datatable', array('id' => 'table-list')) !!}
</div>
<div class="row">
	<div class="col-md-12">
        <span class="pesan"></span>
        <div id="output"></div>
        <div class="progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                <div id="statustxt">0%</div>
            </div>
        </div>
	</div>
</div>
{!! Form::close() !!}
<style>
    .select2-container {
        z-index: 9999 !important;
    }
</style>
<script src="{{ URL::asset('resources/vendor/jquery/jquery.enc.js') }}"></script>
<script src="{{ URL::asset('resources/vendor/jquery/jquery.form.js') }}"></script>
<script src="{{ URL::asset(config('master.aplikasi.author').'/js/ajax_progress.js') }}"></script>
<script src="{{ URL::asset(config('master.aplikasi.author').'/'.$halaman->kode.'/'.\Auth::id().'/ajax.js') }}"></script>
<script src="{{ asset('backend/fromplugin/summernote/summernote.js') }}" async=""></script>
<script src="{{ asset('backend/assets/vendor_components/bootstrap-daterangepicker/daterangepicker.js') }}" async=""></script>
<script src="{{ asset('backend/assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}"></script>
<script type="text/javascript">
    $('.modal-title').html('<span class="fa fa-edit"></span> Ubah {{$halaman->nama}}');
    $('.selectpicker').selectpicker();

    //date
    const d = new Date();
    var date = d.getDate()+'/'+(d.getMonth()+1)+'/'+d.getFullYear();

    $('#tanggal').daterangepicker({
    locale: {
      format: 'DD/MM/YYYY'
    },
    timePicker:false,
    singleDatePicker: false,
    minDate:date
    });

    function myChangeFunction(select){
        $.ajax({
        type: 'get',
        url: "{{ url($url_admin.'/'.$halaman->kode.'/getrekening') }}/" + select.value,
        success: function(result){
            $( ".rekening" ).val( result );
        }
        })
    }

    function add(){
        let new_no = parseInt($('#total_add').val()) + 1;
        $('#total_add').val(new_no);

        $('.dasar').append (`
        <div class="add_`+new_no+` b-1 p-4">
            <div class="form-group row">
                <label class="col-form-label col-md-3">Upload file</label>
                <div class="col-md-9">
                    <div class="custom-file">
                        {!! Form::file('file_notadinas[]', array('id' => 'file_notadinas', 'class' => 'form-control')) !!}
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-md-3">Dasar</label>
                <div class="col-md-9">
                    {!! Form::textarea('perihal_notadinas[]', null, array('id' => 'perihal_notadinas', 'class' => 'form-control', 'style' => 'height:100px')) !!}
                </div>
            </div>
            <div class="text-right">
                <button type="button" class="waves-effect waves-light btn btn-default btn-flat mb-5" title="Hapus Dasar" onclick="remove(`+new_no+`)">X</button>
            </div>
        </div>
        `);
    }

    function remove(val) {
        $('.add_' + val).remove();
    }

    function removeall(val) {
        $('.add_0').remove();
        $('.removeall').hide();
        $('#hapusnodin').val('ya');
    }
</script>
