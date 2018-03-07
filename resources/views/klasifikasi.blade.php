@extends('app.app')
@section('page-title', 'Pengaturan klasifikasi')
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



			
	  			<div class="row">
	  				<a class="btn btn-default" id="tambahData" > Tambah</a>
	  				<a disabled="disabled" href="" class="btn btn-warning" id="deleteData" > Delete</a>
	  				<a disabled="disabled" href="" class="btn btn-primary" id="editData" > Edit</a>
	  				<div class="col-md-6">
	  					
				           <div id="tree" class="col-md-6">
				        <ul>
				            @foreach($klasifikasi as $category)
				                <li
				                data="id: '{{ $category->id }}',kode: '{{ $category->kode }}', status: '{{ $category->id_status }}', penyusutan_akhir: '{{ $category->penyusutan_akhir }}',rAktif: '{{ $category->rAktif }}',rInaktif: '{{ $category->rInaktif }}',deskripsi: '{{ $category->deskripsi }}',nama: '{{ $category->nama }}',parent_id: '{{ $category->parent_id }}'"
				             
				               
				                 @if(count($category->childs)) class="edit lazy folder" @else class="edit" @endif>
				                	@if(!count($category->childs))
				                	
				                	@endif
				                    {{ $category->kode.' - '.$category->nama }}
				                    @if(count($category->childs))
				                        @include('manageChildKlasifikasi',['childs' => $category->childs])
				                    @endif
				                </li>
				            @endforeach
				        </ul>
	  				</div>
	  				</div>
	  				<div class="col-md-6">
	  					<h3>Tambah Klasifikasi</h3>


				  			<form method="POST" id="frm">
				  			{!! csrf_field() !!}

				  				@if ($message = Session::get('success'))
									<div class="alert alert-success alert-block">
										<button type="button" class="close" data-dismiss="alert">×</button>	
									        <strong>{{ $message }}</strong>
									</div>
								@endif

								<input type="hidden" name="parent_id" id="parent_id" value="0">


				  				<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
									{!! Form::label('kode:') !!}
									{!! Form::text('kode', old('kode'), ['class'=>'form-control kode', 'placeholder'=>'Enter Title','disabled'=>'disabled']) !!}
									<span class="text-danger">{{ $errors->first('kode') }}</span>
								</div>



								<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
									{!! Form::label('nama:') !!}
									{!! Form::text('nama', old('nama'), ['class'=>'form-control nama', 'placeholder'=>'Enter Title','disabled'=>'disabled']) !!}
									<span class="text-danger">{{ $errors->first('nama') }}</span>
								</div>



								<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
									{!! Form::label('deskripsi:') !!}
									{!! Form::textarea('deskripsi', old('deskripsi'), ['class'=>'form-control deskripsi', 'placeholder'=>'Enter Title','disabled'=>'disabled']) !!}
									<span class="text-danger">{{ $errors->first('deskripsi') }}</span>
								</div>


								<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
									{!! Form::label('retensi aktif:') !!}
							<div class="input-group col-md-3">
							  {!! Form::text('rAktif', old('retensi_aktif'), ['value'=> '0','class'=>'form-control retensi_aktif',
							   'disabled'=>'disabled']) !!}
							  <span class="input-group-addon" id="basic-addon2">Tahun</span>
							</div>
						</div>



								

								

							<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
									{!! Form::label('retensi inaktif:') !!}
							<div class="input-group col-md-3">
							  {!! Form::text('rInaktif', old('retensi_inaktif'), ['value'=> '0','class'=>'form-control retensi_inaktif','disabled'=>'disabled']) !!}
							  <span class="input-group-addon" id="basic-addon2">Tahun</span>
							</div>
						</div>

								<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">


									{!! Form::label('Penyusutan Akhir:') !!}
									<select name="penyusutan_akhir" class="penyusutan_akhir form-control">
										<option value="0">-</option>
										<option value="1">Dinilai Kembali</option>
										<option value="2">Masuk Berkas Perseorangan</option>
										<option value="3">Musnah</option>
										<option value="4">Permanen</option>
									</select>
								</div>





							




								<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
									{!! Form::label('Status Aktif:') !!}
									<input type="checkbox" name="id_status" class="status"  disabled="disabled" value="1">
									<span class="text-danger">{{ $errors->first('status') }}</span>
								</div>


								<div class="form-group">
									<input type="submit" class="btn btn-success" id="btn_submit" value="simpan" disabled="disabled">
								</div>


				  			</form>


	  				</div>
	  		

