@extends('app.app')
@section('page-title', 'Pengaturan Text Tombol')
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
            <li>Berhasil update data</li>
        </ul>
    </div>
@endif

	<table class="table table-bordered table-responsive" id="table-text-button">
		<thead>
			<tr>
				<th>No</th>
				<th>Keterangan</th>
				<th>Text</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			@foreach($textTombol as $data)
			<tr>
				<td>{{ $no++ }}</td>
				<td>{{ $data->keterangan }}</td>
				<td>{{ $data->text }}</td>
				<td><a href="javascript:;" class="btn btn-warning" id="edit-button" data-id="{{ $data->id_button }}" data-keterangan="{{ $data->keterangan }}" data-text="{{ $data->text }}">Edit</a></td>
			</tr>
			@endforeach
		</tbody>
	</table>


<!-- Modal -->
<div class="modal fade" id="modal-edit-button" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Text Button</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="form-edit-button" action="{{ url('pengaturan/text-tombol/edit') }}" method="post">
        	{!! csrf_field() !!}
        	<input type="hidden" name="id" id="id" required>
        	<div class="form-group">
	        	<div class="col-md-3 col-sm-3 col-xs-3">
	        		<label>Keterangan</label>
	        	</div>
	        	<div class="col-md-9 col-sm-9 col-xs-9">
	        		<input id="input-keterangan" class="form-control" type="text" disabled="" readonly="">
	        	</div>
        	</div>
        	<div class="form-group">
	        	<div class="col-md-3 col-sm-3 col-xs-3">
	        		<label>Text</label>
	        	</div>
	        	<div class="col-md-9 col-sm-9 col-xs-9">
	        		<input id="input-text" name="text" class="form-control" type="text" required>
	        	</div>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="submit-edit-button" class="btn btn-primary">Save changes</button>
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
		$('#table-text-button').DataTable();

		$(document).on('click', '#edit-button', function(){
			$('#modal-edit-button').modal('show');			

			var id = $(this).data('id');
			var keterangan = $(this).data('keterangan');
			var text = $(this).data('text');

			$('#input-keterangan').val(keterangan);
			$('#input-text').val(text);
			$('#id').val(id);
		});

		$(document).on('click', '#submit-edit-button', function(){
		    $('#form-edit-button').submit();
		});
	});
</script>
@endpush