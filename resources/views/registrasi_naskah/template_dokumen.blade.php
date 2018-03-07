@extends('app.app')
@section('page-title', 'Download Template Dokumen')
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

	<table class="table table-bordered table-responsive" id="table-template">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Template Dokumen</th>
				<th>Download</th>
			</tr>
		</thead>
		<tbody>
			@foreach($templateDok as $data)
			<tr>
				<td>{{ $no++ }}</td>
				<td>{{ $data->nama_template }}</td>
				<td><a href="{{ url('registrasi-naskah/template-dokumen/'.$data->id_template.'/download') }}">Link Download</a></td>
			</tr>
			@endforeach
		</tbody>
	</table>

@endsection
@push('js')
<script type="text/javascript" src="{{ asset('assets/vendors/dataTables/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/dataTables/js/dataTables.bootstrap.min.js') }}"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#table-template').DataTable();
	});
</script>
@endpush