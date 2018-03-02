@extends('app.app')
@section('page-title', 'Pengaturan Halaman Depan')
@push('css')
<style type="text/css">
    #show-gambar {
        height: 300px;
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

<form class="form-horizontal" action="{{ url('pengaturan/halaman-depan/edit') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Judul Halaman</label>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-9 col-xs-9">
            <input type="text" name="header_page" class="form-control" value="{{ $halamanDepan->header_page }}">
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10 col-md-offset-2 col-md-10 col-sm-offset-3 col-sm-9 col-xs-offset-3 col-xs-9">
            <img src="{{ asset('assets/images/uploads/halaman_depan/'. $halamanDepan->file_image) }}" class="img-responsive" id="show-gambar" height="400px">
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>File Image</label>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-9 col-xs-9">
            <input type="file" id="file_image" name="file_image" accept=".jpg,.jpeg,.png">
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3">
            <label>Konten</label>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-9 col-xs-9">
            <textarea id="konten" name="konten" class="form-control">{!! $halamanDepan->konten !!}</textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10 col-md-offset-2 col-md-10 col-sm-offset-3 col-sm-9 col-xs-offset-3 col-xs-9">
            <button class="btn btn-primary">Simpan Perubahan</button>
        </div>
    </div>
</form>

@endsection
@push('js')
<script src="{{ asset('/assets/vendors/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript">
  tinymce.init({
    selector: 'textarea#konten',
    height: 500,
    plugins : 'print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
    toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
    toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help fontselect fontsizeselect',
    image_advtab: true,
  });
</script>
<script type="text/javascript">
    function readUploadImagemember(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#show-gambar').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#file_image").change(function () {
        readUploadImagemember(this);
    });
</script>
@endpush