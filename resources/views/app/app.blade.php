<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SISURAT</title>

    <!-- Bootstrap -->
    <link href="{{ asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('assets/vendors/nprogress/nprogress.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('assets/build/css/custom.min.css') }}" rel="stylesheet">

    @stack('css')
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-envelope"></i> <span>Sistem Surat</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{ asset('assets/images/user.png') }}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
          
                <h2>{{ Auth::guard()->user()->nama }}<br>
                  <small style="color:white">[ {{ Auth::guard()->user()->jabatan->jabatan }} - {{ Auth::user()->get_role() }} ]</small></h2>
              </div>
              <div class="clearfix"></div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">



                  @if(Auth::user()->role == '1')
                   <li><a href="{{ url('/dashboard') }}"><i class="fa fa-home" aria-hidden="true"></i> Home </a></li>
                    <li><a><i class="fa fa-user"></i> Unit Kerja &amp; Pengguna <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                       <li><a href="{{ url('/unitkerja') }}"> Pengaturan Unit Kerja </a></li>

                       <li><a href="{{ url('/pengguna') }}"> Pengaturan Pengguna </a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-shield"></i> Klasifikasi &amp; Berkas <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                       <li><a href="{{ url('/klasifikasi') }}"> Pengaturan Klasifikasi </a></li>

                    
                    </ul>
                  </li>
                  
                  @elseif(Auth::user()->role == '2')

                   <li><a href="{{ url('/dashboard') }}"><i class="fa fa-home" aria-hidden="true"></i> Home </a></li>
                   <li><a><i class="fa fa-user"></i> Unit Kerja &amp; Pengguna <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                       <li><a href="{{ url('/unitkerja') }}"> Pengaturan Unit Kerja </a></li>

                       <li><a href="{{ url('/pengguna') }}"> Pengaturan Pengguna </a></li>
                    </ul>
                  </li>

                     <li><a><i class="fa fa-file-archive-o"></i> Berkas <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                       <li><a href="{{ url('berkas') }}"> Berkas Unit Kerja </a></li>

                       
                       <li><a href="{{ url('/berkas/inaktif') }}"> Daftar Berkas yang melewati masa aktif</a></li>
                    
                    </ul>
                  </li>





                  @elseif(Auth::user()->role == '3')

                   <li><a href="{{ url('/dashboard') }}"><i class="fa fa-home" aria-hidden="true"></i> Home </a></li>
                  
                  <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i> Registrasi Naskah <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ url('registrasi-naskah') }}">Registrasi Naskah</a></li>
                        <li><a href="{{ url('registrasi-naskah/template-dokumen') }}">Download Template Dokumen</a></li>
                    </ul>
                  </li>

                  <li><a href="{{ url('naskah-masuk') }}"><i class="fa fa-envelope-o" aria-hidden="true"></i> Naskah Masuk </a></li>
                  
                  <li><a href="#"><i class="fa fa-book" aria-hidden="true"></i> Log Registrasi <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                  
                        <li><a href="{{ url('log/memo') }}">Memo</a></li>
                        <li><a href="{{ url('log/nota-dinas') }}">Nota Dinas</a></li>
                        <li><a href="{{ url('log/naskah-keluar') }}">Naskah Keluar</a></li>
                        <li><a href="{{ url('log/naskah-tanpa-tindak-lanjut') }}">Naskah Tanpa Tindak Lanjut</a></li>
                    </ul>
                  </li>


                   <li><a><i class="fa fa-file-archive-o"></i> Berkas <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                       <li><a href="{{ url('berkas') }}"> Berkas Unit Kerja </a></li>

                       
                       <li><a href="{{ url('/berkas/inaktif') }}"> Daftar Berkas yang melewati masa aktif</a></li>
                    
                    </ul>
                  </li>


                     <li><a><i class="fa fa-user"></i> Laporan <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                       <li><a href="{{ url('/lap/reg-naskah-masuk') }}">Registrasi naskah masuk </a></li>
                        <li><a href="{{ url('lap/reg-naskah-tanpa-tindak-lanjut') }}"> naskah tanpa tindak lanjut </a></li>

                       <li><a href="{{ url('lap/naskah-masuk') }}"> Naskah Masuk </a></li>
                        <li><a href="{{ url('/lap/naskah-keluar') }}"> Naskah Keluar </a></li>

                       
                         <li><a href="{{ url('/lap/berkas') }}"> Daftar berkas </a></li>
                    </ul>
                  </li>






                  @elseif(Auth::user()->role == '4')

                    <li><a href="{{ url('/dashboard') }}"><i class="fa fa-home" aria-hidden="true"></i> Home </a></li>

                    <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i> Registrasi Naskah <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ url('registrasi-naskah') }}">Registrasi Naskah</a></li>
                        <li><a href="{{ url('registrasi-naskah/template-dokumen') }}">Download Template Dokumen</a></li>
                    </ul>
                  </li>

                  <li><a href="{{ url('naskah-masuk') }}"><i class="fa fa-envelope-o" aria-hidden="true"></i> Naskah Masuk </a></li>

                    <li><a><i class="fa fa-file-archive-o"></i> Berkas <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                       <li><a href="{{ url('berkas') }}"> Berkas Unit Kerja </a></li>

                       
                       <li><a href="{{ url('/berkas/inaktif') }}"> Daftar Berkas yang melewati masa aktif</a></li>
                    
                    </ul>
                  </li>




                  <li><a><i class="fa fa-user"></i> Laporan <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                       <li><a href="{{ url('/lap/reg-naskah-masuk') }}">Registrasi naskah masuk </a></li>
                        <li><a href="{{ url('/lap/naskah-keluar') }}"> Naskah Keluar </a></li>

                       
                         <li><a href="{{ url('/lap/berkas') }}"> Daftar berkas </a></li>
                    </ul>
                  </li>



                  @elseif(Auth::user()->role == '5')

                   <li><a href="{{ url('/dashboard') }}"><i class="fa fa-home" aria-hidden="true"></i> Home </a></li>
                    <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i> Registrasi Naskah <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ url('registrasi-naskah') }}">Registrasi Naskah</a></li>
                        <li><a href="{{ url('registrasi-naskah/template-dokumen') }}">Download Template Dokumen</a></li>
                    </ul>
                  </li>
                   <li><a href="#"><i class="fa fa-book" aria-hidden="true"></i> Log Registrasi <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ url('log/registrasi-naskah-masuk') }}">Registrasi Naskah Masuk</a></li>
                       
                        <li><a href="{{ url('log/naskah-tanpa-tindak-lanjut') }}">Naskah Tanpa Tindak Lanjut</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-file-archive-o"></i> Berkas <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                       <li><a href="{{ url('berkas') }}"> Berkas Unit Kerja </a></li>

                       
                       <li><a href="{{ url('/berkas/inaktif') }}"> Daftar Berkas yang melewati masa aktif</a></li>
                    
                    </ul>
                  </li>

                   <li><a><i class="fa fa-user"></i> Laporan <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                       <li><a href="{{ url('/lap/reg-naskah-masuk') }}">Registrasi naskah masuk </a></li>
                        <li><a href="{{ url('lap/reg-naskah-tanpa-tindak-lanjut') }}"> naskah tanpa tindak lanjut </a></li>

                      
                       
                         <li><a href="{{ url('/lap/berkas') }}"> Daftar berkas </a></li>
                    </ul>
                  </li>




                  @endif
                 
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('assets/images/user.png') }}" alt="">{{ Auth::guard()->user()->nama }}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li><a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">{{ $naskahBaru->count() }} @if($count_naskah > 3) + @endif</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    @foreach($naskahBaru as $data)
                    <li>
                      <a href="{{ url('/naskah-masuk/detail/'.$data->id_naskah) }}">
                          <span>Nomor Naskah: {{ $data->nomor_naskah }}</span>
                        </span>
                        <span class="message">
                          Asal Naskah: {{ $data->asal_naskah }}
                        </span>
                      </a>
                    </li>
                    @endforeach
                    <li>
                      <div class="text-center">
                        <a href="{{ url('/naskah-masuk') }}">
                          <strong>Lihat Semua Naskah</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>@yield('page-title')</h2>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      @yield('content')
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

<form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
    <!-- jQuery -->
    <script src="{{ asset('assets/vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('assets/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('assets/vendors/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ asset('assets/vendors/nprogress/nprogress.js') }}"></script>
  
    <!-- Custom Theme Scripts -->
    <script src="{{ asset('assets/build/js/custom.min.js') }}"></script>

    @stack('js')
  </body>
</html>
