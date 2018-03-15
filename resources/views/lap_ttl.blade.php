@extends('laporan')

@section('page-title', 'Laporan Naskah Tanpa Tindak Lanjut')
<title>
	Laporan Naskah Masuk Tanpa Tindak Lanjut
</title>
@section('action')
<form TARGET="_BLANK" action="{{ url('laporan/reg-naskah-tanpa-tindak-lanjut') }}" method="get" class="form-horizontal" enctype="multipart/form-data">

@endsection