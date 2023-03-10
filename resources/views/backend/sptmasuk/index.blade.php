@extends('layouts.backend.index')
@push('title',ucwords(strtolower($halaman->nama)))
@push('header',ucwords(strtolower($halaman->nama)))
@push('tombol')

@endpush
@section('content')
<div class="panel-container show">
	<div class="panel-content">
		<table id="datatable" class="table table-striped table-bordered display" style="width:100%">
			<thead class="bg-primary">
				<tr>
					<th class="width-1">No</th>
					<th class="text-center">NO SPT</th>
					<th class="text-center">Tujuan</th>
					<th class="text-center">Bidang</th>
					<th class="text-center">Tgl. Berangkat</th>
					<th class="text-center">Tgl. Kembali</th>
					<th class="text-center">Waktu</th>
					<th class="text-center">Status</th>
					<th width="50px" class="text-center" tabindex="0" rowspan="1" colspan="1">Aksi</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

@endsection
@push('js')
@include('layouts.backend.js.datatable-js')
<script type="text/javascript" src="{{ URL::asset(config('master.aplikasi.author').'/js/'.$halaman->link.'/'.$halaman->kode.'/jquery-crud.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset(config('master.aplikasi.author').'/'.$halaman->kode.'/datatables.js') }}"></script>
<script src="{{ asset('backend/assets/vendor_components/select2/dist/js/select2.full.js')}}"></script>
@endpush
@push('css')
<link rel="stylesheet" media="screen, print" href="{{ asset('backend/fromplugin/summernote/summernote.css') }}">
@endpush
