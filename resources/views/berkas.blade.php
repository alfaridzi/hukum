@extends('app.app')
@section('page-title', 'Pengaturan berkas')
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/dataTables/css/dataTables.bootstrap.min.css') }}">


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
  
    
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




	<a href="#" class="btn btn-primary" id="tambah-berkas">Tambah</a>

	<table class="table table-bordered table-responsive" id="table-berkas">
		<thead>
			<tr>
				<th>No</th>
				<th>Status Berkas</th>
				<th>No Berkas</th>
				<th>Nama Berkas</th>
				<th>Isi Berkas</th>
				<th>Unit Kerja</th>
				<th>Akhir Retensi Aktif</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($berkas as $data)
			<tr>
				<td>{{ $no++ }}</td>
				<td>{!! $data->status_berkas() !!}</td>
				<td>{{ $data->kode_klasifikasi.'/'.$data->nomor_berkas }}</td>
				<td>{{ $data->judul_berkas }}</td>
				<td>0</td>
				<td>{{ $data->jabatan->title }}</td>
				<td>{{ $data->r_aktif }}</td>
				<td>
					<a href="javascript:;" style="border-radius:0px" class="btn btn-xs btn-warning" id="edit-berkas" data-id="{{ $data->id }}"
					  data-unit_kerja = "{{ $data->jabatan->title }}"
					data-berkas="{{ $data->berkas }}"
					data-kode_klasifikasi = "{{ $data->kode_klasifikasi }}"
					data-no_klasifikasi = "{{ $data->nomor_berkas }}"
					data-judul_berkas = "{{ $data->judul_berkas }}"
					data-retensi_aktif = "{{ $data->r_aktif }}"
					data-retensi_inaktif = "{{ $data->r_inaktif }}"
					data-lokasi_fisik = "{{ $data->lokasi_fisik }}"
					data-isi_ringkas = "{{ $data->isi_ringkas }}"
					data-id_berkas = "{{ $data->id_berkas }}"
					>Edit</a> 
				</form></td>
			</tr>
			@endforeach
		</tbody>
	</table>


<!-- Modal Tambah Satuan-->
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
	        		<input class="form-control" type="text" value="{{ $user->title }}" readonly="">
	        		<input type="hidden" name="id_unitkerja" value="{{ $user->id }}">
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

<!-- Modal Edit Satuan-->
<div class="modal fade" id="modal-edit-berkas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit berkas</h4>
      </div>
      <div class="modal-body">


      	<div id="tree2" class="col-md-6">
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

        <form class="form-horizontal" id="form-edit-berkas" action="{{ url('berkas/edit') }}" method="post">
        	{!! csrf_field() !!}


        	<div class="form-group">
	        	<div class="col-md-12 col-sm-12 col-xs-3">
	        		<label>Unit Kerja</label>
	        	</div>
	        	<div class="col-md-9 col-sm-9 col-xs-9">
	        		<input class="form-control" type="text" id="ed_unit_kerja" readonly="">
	        		<input type="hidden" name="id_berkas" id="ed_id_berkas" ">
	        	</div>
        	</div>

        	<div class="form-group">
	        	<div class="col-md-12 col-sm-12 col-xs-3">
	        		<label>Nomor Berkas</label>
	        	</div>
	        	<div class="col-md-4 col-sm-9 col-xs-9">
	        		<input class="form-control" type="text" name="kode_klasifikasi" id="ed_kode_klasifikasi"  readonly="">
	        	</div>
	        	<div class="col-md-2 col-sm-9 col-xs-9">
	        		<input class="form-control" type="text" name="nomor_berkas" id="ed_no_klasifikasi" readonly="">
	        	</div>
        	</div>


        	<div class="form-group">
	        	<div class="col-md-12 col-sm-12 col-xs-3">
	        		<label>Judul Berkas</label>
	        	</div>
	        	<div class="col-md-9 col-sm-9 col-xs-9">
	        		<input class="form-control" type="text" id="ed_judul_berkas" name="judul_berkas" >
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
	        		<input id="ed_retensi_aktif" class="form-control" type="date" name="r_aktif" >
	        	</div>
        	</div>


        	<div class="form-group">
	        	<div class="col-md-12 col-sm-12 col-xs-3">
	        		<label>Retensi inaktif</label>
	        	</div>
	        	<div class="col-md-9 col-sm-9 col-xs-9">
	        		<input id="ed_retensi_inaktif" class="form-control" type="date" name="r_inaktif" >
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
	        		<input id="ed_lokasi_fisik" class="form-control" type="text" name="lokasi_fisik" >
	        	</div>
        	</div>


        	<div class="form-group">
	        	<div class="col-md-12 col-sm-12 col-xs-3">
	        		<label>Isi Ringkas</label>
	        	</div>
	        	<div class="col-md-9 col-sm-9 col-xs-9">
	        		<textarea id="ed_isi_ringkas" name="isi_ringkas" style="min-height: 120px" class="form-control"></textarea>
	        	</div>
        	</div>






        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="submit-edit-berkas" form="form-edit-berkas" class="btn btn-primary">Save changes</button>
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
		$('#table-berkas').DataTable();

		$(document).on('click', '#edit-berkas', function(){
			$('#modal-edit-berkas').modal('show');

			var unit_kerja = $(this).data('unit_kerja');
			var kode_klasifikasi = $(this).data('kode_klasifikasi');
			var no_klasifikasi = $(this).data('no_klasifikasi');
			var judul_berkas = $(this).data('judul_berkas');
			var retensi_aktif = $(this).data('retensi_aktif');
			var retensi_inaktif = $(this).data('retensi_inaktif');
			var lokasi_fisik = $(this).data('lokasi_fisik');
			var isi_ringkas = $(this).data('isi_ringkas');
			var id_berkas = $(this).data('id_berkas');

			$('#ed_unit_kerja').val(unit_kerja)
			$('#ed_kode_klasifikasi').val(kode_klasifikasi)
			$('#ed_no_klasifikasi').val(no_klasifikasi)
			$('#ed_judul_berkas').val(judul_berkas)
			$('#ed_retensi_aktif').val(retensi_aktif)			
			$('#ed_retensi_inaktif').val(retensi_inaktif)
			$('#ed_lokasi_fisik').val(lokasi_fisik)
			$('#ed_isi_ringkas').val(isi_ringkas)
			$('#ed_id_berkas').val(id_berkas)
		});

		$(document).on('click', '#submit-edit-berkas', function(){
		    $('#form-edit-berkas').submit();
		});

		$('#tambah-berkas').on('click', function() {
			$('#modal-tambah-berkas').modal('show');
		});

		$(document).on('click', '#submit-tambah-berkas', function(){
		    $('#form-tambah-berkas').submit();
		});
	});
</script>
@endpush