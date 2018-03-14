@extends('app.app')
@section('page-title', 'Detail Naskah')
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/dataTables/css/dataTables.bootstrap.min.css') }}">
<style type="text/css">
	#metadata div {
		font-size: 14px;
	}
    input[type=file].form-control {
        height: auto;
        border: 0px;
        box-shadow: none;
    }
    .box-file {
        max-height: 200px;
        overflow-y: auto;
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
@if(is_null($getNaskah->id_berkas))
    <h3 style="color: red" class="text-center">Naskah Belum Diberkaskan</h3>
@endif
{{-- <a href="javascript:;" class="btn btn-success" id="btn-teruskan">Teruskan</a> 
<a href="javascript:;" class="btn btn-info" id="btn-balas">Reply</a> 
<a href="javascript:;" class="btn btn-primary" id="btn-disposisi">Disposisi</a>  --}}
<a href="{{ url('/log/memo/detail/'.$metadataNaskah->id_naskah.'/ubah-metadata') }}" class="btn btn-warning">Ubah Metadata</a>

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
					<th>Asal Naskah</th> <!-- Jabatan Pengirim -->
					<th>Tujuan Naskah</th> <!-- Tujuan Kepada sama tembusan -->
					<th>Keterangan</th>
					<th>Pesan</th>
                    <th>File Upload</th>
                    <th>Aksi</th>
				</tr>
			</thead>
			<tbody>
                @foreach($naskah as $data)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $data->tanggal_registrasi }}</td>
                    <td>
                        @if($naskah->count() < $no)
                            {{ $getNaskah->asal_naskah }}
                        @else
                            {{ $data->user->jabatan->jabatan }}
                        @endif
                    </td>
                    <td>@foreach($data->penerima as $dataPenerima)
                        @if($dataPenerima->sebagai == 'bcc')
                            @if(!$cek) @php $cek = true @endphp<br> <b>Tembusan:</b> @endif
                        @endif
                        @if(!is_null($dataPenerima->tujuan_kirim))
                            {{ $dataPenerima->tujuan_kirim->jabatan->jabatan }},
                        @endif
                    @endforeach</td>
                    <td>{{ $data->get_tipe_registrasi() }}</td>
                    <td>{{ $data->pesan }}</td>
                    <td><ol>@foreach($data->files as $dataFiles)
                        <li><a href="{{ url('/log/naskah-tanpa-tindak-lanjut/detail/'.$data->id_naskah.'/download/'.$dataFiles->nama_file) }}">{{ $dataFiles->nama_file }}</a></li>
                    @endforeach</ol></td>
                    <td></td>
                </tr>
                @endforeach
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
                    <th>File Upload</th>
                    <th>Aksi</th>
				</tr>
			</thead>
			<tbody>
                @foreach($naskah1 as $data)
                <tr>
                    <td>{{ $no1++ }}</td>
                    <td>{{ $data->tanggal_registrasi }}</td>
                    <td>
                        @if($naskah1->count() < $no1)
                            {{ $getNaskah->asal_naskah }}
                        @else
                            {{ $data->user->jabatan->jabatan }}
                        @endif
                    </td>
                    <td>@foreach($data->penerima as $dataPenerima)
                        @if($dataPenerima->sebagai == 'bcc')
                            @if(!$cek) @php $cek = true @endphp<br> <b>Tembusan:</b> @endif
                        @endif
                        @if(!is_null($dataPenerima->tujuan_kirim))
                            {{ $dataPenerima->tujuan_kirim->jabatan->jabatan }},
                        @endif
                    @endforeach</td>
                    <td>{{ $data->get_tipe_registrasi() }}</td>
                    <td>{{ $data->pesan }}</td>
                    <td><ol>@foreach($data->files as $dataFiles)
                        <li><a href="{{ url('/log/naskah-tanpa-tindak-lanjut/detail/'.$data->id_naskah.'/download/'.$dataFiles->nama_file) }}">{{ $dataFiles->nama_file }}</a></li>
                    @endforeach</ol></td>
                    <td></td>
                </tr>
                @endforeach
			</tbody>
		</table>
    </div>
    <div role="tabpanel" class="tab-pane" id="metadata">
    	<br>
    	<div class="row">
    		<div class="col-md-4"><label>Instansi : </label></div>
    		<div class="col-md-8">{{ $metadataNaskah->asal_naskah }}</div>
    	</div>
    	<br>
    	<div class="row">
    		<div class="col-md-4"><label>Jenis Naskah : </label></div>
    		<div class="col-md-8">{{ $metadataNaskah->jenisNaskah->jenis_naskah }}</div>
    	</div>
    	<div class="row">
    		<div class="col-md-4"><label>Tingkat Perkembangan : </label></div>
    		<div class="col-md-8">{{ $metadataNaskah->tingkatPerkembangan->tingkat }}</div>
    	</div>
    	<div class="row">
    		<div class="col-md-4"><label>Tanggal Naskah : </label></div>
    		<div class="col-md-8">{{ $metadataNaskah->get_tanggal_naskah() }}</div>
    	</div>
    	<br>
    	<div class="row">
    		<div class="col-md-4"><label>Nomor Asal Naskah : </label></div>
    		<div class="col-md-8">{{ $metadataNaskah->nomor_naskah }}</div>
    	</div>
    	<div class="row">
    		<div class="col-md-4"><label>Nomor Agenda : </label></div>
    		<div class="col-md-8">{{ $metadataNaskah->nomor_agenda }}</div>
    	</div>
    	<br>
    	<div class="row">
    		<div class="col-md-4"><label>Hal : </label></div>
    		<div class="col-md-8">{{ $metadataNaskah->hal }}</div>
    	</div>
    	<div class="row">
    		<div class="col-md-4"><label>Tingkat Urgensi : </label></div>
    		<div class="col-md-8">{{ $metadataNaskah->urgensi->tingkat }}</div>
    	</div>
    	<div class="row">
    		<div class="col-md-4"><label>Sifat Naskah : </label></div>
    		<div class="col-md-8">{{ $metadataNaskah->sifatNaskah->sifat_naskah }}</div>
    	</div>
    	<div class="row">
    		<div class="col-md-4"><label>Kategori Arsip : </label></div>
    		<div class="col-md-8">{{ $metadataNaskah->get_kategori_arsip() }}</div>
    	</div>
    	<div class="row">
    		<div class="col-md-4"><label>Tingkat Akses Publik : </label></div>
    		<div class="col-md-8">{{ $metadataNaskah->get_akses_publik() }}</div>
    	</div>
    	<div class="row">
    		<div class="col-md-4"><label>Media Arsip : </label></div>
    		<div class="col-md-8">{{ $metadataNaskah->mediaArsip->media_arsip }}</div>
    	</div>
    	<div class="row">
    		<div class="col-md-4"><label>Bahasa : </label></div>
    		<div class="col-md-8">{{ $metadataNaskah->bahasas->bahasa }}</div>
    	</div>
    	<div class="row">
    		<div class="col-md-4"><label>Isi Ringkas : </label></div>
    		<div class="col-md-8">{{ $metadataNaskah->isi_ringkas }}</div>
    	</div>
    	<div class="row">
    		<div class="col-md-4"><label>Arsip Vital / Tidak Vital : </label></div>
    		<div class="col-md-8">{{ $metadataNaskah->get_vital() }}</div>
    	</div>
    	<div class="row">
    		<div class="col-md-4"><label>Jumlah : </label></div>
    		<div class="col-md-8">{{ $metadataNaskah->jumlah }} {{ $metadataNaskah->satuanUnit->nama_satuan }}</div>
    	</div>
    </div>
    <div role="tabpanel" class="tab-pane" id="status-pemberkasan">
        <br>
        <div class="row">
            <div class="col-md-12">
                <a href="#" class="btn btn-primary" id="tambah-berkas">Buat Berkas Baru</a>
            </div>
        </div>
        @if(!is_null($getNaskah->id_berkas))
        <hr>
        <div class="row">
            <div class="col-md-12">
                <p style="color: red; font-weight: bold; font-size: 12px">Naskah sudah diberkaskan di Nomor Berkas: {{ $getNaskah->berkas->kode_klasifikasi }} - Nama Berkas: {{ $getNaskah->berkas->judul_berkas }}, Pada Unit Kerja: {{ $getNaskah->berkas->jabatan->jabatan }}</p>
            </div>
        </div>
        @endif
        <hr>
        <div class="row">
            <div class="col-md-12">
                <p style="color: red">
                    Keterangan :<br>
                    - Jika ingin memindahkan berkas, klik pada baris lokasi berkas baru
                </p>
            </div>
            <form id="form-pindah-berkas" action="{{ url('berkas/pindah/naskah/'.$getNaskah->id_naskah) }}" method="post">
                @csrf
                <input type="hidden" name="id_berkas" value="" id="id_berkas">
            </form>
            <table class="table table-responsive table-bordered" id="table-detail-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Berkas</th>
                        <th>Nomor Berkas</th>
                        <th>Nama Berkas</th>
                        <th>Retensi Aktif</th>
                        <th>Retensi InAktif</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dataBerkas as $data)
                    <tr>
                        <td><a href="javascript:;" data-id-berkas="{{ $data->id_berkas }}" id="btn-pindah">{{ $no2++ }}</a></td>
                        <td><a href="javascript:;" data-id-berkas="{{ $data->id_berkas }}" id="btn-pindah">{{ $data->id_berkas }}</a></td>
                        <td><a href="javascript:;" data-id-berkas="{{ $data->id_berkas }}" id="btn-pindah">{{ $data->nomor_berkas }}</a></td>
                        <td><a href="javascript:;" data-id-berkas="{{ $data->id_berkas }}" id="btn-pindah">{{ $data->judul_berkas }}</a></td>
                        <td><a href="javascript:;" data-id-berkas="{{ $data->id_berkas }}" id="btn-pindah">{{ $data->r_aktif }}</a></td>
                        <td><a href="javascript:;" data-id-berkas="{{ $data->id_berkas }}" id="btn-pindah">{{ $data->r_inaktif }}</a></td>
                        <td><a href="javascript:;" data-id-berkas="{{ $data->id_berkas }}" id="btn-pindah" class="btn btn-warning">Pindah</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
  </div>

