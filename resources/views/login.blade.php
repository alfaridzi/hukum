<!DOCTYPE html>
<html lang="en">
<head>
  <title>Polhukam</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
  <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/login/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/login/vendor/animate/animate.css')}}">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="{{asset('assets/login/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/login/vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/login/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="{{asset('assets/login/vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/login/css/util.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/login/css/main.css')}}">
<!--===============================================================================================-->
<style type="text/css">
  .header-page {
    margin-top: 10px;
    margin-bottom: 10px;
  }

  div.login100-more{
    background: url('assets/images/uploads/halaman_depan/{{ $halamanDepan->file_image }}');
    position: relative;
    padding: 30px;
  }

  div.login100-more .background-login {
    background-color: rgba(255,255,255, 0.2);
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
  }
  div.login100-more .background-login div.text-halaman p {
    position: relative;
    z-index: 1;
    margin: 50% 20px 20px 20px;
    color: white;
  }
</style>
</head>
<body>
  
  <div class="limiter">
    <h1 class="text-center header-page">{{ $halamanDepan->header_page }}</h1>
    <div class="container-login100">
      <div class="wrap-login100">
        <form class="login100-form validate-form" method="post" action="{{ url('/login') }}">
          @if ($errors->any())
          <div class="alert alert-danger" style="width: 100%">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif

      @if(Session::has('success'))
          <div class="alert alert-success" style="width: 100%">
              <ul>
                  <li>{{ Session::get('success') }}</li>
              </ul>
          </div>
      @endif

          @csrf
          <span class="login100-form-title p-b-34">
            Login Panel
          </span>
          
          <div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user name">
            <input id="first-name" class="input100" type="text" name="username" placeholder="User name">
            <span class="focus-input100"></span>
          </div>
          <div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type password">
            <input class="input100" type="password" name="password" placeholder="Password">
            <span class="focus-input100"></span>
          </div>
          
          <div class="container-login100-form-btn">
            <button class="login100-form-btn">
              Sign in
            </button>
          </div>

          <div class="w-full text-center p-t-27 p-b-239">
          </div>

          <div class="w-full text-center">
          </div>
        </form>

        <div class="login100-more">
          <div class="background-login">
            <div class="text-halaman">{!! $halamanDepan->konten !!}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  

  <div id="dropDownSelect1"></div>
  
<!--===============================================================================================-->
  <script src="{{asset('assets/login/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
  <script src="{{asset('assets/login/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
  <script src="{{asset('assets/login/vendor/bootstrap/js/popper.js')}}"></script>
  <script src="{{asset('assets/login/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
  <script src="{{asset('assets/login/vendor/select2/select2.min.js')}}"></script>
  <script>
    $(".selection-2").select2({
      minimumResultsForSearch: 20,
      dropdownParent: $('#dropDownSelect1')
    });
  </script>
<!--===============================================================================================-->
  <script src="{{asset('assets/login/vendor/daterangepicker/moment.min.js')}}"></script>
  <script src="{{asset('assets/login/vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
  <script src="{{asset('assets/login/vendor/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
  <script src="{{asset('assets/login/js/main.js')}}"></script>

</body>
</html>