<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/minia/layouts/pages-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 27 Jun 2021 19:34:09 GMT -->
<head>

        <meta charset="utf-8" />
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />

        <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

        <!-- preloader css -->
        <link rel="stylesheet" href="{{asset('assets/css/preloader.min.css')}}" type="text/css" />

        <!-- Bootstrap Css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

        <!-- SweetAlert2 -->

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />


        @yield('style')
        @toastr_css



    </head>

    <body>

    <!-- <body data-layout="horizontal"> -->

        <!-- Begin page -->
        <div id="layout-wrapper" >


            <header id="page-topbar" >
                <div class="navbar-header" >
                    <div class="d-flex" >
                        <!-- LOGO -->
                        <div class="navbar-brand-box" style="">
                            <a href="#" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{asset('logo/images/logo.png')}}" alt="" height="24">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{asset('logo/images/logo.png')}}" alt="" height="24"> <span class="logo-txt" style="">Economysa</span>
                                </span>
                            </a>

                            <a href="#" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{asset('logo/images/logo.png')}}" alt="" height="24">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{asset('logo/images/logo.png')}}" alt="" height="24"> <span class="logo-txt">Economysa</span>
                                </span>
                            </a>
                        </div>

                        <button type="button"  class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>

                        <!-- App Search-->

                    </div>

                    <div class="d-flex">

                        <div class="dropdown d-inline-block d-lg-none ms-2">
                            <button type="button" class="btn header-item" id="page-header-search-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="search" class="icon-lg"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-search-dropdown">

                                <form class="p-3">
                                    <div class="form-group m-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search ..." aria-label="Search Result">

                                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>



                        <div class="dropdown d-none d-sm-inline-block">
                            <button type="button" class="btn header-item" id="mode-setting-btn">
                                <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
                                <i data-feather="sun" class="icon-lg layout-mode-light"></i>
                            </button>
                        </div>




                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item right-bar-toggle me-2">
                                <i data-feather="settings" class="icon-lg"></i>
                            </button>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item bg-soft-light border-start border-end" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if(Auth::user()->img=="")
                                <img class="rounded-circle header-profile-user" src="{{asset('assets/images/users/avatar-1.jpg')}}"
                                    alt="Header Avatar">
                                    @else

                                    <img class="rounded-circle header-profile-user" src="{{asset('perfil/'.Auth::user()->img)}}"
                                    alt="Header Avatar">

                                    @endif
                                <span class="d-none d-xl-inline-block ms-1 fw-medium">{{ Auth::user()->name }}</span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="{{url('users')}}"><i class="mdi mdi-face-profile font-size-16 align-middle me-1"></i> Perfil</a>



                                <div class="dropdown-divider"></div>
                                @guest
                                    @if (Route::has('login'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                        </li>
                                    @endif

                                    @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                        </li>
                                    @endif
                                @else

                                     <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="mdi mdi-logout font-size-16 align-middle me-1"></i> Logout</a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                                                    @csrf
                                            </form>
                                </div>

                                @endguest

                        </div>

                    </div>
                </div>
            </header>

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu" style="">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title" data-key="t-menu" style="">Menu</li>
                            <input type="hidden"  id="url_raiz_proyecto" value="{{ url('/') }}" />



                            @if(Auth::user()->admin==1)

                            <li>
                                <a href="{{url('home')}}" class="">
                                    <i data-feather="cpu"></i>
                                    <span data-key="t-icons" style="">Dashboard</span>
                                </a>


                            </li>

                            @foreach($areas as $area)

                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="grid"></i>
                                    <span data-key="t-apps" style="">{{$area->name}}</span>
                                </a>
                                @foreach($area->categorias as $c)
                                 <ul class="sub-menu" aria-expanded="false">

                                  <li>
                                        <a href="{{ url('detalle',$c->slug) }}">
                                            <span data-key="t-chat" style="">{{$c->name}}</span>
                                        </a>
                                    </li>


                                  </ul>
                                  @endforeach



                            </li>

                            @endforeach





                            @endif

                            @if(Auth::user()->admin==0)
                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="grid"></i>
                                    <span data-key="t-apps" style="">Matenimiento</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">

                                    <li>
                                        <a href="{{url('inventario')}}">
                                            <span data-key="t-chat" style="">Registro de inventario</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{url('users')}}">
                                            <span data-key="t-chat" style="">Usuario</span>
                                        </a>
                                    </li>




                                    <!--<li>
                                        <a href="{{url('home')}}">
                                            <span data-key="t-chat">Reportes Elxer</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{url('home')}}">
                                            <span data-key="t-chat">Reportes Elxer</span>
                                        </a>
                                    </li>

                                         <li>
                                            <a href="{{url('sector')}}">
                                                <span data-key="t-calendar">Sector</span>
                                            </a>
                                        </li>

                                    <li>
                                        <a href="{{url('persona')}}">
                                            <span data-key="t-chat">Cliente</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{url('tipo-servicio')}}">
                                            <span data-key="t-calendar">Concepto de Tipo de Servicio</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{url('tipo-vivienda')}}">
                                            <span data-key="t-calendar">Clasificación Vivienda</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{url('sub-categoria-domicilio')}}">
                                            <span data-key="t-calendar">Asociar sub categoria vivienda a (Recibos Solidos)</span>
                                        </a>
                                    </li>




                                    <li>
                                        <a href="{{url('tarifas')}}">
                                            <span data-key="t-chat"> Asignar Tarifas (Recibos Agua)</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{url('tarifas-servicios')}}">
                                            <span data-key="t-chat"> Asignar Tarifas (Recibos Solidos)</span>
                                        </a>
                                    </li>




                                    <li>
                                        <a href="{{url('asignacion-servicio')}}">
                                            <span data-key="t-chat">Asignar Servicio Agua</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{url('asignacion-servicios-generales')}}">
                                            <span data-key="t-chat">Asignar Servicio Generales</span>
                                        </a>
                                    </li>-->






                                </ul>
                            </li>
                            @endif



                           <!-- <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="cpu"></i>
                                    <span data-key="t-icons">Gestion de Recibos</span>
                                </a>

                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{url('recibos')}}" data-key="t-boxicons">Generación Recibos Agua</a></li>
                                    <li><a href="{{url('recibos-servicios')}}" data-key="t-boxicons">Generación Recibos Servicios</a></li>
                                    <li><a href="{{url('recibos-agua')}}" data-key="t-boxicons">Recibo Agua</a></li>
                                    <li><a href="{{url('recibo-solidos')}}" data-key="t-material-design">Recibo Residuos Solidos</a></li>
                                    <li><a href="{{url('corte-servicio')}}" data-key="t-material-design">Gestionar Corte de Servicio</a></li>

                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="map"></i>
                                    <span data-key="t-maps">Pagos de Recibos</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{url('facturacion')}}" data-key="t-g-maps">Pagos</a></li>

                                </ul>
                            </li>



                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="briefcase"></i>
                                    <span data-key="t-components">Caja</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{url('caja')}}" data-key="t-alerts">Caja</a></li>
                                     <li><a href="{{url('movimientos')}}" data-key="t-buttons">Movimientos</a></li>-->

                                 <!--</ul>
                            </li>-->

                            <!--<li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="sliders"></i>
                                    <span data-key="t-tables">Deudas</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{url('deudas')}}" data-key="t-basic-tables">Cargar Deudas Antiguas</a></li>

                                </ul>
                            </li>


                              <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="file-text"></i>
                                    <span data-key="t-pages">Reportes</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{url('impresion-masiva')}}" data-key="t-starter-page">Impresión Masiva (Recibos Agua)</a></li>
                                    <li><a href="{{url('impresion-masiva-solidos')}}" data-key="t-starter-page">Impresión Masiva (Recibos Solidos)</a></li>
                                    <li><a href="{{url('recibos-pendiente-cliente')}}" data-key="t-starter-page">Recibos Pendientes por Cliente</a></li>
                                    <li><a href="{{url('reporte-caja')}}" data-key="t-timeline">Reporte Caja</a></li>
                                    <li><a href="{{url('reporte-recibos-estado')}}" data-key="t-maintenance">Reporte Recibos</a></li>
                                    <li><a href="{{url('reporte-deudas')}}" data-key="t-maintenance">Reporte Deudas</a></li>
                                    <li><a href="{{url('reporte-personas')}}" data-key="t-maintenance">Historial Personas</a></li>


                                </ul>
                            </li>  !-->


                            <!--<li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="users"></i>
                                    <span data-key="t-authentication">Usuarios</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                     <li><a href="{{url('permisos')}}" data-key="t-login">Permisos</a></li> !-->
                                    <!--<li><a href="{{url('roles')}}" data-key="t-register">Roles</a></li>
                                    <li><a href="{{url('configuracion')}}" data-key="t-lock-screen">Configuración</a></li>


                                    <li><a href="{{url('users')}}" data-key="t-recover-password">Usuarios</a></li>


                                </ul>
                            </li> !-->












                        </ul>


                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">



               @yield('contenidos')

            </div>
                <!-- End Page-content -->


                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © Economysa.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    Economysa <a href="#!" class="text-decoration-underline"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->


        <!-- Right Sidebar -->
        <div class="right-bar">
            <div data-simplebar class="h-100">
                <div class="rightbar-title d-flex align-items-center bg-dark p-3">

                    <h5 class="m-0 me-2 text-white">Theme Customizer</h5>

                    <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                        <i class="mdi mdi-close noti-icon"></i>
                    </a>
                </div>

                <!-- Settings -->
               <!--  <hr class="m-0" />

                <div class="p-4">

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="hidden" name="layout"
                            id="layout-vertical" value="vertical">

                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="hidden" name="layout"
                            id="layout-horizontal" value="horizontal">

                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Layout Mode</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-mode"
                            id="layout-mode-light" value="light">
                        <label class="form-check-label" for="layout-mode-light">Light</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-mode"
                            id="layout-mode-dark" value="dark">
                        <label class="form-check-label" for="layout-mode-dark">Dark</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Layout Width</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-width"
                            id="layout-width-fuild" value="fuild" onchange="document.body.setAttribute('data-layout-size', 'fluid')">
                        <label class="form-check-label" for="layout-width-fuild">Fluid</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-width"
                            id="layout-width-boxed" value="boxed" onchange="document.body.setAttribute('data-layout-size', 'boxed')">
                        <label class="form-check-label" for="layout-width-boxed">Boxed</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Layout Position</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-position"
                            id="layout-position-fixed" value="fixed" onchange="document.body.setAttribute('data-layout-scrollable', 'false')">
                        <label class="form-check-label" for="layout-position-fixed">Fixed</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-position"
                            id="layout-position-scrollable" value="scrollable" onchange="document.body.setAttribute('data-layout-scrollable', 'true')">
                        <label class="form-check-label" for="layout-position-scrollable">Scrollable</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Topbar Color</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="topbar-color"
                            id="topbar-color-light" value="light" onchange="document.body.setAttribute('data-topbar', 'light')">
                        <label class="form-check-label" for="topbar-color-light">Light</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="topbar-color"
                            id="topbar-color-dark" value="dark" onchange="document.body.setAttribute('data-topbar', 'dark')">
                        <label class="form-check-label" for="topbar-color-dark">Dark</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2 sidebar-setting">Sidebar Size</h6>

                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-size"
                            id="sidebar-size-default" value="default" onchange="document.body.setAttribute('data-sidebar-size', 'lg')">
                        <label class="form-check-label" for="sidebar-size-default">Default</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-size"
                            id="sidebar-size-compact" value="compact" onchange="document.body.setAttribute('data-sidebar-size', 'md')">
                        <label class="form-check-label" for="sidebar-size-compact">Compact</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-size"
                            id="sidebar-size-small" value="small" onchange="document.body.setAttribute('data-sidebar-size', 'sm')">
                        <label class="form-check-label" for="sidebar-size-small">Small (Icon View)</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2 sidebar-setting">Sidebar Color</h6>

                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-color"
                            id="sidebar-color-light" value="light" onchange="document.body.setAttribute('data-sidebar', 'light')">
                        <label class="form-check-label" for="sidebar-color-light">Light</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-color"
                            id="sidebar-color-dark" value="dark" onchange="document.body.setAttribute('data-sidebar', 'dark')">
                        <label class="form-check-label" for="sidebar-color-dark">Dark</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-color"
                            id="sidebar-color-brand" value="brand" onchange="document.body.setAttribute('data-sidebar', 'brand')">
                        <label class="form-check-label" for="sidebar-color-brand">Brand</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2"></h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="hidden" name="layout-direction"
                            id="layout-direction-ltr" value="ltr">

                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="hidden" name="layout-direction"
                            id="layout-direction-rtl" value="rtl">

                    </div>

                </div>

            </div> end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
        <script src="{{asset('assets/libs/feather-icons/feather.min.js')}}"></script>
        <!-- pace js -->
        <script src="{{asset('assets/libs/pace-js/pace.min.js')}}"></script>

        <script src="{{asset('assets/js/app.js')}}"></script>
        <script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>







         @yield('script')

    </body>

<!-- Mirrored from themesbrand.com/minia/layouts/pages-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 27 Jun 2021 19:34:09 GMT -->
</html>
