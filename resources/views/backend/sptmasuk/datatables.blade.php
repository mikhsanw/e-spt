$(document).ready(function() {
	$('#datatable').DataTable({
		responsive: true,
		serverside: true,
		lengthChange: false,
		language: {
            url: "{{ asset('resources/vendor/datatables/js/indonesian.json') }}"
        },
		processing: true,
		serverSide: true,
		ajax: "{{ url($url_admin.'/'.$kode.'/data') }}",
		columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
				{ data: 'no_spt' },
				{ data: 'tempat_tujuan' },
				{ data: 'bidang.nama' },
				{ data: 'tgl_perjalanan' },
				{ data: 'tanggal_pengajuan' },
				{ data: 'status_spt' },
				{ data: 'action', orderable: false, searchable: false}
		    ]
    });
});
