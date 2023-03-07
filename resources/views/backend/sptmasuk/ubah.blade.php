{!! Form::open(array('id' => 'frmOji', 'route' => [$halaman->kode.'.update', $data->id], 'class' => 'form account-form', 'method' => 'PUT')) !!}
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
  @if(in_array($data->status_spt,[0,1]))
            <label for="">Beri Tindakan :</label><br>

            <select name="status_spt" class="form-control" id="status_spt" required>
                <option value="">--pilih tindakan--</option>
                <option value="2" {{$data->status_spt ==2 ? 'selected' : ''}}>Terima Pengajuan</option>
                <option value="3" {{$data->status_spt ==3 ? 'selected' : ''}}>Revisi Pengajuan</option>
                <option value="4" {{$data->status_spt ==4 ? 'selected' : ''}}>Tolak Pengajuan</option>
            </select>
@else
<label for="">Status Pengajuan :</label><br>
@if($data->status_spt ==2)
<h4 class="text-success"> <i class="fa fa-check"></i> Diterima </h4>
@elseif($data->status_spt ==3)
<h4 class="text-warning"> <i class="fa fa-spinner"></i> Menunggu Revisi </h4>

@else 
<h4 class="text-danger"> <i class="fa fa-close"></i> Ditolak </h4>

@endif
@endif
        </p>
       
	{!! Form::hidden('table-list', 'datatable', array('id' => 'table-list')) !!}
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
<script type="text/javascript">
    $('.kirim-modal').html('Submit');
    $('.kirim-modal').attr('class','btn btn-sm kirim-modal float-right submit-ubah btn-primary');
    $('.modal-title').html('<span class="fa fa-edit"></span> Lihat  {{$halaman->nama}}');
    $('.js-summernote').summernote({
        // toolbar: [['para', ['ul', 'ol']]],
        height: 200,
        dialogsInBody: true
    });
</script>
