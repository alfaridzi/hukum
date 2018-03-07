@extends('app.app')
@section('page-title', 'Detail Naskah')
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/dataTables/css/dataTables.bootstrap.min.css') }}">
<style type="text/css">
	#metadata div {
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

<a href="{{ url('/naskah-masuk/detail/'.$naskah->id_naskah.'/ubah-metadata') }}" class="btn btn-warning">Ubah Metadata</a>

<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#tindaklanjut-masuk" aria-controls="home" role="tab" data-toggle="tab">Tindaklanjut Masuk</a></li>
    <li role="presentation"><a href="#histori-naskah" aria-controls="profile" role="tab" data-toggle="tab">Histori Naskah</a></li>
    <li role="presentation"><a href="#metadata" aria-controls="messages" role="tab" data-toggle="tab">Metadata</a></li>
    <li role="presentation"><a href="#status-pemberkasan" aria-controls="settings" role="tab" data-toggle="tab">Status Pemberkasan</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="tindaklanjut-masuk">
    	<br>
    	<table class="table table-bordered table-responsive" id="table-detail-1">
			<thead>
				<tr>
					<th>No</th>
					<th>Tanggal & Jam</th>
					<th>Asal Naskah</th>
					<th>Tujuan Naskah</th>
					<th>Keterangan</th>
					<th>Pesan</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
    </div>
    <div role="tabpanel" class="tab-pane" id="histori-naskah">
    	<br>
    	<table class="table table-bordered table-responsive" id="table-detail-2">
			<thead>
				<tr>
					<th>No</th>
					<th>Tanggal & Jam</th>
					<th>Asal Naskah</th>
					<th>Tujuan Naskah</th>
					<th>Keterangan</th>
					<th>Pesan</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
    </div>
    <div role="tabpanel" class="tab-pane" id="metadata">
    	<br>
    	<div class="row">
    		<div class="col-md-4"><label>Instansi : </label></div>
    		<div class="col-md-8">{{ $naskah->asal_naskah }}</div>
    	</div>
    	<br>
    	<div class="row">
    		<div class="col-md-4"><label>Jenis Naskah : </label></div>
    		<div class="col-md-8">{{ $naskah->jenisNaskah->jenis_naskah }}</div>
    	</div>
    	<div class="row">
    		<div class="col-md-4"><label>Tingkat Perkembangan : </label></div>
    		<div class="col-md-8">{{ $naskah->detail->tingkatPerkembangan->tingkat }}</div>
    	</div>
    	<div class="row">
    		<div class="col-md-4"><label>Tanggal Naskah : </label></div>
    		<div class="col-md-8">{{ $naskah->get_tanggal_naskah() }}</div>
    	</div>
    	<br>
    	<div class="row">
    		<div class="col-md-4"><label>Nomor Asal Naskah : </label></div>
    		<div class="col-md-8">{{ $naskah->nomor_naskah }}</div>
    	</div>
    	<div class="row">
    		<div class="col-md-4"><label>Nomor Agenda : </label></div>
    		<div class="col-md-8">{{ $naskah->nomor_agenda }}</div>
    	</div>
    	<br>
    	<div class="row">
    		<div class="col-md-4"><label>Hal : </label></div>
    		<div class="col-md-8">{{ $naskah->hal }}</div>
    	</div>
    	<div class="row">
    		<div class="col-md-4"><label>Tingkat Urgensi : </label></div>
    		<div class="col-md-8">{{ $naskah->urgensi->tingkat }}</div>
    	</div>
    	<div class="row">
    		<div class="col-md-4"><label>Sifat Naskah : </label></div>
    		<div class="col-md-8">{{ $naskah->detail->sifatNaskah->sifat_naskah }}</div>
    	</div>
    	<div class="row">
    		<div class="col-md-4"><label>Kategori Arsip : </label></div>
    		<div class="col-md-8">{{ $naskah->detail->kategori_arsip() }}</div>
    	</div>
    	<div class="row">
    		<div class="col-md-4"><label>Tingkat Akses Publik : </label></div>
    		<div class="col-md-8">{{ $naskah->detail->akses_publik() }}</div>
    	</div>
    	<div class="row">
    		<div class="col-md-4"><label>Media Arsip : </label></div>
    		<div class="col-md-8">{{ $naskah->detail->mediaArsip->media_arsip }}</div>
    	</div>
    	<div class="row">
    		<div class="col-md-4"><label>Bahasa : </label></div>
    		<div class="col-md-8">{{ $naskah->detail->bahasas->bahasa }}</div>
    	</div>
    	<div class="row">
    		<div class="col-md-4"><label>Isi Ringkas : </label></div>
    		<div class="col-md-8">{{ $naskah->detail->isi_ringkas }}</div>
    	</div>
    	<div class="row">
    		<div class="col-md-4"><label>Arsip Vital / Tidak Vital : </label></div>
    		<div class="col-md-8">{{ $naskah->detail->vital() }}</div>
    	</div>
    	<div class="row">
    		<div class="col-md-4"><label>Jumlah : </label></div>
    		<div class="col-md-8">{{ $naskah->detail->jumlah }} {{ $naskah->detail->satuanUnit->satuan_unit }}</div>
    	</div>
    </div>
    <div role="tabpanel" class="tab-pane" id="status-pemberkasan">.a..</div>
  </div>

</div>

@endsection
@push('js')
<script type="text/javascript" src="{{ asset('assets/vendors/dataTables/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/dataTables/js/dataTables.bootstrap.min.js') }}"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#table-detail-1').DataTable();
		$('#table-detail-2').DataTable();
	});
</script>
@endpush