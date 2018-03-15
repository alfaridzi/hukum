@extends('laporan')

@section('page-title', 'Laporan Naskah Masuk')
<title>
	Laporan Naskah Masuk
</title>
@section('action')
<form TARGET="_BLANK" action="{{ url('laporan/naskah-masuk') }}" method="get" class="form-horizontal" enctype="multipart/form-data">

@endsection