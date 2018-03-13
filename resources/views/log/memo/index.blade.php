@extends('app.app')
@section('page-title', 'Log Memo')
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

	<table class="table table-bordered table-responsive" id="table-memo">
		<thead>
			<tr>
				<th>No</th>
				<th>Status Naskah</th>
				<th>Urgensi</th>
				<th>Nomor Surat</th>
				<th>Asal Naskah</th>
				<th>Hal</th>
				<th>Tanggal Naskah</th>
				<th>Tanggal Registrasi</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			@foreach($naskah as $data)
			<tr>
				<td>{{ $no++ }}</td>
				<td><a href="{{ url('log/memo/detail/'.$data->id_naskah) }}">@foreach($data->penerima as $dataPenerima)
					{{ $dataPenerima->get_status_naskah() }}
					@endforeach
				</a></td>
				<td><a href="{{ url('log/memo/detail/'.$data->id_naskah) }}">{{ $data->urgensi->tingkat }}</a></td>
				<td><a href="{{ url('log/memo/detail/'.$data->id_naskah) }}">{{ $data->nomor_naskah }}</a></td>
				<td><a href="{{ url('log/memo/detail/'.$data->id_naskah) }}">{{ $data->asal_naskah }}</a></td>
				<td><a href="{{ url('log/memo/detail/'.$data->id_naskah) }}">{{ $data->hal }}
					@if(is_null($data->id_berkas) || $data->id_berkas == "")
					<div>
						<label class="label label-danger">(Belum Diberkaskan)</label>
					</div>

					@else

					<div>
						<label class="label label-success">(Sudah Diberkaskan)</label>
					</div>
					@endif
				</a></td>
				<td><a href="{{ url('log/memo/detail/'.$data->id_naskah) }}">{{ $data->tanggal_naskah }}</a></td>
				<td><a href="{{ url('log/memo/detail/'.$data->id_naskah) }}">{{ $data->tanggal_registrasi }}</a></td>
				<td>
					@if($data->getPenerima->count() == 1)
					<form action="{{ url('log/memo/delete/'.$data->id_naskah) }}" method="post">
						@csrf
						<button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus naskah ini?')">Hapus</button>
					</form>
					@endif
				</td>
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
		$('#table-memo').DataTable();
	});
</script>
@endpush