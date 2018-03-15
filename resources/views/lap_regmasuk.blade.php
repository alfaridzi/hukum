@extends('laporan')

@section('page-title', 'Laporan Registrasi Naskah Masuk')
<title>
    Laporan Registrasi Naskah Masuk
</title>
@section('action')
<form TARGET="_BLANK" action="{{ url('laporan/reg-naskah-masuk') }}" method="get" class="form-horizontal" enctype="multipart/form-data">

@endsection