@extends('app.app')
@section('page-title', 'Berita Acara Penyerahan Arsip Statis')
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/dataTables/css/dataTables.bootstrap.min.css') }}
">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
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

	<div class="row" id="form-tambah">
		<div class="col-md-5">
			<form action="#" method="post">
				<div class="form-group">
					<label>Nomor Berita Acara</label>
					<input type="text" name="nomor_berita" class="form-control">
				</div>
				<div class="form-group">
					<label>Tanggal Berita Acara</label>
					<input type="text" name="tanggal_berita" id="datepicker" class="form-control">
				</div>
				<div class="form-group">
					<label>No. Surat Usul Musnah</label>
					<select class="form-control" name="no_usul_musnah">
						<option selected="" disabled="">-</option>
					</select>
				</div>
				<div class="form-group">
					<label>Upload Surat</label>
					<input type="file" name="upload_surat">
				</div>
			</div>
			<div class="col-md-12">
				<br>
				<table class="table table-bordered table-responsive" id="table-usul-arsip1">
					<thead>
						<tr>
							<th>No</th>
							<th>Kode Berkas</th>
							<th>Nama Berkas</th>
							<th>Unit Kerja</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
			</div>
			<div class="col-md-12 pull-right">
				<button class="btn btn-primary" type="submit">Simpan</button> <a href="javascript:;" class="btn btn-warning" id="btn-batal">Batal</a>
			</div>
		</form>
	</div>

	<div class="row" id="form-tbl">
		<a href="javascript:;" class="btn btn-primary" id="btn-tambah">Tambah</a>
		<br>
		<table class="table table-bordered table-responsive" id="table-usul-arsip2">
			<thead>
				<tr>
					<th>No</th>
					<th>Nomor Berita Acara</th>
					<th>Tanggal Berita Acara</th>
					<th>File Berita Acara</th>
					<th>Surat Permohonan</th>
					<th>Ket</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				
			</tbody>
		</table>
	</div>
@endsection
@push('js')
<script type="text/javascript" src="{{ asset('assets/vendors/dataTables/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/dataTables/js/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

<script type="text/javascript">
	$('#form-tambah').hide();

	$(document).ready(function() {
		$('#table-usul-arsip1').DataTable();
		$('#table-usul-arsip2').DataTable();
	});

	$('#datepicker').datepicker({
        format: 'yyyy-mm-dd',
    });

    $('#btn-tambah').on('click', function(){
    	$('#form-tambah').show();
    	$('#form-tbl').hide();
    	alert('Tidak ada permohanan usul musnah!!');
    	window.location.replace("{{ url('berkas/serah') }}");
    });

    $('#btn-batal').on('click', function(){
    	$('#form-tbl').show();
    	$('#form-tambah').hide();
    });
</script>
@endpush