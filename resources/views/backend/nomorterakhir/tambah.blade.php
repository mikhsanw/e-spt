{!! Form::open(array('id' => 'frmOji', 'route' => [$halaman->kode.'.store'], 'class' => 'form account-form', 'method' => 'post', 'files' => 'true')) !!}
<div class="row">
    <div class="col-md-12">
        <p>
            {!! Form::label('jenis', 'Masukkan Jenis', array('class' => 'control-label')) !!}
            {!! Form::select('jenis', config('master.jenis_spt'), null, array('id' => 'jenis', 'class' => 'form-control', 'placeholder'=>'Pilih','style' => 'width:100%','onchange'=>'myChange(this.value)')) !!}
        </p>
        <p>
            {!! Form::label('nomor_terakhir', 'Masukkan Nomor Terakhir', array('class' => 'control-label')) !!}
            {!! Form::text('nomor_terakhir', null, array('id' => 'nomor_terakhir', 'class' => 'form-control', 'autocomplete' => 'off')) !!}
        </p>
        <p class="bidanginput">
            {!! Form::label('bidang_id', 'Pilih Bidang', array('class' => 'control-label')) !!}
            {!! Form::select('bidang_id', $bidang, null, array('id' => 'bidang', 'class' => 'select2 form-control bidang', 'placeholder'=>'Pilih','style' => 'width:100%')) !!}
        </p>
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
<script type="text/javascript">
    $('.modal-title').html('<span class="fa fa-edit"></span> Tambah {{$halaman->nama}}');

    $('.bidanginput').hide();
    function myChange(value){
        console.log(value)
        if(value=="SPPD"){
            $('.bidanginput').show();
        }else{
            $('.bidanginput').hide();
        }
    }
</script>