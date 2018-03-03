@extends('app.app')
@section('page-title', 'Pengaturan Media Arsip')
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

	<a href="#" class="btn btn-primary" id="tambah-media-arsip">Tambah</a>

	<table class="table table-bordered table-responsive" id="table-media-arsip">
		<thead>
			<tr>
				<th>No</th>
				<th>Media Arsip</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			@foreach($mediaArsip as $data)
			<tr>
				<td>{{ $no++ }}</td>
				<td>{{ $data->media_arsip }}</td>
				<td><form style="margin:0; padding:0;" action="{{ url('pengaturan/media-arsip/'.$data->id_media_arsip.'/delete') }}" method="post">
					@method('delete')
					@csrf
					<a href="javascript:;" class="btn btn-warning" id="edit-media-arsip" data-id="{{ $data->id_media_arsip }}" data-media-arsip="{{ $data->media_arsip }}">Edit</a> 
					<button style="display: inline;" type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete</button>
				</form></td>
			</tr>
			@endforeach
		</tbody>
	</table>


<!-- Modal Tambah Satuan-->
<div class="modal fade" id="modal-tambah-media-arsip" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Media Arsip</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="form-tambah-media-arsip" action="{{ url('pengaturan/media-arsip/tambah') }}" method="post">
        	{!! csrf_field() !!}
        	<div class="form-group">
	        	<div class="col-md-3 col-sm-3 col-xs-3">
	        		<label>Media Arsip</label>
	        	</div>
	        	<div class="col-md-9 col-sm-9 col-xs-9">
	        		<input class="form-control" type="text" name="media_arsip" required="">
	        	</div>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="submit-tambah-media-arsip" form="form-tambah-media-arsip" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit Satuan-->
<div class="modal fade" id="modal-edit-media-arsip" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Media Arsip</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="form-edit-media-arsip" action="{{ url('pengaturan/media-arsip/edit') }}" method="post">
        	{!! csrf_field() !!}
        	<input type="hidden" name="id" id="id" required>
        	<div class="form-group">
	        	<div class="col-md-3 col-sm-3 col-xs-3">
	        		<label>Media Arsip</label>
	        	</div>
	        	<div class="col-md-9 col-sm-9 col-xs-9">
	        		<input id="input-media-arsip" class="form-control" type="text" name="media_arsip" required>
	        	</div>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="submit-edit-media-arsip" form="form-edit-media-arsip" class="btn btn-primary">Save changes</button>
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
		$('#table-media-arsip').DataTable();

		$(document).on('click', '#edit-media-arsip', function(){
			$('#modal-edit-media-arsip').modal('show');

			var id = $(this).data('id');
			var media_arsip = $(this).data('media-arsip');

			$('#input-media-arsip').val(media_arsip);
			$('#id').val(id);
		});

		$(document).on('click', '#submit-edit-media-arsip', function(){
		    $('#form-edit-media-arsip').submit();
		});

		$('#tambah-media-arsip').on('click', function() {
			$('#modal-tambah-media-arsip').modal('show');
		});

		$(document).on('click', '#submit-tambah-media-arsip', function(){
		    $('#form-tambah-media-arsip').submit();
		});
	});
</script>
@endpush