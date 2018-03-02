@extends('app.app')
@section('page-title', 'Pengaturan Halaman Depan')
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

<form class="form-horizontal">
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Judul Halaman</label>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-9 col-xs-9">
            <input type="text" name="header_page" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Konten</label>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-9 col-xs-9">
            <textarea id="konten" name="konten" class="form-control"></textarea>
        </div>
    </div>
</form>

@endsection
@push('js')
<script type="text/javascript" src="{{ asset('assets/vendors/dataTables/js/dataTables.bootstrap.min.js') }}"></script>
@endpush