@extends('app.app')
@section('page-title', 'Pengaturan Isi Disposisi')
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

	<a href="#" class="btn btn-primary" id="tambah-disposisi">Tambah</a>

	<table class="table table-bordered table-responsive" id="table-isi-disposisi">
		<thead>
			<tr>
				<th>No</th>
				<th>Grup Jabatan</th>
				<th>Isi Disposisi</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			@foreach($isiDisposisi as $data)
			<tr>
				<td>{{ $no++ }}</td>
				<td>{{ $data->grup_jabatan->nama_grup }}</td>
				<td>{{ $data->isi_disposisi }}</td>
				<td><form style="margin:0; padding:0;" action="{{ url('pengaturan/isi-disposisi/delete', $data->id_disposisi) }}" method="post">
					@method('delete')
					@csrf
					<a href="javascript:;" class="btn btn-warning" id="edit-disposisi" data-id="{{ $data->id_disposisi }}" data-grup-jabatan="{{ $data->grup_jabatan->id_grup }}" data-isi-disposisi="{{ $data->isi_disposisi }}">Edit</a> 
					<button style="display: inline;" type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete</button>
				</form></td>
			</tr>
			@endforeach
		</tbody>
	</table>


<!-- Modal Tambah Satuan-->
<div class="modal fade" id="modal-tambah-disposisi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Isi Disposisi</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="form-tambah-disposisi" action="{{ url('pengaturan/isi-disposisi/tambah') }}" method="post">
        	{!! csrf_field() !!}
        	<div class="form-group">
	        	<div class="col-md-3 col-sm-3 col-xs-3">
	        		<label>Isi Disposisi</label>
	        	</div>
	        	<div class="col-md-9 col-sm-9 col-xs-9">
	        		<input class="form-control" type="text" name="isi_disposisi" required="">
	        	</div>
        	</div>
        	<div class="form-group">
	        	<div class="col-md-3 col-sm-3 col-xs-3">
	        		<label>Grup Jabatan</label>
	        	</div>
	        	<div class="col-md-9 col-sm-9 col-xs-9">
	        		<select class="form-control" name="grup_jabatan">
	        			@foreach($grupJabatan as $dataJabatan)
	        				<option value="{{ $dataJabatan->id_grup }}">{{ $dataJabatan->nama_grup }}</option>
	        			@endforeach
	        		</select>
	        	</div>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="submit-tambah-disposisi" form="form-tambah-disposisi" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit Satuan-->
<div class="modal fade" id="modal-edit-disposisi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Isi Disposisi</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="form-edit-disposisi" action="{{ url('pengaturan/isi-disposisi/edit') }}" method="post">
        	{!! csrf_field() !!}
        	<input type="hidden" name="id" id="id" required>
        	<div class="form-group">
	        	<div class="col-md-3 col-sm-3 col-xs-3">
	        		<label>Isi Disposisi</label>
	        	</div>
	        	<div class="col-md-9 col-sm-9 col-xs-9">
	        		<input id="input-isi-disposisi" class="form-control" type="text" name="isi_disposisi" required="">
	        	</div>
        	</div>
        	<div class="form-group">
	        	<div class="col-md-3 col-sm-3 col-xs-3">
	        		<label>Grup Jabatan</label>
	        	</div>
	        	<div class="col-md-9 col-sm-9 col-xs-9">
	        		<select class="form-control" name="grup_jabatan">
	        			@foreach($grupJabatan as $dataJabatan)
	        				<option id="option-{{ $dataJabatan->id_grup }}" value="{{ $dataJabatan->id_grup }}">{{ $dataJabatan->nama_grup }}</option>
	        			@endforeach
	        		</select>
	        	</div>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="submit-edit-disposisi" form="form-edit-disposisi" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

@endsection
@push('js')
<script type="text/javascript" src="{{ asset('assets/vendors/dataTables/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/dataTables/js/dataTables.bootstrap.min.js') }}"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#table-isi-disposisi').DataTable();

		$(document).on('click', '#edit-disposisi', function(){
			$('#modal-edit-disposisi').modal('show');

			var id = $(this).data('id');
			var grup_jabatan = $(this).data('grup-jabatan');
			var isi_disposisi = $(this).data('isi-disposisi');
			
			$('#input-isi-disposisi').val(isi_disposisi);
			$('option#option-'+grup_jabatan).attr('selected', true);
			$('#id').val(id);
		});

		$(document).on('click', '#submit-edit-disposisi', function(){
		    $('#form-edit-disposisi').submit();
		});

		$('#tambah-disposisi').on('click', function() {
			$('#modal-tambah-disposisi').modal('show');
		});

		$(document).on('click', '#submit-tambah-disposisi', function(){
		    $('#form-tambah-disposisi').submit();
		});
	});
</script>
@endpush