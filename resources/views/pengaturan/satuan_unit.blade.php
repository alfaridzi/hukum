@extends('app.app')
@section('page-title', 'Pengaturan Satuan Unit')
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

	<a href="#" class="btn btn-primary" id="tambah-satuan">Tambah</a>

	<table class="table table-bordered table-responsive" id="table-satuan-unit">
		<thead>
			<tr>
				<th>No</th>
				<th>Satuan Unit</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			@foreach($satuanUnit as $data)
			<tr>
				<td>{{ $no++ }}</td>
				<td>{{ $data->nama_satuan }}</td>
				<td><form style="margin:0; padding:0;" action="{{ url('pengaturan/satuan-unit/delete', $data->id_satuan) }}" method="post">
					@method('delete')
					@csrf
					<a href="javascript:;" class="btn btn-warning" id="edit-satuan" data-id="{{ $data->id_satuan }}" data-nama-satuan="{{ $data->nama_satuan }}">Edit</a> 
					<button style="display: inline;" type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete</button>
				</form></td>
			</tr>
			@endforeach
		</tbody>
	</table>


<!-- Modal Tambah Satuan-->
<div class="modal fade" id="modal-tambah-satuan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Satuan Unit</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="form-tambah-satuan" action="{{ url('pengaturan/satuan-unit/tambah') }}" method="post">
        	{!! csrf_field() !!}
        	<div class="form-group">
	        	<div class="col-md-3 col-sm-3 col-xs-3">
	        		<label>Satuan Unit</label>
	        	</div>
	        	<div class="col-md-9 col-sm-9 col-xs-9">
	        		<input class="form-control" type="text" name="nama_satuan" required="">
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
<div class="modal fade" id="modal-edit-satuan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Satuan Unit</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="form-edit-satuan" action="{{ url('pengaturan/satuan-unit/edit') }}" method="post">
        	{!! csrf_field() !!}
        	<input type="hidden" name="id" id="id" required>
        	<div class="form-group">
	        	<div class="col-md-3 col-sm-3 col-xs-3">
	        		<label>Satuan Unit</label>
	        	</div>
	        	<div class="col-md-9 col-sm-9 col-xs-9">
	        		<input id="input-nama-satuan" class="form-control" type="text" name="nama_satuan">
	        	</div>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="submit-edit-satuan" form="form-edit-satuan" class="btn btn-primary">Save changes</button>
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
		$('#table-satuan-unit').DataTable();

		$(document).on('click', '#edit-satuan', function(){
			$('#modal-edit-satuan').modal('show');

			var id = $(this).data('id');
			var nama_satuan = $(this).data('nama-satuan');

			$('#input-nama-satuan').val(nama_satuan);
			$('#id').val(id);
		});

		$(document).on('click', '#submit-edit-satuan', function(){
		    $('#form-edit-satuan').submit();
		});

		$('#tambah-satuan').on('click', function() {
			$('#modal-tambah-satuan').modal('show');
		});

		$(document).on('click', '#submit-tambah-satuan', function(){
		    $('#form-tambah-satuan').submit();
		});
	});
</script>
@endpush