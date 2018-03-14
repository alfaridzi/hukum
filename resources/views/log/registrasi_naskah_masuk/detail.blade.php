@extends('app.app')
@section('page-title', 'Detail Naskah')
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/dataTables/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
<link rel="stylesheet" type="text/css" href="http://sikdnew.kemsos.go.id/style/tree.skinpengguna.css">
<link rel='stylesheet' type='text/css' href='http://wwwendt.de/tech/dynatree/src/skin-vista/ui.dynatree.css'>
<style type="text/css">
 .tree, .tree ul {
    margin: 0;
    padding: 0;
    list-style: none;
    font-weight:bolder;
}
.dynatree-has-children >a {
    font-weight: bolder !important;
}


.glyphicon-file {
    color:black !important;
}
</style>
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
    .bootstrap-tagsinput{
        width: 100%;
        height: 100%;
        border-radius: 0px;
    }
    .bootstrap-tagsinput .tag{
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

@if(is_null($getNaskah->id_berkas))
    <h3 style="color: red" class="text-center">Naskah Belum Diberkaskan</h3>
@endif

@if($getNaskah->penerima->whereIn('sebagai', ['final'])->isEmpty())
    @if(!$cekNaskah->isEmpty())
        <a href="javascript:;" class="btn btn-success" id="btn-teruskan">Teruskan</a> 
        <a href="javascript:;" class="btn btn-info" id="btn-balas">Balas</a> 
        <a href="javascript:;" class="btn btn-primary" id="btn-disposisi">Disposisi</a>
        @if($getNaskah->id_user == Auth::user()->id_user)
            <a href="{{ url('/log/registrasi-naskah-masuk/detail/'.$metadataNaskah->id_naskah.'/ubah-metadata') }}" class="btn btn-warning">Ubah Metadata</a>
        @else
            <a href="{{ url('/log/registrasi-naskah-masuk/detail/'.$metadataNaskah->id_naskah.'/ubah-metadata') }}" class="btn btn-warning">Ubah Metadata</a>
        @endif
    @elseif($getNaskah->id_user == Auth::user()->id_user)
        <a href="{{ url('/log/registrasi-naskah-masuk/detail/'.$metadataNaskah->id_naskah.'/ubah-metadata') }}" class="btn btn-warning">Ubah Metadata</a>
    @endif
@endif

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
        @if($getNaskah->penerima->whereIn('sebagai', ['final'])->isEmpty())
            @if(!$cekNaskah->isEmpty())
                <a href="javascript:;" class="btn btn-success" id="btn-final">Upload Dokumen Final</a>
                <p style="color:red;">(Dipergunakan untuk mengupload hasil scan naskah yang telah ditandatangani pimpinan dan diberikan nomor naskah)</p>
            @endif
        @endif
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
                    <td>{{ $data->created_at }}</td>
                    <td>
                        @if($naskah->count() < $no)
                            {{ $getNaskah->asal_naskah }}
                        @else
                            {{ $data->user->jabatan->jabatan }}
                        @endif
                    </td>
                    <td>
                    @if($data->sebagai == 'final')
                            <p style="color: red">{{ $data->get_sebagai() }}</p>
                        @else
                        @foreach($data->get_tujuan() as $dataPenerima)
                            @if($dataPenerima->sebagai == 'bcc')
                                @if(!$cek) @php $cek = true @endphp<br> <b>Tembusan:</b> @endif
                            @endif
                            @if(!is_null($dataPenerima->tujuan_kirim))
                                {{ $dataPenerima->tujuan_kirim->jabatan->jabatan }},
                            @endif
                        @endforeach
                    @endif
                    </td>
                    <td>
                        @if($data->sebagai == 'final')
                            <p style="color: red">{{ $data->get_sebagai() }}</p>
                        @else
                            {{ $data->get_sebagai() }}
                        @endif
                    </td>
                    <td>
                        @if(!$data->disposisi->isEmpty())
                            <ul>
                            @foreach($data->disposisi as $disposisi)
                                <li>{{ $disposisi->isiDisposisi->isi_disposisi }}</li>
                            @endforeach
                            </ul>
                            {{ $data->pesan }}
                        @else
                            {{ $data->pesan }}
                        @endif
                    </td>
                    <td><ol>@foreach($data->files as $dataFiles)
                        <li><a href="{{ url('/log/registrasi-naskah-masuk/detail/'.$data->id_naskah.'/download/'.$dataFiles->nama_file) }}">{{ $dataFiles->nama_file }}</a></li>
                    @endforeach</ol></td>
                    <td>
                        @if(!$data->disposisi->isEmpty())
                        <a href="{{ url('cetak/'.$data->id_naskah.'/disposisi/'.$data->id_group) }}" class="btn btn-info" id="cetakDisposisi">Print</a>
                        @endif
                        @if($data->id_user == Auth::user()->id_user && $naskah->count() >= $no)
                            <form action="{{ url('/log/registrasi-naskah-masuk/detail/'.$data->id_naskah.'/delete/'.$data->id_group) }}" method="post">
                            @csrf
                                <button class="btn btn-danger" type="submit" onclick="return confirm('Apakah anda yakin ingin menghapus ini?')">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @php $cek = false @endphp
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
                    <td>{{ $data->created_at }}</td>
                    <td>
                        @if($naskah1->count() < $no1)
                            {{ $getNaskah->asal_naskah }}
                        @else
                            {{ $data->user->jabatan->jabatan }}
                        @endif
                    </td>
                    <td>
                    @if($data->sebagai == 'final')
                        <p style="color: red">{{ $data->get_sebagai() }}</p>
                    @else
                    @foreach($data->get_tujuan() as $dataPenerima)
                        @if($dataPenerima->sebagai == 'bcc')
                            @if(!$cek) @php $cek = true @endphp<br> <b>Tembusan:</b> @endif
                        @endif
                        @if(!is_null($dataPenerima->tujuan_kirim))
                            {{ $dataPenerima->tujuan_kirim->jabatan->jabatan }},
                        @endif
                    @endforeach
                    @endif
                    </td>
                    <td>
                        @if($data->sebagai == 'final')
                            <p style="color: red">{{ $data->get_sebagai() }}</p>
                        @else
                            {{ $data->get_sebagai() }}
                        @endif
                    </td>
                    <td>
                        @if(!$data->disposisi->isEmpty())
                            <ul>
                            @foreach($data->disposisi as $disposisi)
                                <li>{{ $disposisi->isiDisposisi->isi_disposisi }}</li>
                            @endforeach
                            </ul>
                            {{ $data->pesan }}
                        @else
                            {{ $data->pesan }}
                        @endif
                    </td>
                    <td><ol>@foreach($data->files as $dataFiles)
                        <li><a href="{{ url('log/registrasi-naskah-masuk/download/'.$dataFiles->nama_file) }}">{{ $dataFiles->nama_file }}</a></li>
                    @endforeach</ol></td>
                    <td>
                        @if(!$data->disposisi->isEmpty())
                        <a href="{{ url('cetak/'.$data->id_naskah.'/disposisi/'.$data->id_group) }}" class="btn btn-info" id="cetakDisposisi">Print</a>
                        @endif
                        @if($data->id_user == Auth::user()->id_user && $naskah1->count() >= $no1)
                            <form action="{{ url('/log/registrasi-naskah-masuk/detail/'.$data->id_naskah.'/delete/'.$data->id_group) }}" method="post">
                            @csrf
                                <button class="btn btn-danger" type="submit" onclick="return confirm('Apakah anda yakin ingin menghapus ini?')">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @php $cek1 = false @endphp
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

<div class="modal fade" id="modal-teruskan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Teruskan</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="form-teruskan" action="{{ url('/log/registrasi-naskah-masuk/detail/'.$metadataNaskah->id_naskah.'/teruskan') }}" method="post" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="form-group">
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <label>Tujuan Surat</label>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-9">
                    <input class="form-control tujuan-naskah" type="text" name="kepada" required="">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <label>Tembusan</label>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-9">
                    <input class="form-control tujuan-naskah" type="text" name="tembusan">
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
</div>

<div class="modal fade" id="modal-balas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Balas</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="form-balas" action="{{ url('/log/registrasi-naskah-masuk/detail/'.$metadataNaskah->id_naskah.'/balas') }}" method="post" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="form-group">
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <label>Tujuan Surat</label>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-9">
                    <input class="form-control tujuan-naskah" type="text" name="kepada" required="">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <label>Tembusan</label>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-9">
                    <input class="form-control tujuan-naskah" type="text" name="tembusan">
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
        <button type="submit" id="submit-balas" form="form-balas" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-disposisi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Disposisi</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="form-disposisi" action="{{ url('/log/registrasi-naskah-masuk/detail/'.$metadataNaskah->id_naskah.'/disposisi') }}" method="post" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="form-group">
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <label>No Index</label>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <input class="form-control" type="text" name="no_index">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <label>Sifat</label>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <select name="sifat" class="form-control">
                        @foreach($sifatNaskah as $data)
                            <option value="{{ $data->id_sifat_naskah }}">{{ $data->sifat_naskah }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <label>Isi Disposisi</label>
                </div>
                @foreach($isiDisposisi as $data)
                <div class="col-md-9 col-sm-9 col-xs-9">
                    <input type="checkbox" value="{{ $data->id_disposisi }}" name="disposisi[]"> {{ $data->isi_disposisi }}
                </div>
                @endforeach
            </div>
            <div class="form-group">
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <label>Tujuan</label>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-9">
                    <input class="form-control tujuan-naskah" type="text" name="kepada" required>
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
        <button type="submit" id="submit-disposisi" form="form-disposisi" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-final" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Upload Dokumen Final</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="form-final" action="{{ url('/log/registrasi-naskah-masuk/detail/'.$metadataNaskah->id_naskah.'/dokumen-final') }}" method="post" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="form-group">
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <label>Jenis Dokumen</label>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-9">
                    <p>-- Dokumen Final --</p>
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
        <button type="submit" id="submit-final" form="form-final" class="btn btn-primary">Save changes</button>
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
<script type="text/javascript" src="{{ asset('assets/vendors/typeahead/bloodhound.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
<script type="text/javascript" src="https://rawgit.com/davidkonrad/Bootstrap-3-Typeahead/master/bootstrap3-typeahead.js"></script>
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
    var pengguna = {!! $user !!};

    var pengguna = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        local: pengguna
    });

$('.tujuan-naskah').tagsinput({
    itemValue: 'id_user',
    itemText: function(pengguna){
        return pengguna.nama + ' (' + pengguna.jabatan.jabatan + ')';
    },
    typeahead: {
        name: 'pengguna',
        displayKey: function(pengguna){
            return pengguna.nama + ' (' + pengguna.jabatan.jabatan + ')';
        },
        source: pengguna.local,
        // source: places.map(function(item) { return item.name }),
        afterSelect: function() {
            this.$element[0].value = '';
        }
    }
});


    $(document).ready(function() {
        $('a#cetakDisposisi').click(function() {
            window.open($(this).attr('href'),'title', 'width=800, height=700');
            return false;
        });
        $('#table-detail-1').DataTable();
        $('#table-detail-2').DataTable();
        $('#table-detail-3').DataTable();

        $('#btn-teruskan').on('click', function(){
            $('#modal-teruskan').modal('show');
        });

        $('#btn-balas').on('click', function(){
            $('#modal-balas').modal('show');
        });

        $('#btn-disposisi').on('click', function(){
            $('#modal-disposisi').modal('show');
        });

        $('#btn-final').on('click', function(){
            $('#modal-final').modal('show');
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