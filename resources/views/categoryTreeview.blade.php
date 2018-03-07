@extends('app.app')
@section('page-title', 'Pengaturan Unit Kerja & Pengguna')
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

			
	  			<div class="row">
	  				<a href="" class="btn btn-default" id="tambahData" > Tambah</a>
	  				<a disabled="disabled" href="" class="btn btn-warning" id="deleteData" > Delete</a>
	  				<a disabled="disabled" href="" class="btn btn-primary" id="editData" > Edit</a>
	  				<div class="col-md-6">
	  					
				           <div id="tree" class="col-md-6">
				        <ul>
				            @foreach($unitKerja as $category)
				                <li
				                data="id: '{{ $category->id }}',status: '{{ $category->id_status }}', jabatan: '{{ $category->jabatan }}',id_grup: '{{ $category->id_grup }}',parent_id: '{{ $category->parent_id }}'"
				             
				               
				                 @if(count($category->childs)) class="edit lazy folder" @else class="edit" @endif>
				                	@if(!count($category->childs))
				                	
				                	@endif
				                    {{ $category->title }}
				                    @if(count($category->childs))
				                        @include('manageChild',['childs' => $category->childs])
				                    @endif
				                </li>
				            @endforeach
				        </ul>
	  				</div>
	  				</div>
	  				<div class="col-md-6">
	  					<h3>Tambah Jabatan</h3>


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
									{!! Form::label('Jabatan:') !!}
									{!! Form::text('jabatan', old('jabatan'), ['class'=>'form-control jabatan', 'placeholder'=>'Enter Title','disabled'=>'disabled']) !!}
									<span class="text-danger">{{ $errors->first('jabatan') }}</span>
								</div>


								<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
									{!! Form::label('unit kerja:') !!}
									{!! Form::text('title', old('unitkerja'), ['class'=>'form-control unitkerja', 'placeholder'=>'Enter Title','disabled'=>'disabled']) !!}
									<span class="text-danger">{{ $errors->first('unitkerja') }}</span>
								</div>





								<div id="grupjabatan" class="form-group {{ $errors->has('parent_id') ? 'has-error' : '' }}">
									{!! Form::label('grup jabatan:') !!}
									{!! Form::select('id_grup',$grupjabatan, old('id_grup'), ['class'=>'form-control grupjabatan', 'placeholder'=>'-','value'=>'0','disabled'=>'disabled']) !!}
									<span class="text-danger">{{ $errors->first('parent_id') }}</span>
								</div>




								<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
									{!! Form::label('Status Aktif:') !!}
									<input type="checkbox" name="id_status" class="status" id="status" disabled="disabled" value="1">
									<span class="text-danger">{{ $errors->first('status') }}</span>
								</div>


								<div class="form-group">
									<input type="submit" class="btn btn-success" id="btn_submit" value="simpan">
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
                $('.jabatan').val(node.data.jabatan);
				$('.unitkerja').val(node.data.title);
				$('#parent_id').val(node.data.id);
				$('.grupjabatan option').removeAttr('selected');
				$('#grupjabatan option[value=' + node.data.id_grup + ']').attr('selected','selected');

				if(node.data.status == 1) {
					$('.status').attr('checked','checked');
				} else {
					$('.status').removeAttr('checked');
				}


				$('#frm').attr("action", "{{ url('unitkerja/update') }}/" + node.data.id);

				$("#deleteData").attr("href", "{{ url('unitkerja/delete') }}/" + node.data.id);
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
		$('.jabatan').val('');
		$('.unitkerja').val('');
		$('#frm').attr("action", "{{ url('unitkerja/tambah') }}");
		$(".jabatan").removeAttr('disabled');
		$(".unitkerja").removeAttr('disabled');
		$(".status").removeAttr('disabled');
		$(".grupjabatan").removeAttr('disabled');
		$('#btn_submit	').val('Tambah');
		return false;
	});



	$(document).on('click', '.edit', function(){
			var id = $(this).data('id');
			var title = $(this).data('title');
			$('.jabatan').val(title);
			$('.status').val(title);
			$('.unitkerja').val(title);

			$('#btn_submit	').val('Edit');
			return false;
		});


	$(document).on('click', '#editData', function(){
			var id = $(this).data('id');
			var title = $(this).data('title');
			$(".jabatan").removeAttr('disabled');
			$(".unitkerja").removeAttr('disabled');
			$(".status").removeAttr('disabled');
			$('#parent_id').removeAttr('name');
			$(".grupjabatan").removeAttr('disabled');
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