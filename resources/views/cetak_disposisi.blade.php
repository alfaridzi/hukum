<!DOCTYPE html>
<html>
<head>
	<title>SISURAT | Cetak Disposisi</title>
	<link href="{{ asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
	<style type="text/css">
	</style>
</head>
<body>
<br>
<div class="container">
	<div class="col-md-3">
	</div>
	<div class="col-md-6">
		<table class="table table-bordered">
			<tr>
				<td colspan="3" class="text-center">
					<b>Lembar Disposisi</b>
					<br>
					<b>{{ $penerima->user->jabatan->jabatan }}</b>
				</td>
			</tr>
			<tr>
				<td>A.</td>
				<td>Nomor Indeks : 
					@foreach($penerima->disposisi as $dataDisposisi)
						{{ $dataDisposisi->no_index }}
					@endforeach
				</td>
				<td>Tanggal Disposisi : 
					@foreach($penerima->disposisi as $dataDisposisi)
						{{ $dataDisposisi->get_tanggal_disposisi() }}
					@endforeach
				</td>
			</tr>
			<tr>
				<td></td>
				<td>Nomor Surat : {{ $penerima->naskah->nomor_naskah }}</td>
				<td>Tanggal Surat : {{ $penerima->naskah->get_tanggal_naskah() }}</td>
			</tr>
			<tr>
				<td>B.</td>
				<td>DITERUSKAN KEPADA</td>
				<td>ISI DISPOSISI</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<ul>
					@foreach($penerima->get_tujuan() as $dataTujuan)
						<li>{{ $dataTujuan->tujuan_kirim->jabatan->jabatan }}</li>
					@endforeach
					</ul>
				</td>
				<td>
					<ul>
					@if(!$penerima->disposisi->isEmpty())
					@foreach($penerima->disposisi as $dataDisposisi)
						@if(!is_null($dataDisposisi->disposisi))
						@foreach($dataDisposisi->get_disposisi() as $data)
						<li>{{ $data->isiDisposisi() }}</li>
						@endforeach
						@endif
					@endforeach
					@endif
					</ul>
				</td>
			</tr>
			<tr>
				<td>C.</td>
				<td colspan="2">
					Catatan Lain
					<br>
					{{ $penerima->pesan }}
				</td>
			</tr>
		</table>
		</div>
	</div>
</div>
<!-- jQuery -->
    <script src="{{ asset('assets/vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('assets/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript">
    	window.print();
    </script>
</body>
</html>