</div>
<div class="modal fade" id="modal-tambah-berkas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah berkas</h4>
      </div>
      <div class="modal-body">

        <div class="col-md-12 col-sm-12 col-xs-3">
            <label>Klasifikasi</label>
        </div>

         <div id="tree" class="col-md-6">
            <ul>
                @foreach($klasifikasi as $item)
                    <li
                    data="kode_klasifikasi: '{{ $item->kode }}'"
                   
                     @if(count($item->childs)) class="edit lazy folder" @else class="edit" @endif>
                        @if(!count($item->childs))
                        
                        @endif
                        {{ $item->kode.' - '.$item->nama }}
                        @if(count($item->childs))
                            @include('manageChildKlasifikasiBerkas',['childs' => $item->childs])
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>


        <form class="form-horizontal" id="form-tambah-berkas" action="{{ url('berkas/tambah') }}" method="post">
            {!! csrf_field() !!}


            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-3">
                    <label>Unit Kerja</label>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-9">
                    <input class="form-control" type="text" value="{{ $userJabatan->title }}" readonly="">
                    <input type="hidden" name="id_unitkerja" value="{{ $userJabatan->id }}">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-3">
                    <label>Nomor Berkas</label>
                </div>
                <div class="col-md-4 col-sm-9 col-xs-9">
                    <input class="form-control" type="text" name="kode_klasifikasi" id="kode_klasifikasi"  readonly="">
                </div>
                <div class="col-md-2 col-sm-9 col-xs-9">
                    <input class="form-control" type="text" name="nomor_berkas" value="{{ $nomor_berkas }}" readonly="">
                </div>
            </div>


            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-3">
                    <label>Judul Berkas</label>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-9">
                    <input class="form-control" type="text" name="judul_berkas" >
                </div>
            </div>


            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">


            <div class="col-md-12 col-sm-12 col-xs-3">
                <label>Hitung waktu retensi dari</label>
            </div>
                <div class="col-md-9">
                    <select name="retensi_dari" class="penyusutan_akhir form-control">
                        <option value="1">Sejak Berkas Dibuat</option>
                        <option value="0">Sejak Berkas Ditutup</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-3">
                    <label>Retensi aktif</label>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-9">
                    <input class="form-control" type="date" name="r_aktif" >
                </div>
            </div>


            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-3">
                    <label>Retensi inaktif</label>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-9">
                    <input class="form-control" type="date" name="r_inaktif" >
                </div>
            </div>

            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">


            <div class="col-md-12 col-sm-12 col-xs-3">
                <label>Tindakan Penyusutan Akhir</label>
            </div>
                <div class="col-md-9">
                    <select name="penyusutan_akhir" class="penyusutan_akhir form-control">
                        <option value="1">Dinilai Kembali</option>
                        <option value="2">Masuk Berkas Perseorangan</option>
                        <option value="3">Musnah</option>
                        <option value="4">Permanen</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-3">
                    <label>Lokasi Fisik Berkas</label>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-9">
                    <input class="form-control" type="text" name="lokasi_fisik" >
                </div>
            </div>


            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-3">
                    <label>Isi Ringkas</label>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-9">
                    <textarea name="isi_ringkas" style="min-height: 120px" class="form-control"></textarea>
                </div>
            </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="submit-tambah-berkas" form="form-tambah-berkas" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endsection
