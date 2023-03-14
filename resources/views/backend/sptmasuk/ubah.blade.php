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

       
        <!-- <object data="{{url('sptmasuk/viewspt/'.$data->id)}}" type="application/pdf" style="background: transparent url({{asset('backend/img/loading.gif')}}) no-repeat center; width: 100%;height: 700px">
            <p>
                File PDF tidak dapat ditampilkan, silahkan download file
              
            </p>
        </object> -->
        <p>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Nota Dinas</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">SPT</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">SPPD</button>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
</div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
  <object data="{{url('sptmasuk/viewspt/'.$data->id)}}" type="application/pdf" style="background: transparent url({{asset('backend/img/loading.gif')}}) no-repeat center; width: 100%;height: 700px">
                File PDF tidak dapat ditampilkan, silahkan download file
              
        </object>
  </div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
    <div class="sppdview" style="display:none">
    <button class="btn btn-danger btn-xs float-end pull-right my-3" onclick="$('.listsppd').show();$('.sppdview').hide()" type="button"> <i class="fas fa-close"></i> Tutup</button>
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
                <td><button onclick="$('.listsppd').hide();$('.sppdview').show();lihatsppd(`{{$p->id_pegawai}}`)"
                                            class="btn btn-info btn-sm" type="button"> <i class="fa fa-eye"
                                                aria-hidden="true"></i> lihat</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>
  </div>
</div>
        </p>
        <p>
  @if(in_array($data->status_spt,[0,1]))
            <label for="">Beri Tindakan :</label><br>

            <select name="status_spt" class="form-control" id="status_spt" required>
                <option value="">--pilih tindakan--</option>
                <option value="2" {{$data->status_spt ==2 ? 'selected' : ''}}>Terima Pengajuan</option>
                <option value="3" {{$data->status_spt ==3 ? 'selected' : ''}}>Revisi Pengajuan</option>
                <option value="4" {{$data->status_spt ==4 ? 'selected' : ''}}>Tolak Pengajuan</option>
            </select>
            <br>
            <label for="">Catatan Pimpinan <small class="text-warning">Beri tanda ( - ) jika kosong</small></label>
            <textarea required id="catatan_pimpinan" class="form-control" name="catatan_pimpinan" placeholder="Beri catatan [opsional]"></textarea>
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

<script type="text/javascript">
    $('.modal-title').html('<span class="fa fa-edit"></span> Lihat {{$halaman->nama}}');
    function lihatsppd(val){
        console.log(val)
        
        $('.sppd').html(`
                <object data="{{url('sptmasuk/viewsppd/'.$data->id)}}/`+val+`" type="application/pdf"
                                style="background: transparent url({{asset('backend/img/loading.gif')}}) no-repeat center; width: 100%;height: 700px;">
                                File PDF tidak dapat ditampilkan, silahkan download file
                </object>
           `);
    }
</script>
