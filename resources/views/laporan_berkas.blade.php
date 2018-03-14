
	<table class="table table-bordered table-responsive" id="table-berkas">
		<thead>
			<tr>
				<th>No</th>
				<th>No Berkas</th>
				<th>Nama Berkas</th>
				<th>Isi Berkas</th>
				<th>Unit Kerja</th>
				<th>Akhir Retensi Aktif</th>
				<th>Akhir Retensi Inaktif</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($berkas as $data)
			<tr>
				<td>{{ $no++ }}</td>
				<td>{{ $data->kode_klasifikasi.'/'.$data->nomor_berkas }}</td>
				<td>{{ $data->judul_berkas }}</td>
				<td>{{ $data->naskah->count() }} Item</td>
				<td>{{ $data->jabatan->title }}</td>
				<td>{{ $data->r_aktif }}</td>
				<td>{{ $data->r_inaktif }}</td>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

