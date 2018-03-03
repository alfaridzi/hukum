@extends('app.app')
@section('page-title', 'Upload Template Dokumen')
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

	<a href="#" class="btn btn-primary" id="tambah-template">Tambah</a>

	<table class="table table-bordered table-responsive" id="table-template">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Template Dokumen</th>
				<th>Download</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			@foreach($templateDok as $data)
			<tr>
				<td>{{ $no++ }}</td>
				<td>{{ $data->nama_template }}</td>
				<td><a href="{{ url('pengaturan/template-dokumen/'.$data->id_template.'/download') }}">Link Download</a></td>
				<td><form style="margin:0; padding:0;" action="{{ url('pengaturan/template-dokumen/'.$data->id_template.'/delete') }}" method="post">
					@method('delete')
					@csrf
					<a href="javascript:;" class="btn btn-warning" id="edit-template" data-id="{{ $data->id_template }}" data-nama-template="{{ $data->nama_template }}">Edit</a> 
					<button style="display: inline;" type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete</button>
				</form></td>
			</tr>
			@endforeach
		</tbody>
	</table>


<!-- Modal Tambah Satuan-->
<div class="modal fade" id="modal-tambah-template" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Template Dokumen</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="form-tambah-template" action="{{ url('pengaturan/template-dokumen/tambah') }}" method="post" enctype="multipart/form-data">
        	{!! csrf_field() !!}
        	<div class="form-group">
	        	<div class="col-md-3 col-sm-3 col-xs-3">
	        		<label>Nama Template Dokumen</label>
	        	</div>
	        	<div class="col-md-9 col-sm-9 col-xs-9">
	        		<input class="form-control" type="text" name="nama_template" required="">
	        	</div>
        	</div>
        	<div class="form-group">
	        	<div class="col-md-3 col-sm-3 col-xs-3">
	        		<label>Pilih Dokumen</label>
	        	</div>
	        	<div class="col-md-9 col-sm-9 col-xs-9">
	        		<input type="file" name="file_template" required="">
	        	</div>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="submit-tambah-template" form="form-tambah-template" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit Satuan-->
<div class="modal fade" id="modal-edit-template" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Template Dokumen</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="form-edit-template" action="{{ url('pengaturan/template-dokumen/edit') }}" method="post" enctype="multipart/form-data">
        	{!! csrf_field() !!}
        	<input type="hidden" name="id" id="id" required>
        	<div class="form-group">
	        	<div class="col-md-3 col-sm-3 col-xs-3">
	        		<label>Nama Template Dokumen</label>
	        	</div>
	        	<div class="col-md-9 col-sm-9 col-xs-9">
	        		<input id="input-template" class="form-control" type="text" name="nama_template" required>
	        	</div>
        	</div>
        	<div class="form-group">
	        	<div class="col-md-3 col-sm-3 col-xs-3">
	        		<label>Pilih Dokumen</label>
	        	</div>
	        	<div class="col-md-9 col-sm-9 col-xs-9">
	        		<input type="file" name="file_template">
	        	</div>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="submit-edit-template" form="form-edit-template" class="btn btn-primary">Save changes</button>
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
		$('#table-template').DataTable();

		$(document).on('click', '#edit-template', function(){
			$('#modal-edit-template').modal('show');

			var id = $(this).data('id');
			var nama_template = $(this).data('nama-template');

			$('#input-template').val(nama_template);
			$('#id').val(id);
		});

		$(document).on('click', '#submit-edit-template', function(){
		    $('#form-edit-template').submit();
		});

		$('#tambah-template').on('click', function() {
			$('#modal-tambah-template').modal('show');
		});

		$(document).on('click', '#submit-tambah-template', function(){
		    $('#form-tambah-template').submit();
		});
	});
</script>
@endpush