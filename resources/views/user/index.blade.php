@extends('app.app')
@section('page-title', 'Pengaturan user')
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/dataTables/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/dataTables/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="http://sikdnew.kemsos.go.id/style/tree.skinpengguna.css">
<link rel='stylesheet' type='text/css' href='http://wwwendt.de/tech/dynatree/src/skin-vista/ui.dynatree.css'>

<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">





<style type="text/css">
#form-tambah-user {
	margin-top: 20px !important;
}
 .tree, .tree ul {
    margin: 0;
    padding: 0;
    list-style: none;
    font-weight:bolder;
}
.dynatree-has-children >a {
	font-weight: bolder !important;
}


.glyphicon-file {
	color:black !important;
}
</style>


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

	<a href="#" class="btn btn-primary" id="tambah-user">Tambah</a>

	<table class="table table-bordered table-responsive" id="table-user">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Unit Kerja</th>
				<th>Jabatan</th>
				
				<th>Username</th>
				<th>Aktif</th>
				<th>Aksi</th>
				
			</tr>
		</thead>
		<tbody>
			@foreach($user as $data)
			<tr>
				<td>{{ $no++ }}</td>
				<td>{{ $data->nama }}</td>
				<td>{{ $data->jabatan->title  }}</td>
				<td>{{ $data->jabatan->jabatan  }}</td>

				
				<td> {{  $data->username }}</td>
				<td class="text-center">{{ $data->getstatus()  }}</td>
				<td><form style="margin:0; padding:0;" action="{{ url('pengguna/'.$data->id_user.'/delete') }}" method="post">
					@method('delete')
					@csrf
					<a href="javascript:;" class="btn btn-warning" id="edit-user" data-id="{{ $data->id_user }}" data-nama="{{ $data->nama }}" data-username="{{ $data->username }}" data-id_jabatan="{{ $data->id_jabatan }}">Edit</a> 
					<button style="display: inline;" type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Delete</button>
				</form></td>
			</tr>
			@endforeach
		</tbody>
	</table>


