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

{{-- <a href="javascript:;" class="btn btn-success" id="btn-teruskan">Teruskan</a> 
<a href="javascript:;" class="btn btn-info" id="btn-balas">Reply</a> 
<a href="javascript:;" class="btn btn-primary" id="btn-disposisi">Disposisi</a>  --}}
<a href="{{ url('/log/registrasi-naskah-masuk/detail/'.$metadataNaskah->id_naskah.'/ubah-metadata') }}" class="btn btn-warning">Ubah Metadata</a>

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
				</tr>
			</thead>
			<tbody>
                @foreach($naskah as $data)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $data->tanggal_registrasi }}</td>
                    <td>{{ $data->user->jabatan->jabatan }}</td>
                    <td>@foreach($data->penerima as $dataPenerima)
                        @if($dataPenerima->sebagai == 'cc1')
                            @if(!$cek) @php $cek = true @endphp<br> <b>Tembusan:</b> @endif
                        @endif
                        @if(!is_null($dataPenerima->tujuan_kirim))
                            {{ $dataPenerima->tujuan_kirim->jabatan->jabatan }},
                        @endif
                    @endforeach</td>
                    <td>@foreach($data->groupPenerima as $dataPenerima)
                        {{ $dataPenerima->get_sebagai() }}
                    @endforeach</td>
                    <td>{{ $data->pesan }}</td>
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
				</tr>
			</thead>
			<tbody>
                @foreach($naskah1 as $data)
                <tr>
                    <td>{{ $no1++ }}</td>
                    <td>{{ $data->tanggal_registrasi }}</td>
                    <td>{{ $data->user->jabatan->jabatan }}</td>
                    <td>@foreach($data->penerima as $dataPenerima)
                        @if($dataPenerima->sebagai == 'cc1')
                            @if(!$cek) @php $cek = true @endphp<br> <b>Tembusan:</b> @endif
                        @endif
                        @if(!is_null($dataPenerima->tujuan_kirim))
                            {{ $dataPenerima->tujuan_kirim->jabatan->jabatan }},
                        @endif
                    @endforeach</td>
                    <td>{{ $data->get_tipe_registrasi() }}</td>
                    <td>{{ $data->pesan }}</td>
                    <td><ol>@foreach($data->files as $dataFiles)
                        <li><a href="{{ url('log/registrasi-naskah-masuk/download/'.$dataFiles->nama_file) }}">{{ $dataFiles->nama_file }}</a></li>
                    @endforeach</ol></td>
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
        @if(!is_null($metadataNaskah->id_berkas))

        <h3>Naskah Sudah diberkaskan</h3>

        @endif
    </div>
  </div>

</div>

{{-- <div class="modal fade" id="modal-teruskan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Teruskan</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="form-teruskan" action="{{ url('pengaturan/ekstensi-file/tambah') }}" method="post">
            {!! csrf_field() !!}
            <div class="form-group">
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <label>Tujuan Surat</label>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-9">
                    <input class="form-control" type="text" name="kepada" required="">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <label>Tembusan</label>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-9">
                    <input class="form-control" type="text" name="tembusan">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <label>Pesan</label>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-9">
                    <textarea class="form-control" name="pesan"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <label>File Upload</label>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-9 box-file">
                    <div class="input-group control-group increment">
                      <input type="file" name="file_uploads[]" class="form-control">
                      <div class="input-group-btn"> 
                        <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                      </div>
                    </div>
                    <div class="clone hide">
                      <div class="control-group input-group" style="margin-top:10px">
                        <input type="file" name="file_uploads[]" class="form-control">
                        <div class="input-group-btn"> 
                          <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="submit-teruskan" form="form-teruskan" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> --}}

{{-- <div class="modal fade" id="modal-balas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Kirim Nota Dinas</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="form-teruskan" action="{{ url('pengaturan/ekstensi-file/tambah') }}" method="post">
            {!! csrf_field() !!}
            <div class="form-group">
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <label>Tujuan Surat</label>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-9">
                    <input class="form-control" type="text" name="kepada" required="">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <label>Tembusan</label>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-9">
                    <input class="form-control" type="text" name="tembusan">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <label>Pesan</label>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-9">
                    <textarea class="form-control" name="pesan"></textarea>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="submit-teruskan" form="form-teruskan" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> --}}

@endsection
@push('js')
<script type="text/javascript" src="{{ asset('assets/vendors/dataTables/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/dataTables/js/dataTables.bootstrap.min.js') }}"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#table-detail-1').DataTable();
		$('#table-detail-2').DataTable();

        $('#btn-teruskan').on('click', function(){
            $('#modal-teruskan').modal('show');
        });

        $('#btn-balas').on('click', function(){
            $('#modal-balas').modal('show');
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