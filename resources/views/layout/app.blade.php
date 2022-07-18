<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>BtO - Warehouse</title>
       
        <!-- Favicon-->
        <link rel = "icon" href ="{{asset('public/logo/image2.png')}}" type = "image/x-icon">
        <!-- Core theme CSS (includes Bootstrap)-->
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
        
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">

        <!--Start custom style-->
        <link rel="stylesheet" href="{{asset('public/style/layout.css')}}">
        <link rel="stylesheet" href="{{asset('public/style/modal.css')}}">
        <link href="{{asset('public/style/sidebar.css')}}" rel="stylesheet" />
        <!--End custom style-->
        
    </head>
    <body>
        <div class="d-flex" id="wrapper">
            <!-- Start sidebar-->
            <div class="border-end bg-white" id="sidebar-wrapper">
                <div class="sidebar-heading"><a href="{{route('home')}}">BtO CRUD Panel</a></div>
                <div class="list-group list-group-flush">
                <nav class="sidebar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link master-menu tab1" href="#"> Standard CRUD tables <i class="bi small bi-caret-down-fill"></i> </a>
                            <ul id="submenu1" class="submenu collapse">
                                <li><a class="sub-link" href="{{route('crud.table_layout1')}}"><img src="{{asset('public/icon/icon-table.png')}}" style="width:20px;"> Basic layout</a></li>
                                <li><a class="sub-link" href="{{route('crud.table_layout2')}}"><img src="{{asset('public/icon/icon-table.png')}}" style="width:20px;"> Grouped action button</a></li>
                                <li><a class="sub-link" href="{{route('crud.table_layout3')}}"><img src="{{asset('public/icon/icon-table.png')}}" style="width:20px;"> Selected row</a> </li>
                                <li><a class="sub-link" href="{{route('crud.table_layout4')}}"><img src="{{asset('public/icon/icon-table.png')}}" style="width:20px;"> Integrated outside form</a> </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link master-menu tab2" href="#"> Custom CRUD tables<i class="bi small bi-caret-down-fill"></i> </a>
                            <ul id="submenu2" class="submenu collapse">
                                <li><a class="sub-link" href="{{route('crud.table_layout5')}}"><img src="{{asset('public/icon/icon-table.png')}}" style="width:20px;"> Child rows</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                </div>
            </div>
            <!--End sidebar-->

            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <nav class="navbar navbar-expand-md">
                    <div class="container-fluid">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ml-auto">
                            
                                <!-- Authentication Links -->
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
                            </ul>
                        </div>

                    </div>
                </nav>
                <!-- Page content-->
                
                @yield('content')
        
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
                <!-- DataTables -->
                <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
                <!-- Bootstrap JavaScript -->
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
               
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