
	 <link href="{{ asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
<style type="text/css">
	* {
		font-size: 12px;
	} .table-striped > tbody > tr:nth-child(2n+1) > td, .table-striped > tbody > tr:nth-child(2n+1) > th { background-color: #74b9ff; }
</style>


<h3 class="text-center" style="font-weight:700">Laporan Berkas Unit Kerja</h3>

<?php
$dari = date('d-m-Y', strtotime($_GET['dari']));
$sampai = date('d-m-Y', strtotime($_GET['dari']));

?>
<h4 class="text-center">{{ $dari }} s/d {{ $sampai }}</h4>

	<table class="table table-bordered table-striped" id="table-naskah-masuk">
		<thead>
			<tr>
				<th>No</th>
				<th>No Berkas</th>
				<th>Nama Berkas</th>
				<th>Tanggal Berkas dibuat</th>
				<th>Unit Kerja</th>
				<th>Isi Berkas</th>
				<th>Akhir Retensi Aktif</th>
				<th>Akhir Retensi Inaktif</th>
				
			</tr>
		</thead>
		<tbody>
			@if($berkas->count() < 1)
			<tr>
				<td colspan="8" class="text-center"> Tidak ada data</td>
			</tr>
			@endif
			@foreach($berkas as $data)
			<tr>
				<td>{{ $no++ }}</td>
				<td>{{ $data->kode_klasifikasi.'/'.$data->nomor_berkas }}</td>
				<td>{{ $data->judul_berkas }}</td>
				<td>{{ $data->created_at }}</td>
				<td>{{ $data->jabatan->title }}</td>
				<td>{{ $data->naskah->count() }} Item</td>
				<td>{{ $data->r_aktif }}</td>
				<td>{{ $data->r_inaktif }}</td>
				
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

