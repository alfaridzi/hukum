@extends('app.app')
@section('page-title', 'Ubah Metadata')
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
<style type="text/css">
	label span {
        color:red;
    }
    label#last-agenda {
        color:red;
    }
    p#tujuan-naskah {
        font-size: 14px;
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

<form class="form-horizontal" action="{{ url('/log/naskah-keluar/detail/'.$naskah->id_naskah.'/ubah-metadata/update') }}" method="post">
	@csrf
	<div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Tanggal Registrasi</label>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-7 col-xs-8">
            <p>{{ $naskah->tanggal_registrasi }}</p>
        </div>
    </div>
    <br>
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Jenis Naskah <span>*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-5 col-xs-6">
            <select name="jenis_naskah" class="form-control" required>
            	@foreach($jenisNaskah as $data)
            	<option @if($data->id_jenis_naskah == $naskah->jenisNaskah->id_jenis_naskah) selected @endif value="{{ $data->id_jenis_naskah }}">{{ $data->jenis_naskah }}</option>
            	@endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Tingkat Perkembangan <span>*</span></label>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5">
            <select name="perkembangan" class="form-control" required>
            	@foreach($perkembangan as $data)
            	<option @if($data->id_perkembangan == $naskah->tingkatPerkembangan->id_perkembangan) selected @endif value="{{ $data->id_perkembangan }}">{{ $data->tingkat }}</option>
            	@endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Tanggal Naskah <span>*</span></label>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5">
            <input type="text" id="datepicker" name="tanggal_naskah" class="form-control" value="{{ $naskah->tanggal_naskah }}" required>
        </div>
    </div>
    <br>
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Nomor Asal Naskah <span>*</span></label>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-7 col-xs-8">
            <input type="text" class="form-control" name="nomor_naskah" value="{{ $naskah->nomor_naskah }}" required>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Nomor Agenda</label>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-7 col-xs-8">
            <input type="text" class="form-control" name="nomor_agenda" value="{{ $naskah->nomor_agenda }}" placeholder="disini jika menggunakan buku agenda">
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10 col-md-offset-2 col-md-10 col-sm-offset-3 col-sm-9 col-xs-offset-3 col-xs-9">
            <label id="last-agenda">Nomor Agenda Terakhir adalah : {{ $nomor_agenda }}</label>
        </div>
        <div class="col-lg-offset-2 col-lg-10 col-md-offset-2 col-md-10 col-sm-offset-3 col-sm-9 col-xs-offset-3 col-xs-9">
            <p>Pengisian No. Agenda harus mencantumkan Tahun, contoh : 001/xx/2018</p>
        </div>
    </div>
    <br>
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Hal <span>*</span></label>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-7 col-xs-8">
            <input type="text" class="form-control" name="hal" value="{{ $naskah->hal }}" required>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Tingkat Urgensi <span>*</span></label>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5">
            <select name="tingkat_urgensi" class="form-control" required>
            	@foreach($urgensi as $data)
            	<option @if($data->id_urgensi == $naskah->urgensi->id_urgensi) selected @endif value="{{ $data->id_urgensi }}">{{ $data->tingkat }}</option>
            	@endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Sifat Naskah <span>*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-5 col-xs-6">
            <select name="sifat_naskah" class="form-control" required>
            	@foreach($sifatNaskah as $data)
            	<option @if($data->id_sifat_naskah == $naskah->sifatNaskah->id_sifat_naskah) selected @endif value="{{ $data->id_sifat_naskah }}">{{ $data->sifat_naskah }}</option>
            	@endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Kategori Arsip <span>*</span></label>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5">
            <select name="kategori_arsip" class="form-control" required>
            	<option value="0" @if($naskah->kategori_arsip == '0') selected @endif>Umum</option>
            	<option value="1" @if($naskah->kategori_arsip == '1') selected @endif>Terjaga</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Tingkat Akses Publik <span>*</span></label>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5">
            <select name="akses_publik" class="form-control" required>
            	<option value="0" @if($naskah->akses_publik == '0') selected @endif>Terbuka</option>
            	<option value="1" @if($naskah->akses_publik == '1') selected @endif>Tertutup</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Media Arsip <span>*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-5 col-xs-6">
            <select name="media_arsip" class="form-control" required>
            	@foreach($mediaArsip as $data)
            	<option @if($data->id_media_arsip == $naskah->mediaArsip->id_media_arsip) selected @endif value="{{ $data->id_media_arsip }}">{{ $data->media_arsip }}</option>
            	@endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Bahasa <span>*</span></label>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5">
            <select name="bahasa" class="form-control" required>
            	@foreach($bahasa as $data)
            	<option @if($data->id_bahasa == $naskah->bahasas->id_bahasa) selected @endif value="{{ $data->id_bahasa }}">{{ $data->bahasa }}</option>
            	@endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Isi Ringkas</label>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-7 col-xs-8">
            <textarea name="isi_ringkas" class="form-control" rows="10">{{ $naskah->isi_ringkas }}</textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Arsip Vital / Tidak Vital <span>*</span></label>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5">
            <select name="vital" class="form-control">
            	<option value="0" @if($naskah->vital == '0') selected @endif>Tidak Vital</option>
            	<option value="1" @if($naskah->vital == '1') selected @endif>Vital</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Jumlah</label>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
            <input type="number" name="jumlah" class="form-control" value="{{ $naskah->jumlah }}">
        </div>
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5">
            <select name="satuan_unit" class="form-control">
            	@foreach($satuanUnit as $data)
            	<option @if($data->id_satuan == $naskah->satuanUnit->id_satuan) selected @endif value="{{ $data->id_satuan }}">{{ $data->nama_satuan }}</option>
            	@endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Lokasi Fisik</label>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-7 col-xs-8">
            <input type="text" class="form-control" name="lokasi_fisik" value="{{ $naskah->lokasi_fisik }}">
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10 col-md-offset-2 col-md-10 col-sm-offset-3 col-sm-9 col-xs-offset-3 col-xs-9">
            <button class="btn btn-primary">Kirim</button>
        </div>
    </div>
</form>
@endsection
@push('js')
<script type="text/javascript" src="{{ asset('assets/vendors/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript">
	$('#datepicker').datepicker({
        format: 'yyyy-mm-dd',
    });
</script>
@endpush