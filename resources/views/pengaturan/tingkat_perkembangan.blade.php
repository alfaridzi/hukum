@extends('app.app')
@section('page-title', 'Pengaturan Tingkat Perkembangan')
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

	<a href="#" class="btn btn-primary" id="tambah-perkembangan">Tambah</a>

	<table class="table table-bordered table-responsive" id="table-tingkat-perkembangan">
		<thead>
			<tr>
				<th>No</th>
				<th>Tingkat Perkembangan</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			@foreach($perkembangan as $data)
			<tr>
				<td>{{ $no++ }}</td>
				<td>{{ $data->tingkat }}</td>
				<td><form style="margin:0; padding:0;" action="{{ url('pengaturan/tingkat-perkembangan/'.$data->id_perkembangan.'/delete') }}" method="post">
					@method('delete')
					@csrf
					<a href="javascript:;" class="btn btn-warning" id="edit-tingkat-perkembangan" data-id="{{ $data->id_perkembangan }}" data-tingkat="{{ $data->tingkat }}">Edit</a> 
					<button style="display: inline;" type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete</button>
				</form></td>
			</tr>
			@endforeach
		</tbody>
	</table>


<!-- Modal Tambah Satuan-->
<div class="modal fade" id="modal-tambah-perkembangan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Tingkat Perkembangan</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="form-tambah-perkembangan" action="{{ url('pengaturan/tingkat-perkembangan/tambah') }}" method="post">
        	{!! csrf_field() !!}
        	<div class="form-group">
	        	<div class="col-md-3 col-sm-3 col-xs-3">
	        		<label>Tingkat Perkembangan</label>
	        	</div>
	        	<div class="col-md-9 col-sm-9 col-xs-9">
	        		<input class="form-control" type="text" name="tingkat_perkembangan" required="">
	        	</div>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="submit-tambah-perkembangan" form="form-tambah-perkembangan" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit Satuan-->
<div class="modal fade" id="modal-edit-perkembangan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Tingkat Perkembangan</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="form-edit-perkembangan" action="{{ url('pengaturan/tingkat-perkembangan/edit') }}" method="post">
        	{!! csrf_field() !!}
        	<input type="hidden" name="id" id="id" required>
        	<div class="form-group">
	        	<div class="col-md-3 col-sm-3 col-xs-3">
	        		<label>Tingkat Perkembangan</label>
	        	</div>
	        	<div class="col-md-9 col-sm-9 col-xs-9">
	        		<input id="input-perkembangan" class="form-control" type="text" name="tingkat_perkembangan" required>
	        	</div>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="submit-edit-perkembangan" form="form-edit-perkembangan" class="btn btn-primary">Save changes</button>
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
		$('#table-tingkat-perkembangan').DataTable();

		$(document).on('click', '#edit-tingkat-perkembangan', function(){
			$('#modal-edit-perkembangan').modal('show');

			var id = $(this).data('id');
			var tingkat = $(this).data('tingkat');

			$('#input-perkembangan').val(tingkat);
			$('#id').val(id);
		});

		$(document).on('click', '#submit-edit-perkembangan', function(){
		    $('#form-edit-perkembangan').submit();
		});

		$('#tambah-perkembangan').on('click', function() {
			$('#modal-tambah-perkembangan').modal('show');
		});

		$(document).on('click', '#submit-tambah-perkembangan', function(){
		    $('#form-tambah-perkembangan').submit();
		});
	});
</script>
@endpush