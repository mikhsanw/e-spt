{!! Form::open(array('id' => 'frmOji', 'route' => [$halaman->kode.'.store'], 'class' => 'form account-form', 'method' => 'post', 'files' => 'true')) !!}
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h4 class="box-title">Nota Dinas</h4>  
                <small class="text-danger"> (kosongkan jika tanpa nota dinas)</small>
            </div>
            <div class="box-body">
                <div class="form-group row">
                    <label class="col-form-label col-md-3">Upload Nota Dinas</label>
                    <div class="col-md-9">
                        <div class="custom-file">
                            {!! Form::file('file_notadinas', array('id' => 'file_notadinas', 'class' => 'custom-file-input')) !!}
                            <label class="custom-file-label" for="file_notadinas">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-3">Perihal Nota Dinas</label>
                    <div class="col-md-9">
                        {!! Form::textarea('perihal_notadinas', null, array('id' => 'perihal_notadinas', 'class' => 'form-control', 'style' => 'height:100px')) !!}
                    </div>
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
                        {!! Form::textarea('maksud_perjalanan',  NULL, array('id' => 'maksud_perjalanan', 'class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-3">Tanggal Berangkat</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            {!! Form::text('tanggal', null, array('id' => 'tanggal', 'class' => 'form-control pull-right', 'autocomplete' => 'off')) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-3">Angkutan</label>
                    <div class="col-md-9">
                        {!! Form::select('angkutan[]', config('master.angkutan'), null, array('id' => 'angkutan', 'class' => 'form-control select2 angkutan', 'multiple' => 'multiple','style' => 'width:100%')) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <label>Tempat Berangkat</label>
                            {!! Form::text('tempat_berangkat', null, array('id' => 'tempat_berangkat', 'class' => 'form-control', 'autocomplete' => 'off')) !!}
                        </div>
                        <div class="col-6">
                            <label>Tempat Tujuan</label>
                            {!! Form::text('rekening', null, array('id' => 'tempat_tujuan', 'class' => 'form-control', 'autocomplete' => 'off')) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <label>Kegiatan</label>
                            {!! Form::select('kegiatan_id', $kegiatan, null, array('id' => 'kegiatan_id', 'class' => 'form-control kegiatan_id select2', 'placeholder'=>'', 'onchange'=>'myChangeFunction(this)', 'style' => 'width:100%')) !!}
                        </div>
                        <div class="col-6">
                            <label>Nomor Rekening</label>
                            <p><input id="rekening" type='text' class='form-control rekening' readonly></p>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-3">Pejabat Penandatangan</label>
                    <div class="col-md-9">
                        {!! Form::select('penandatangan_id', $penandatangan, null, array('id' => 'penandatangan_id', 'class' => 'form-control penandatangan_id select2', 'placeholder'=>'', 'style' => 'width:100%')) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-md-3">Pegawai yang ditugaskan</label>
                    <div class="col-md-9">
                        {!! Form::select('pegawai_id[]', $pegawai->pluck('nama','id'), null, array('id' => 'pegawai_id', 'class' => 'form-control pegawai_id select2', 'placeholder'=>'', 'style' => 'width:100%')) !!}
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
<script type="text/javascript">
    $('.modal-title').html('<span class="fa fa-edit"></span> Tambah {{$halaman->nama}}');
    $('.js-summernote').summernote({
        // toolbar: [['para', ['ul', 'ol']]],
        height: 200,
        dialogsInBody: true
    });
    $('#tanggal').daterangepicker({
    locale: {
      format: 'DD/MM/YYYY'
    }
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
</script>