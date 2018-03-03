@extends('app.app')
@section('page-title', 'Pengaturan Tingkat Urgensi')
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

	<a href="#" class="btn btn-primary" id="tambah-urgensi">Tambah</a>

	<table class="table table-bordered table-responsive" id="table-tingkat-urgensi">
		<thead>
			<tr>
				<th>No</th>
				<th>Tingkat Urgensi</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			@foreach($urgensi as $data)
			<tr>
				<td>{{ $no++ }}</td>
				<td>{{ $data->tingkat }}</td>
				<td><form style="margin:0; padding:0;" action="{{ url('pengaturan/tingkat-urgensi/'.$data->id_urgensi.'/delete') }}" method="post">
					@method('delete')
					@csrf
					<a href="javascript:;" class="btn btn-warning" id="edit-urgensi" data-id="{{ $data->id_urgensi }}" data-tingkat="{{ $data->tingkat }}">Edit</a> 
					<button style="display: inline;" type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete</button>
				</form></td>
			</tr>
			@endforeach
		</tbody>
	</table>


<!-- Modal Tambah Satuan-->
<div class="modal fade" id="modal-tambah-urgensi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Tingkat Urgensi</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="form-tambah-urgensi" action="{{ url('pengaturan/tingkat-urgensi/tambah') }}" method="post">
        	{!! csrf_field() !!}
        	<div class="form-group">
	        	<div class="col-md-3 col-sm-3 col-xs-3">
	        		<label>Tingkat Urgensi</label>
	        	</div>
	        	<div class="col-md-9 col-sm-9 col-xs-9">
	        		<input class="form-control" type="text" name="tingkat_urgensi" required="">
	        	</div>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="submit-tambah-urgensi" form="form-tambah-urgensi" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit Satuan-->
<div class="modal fade" id="modal-edit-urgensi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Bahasa</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="form-edit-urgensi" action="{{ url('pengaturan/tingkat-urgensi/edit') }}" method="post">
        	{!! csrf_field() !!}
        	<input type="hidden" name="id" id="id" required>
        	<div class="form-group">
	        	<div class="col-md-3 col-sm-3 col-xs-3">
	        		<label>Tingkat Urgensi</label>
	        	</div>
	        	<div class="col-md-9 col-sm-9 col-xs-9">
	        		<input id="input-urgensi" class="form-control" type="text" name="tingkat_urgensi" required>
	        	</div>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="submit-edit-urgensi" form="form-edit-urgensi" class="btn btn-primary">Save changes</button>
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
		$('#table-tingkat-urgensi').DataTable();

		$(document).on('click', '#edit-urgensi', function(){
			$('#modal-edit-urgensi').modal('show');

			var id = $(this).data('id');
			var tingkat = $(this).data('tingkat');

			$('#input-urgensi').val(tingkat);
			$('#id').val(id);
		});

		$(document).on('click', '#submit-edit-urgensi', function(){
		    $('#form-edit-urgensi').submit();
		});

		$('#tambah-urgensi').on('click', function() {
			$('#modal-tambah-urgensi').modal('show');
		});

		$(document).on('click', '#submit-tambah-urgensi', function(){
		    $('#form-tambah-urgensi').submit();
		});
	});
</script>
@endpush