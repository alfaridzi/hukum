@extends('app.app')
@section('page-title', 'Pengaturan Jenis Naskah')
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

	<a href="#" class="btn btn-primary" id="tambah-jenis-naskah">Tambah</a>

	<table class="table table-bordered table-responsive" id="table-jenis-naskah">
		<thead>
			<tr>
				<th>No</th>
				<th>Jenis Naskah</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			@foreach($jenisNaskah as $data)
			<tr>
				<td>{{ $no++ }}</td>
				<td>{{ $data->jenis_naskah }}</td>
				<td><form style="margin:0; padding:0;" action="{{ url('pengaturan/jenis-naskah/'.$data->id_jenis_naskah.'/delete') }}" method="post">
					@method('delete')
					@csrf
					<a href="javascript:;" class="btn btn-warning" id="edit-jenis-naskah" data-id="{{ $data->id_jenis_naskah }}" data-jenis-naskah="{{ $data->jenis_naskah }}">Edit</a> 
					<button style="display: inline;" type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete</button>
				</form></td>
			</tr>
			@endforeach
		</tbody>
	</table>


<!-- Modal Tambah Satuan-->
<div class="modal fade" id="modal-tambah-jenis-naskah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Jenis Naskah</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="form-tambah-jenis-naskah" action="{{ url('pengaturan/jenis-naskah/tambah') }}" method="post">
        	{!! csrf_field() !!}
        	<div class="form-group">
	        	<div class="col-md-3 col-sm-3 col-xs-3">
	        		<label>Jenis Naskah</label>
	        	</div>
	        	<div class="col-md-9 col-sm-9 col-xs-9">
	        		<input class="form-control" type="text" name="jenis_naskah" required="">
	        	</div>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="submit-tambah-jenis-naskah" form="form-tambah-jenis-naskah" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit Satuan-->
<div class="modal fade" id="modal-edit-jenis-naskah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Bahasa</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="form-edit-jenis-naskah" action="{{ url('pengaturan/jenis-naskah/edit') }}" method="post">
        	{!! csrf_field() !!}
        	<input type="hidden" name="id" id="id" required>
        	<div class="form-group">
	        	<div class="col-md-3 col-sm-3 col-xs-3">
	        		<label>Jenis Naskah</label>
	        	</div>
	        	<div class="col-md-9 col-sm-9 col-xs-9">
	        		<input id="input-jenis-naskah" class="form-control" type="text" name="jenis_naskah" required>
	        	</div>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="submit-edit-jenis-naskah" form="form-edit-jenis-naskah" class="btn btn-primary">Save changes</button>
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
		$('#table-jenis-naskah').DataTable();

		$(document).on('click', '#edit-jenis-naskah', function(){
			$('#modal-edit-jenis-naskah').modal('show');

			var id = $(this).data('id');
			var jenis_naskah = $(this).data('jenis-naskah');

			$('#input-jenis-naskah').val(jenis_naskah);
			$('#id').val(id);
		});

		$(document).on('click', '#submit-edit-jenis-naskah', function(){
		    $('#form-edit-jenis-naskah').submit();
		});

		$('#tambah-jenis-naskah').on('click', function() {
			$('#modal-tambah-jenis-naskah').modal('show');
		});

		$(document).on('click', '#submit-tambah-jenis-naskah', function(){
		    $('#form-tambah-jenis-naskah').submit();
		});
	});
</script>
@endpush