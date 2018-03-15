@extends('app.app')


@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
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

@yield('action')

    @csrf
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Tanggal Naskah <span>*</span></label>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5">
            <input type="text" class="form-control" id="datepicker" name="dari" value="{{ date('Y-m-d') }}" required>
            </div>
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5">
             <input type="text" class="form-control" id="datepicker2" name="sampai" value="{{ date('Y-m-d') }}" required>
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
<script type="text/javascript" src="{{ asset('assets/vendors/typeahead/bloodhound.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
<script type="text/javascript" src="https://rawgit.com/davidkonrad/Bootstrap-3-Typeahead/master/bootstrap3-typeahead.js"></script>
<script type="text/javascript">


    $('.radioberkas').on('click', function() {
        $('#field_berkas').val(this.value);
    });
    $('#pilih_berkas').on('click', function() {
            $('#modal-tambah-berkas').modal('show');
        });


    $('#datepicker').datepicker({
        format: 'yyyy-mm-dd',
    });

    $('#datepicker2').datepicker({
        format: 'yyyy-mm-dd',
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

// $('.tujuan-naskah').tagsinput({
//     itemValue: 'id_user',
//     itemText: 'nama',
//     typeahead: {
//         name: 'pengguna',
//         displayKey: 'nama',
//         source: pengguna.local,
//         // source: places.map(function(item) { return item.name }),
//         afterSelect: function() {
//             this.$element[0].value = '';
//         }
//     }
// }); 

    $(document).ready(function() {

        $('select[name=tipe_registrasi]').on('change', function(){
            if ($(this).val() == 5) {
                $('.change').hide();
                $('input[name=kepada]').removeAttr('required');
            }else{
                $('.change').show();
                $('input[name=kepada]').attr('required', true);
            }
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
