<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Simple Sidebar - Start Bootstrap Template</title>
       
        <!-- Favicon-->
        <link rel = "icon" href ="{{asset('public/logo/image.png')}}" type = "image/x-icon">
        <!-- Core theme CSS (includes Bootstrap)-->
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
        
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
        
        <!--Icon library-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!--Date picker style-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.standalone.min.css">

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <link rel="stylesheet" href="{{asset('public/style/layout.css')}}">

        <link rel="stylesheet" href="{{asset('public/style/modal.css')}}">

        <link href="{{asset('public/style/sidebar.css')}}" rel="stylesheet" />

    </head>
    <body>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <div class="border-end bg-white" id="sidebar-wrapper">
                <div class="sidebar-heading"><a href="{{route('home')}}"><img class="d-inline-block align-top" src="{{asset('public/logo/image.png')}}" width="20" height="20" alt="">&nbsp;&nbsp; BTO CRUD Panel</a></div>
                <div class="list-group list-group-flush">
                <nav class="sidebar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link master-menu" href="#"> Standard CRUD operation <i class="bi small bi-caret-down-fill"></i> </a>
                            <ul class="submenu collapse">
                                <li><a class="nav-link" href="{{route('crud.table_layout1')}}"><img src="{{asset('public/icon/icon-table.png')}}" style="width:20px;"> Basic layout</a></li>
                                <li><a class="nav-link" href="{{route('crud.table_layout2')}}"><img src="{{asset('public/icon/icon-table.png')}}" style="width:20px;"> Grouped action button</a></li>
                                <li><a class="nav-link" href="{{route('crud.table_layout3')}}"><img src="{{asset('public/icon/icon-table.png')}}" style="width:20px;"> Selected row</a> </li>
                                <li><a class="nav-link" href="{{route('crud.table_layout4')}}"><img src="{{asset('public/icon/icon-table.png')}}" style="width:20px;"> Integrated outside form</a> </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link master-menu" href="#"> More menus <i class="bi small bi-caret-down-fill"></i> </a>
                            <ul class="submenu collapse">
                                <li><a class="nav-link" href="#">Submenu item 4 </a></li>
                                <li><a class="nav-link" href="#">Submenu item 5 </a></li>
                                <li><a class="nav-link" href="#">Submenu item 6 </a></li>
                                <li><a class="nav-link" href="#">Submenu item 7 </a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link master-menu" href="#"> Another submenus <i class="bi small bi-caret-down-fill"></i> </a>
                            <ul class="submenu collapse">
                                <li><a class="nav-link" href="#">Submenu item 8 </a></li>
                                <li><a class="nav-link" href="#">Submenu item 9 </a></li>
                                <li><a class="nav-link" href="#">Submenu item 10 </a></li>
                                <li><a class="nav-link" href="#">Submenu item 11 </a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                </div>
            </div>
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <nav class="navbar sticky-top navbar-expand-md" style="background-image: linear-gradient(#c7d9ed, #b4c7e7, #c7d9ed); border-bottom: 1px solid #577fb3; padding-top:0.45rem; padding-bottom:0.45rem;">
                    <div class="container-fluid">
                        <!--<button class="btn btn-primary" id="sidebarToggle"><img src="{{asset('public/icon/toggle-button.png')}}" /></button>-->

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">

                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ml-auto">
                            
                                <!-- Authentication Links -->
                                @guest
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                    @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                        </li>
                                    @endif
                                @else
                                    <li class="nav-item dropdown">
                                        <a style="color:#0a4293; font-size:14px; font-weight:600;" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }} <span class="caret"></span>
                                        </a>

                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a class="dropdown-item" style="color:#0a4293; font-size:14px; background-color:#fafafa;" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                                                    {{ csrf_field() }}
                                                </form>
                                            </li>
                                        </ul>
                                    </li>
                                @endguest
                            </ul>
                        </div>

                    </div>
                </nav>
                <!-- Page content-->
                <main class="py-4">
                @yield('content')
        
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
                <!-- DataTables -->
                <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
                <!-- Bootstrap JavaScript -->
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
                
                <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
                <script src="//cdn.datatables.net/plug-ins/1.10.25/api/sum().js"></script>
                <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                
                <script src="{{asset('public/js/script.js')}}"></script>
                <!-- App scripts -->
                @stack('scripts')
                </main>
            </div>
        </div>
        <div class="footer">
            <p>Copyright &copy; Back to Office CRUD Panel. All rights reserved.</p>
        </div>
    </body>
</html>