<!-- Modal Tambah Satuan-->
<div class="modal fade" id="modal-tambah-user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah user</h4>
      </div>
      <div class="modal-body">

      		<div class="col-md-12 col-sm-2 col-xs-2">
	        	<label>Unit Kerja</label>
	        </div>

      		<div id="tree">
				        <ul>
				            @foreach($unitKerja as $category)
				                <li
				                data="id: '{{ $category->id }}',status: '{{ $category->id_status }}', jabatan: '{{ $category->jabatan }}',id_grup: '{{ $category->id_grup }}',parent_id: '{{ $category->parent_id }}'"
				             
				               
				                 @if(count($category->childs)) class="edit lazy folder" @else class="edit" @endif>
				                	@if(!count($category->childs))
				                	
				                	@endif
				                    {{ $category->title }}
				                    @if(count($category->childs))
				                        @include('manageChild',['childs' => $category->childs])
				                    @endif
				                </li>
				            @endforeach
				        </ul>
	  			</div>
      

        <form class="form-horizontal" id="form-tambah-user" action="{{ url('/pengguna/tambah') }}" method="post">

   
       	
       
        	{!! csrf_field() !!}
        	<input type="hidden" name="id_jabatan" id="id_jabatan">

        	<div class="form-group">
        		<div class="col-md-12 col-sm-2 col-xs-2">
	        		<label>Tipe Pengguna</label>
	        	</div>
	        	<div class="col-md-8 col-sm-10 col-xs-10">
	        		<select name="role" class="role form-control">
						<option value="1">Administrasi pusat</option>
						<option value="2">Administrasi satuan organisasi</option>
						<option value="3">Pejabat struktural</option>
						<option value="4">Sekretaris</option>
						<option value="5">Pencatat surat</option>
					</select>
				</div>
        	</div>
        	

        	<div class="form-group" >
        		<div class="col-md-12 col-sm-2 col-xs-2">
	        		<label>Jabatan Atasan Langsung</label>
	        	</div>

	        	<div class="col-md-12 col-sm-10 col-xs-10">
        			<select name="id_jabatan_atasan" class="selectpicker" data-live-search="true">
	        		@foreach($unit as $item)
					  <option value="{{ $item->id }}">{{ $item->jabatan }}</option>
					 @endforeach
					</select>

        		</div>
        	</div>

        	<div class="form-group">
	        	<div class="col-md-12 col-sm-2 col-xs-2">
	        		<label>Nama Lengkap</label>
	        	</div>
	        	<div class="col-md-8 col-sm-10 col-xs-10">
	        		<input class="form-control" type="text" name="nama" required="">
	        	</div>
        	</div>


        	<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
									<div class="col-md-2 col-sm-2 col-xs-2">
	        		<label>Status Aktif</label>
	        	</div>
	        	<div class="col-md-2 col-sm-10 col-xs-10">
									<input type="checkbox" checked name="id_status" class="status" value="1">
									<span class="text-danger">{{ $errors->first('status') }}</span>
								</div>
				</div>



			<hr>

			<div class="form-group">
	        	<div class="col-md-12 col-sm-2 col-xs-2">
	        		<label>Username</label>
	        	</div>
	        	<div class="col-md-8 col-sm-10 col-xs-10">
	        		<input class="form-control" type="text" name="username" required="">
	        	</div>
        	</div>


        	<div class="form-group">
	        	<div class="col-md-12 col-sm-2 col-xs-2">
	        		<label>Password</label>
	        	</div>
	        	<div class="col-md-8 col-sm-10 col-xs-10">
	        		<input class="form-control" type="password" name="password" required="">
	        	</div>
        	</div>

        	<div class="form-group">
	        	<div class="col-md-12 col-sm-2 col-xs-2">
	        		<label>Ulangi Password</label>
	        	</div>
	        	<div class="col-md-8 col-sm-10 col-xs-10">
	        		<input class="form-control" type="password" name="password_confirmation" required="">
	        	</div>
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="submit-tambah-user" form="form-tambah-user" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit Satuan-->
<div class="modal fade" id="modal-edit-user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit user</h4>
      </div>
      <div class="modal-body">

      	<div class="col-md-12 col-sm-2 col-xs-2">
	        	<label>Unit Kerja</label>
	        </div>

      	<div id="tree2">
				        <ul>
				            @foreach($unitKerja as $category)
				                <li
				                data="id: '{{ $category->id }}',status: '{{ $category->id_status }}', jabatan: '{{ $category->jabatan }}',id_grup: '{{ $category->id_grup }}',parent_id: '{{ $category->parent_id }}'"
				             
				               
				                 @if(count($category->childs)) class="edit lazy folder" @else class="edit" @endif>
				                	@if(!count($category->childs))
				                	
				                	@endif
				                    {{ $category->title }}
				                    @if(count($category->childs))
				                        @include('manageChild',['childs' => $category->childs])
				                    @endif
				                </li>
				            @endforeach
				        </ul>
	  			</div>



        <form style="margin-top:10px" class="form-horizontal" id="form-edit-user" action="{{ url('pengguna/edit') }}" method="post">
        	{!! csrf_field() !!}
        	<input type="hidden" name="id_jabatan" class="id_jabatan">
        	<input type="hidden" name="id_user" class="id_user">
        	<div class="form-group">
        		<div class="col-md-12 col-sm-2 col-xs-2">
	        		<label>Tipe Pengguna</label>
	        	</div>
	        	<div class="col-md-8 col-sm-10 col-xs-10">
	        		<select name="role" class="role form-control">
						<option value="1">Administrasi pusat</option>
						<option value="2">Administrasi satuan organisasi</option>
						<option value="3">Pejabat struktural</option>
						<option value="4">Sekretaris</option>
						<option value="5">Pencatat surat</option>
					</select>
				</div>
        	</div>
        	

        	<div class="form-group" >
        		<div class="col-md-12 col-sm-2 col-xs-2">
	        		<label>Jabatan Atasan Langsung</label>
	        	</div>

	        	<div class="col-md-12 col-sm-10 col-xs-10">
        			<select name="jabatan_atasan_langsung" class="selectpicker" data-live-search="true">
	        		@foreach($unit as $item)
					  <option value="{{ $item->id }}">{{ $item->jabatan }}</option>
					 @endforeach
					</select>

        		</div>
        	</div>

        	<div class="form-group">
	        	<div class="col-md-12 col-sm-2 col-xs-2">
	        		<label>Nama Lengkap</label>
	        	</div>
	        	<div class="col-md-8 col-sm-10 col-xs-10">
	        		<input class="form-control" type="text" id="ed_nama" name="nama" required="">
	        	</div>
        	</div>


        	<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
									<div class="col-md-2 col-sm-2 col-xs-2">
	        		<label>Status Aktif</label>
	        	</div>
	        	<div class="col-md-2 col-sm-10 col-xs-10">
									<input type="checkbox" checked name="id_status" class="status" value="1">
									<span class="text-danger">{{ $errors->first('status') }}</span>
								</div>
				</div>



			<hr>

			<div class="form-group">
	        	<div class="col-md-12 col-sm-2 col-xs-2">
	        		<label>Username</label>
	        	</div>
	        	<div class="col-md-8 col-sm-10 col-xs-10">
	        		<input id="ed_username" class="form-control" type="text" name="username" required="">
	        	</div>
        	</div>


        	<div class="form-group">
	        	<div class="col-md-12 col-sm-2 col-xs-2">
	        		<label>Password</label>
	        	</div>
	        	<div class="col-md-8 col-sm-10 col-xs-10">
	        		<input class="form-control" type="password" name="password">
	        	</div>
        	</div>

        	<div class="form-group">
	        	<div class="col-md-12 col-sm-2 col-xs-2">
	        		<label>Ulangi Password</label>
	        	</div>
	        	<div class="col-md-8 col-sm-10 col-xs-10">
	        		<input class="form-control" type="password" name="password_confirmation">
	        	</div>
        	</div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="submit-edit-user" form="form-edit-user" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