@push('js')
<script type="text/javascript" src="{{ asset('assets/vendors/dataTables/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/dataTables/js/dataTables.bootstrap.min.js') }}"></script>
<script src='http://wwwendt.de/tech/dynatree/jquery/jquery-ui.custom.js' type="text/javascript"></script>
    <script src='http://wwwendt.de/tech/dynatree/jquery/jquery.cookie.js' type="text/javascript"></script>
    <script src='http://wwwendt.de/tech/dynatree/src/jquery.dynatree.js' type="text/javascript"></script>
<!-- Add code to initialize the tree when the document is loaded: -->
    <script type="text/javascript">
    $(function(){
       
        $("#tree").dynatree({
            autoCollapse: true,

            onActivate: function(node) {
                $('#kode_klasifikasi').val(node.data.kode_klasifikasi);
            },
            persist: false
            
        });
    });

    $(function(){
       
        $("#tree2").dynatree({
            autoCollapse: true,

            onActivate: function(node) {
                $('#kode_klasifikasi').val(node.data.kode_klasifikasi);
            },
            persist: false
            
        });
    });
    </script>
<script type="text/javascript">
	$(document).ready(function() {

		$('#table-detail-1').DataTable();
		$('#table-detail-2').DataTable();
        $('#table-detail-3').DataTable();
        
        $('#btn-teruskan').on('click', function(){
            $('#modal-teruskan').modal('show');
        });

        $('#btn-balas').on('click', function(){
            $('#modal-balas').modal('show');
        });

        $('#tambah-berkas').on('click', function() {
            $('#modal-tambah-berkas').modal('show');
        });

        $(document).on('click', '#btn-pindah', function(e){
            e.preventDefault();
            var jawaban = confirm('Apakah anda yakin ingin memindahkan naskah ini?');

            if (jawaban) {
                var id_berkas = $(this).data('id-berkas');

                $('input#id_berkas').val(id_berkas);

                document.getElementById('form-pindah-berkas').submit();
            }
        })

        $(document).on('click', '#submit-tambah-berkas', function(){
            $('#form-tambah-berkas').submit();
        });

        $(".btn-success").click(function(){ 
            var html = $(".clone").html();
            $(".increment").after(html);
        });

        $("body").on("click",".btn-danger",function(){ 
            $(this).parents(".control-group").remove();
        });
	});
</script>
@endpush