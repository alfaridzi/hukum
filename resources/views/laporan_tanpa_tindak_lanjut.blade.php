

	<table class="table table-bordered table-responsive" id="table-naskah-masuk">
		<thead>
			<tr>
				<th>No</th>
				<th>Tanggal Naskah</th>
				<th>Nomor Surat</th>
				<th>perihal</th>
				<th>Asal Naskah</th>
			
				<th>Tanggal Registrasi</th>
				<th>Keterangan</th>
			</tr>
		</thead>
		<tbody>
			@foreach($naskah as $data)
			<tr>
				<td>{{ $no++ }}</td>
				<td><a href="{{ url('/naskah-masuk/detail/'.$data->id_naskah) }}">{{ $data->tanggal_naskah }}</a></td>

				<td><a href="{{ url('/naskah-masuk/detail/'.$data->id_naskah) }}">{{ $data->nomor_naskah }}</a></td>

				<td><a href="{{ url('/naskah-masuk/detail/'.$data->id_naskah) }}">{{ $data->hal }}

				<td><a href="{{ url('/naskah-masuk/detail/'.$data->id_naskah) }}">{{ $data->asal_naskah }}</a></td>
				
			

				<td><a href="{{ url('/naskah-masuk/detail/'.$data->id_naskah) }}">{{ $data->tanggal_registrasi }}</a></td>
			

				 	<td>
                    {{ $data->get_tipe_registrasi() }}</td>


				


	
			</tr>
			@endforeach
		</tbody>
	</table>

