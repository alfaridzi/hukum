@extends('app.app')
@section('page-title', 'Pengaturan Sifat Naskah')
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

	<a href="#" class="btn btn-primary" id="tambah-sifat-naskah">Tambah</a>

	<table class="table table-bordered table-responsive" id="table-sifat-naskah">
		<thead>
			<tr>
				<th>No</th>
				<th>Sifat Naskah</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			@foreach($sifatNaskah as $data)
			<tr>
				<td>{{ $no++ }}</td>
				<td>{{ $data->sifat_naskah }}</td>
				<td><form style="margin:0; padding:0;" action="{{ url('pengaturan/sifat-naskah/'.$data->id_sifat_naskah.'/delete') }}" method="post">
					@method('delete')
					@csrf
					<a href="javascript:;" class="btn btn-warning" id="edit-sifat-naskah" data-id="{{ $data->id_sifat_naskah }}" data-sifat-naskah="{{ $data->sifat_naskah }}">Edit</a> 
					<button style="display: inline;" type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete</button>
				</form></td>
			</tr>
			@endforeach
		</tbody>
	</table>


<!-- Modal Tambah Satuan-->
<div class="modal fade" id="modal-tambah-sifat-naskah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Sifat Naskah</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="form-tambah-sifat-naskah" action="{{ url('pengaturan/sifat-naskah/tambah') }}" method="post">
        	{!! csrf_field() !!}
        	<div class="form-group">
	        	<div class="col-md-3 col-sm-3 col-xs-3">
	        		<label>Sifat Naskah</label>
	        	</div>
	        	<div class="col-md-9 col-sm-9 col-xs-9">
	        		<input class="form-control" type="text" name="sifat_naskah" required="">
	        	</div>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="submit-tambah-sifat-naskah" form="form-tambah-sifat-naskah" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit Satuan-->
<div class="modal fade" id="modal-edit-sifat-naskah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Sifat Naskah</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="form-edit-sifat-naskah" action="{{ url('pengaturan/sifat-naskah/edit') }}" method="post">
        	{!! csrf_field() !!}
        	<input type="hidden" name="id" id="id" required>
        	<div class="form-group">
	        	<div class="col-md-3 col-sm-3 col-xs-3">
	        		<label>Sifat Naskah</label>
	        	</div>
	        	<div class="col-md-9 col-sm-9 col-xs-9">
	        		<input id="input-sifat-naskah" class="form-control" type="text" name="sifat_naskah" required>
	        	</div>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="submit-edit-sifat-naskah" form="form-edit-sifat-naskah" class="btn btn-primary">Save changes</button>
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
		$('#table-sifat-naskah').DataTable();

		$(document).on('click', '#edit-sifat-naskah', function(){
			$('#modal-edit-sifat-naskah').modal('show');

			var id = $(this).data('id');
			var sifat_naskah = $(this).data('sifat-naskah');

			$('#input-sifat-naskah').val(sifat_naskah);
			$('#id').val(id);
		});

		$(document).on('click', '#submit-edit-sifat-naskah', function(){
		    $('#form-edit-sifat-naskah').submit();
		});

		$('#tambah-sifat-naskah').on('click', function() {
			$('#modal-tambah-sifat-naskah').modal('show');
		});

		$(document).on('click', '#submit-tambah-sifat-naskah', function(){
		    $('#form-tambah-sifat-naskah').submit();
		});
	});
</script>
@endpush