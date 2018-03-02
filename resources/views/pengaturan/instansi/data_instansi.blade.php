@extends('app.app')
@section('page-title', 'Pengaturan Data Instansi')
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

	<a href="{{ url('pengaturan/instansi/tambah') }}" class="btn btn-primary" id="tambah-instansi">Tambah</a>

	<table class="table table-bordered table-responsive" id="table-data-instansi">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Instansi</th>
				<th>Status</th>
				<th>Tanggal Perubahan Setting</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			@foreach($instansi as $data)
			<tr>
				<td>{{ $no++ }}</td>
				<td>{{ $data->nama_instansi }}</td>
				<td>{{ $data->get_status() }}</td>
				<td>{{ $data->getTanggalPerubahan() }}</td>
				<td><form style="margin:0; padding:0;" action="{{ url('pengaturan/instansi/'.$data->id_instansi.'/delete') }}" method="post">
					@method('delete')
					@csrf
					<a href="{{ url('pengaturan/instansi/'.$data->id_instansi.'/edit') }}" class="btn btn-warning">Edit</a> 
					<button style="display: inline;" type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete</button>
				</form></td>
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
		$('#table-data-instansi').DataTable();
	});
</script>
@endpush