@endsection
@push('js')
<script type="text/javascript" src="{{ asset('assets/vendors/dataTables/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/dataTables/js/dataTables.bootstrap.min.js') }}"></script>

 <script src='http://wwwendt.de/tech/dynatree/jquery/jquery-ui.custom.js' type="text/javascript"></script>
    <script src='http://wwwendt.de/tech/dynatree/jquery/jquery.cookie.js' type="text/javascript"></script>
    <script src='http://wwwendt.de/tech/dynatree/src/jquery.dynatree.js' type="text/javascript"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
<!-- Add code to initialize the tree when the document is loaded: -->
    <script type="text/javascript">
    $(function(){
       
        $("#tree").dynatree({
        	autoCollapse: true,
            onActivate: function(node) {
                $('#id_jabatan').val(node.data.id);
            },
            persist: false
            
        });
    });


    $(function(){
       
        $("#tree2").dynatree({
        	autoCollapse: true,
            onActivate: function(node) {
                $('.id_jabatan').val(node.data.id);
            },
            persist: false
            
        });
    });
    </script>


<script type="text/javascript">
	$(document).ready(function() {
		$('#table-user').DataTable();

		$(document).on('click', '#edit-user', function(){
			$('#modal-edit-user').modal('show');

			var id = $(this).data('id');
			var nama = $(this).data('nama');
			var username = $(this).data('username');
			var ids = $(this).data('id_jabatan');
			$('.id_jabatan').val(ids);
			$('.id_user').val(id);
			$('#ed_nama').val(nama);
			$('#ed_username').val(username);
			$('#id').val(id);
		});

		$(document).on('click', '#submit-edit-user', function(){
		    $('#form-edit-user').submit();
		});

		$('#tambah-user').on('click', function() {
			$('#modal-tambah-user').modal('show');
		});

		$(document).on('click', '#submit-tambah-user', function(){
		    $('#form-tambah-user').submit();
		});
	});
</script>
@endpush