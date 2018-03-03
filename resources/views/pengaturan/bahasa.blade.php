@extends('app.app')
@section('page-title', 'Pengaturan Bahasa')
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

	<a href="#" class="btn btn-primary" id="tambah-bahasa">Tambah</a>

	<table class="table table-bordered table-responsive" id="table-bahasa">
		<thead>
			<tr>
				<th>No</th>
				<th>Bahasa</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			@foreach($bahasa as $data)
			<tr>
				<td>{{ $no++ }}</td>
				<td>{{ $data->bahasa }}</td>
				<td><form style="margin:0; padding:0;" action="{{ url('pengaturan/bahasa/'.$data->id_bahasa.'/delete') }}" method="post">
					@method('delete')
					@csrf
					<a href="javascript:;" class="btn btn-warning" id="edit-bahasa" data-id="{{ $data->id_bahasa }}" data-bahasa="{{ $data->bahasa }}">Edit</a> 
					<button style="display: inline;" type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete</button>
				</form></td>
			</tr>
			@endforeach
		</tbody>
	</table>


<!-- Modal Tambah Satuan-->
<div class="modal fade" id="modal-tambah-bahasa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Bahasa</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="form-tambah-bahasa" action="{{ url('pengaturan/bahasa/tambah') }}" method="post">
        	{!! csrf_field() !!}
        	<div class="form-group">
	        	<div class="col-md-3 col-sm-3 col-xs-3">
	        		<label>Bahasa</label>
	        	</div>
	        	<div class="col-md-9 col-sm-9 col-xs-9">
	        		<input class="form-control" type="text" name="bahasa" required="">
	        	</div>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="submit-tambah-bahasa" form="form-tambah-bahasa" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit Satuan-->
<div class="modal fade" id="modal-edit-bahasa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Bahasa</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="form-edit-bahasa" action="{{ url('pengaturan/bahasa/edit') }}" method="post">
        	{!! csrf_field() !!}
        	<input type="hidden" name="id" id="id" required>
        	<div class="form-group">
	        	<div class="col-md-3 col-sm-3 col-xs-3">
	        		<label>Bahasa</label>
	        	</div>
	        	<div class="col-md-9 col-sm-9 col-xs-9">
	        		<input id="input-bahasa" class="form-control" type="text" name="bahasa" required>
	        	</div>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="submit-edit-bahasa" form="form-edit-bahasa" class="btn btn-primary">Save changes</button>
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
		$('#table-bahasa').DataTable();

		$(document).on('click', '#edit-bahasa', function(){
			$('#modal-edit-bahasa').modal('show');

			var id = $(this).data('id');
			var bahasa = $(this).data('bahasa');

			$('#input-bahasa').val(bahasa);
			$('#id').val(id);
		});

		$(document).on('click', '#submit-edit-bahasa', function(){
		    $('#form-edit-bahasa').submit();
		});

		$('#tambah-bahasa').on('click', function() {
			$('#modal-tambah-bahasa').modal('show');
		});

		$(document).on('click', '#submit-tambah-bahasa', function(){
		    $('#form-tambah-bahasa').submit();
		});
	});
</script>
@endpush