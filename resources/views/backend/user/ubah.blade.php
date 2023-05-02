{!! Form::open(array('id' => 'frmOji', 'route' => [$halaman->kode.'.update', $user->id], 'class' => 'form account-form', 'method' => 'PUT','files' => 'true')) !!}
<div class="row">
    <div class="col-md-12 form-group">
        {!! Form::label('Nama', 'Namanya siapa ?', array('class' => 'col-md-6 control-label')) !!}
        {!! Form::text('nama', $user->nama, array('id' => 'nama', 'class' => 'form-control', 'placeholder' =>
        'Nama')) !!}
    </div>
    <div class="form-group col-md-6">
        {!! Form::label('username', 'Username', array('class' => 'col-md-6 control-label')) !!}
        {!! Form::text('username', $user->username, array('id' => 'username', 'class' => 'form-control',
        'placeholder' => 'Username', 'readonly')) !!}
    </div>
    <div class="form-group col-md-6">
        {!! Form::label('Password', 'Password', array('class' => 'col-md-6 control-label')) !!}
        <input type="password" name="password" id="password" class="form-control" placeholder="Password"/>
        <small>Kosongkan jika tidak perlu</small>
    </div>
    <div class="form-group col-md-4">
        {!! Form::label('Email', 'E-Mail', array('class' => 'col-md-6 control-label')) !!}
        {!! Form::text('email', $user->email, array('id' => 'email', 'class' => 'form-control', 'placeholder' =>
        'Email')) !!}
    </div>
    <div class="form-group col-md-8">
        {!! Form::label('Akses Grup', 'Akses Grup', array('class' => 'col-md-6 control-label')) !!}
        {!! Form::select('aksesgrup_id', $aksesgrup, $user->aksesgrup_id, array('id' => 'aksesgrup_id', 'class' =>
        'form-control')) !!}
    </div>
 
    <div class="col-md-12 form-group">
        <div class="form-group">
            {!! Form::label('Bidang', 'Bidang', array('class' => 'control-label')) !!}
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
    $('.modal-title').html('<span class="fa fa-edit"></span> Ubah {{$halaman->nama}}');
</script>