@endsection
@push('js')


 <script src='http://wwwendt.de/tech/dynatree/jquery/jquery-ui.custom.js' type="text/javascript"></script>
    <script src='http://wwwendt.de/tech/dynatree/jquery/jquery.cookie.js' type="text/javascript"></script>
    <script src='http://wwwendt.de/tech/dynatree/src/jquery.dynatree.js' type="text/javascript"></script>
<!-- Add code to initialize the tree when the document is loaded: -->
    <script type="text/javascript">
    $(function(){
       
        $("#tree").dynatree({
        	autoCollapse: true,

            onActivate: function(node) {
                console.log(node.data);
                $('.nama').val(node.data.nama);
				$('.kode').val(node.data.kode);
				$('.retensi_aktif').val(node.data.rAktif);
				$('.retensi_inaktif').val(node.data.rInaktif);
				$('.deskripsi').val(node.data.deskripsi);
				$('#parent_id').val(node.data.id);
				$('.penyusutan_akhir option').removeAttr('selected');
				$('.penyusutan_akhir option[value=' + node.data.penyusutan_akhir + ']').attr('selected','selected');

		

				if(node.data.status == 1) {
					$('.status').prop('checked',true)
				} else {
					$('.status').prop('checked',false)
				}


				$('#frm').attr("action", "{{ url('klasifikasi/update') }}/" + node.data.id);

				$("#deleteData").attr("href", "{{ url('klasifikasi/delete') }}/" + node.data.id);
			$("#deleteData").attr("onclick", "return confirm('are you su re you want to delete " + node.data.title + " ?')")
				$("#deleteData").removeAttr('disabled');
				$("#editData").removeAttr('disabled');
				$("#tambahData").removeAttr('disabled');
				$('#btn_submit	').val('Edit');
            },
            persist: false
            
        });
    });
    </script>
<script type="">

	$('#tambahData').click(function() {

		$('.nama').val('');
		$('.kode').val('');
		$('.retensi_aktif').val('');
		$('.retensi_inaktif').val('');
		$('.deskripsi').val('');

		$('#btn_submit').removeAttr('disabled');
		$('.nama').removeAttr('disabled');
		$('.kode').removeAttr('disabled');
		$('.retensi_aktif').removeAttr('disabled');
		$('.retensi_inaktif').removeAttr('disabled');
		$('.deskripsi').removeAttr('disabled');
		$('.penyusutan_akhir option').removeAttr('disabled');
		$('.status').removeAttr('disabled');
		$('#frm').attr("action", "{{ url('klasifikasi/tambah') }}");

		$('#btn_submit	').val('Tambah');
		return false;
	});



	$(document).on('click', '#editData', function(){
			$('#btn_submit').removeAttr('disabled');
			$('.nama').removeAttr('disabled');
			$('.kode').removeAttr('disabled');
			$('.retensi_aktif').removeAttr('disabled');
			$('.retensi_inaktif').removeAttr('disabled');
			$('.deskripsi').removeAttr('disabled');
			$('.penyusutan_akhir option').removeAttr('disabled');
			$('.status').removeAttr('disabled');
			$('#btn_submit	').val('Edit');
			$('#parent_id').removeAttr('name');
			return false;
		});







	$(document).on('click', '.edit', function(){
			var id = $(this).data('id');
			var title = $(this).data('title');
			$("#deleteData").attr("href", "{{ url('klasifikasi/delete') }}/" + id);
			$("#deleteData").removeAttr('disabled');
			$("#editData").removeAttr('disabled');
		
			
			return false;
		});
</script> 
@endpush