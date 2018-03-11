@extends('app.app')
@section('page-title', 'Log Naskah Tanpa Tindak Lanjut')
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

	<table class="table table-bordered table-responsive" id="table-naskah-masuk">
		<thead>
			<tr>
				<th>No</th>
				<th>Nomor Naskah</th>
				<th>Hal</th>
				<th>Tanggal Naskah</th>
			</tr>
		</thead>
		<tbody>
			@foreach($naskah as $data)
			<tr>
				<td>{{ $no++ }}</td>
				<td><a href="{{ url('log/naskah-tanpa-tindak-lanjut/detail/'.$data->id_naskah) }}">{{ $data->nomor_naskah }}</a></td>
				<td><a href="{{ url('log/naskah-tanpa-tindak-lanjut/detail/'.$data->id_naskah) }}">{{ $data->hal }}
					@if(is_null($data->berkas) || $data->berkas == "")
					<div>
						<label class="label label-danger">(Belum Diberkaskan)</label>
					</div>
					@endif
				</a></td>
				<td><a href="{{ url('log/naskah-tanpa-tindak-lanjut/detail/'.$data->id_naskah) }}">{{ $data->tanggal_naskah }}</a></td>
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
		$('#table-naskah-masuk').DataTable();
	});
</script>
@endpush