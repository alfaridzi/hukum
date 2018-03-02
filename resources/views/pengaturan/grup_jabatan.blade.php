@extends('app.app')
@section('page-title', 'Pengaturan Grup Jabatan')
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

	<a href="#" class="btn btn-primary" id="tambah-grup">Tambah</a>

	<table class="table table-bordered table-responsive" id="table-grup-jabatan">
		<thead>
			<tr>
				<th>No</th>
				<th>Grup Jabatan</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			@foreach($grupJabatan as $data)
			<tr>
				<td>{{ $no++ }}</td>
				<td>{{ $data->nama_grup }}</td>
				<td><form style="margin:0; padding:0;" action="{{ url('pengaturan/grup-jabatan/delete', $data->id_grup) }}" method="post">
					@method('delete')
					@csrf
					<a href="javascript:;" class="btn btn-warning" id="edit-grup" data-id="{{ $data->id_grup }}" data-nama-grup="{{ $data->nama_grup }}">Edit</a> 
					<button style="display: inline;" type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete</button>
				</form></td>
			</tr>
			@endforeach
		</tbody>
	</table>


<!-- Modal Tambah Satuan-->
<div class="modal fade" id="modal-tambah-grup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Grup Jabatan</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="form-tambah-satuan" action="{{ url('pengaturan/grup-jabatan/tambah') }}" method="post">
        	{!! csrf_field() !!}
        	<div class="form-group">
	        	<div class="col-md-3 col-sm-3 col-xs-3">
	        		<label>Grup Jabatan</label>
	        	</div>
	        	<div class="col-md-9 col-sm-9 col-xs-9">
	        		<input class="form-control" type="text" name="nama_grup" required="">
	        	</div>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" form="form-tambah-satuan" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit Satuan-->
<div class="modal fade" id="modal-edit-grup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Grup Jabatan</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="form-edit-jabatan" action="{{ url('pengaturan/grup-jabatan/edit') }}" method="post">
        	{!! csrf_field() !!}
        	<input type="hidden" name="id" id="id" required>
        	<div class="form-group">
	        	<div class="col-md-3 col-sm-3 col-xs-3">
	        		<label>Grup Jabatan</label>
	        	</div>
	        	<div class="col-md-9 col-sm-9 col-xs-9">
	        		<input id="input-nama-grup" class="form-control" type="text" name="nama_grup">
	        	</div>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="submit-edit-jabatan" form="form-edit-jabatan" class="btn btn-primary">Save changes</button>
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
		$('#table-grup-jabatan').DataTable();

		$(document).on('click', '#edit-grup', function(){
			$('#modal-edit-grup').modal('show');

			var id = $(this).data('id');
			var nama_grup = $(this).data('nama-grup');

			$('#input-nama-grup').val(nama_grup);
			$('#id').val(id);
		});

		$(document).on('click', '#submit-edit-grup', function(){
		    $('#form-edit-grup').submit();
		});

		$('#tambah-grup').on('click', function() {
			$('#modal-tambah-grup').modal('show');
		});

		$(document).on('click', '#submit-tambah-grup', function(){
		    $('#form-tambah-grup').submit();
		});
	});
</script>
@endpush