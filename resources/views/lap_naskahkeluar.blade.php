@extends('laporan')

@section('page-title', 'Laporan Naskah keluar')
<title>
	Laporan Naskah keluar
</title>
@section('action')
<form TARGET="_BLANK" action="{{ url('laporan/naskah-keluar') }}" method="get" class="form-horizontal" enctype="multipart/form-data">

@endsection