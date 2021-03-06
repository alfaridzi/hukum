@extends('app.app')
@section('page-title', 'Registrasi Naskah')
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

<form action="{{ url('registrasi-naskah/simpan') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Jenis Naskah</label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-5 col-xs-6">
            <select class="form-control" name="jenis_naskah">
                @foreach($jenisNaskah as $data)
                <option value="{{ $data->id_jenis_naskah }}">{{ $data->jenis_naskah }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Tanggal Naskah <span>*</span></label>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5">
            <input type="text" class="form-control" id="datepicker" name="tanggal_naskah" value="{{ date('Y-m-d') }}" required>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Nomor Asal Naskah <span>*</span></label>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-7 col-xs-8">
            <input type="text" class="form-control" name="nomor_naskah" required>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Nomor Agenda</label>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-7 col-xs-8">
            <input type="text" class="form-control" name="nomor_agenda" placeholder="disini jika menggunakan buku agenda">
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
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Hal <span>*</span></label>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-7 col-xs-8">
            <input type="text" class="form-control" name="hal" required>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Asal Naskah <span>*</span></label>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-7 col-xs-8">
            <input type="text" class="form-control" name="asal_naskah" required>
        </div>
    </div>


    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Berkaskan <span>*</span></label>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-7 col-xs-8">
            <input type="hidden" class="form-control" name="id_berkas" required>

            <a href="javascript:;" id="pilih_berkas" class="btn btn-xs btn-primary" style="border-radius: 0px">Pilih Berkas</a>

        </div>


    </div>
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Tingkat Urgensi <span>*</span></label>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-5 col-xs-6">
            <select class="form-control" name="tingkat_urgensi" required>
                @foreach($urgensi as $data)
                <option value="{{ $data->id_urgensi }}">{{ $data->tingkat }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <br>
    <div class="form-group change">
        <div class="col-lg-offset-2 col-lg-6 col-md-offset-2 col-md-10 col-sm-offset-3 col-sm-9 col-xs-offset-3 col-xs-9">
            <p class="text-center" id="tujuan-naskah">Tujuan Naskah</p>
        </div>
    </div>
    <div class="form-group change">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Kepada <span>*</span></label>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-7 col-xs-8">
            <input type="text" class="form-control tujuan-naskah" name="kepada" required="">
        </div>
    </div>
    <div class="form-group change">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Tembusan</label>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-7 col-xs-8">
            <input type="text" class="form-control tujuan-naskah" name="tembusan" id="tembusan" autocomplete="off" data-role="tagsinput">
        </div>
    </div>
    <br>
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>File Upload</label>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-7 col-xs-8 box-file">
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
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Tipe Registrasi</label>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-7 col-xs-8">
            <select class="form-control" name="tipe_registrasi">
                <option value="1">Naskah Masuk</option>
                <option value="2">Memo</option>
                <option value="3">Nota Dinas</option>
                <option value="4">Naskah Keluar</option>
                <option value="5">Naskah Tanpa Tidak Lanjut</option>
            </select>
        </div>
    </div>

    <input type="hidden" name="id_berkas" id="field_berkas">
    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10 col-md-offset-2 col-md-10 col-sm-offset-3 col-sm-9 col-xs-offset-3 col-xs-9">
            <button class="btn btn-primary">Kirim</button>
        </div>
    </div>
</form>


<div class="modal fade" id="modal-tambah-berkas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Berkas</h4>
      </div>
      <div class="modal-body">

        <table class="table table-condensed">
            <tr>
                <td>No</td>
                <td></td>
                <td>Klasifikasi</td>
                <td>Berkas</td>
            </tr>
     
        @foreach($berkas as $item)
                <tr>
                    <td>{{$no++}}</td>
                    <td><input type="radio" class="radioberkas" name="id_berkas" value="{{ $item->id_berkas }}"></td>
                    <td>{{ $item->klasifikasi->kode}} - {{$item->klasifikasi->nama}}</td>
                    <td>{{ $item->kode_klasifikasi.'/'.$item->nomor_berkas.' - '.$item->judul_berkas}}</td>
                </tr>
        @endforeach

    </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    
      </div>
    </div>
  </div>
</div>
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
