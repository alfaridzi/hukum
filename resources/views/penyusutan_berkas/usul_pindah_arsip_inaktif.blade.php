@extends('app.app')
@section('page-title', 'Usul Pindah Arsip Aktif Ke Record Center')
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/dataTables/css/dataTables.bootstrap.min.css') }}">
@endpush
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{{ Session::get('success') }}</li>
        </ul>
    </div>
@endif

	<table class="table table-bordered table-responsive" id="table-usul-arsip">
		<thead>
			<tr>
				<th>No</th>
				<th>Nomor Permohonan</th>
				<th>Tanggal Permohonan</th>
				<th>Periode Arsip</th>
				<th>Unit Kerja</th>
				<th>Ket</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			
		</tbody>
	</table>

@endsection
@push('js')
<script type="text/javascript" src="{{ asset('assets/vendors/dataTables/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/dataTables/js/dataTables.bootstrap.min.js') }}"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#table-usul-arsip').DataTable();
	});
</script>
@endpush