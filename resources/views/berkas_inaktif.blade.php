@extends('app.app')
@section('page-title', 'Pengaturan berkas inaktif')
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/dataTables/css/dataTables.bootstrap.min.css') }}">


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
  
    
    <link rel="stylesheet" type="text/css" href="http://sikdnew.kemsos.go.id/style/tree.skinpengguna.css">
    <link rel='stylesheet' type='text/css' href='http://wwwendt.de/tech/dynatree/src/skin-vista/ui.dynatree.css'>



    <style type="text/css">
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






	<table class="table table-bordered table-responsive" id="table-berkas">
		<thead>
			<tr>
				<th>No</th>
				<th>Status Berkas</th>
				<th>No Berkas</th>
				<th>Nama Berkas</th>
				<th>Akhir Retensi Aktif</th>
			
			</tr>
		</thead>
		<tbody>
			@foreach($berkas as $data)
			<tr>
				<td>{{ $no++ }}</td>
				<td>{!! $data->status_berkas() !!}</td>
				<td>{{ $data->kode_klasifikasi.'/'.$data->nomor_berkas }}</td>
				<td>{{ $data->judul_berkas }}</td>
			
				<td>{{ $data->r_aktif }}</td>

				</form>
			</tr>
			@endforeach
		</tbody>
	</table>






@endsection
@push('js')
<script type="text/javascript" src="{{ asset('assets/vendors/dataTables/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/dataTables/js/dataTables.bootstrap.min.js') }}"></script>



<script src='http://wwwendt.de/tech/dynatree/jquery/jquery-ui.custom.js' type="text/javascript"></script>
    <script src='http://wwwendt.de/tech/dynatree/jquery/jquery.cookie.js' type="text/javascript"></script>
    <script src='http://wwwendt.de/tech/dynatree/src/jquery.dynatree.js' type="text/javascript"></script>
<!-- Add code to initialize the tree when the document is loaded: -->

<script type="text/javascript">
	$(document).ready(function() {
		$('#table-berkas').DataTable();

		
		$(document).on('click', '#submit-edit-berkas', function(){
		    $('#form-edit-berkas').submit();
		});

		$('#tambah-berkas').on('click', function() {
			$('#modal-tambah-berkas').modal('show');
		});

		$(document).on('click', '#submit-tambah-berkas', function(){
		    $('#form-tambah-berkas').submit();
		});
	});
</script>
@endpush