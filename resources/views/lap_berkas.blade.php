@extends('laporan')

@section('page-title', 'Laporan berkas')
<title>
	Laporan Berkas
</title>
@section('action')
<form TARGET="_BLANK" action="{{ url('laporan/berkas') }}" method="get" class="form-horizontal" enctype="multipart/form-data">

@endsection