@extends('app.app')
@section('page-title', 'Tambah Data Instansi')
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
<style type="text/css">
    label span {
        color:red;
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

<form class="form-horizontal" action="{{ url('pengaturan/instansi/simpan') }}" method="post">
    @csrf
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Kode Instansi <span>*</span></label>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <input type="text" name="kode_instansi" class="form-control" required>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Nama Instansi <span>*</span></label>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-9 col-xs-9">
            <input type="text" name="nama_instansi" class="form-control" value="KEMENTERIAN SOSIAL REPUBLIK INDONESIA" required>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Nama Resmi Lainnya</label>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-9 col-xs-9">
            <input type="text" name="nama_lain" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Tipe Instansi</label>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-9 col-xs-9">
            <input type="text" name="tipe_instansi" class="form-control" required>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Tanggal Keberadaan Instansi <span>*</span></label>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-5">
            <div class="input-group date" data-provide="datepicker">
			    <input type="text" class="form-control" name="tanggal_keberadaan" required>
			    <div class="input-group-addon">
			        <span class="glyphicon glyphicon-th"></span>
			    </div>
			</div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Fungsi, Jabatan dan Kegiatan <span>*</span></label>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-9 col-xs-9">
            <textarea id="detail" name="detail" class="form-control" rows="10" required></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Mandat/Sumber Kewenangan <span>*</span></label>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-9 col-xs-9">
            <input type="text" name="mandat" class="form-control" required>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Status <span>*</span></label>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-9 col-xs-9">
        	<label class="radio-inline">
            	<input type="radio" name="status" value="1" required> Aktif
            </label>
            <label class="radio-inline">
            	<input type="radio" name="status" value="0"> Tidak Aktif
            </label>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10 col-md-offset-2 col-md-10 col-sm-offset-3 col-sm-9 col-xs-offset-3 col-xs-9">
            <button class="btn btn-primary">Simpan Perubahan</button>
        </div>
    </div>
</form>
	
@endsection
@push('js')
<script type="text/javascript" src="{{ asset('assets/vendors/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
@endpush