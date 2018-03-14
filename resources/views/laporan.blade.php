@extends('app.app')
@section('page-title', 'Laporan')
@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
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

<form action="{{ url('laporan/naskah-masuk') }}" method="get" target="_BLANK" id="form-laporan">
	<div class="form-group">
		<select class="form-control" name="tipe_laporan" required>
			<option selected="" disabled="">-- Pilih laporan yang akan dicetak --</option>
			<option value="1">Naskah Masuk</option>
			<option value="2">Naskah Keluar</option>
		</select>
	</div>
	<div class="row">
		<div class="col-md-6 form-group">
			<label>Tanggal Awal</label>
			<input type="text" name="tanggal_awal" class="datepicker form-control">
		</div>
		<div class="col-md-6 form-group">
			<label>Tanggal Akhir</label>
			<input type="text" name="tanggal_akhir" class="datepicker form-control">
		</div>
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
@push('js')
<script type="text/javascript" src="{{ asset('assets/vendors/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript">
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
    });

    $(document).on('ready', function(){
    	$('select[name=tipe_laporan]').on('change', function(){
    		var tipe_laporan = $(this).val();
    		if (tipe_laporan == '1') {
    			$('#form-laporan').attr('action', '{{ url('laporan/naskah-masuk') }}');
    		}else if(tipe_laporan == '2') {
    			$('#form-laporan').attr('action', '{{ url('laporan/naskah-keluar') }}');
    		}
    		console.log(tipe_laporan);
    	});
    });
</script>
@endpush