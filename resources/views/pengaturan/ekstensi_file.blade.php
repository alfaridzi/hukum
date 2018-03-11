@extends('app.app')
@section('page-title', 'Pengaturan Ekstensi File')
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

	<a href="#" class="btn btn-primary" id="tambah-jenis-ekstensi">Tambah</a>

	<table class="table table-bordered table-responsive" id="table-jenis-ekstensi">
		<thead>
			<tr>
				<th>No</th>
				<th>Jenis Ekstensi File</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			@foreach($ekstensi as $data)
			<tr>
				<td>{{ $no++ }}</td>
				<td>.{{ $data->jenis_ekstensi }}</td>
				<td><form style="margin:0; padding:0;" action="{{ url('pengaturan/ekstensi-file/'.$data->id_ekstensi.'/delete') }}" method="post">
					@method('delete')
					@csrf
					<a href="javascript:;" class="btn btn-warning" id="edit-jenis-ekstensi" data-id="{{ $data->id_ekstensi }}" data-jenis-ekstensi="{{ $data->jenis_ekstensi }}">Edit</a> 
					<button style="display: inline;" type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete</button>
				</form></td>
			</tr>
			@endforeach
		</tbody>
	</table>


<!-- Modal Ekstensi-->
<div class="modal fade" id="modal-tambah-ekstensi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Jenis Ekstensi</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="form-tambah-ekstensi" action="{{ url('pengaturan/ekstensi-file/tambah') }}" method="post">
        	{!! csrf_field() !!}
        	<div class="form-group">
	        	<div class="col-md-3 col-sm-3 col-xs-3">
	        		<label>Jenis Ekstensi File</label>
	        	</div>
	        	<div class="col-md-9 col-sm-9 col-xs-9">
	        		<input class="form-control" type="text" name="jenis_ekstensi" required="">
	        	</div>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="submit-tambah-ekstensi" form="form-tambah-ekstensi" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit Satuan-->
<div class="modal fade" id="modal-edit-ekstensi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Jenis Ekstensi</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="form-edit-ekstensi" action="{{ url('pengaturan/ekstensi-file/edit') }}" method="post">
        	{!! csrf_field() !!}
        	<input type="hidden" name="id" id="id" required>
        	<div class="form-group">
	        	<div class="col-md-3 col-sm-3 col-xs-3">
	        		<label>Jenis Ekstensi File</label>
	        	</div>
	        	<div class="col-md-9 col-sm-9 col-xs-9">
	        		<input id="input-ekstensi" class="form-control" type="text" name="jenis_ekstensi" required>
	        	</div>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="submit-edit-ekstensi" form="form-edit-ekstensi" class="btn btn-primary">Save changes</button>
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
		$('#table-jenis-ekstensi').DataTable();

		$(document).on('click', '#edit-jenis-ekstensi', function(){
			$('#modal-edit-ekstensi').modal('show');

			var id = $(this).data('id');
			var ekstensi = $(this).data('jenis-ekstensi');

			$('#input-ekstensi').val(ekstensi);
			$('#id').val(id);
		});

		$(document).on('click', '#submit-edit-ekstensi', function(){
		    $('#form-edit-ekstensi').submit();
		});

		$('#tambah-jenis-ekstensi').on('click', function() {
			$('#modal-tambah-ekstensi').modal('show');
		});

		$(document).on('click', '#submit-tambah-ekstensi', function(){
		    $('#form-tambah-ekstensi').submit();
		});
	});
</script>
@endpush