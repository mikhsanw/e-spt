@extends('layouts.backend.index')
@push('title',$halaman->nama)
@push('header',$halaman->nama)
@push('tombol')
<button class="waves-effect waves-light btn bg-gradient-primary text-white py-2 px-3 tambah">
	Tambah
</button>
@endpush
@section('content')
<div class="panel-container show">
	<div class="panel-content">
		<table id="datatable" class="table table-striped table-bordered display" style="width:100%">
			<thead class="bg-primary">
				<tr>
					<th width="10px">No</th>
					<th class="text-center">Maksud Perjalanan</th>
					<th class="text-center">Tujuan</th>
					<th class="text-center">Tanggal Perjalanan</th>
					<th class="text-center">Tgl. Pengajuan</th>
					<th class="text-center">Status</th>
					<th width="80px" class="text-center" tabindex="0">Aksi</th>
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
<script type="text/javascript" src="{{ URL::asset(config('master.aplikasi.author').'/'.$halaman->kode.'/jquery.js') }}"></script>
<script src="{{ asset('backend/assets/vendor_components/select2/dist/js/select2.full.js')}}"></script>
<script src="{{ asset('backend/assets/vendor_components/moment/min/moment.min.js')}}"></script>
@endpush
