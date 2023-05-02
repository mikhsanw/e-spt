{!! Form::open(array('id' => 'frmOji', 'route' => [$halaman->kode.'.store'], 'class' => 'form account-form', 'method' => 'post')) !!}
<div class="row">
    <div class="col-md-12 form-group">
        <div class="form-group">
            {!! Form::label('Nama', 'Siapa Namanya ?', array('class' => 'control-label')) !!}
            {!! Form::text('nama', NULL, array('id' => 'nama', 'class' => 'form-control', 'placeholder' => 'Nama')) !!}
        </div>
        <div class="form-group">
            {!! Form::label('username', 'Username', array('class' => 'control-label')) !!}
            {!! Form::text('username', NULL, array('id' => 'username', 'class' => 'form-control', 'placeholder' => 'Username')) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Password', 'Password', array('class' => 'control-label')) !!}
            <input type="password" name="password" id="password" class="form-control" placeholder="Password"/>
        </div>
        <div class="form-group">
            {!! Form::label('email', 'E-Mail', array('class' => 'control-label')) !!}
            {!! Form::text('email', NULL, array('id' => 'email', 'class' => 'form-control', 'placeholder' => 'Email')) !!}
        </div>
    </div>
    <div class="col-md-12 form-group">
        <div class="form-group">
            {!! Form::label('Akses Grup', 'Akses Grup', array('class' => 'control-label')) !!}
            {!! Form::select('aksesgrup_id', $aksesgrup, 5, array('id' => 'aksesgrup_id', 'class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-md-12 form-group">
        <div class="form-group">
            @php 
            $d=Auth::user()->level == 1 ? \App\Model\Opd::with('bidang')->get() : \App\Model\Opd::with('bidang')->whereHas('bidang', function($query){
                $query->where('bidangs.opd_id','=', Auth::user()->bidang->opd_id);  
            })->get();
            @endphp
            {!! Form::label('Bidang', 'Bidang', array('class' => 'control-label')) !!}
            <select name="bidang_id" id="" class="form-control">
                @if(Auth::user()->level == 1)
          @foreach($d as $r)
        <optgroup label="{{$r->nama}}">
            @foreach($r->bidang as $r2)
        <option value="{{$r2->id}}">{{$r2->nama}}</option>

            @endforeach
        </optgroup>
          @endforeach
          @else 
          @foreach($d as $r)
            @foreach($r->bidang as $r2)
        <option value="{{$r2->id}}">{{$r2->nama}}</option>
            @endforeach
          @endforeach
          @endif
          </select>
        </div>
    </div>
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
{!! Form::hidden('table-list', 'datatable', array('id' => 'table-list')) !!}
{!! Form::close() !!}
<script src="{{ URL::asset('resources/vendor/jquery/jquery.enc.js') }}"></script>
<script src="{{ URL::asset('resources/vendor/jquery/jquery.form.js') }}"></script>
<script src="{{ URL::asset(config('master.aplikasi.author').'/js/ajax_progress.js') }}"></script>
<script>
    $('.modal-title').html('<i class="{!! $halaman->icon !!}"></i> Tambah {{ $halaman->nama }}');
</script>
