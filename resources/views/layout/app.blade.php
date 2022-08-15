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
        @if(Auth::check())
        <div class="d-flex" id="wrapper">
            <!-- Start sidebar-->
            <div class="border-end bg-white" id="sidebar-wrapper">
                <div class="sidebar-heading"><a href="{{route('home')}}">BtO Retailer System v1.0.</a></div>
                <div class="list-group list-group-flush">
                <nav class="sidebar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link master-menu tab3" href="#"> Master Data<i class="bi small bi-caret-down-fill"></i> </a>
                            <ul id="submenu3" class="submenu collapse">
                                <li><a class="sub-link" href="{{route('master_data.category.index')}}"><img src="{{asset('public/icon/icon-table.png')}}" style="width:20px;"> Category</a></li>
                                <li><a class="sub-link" href="{{route('master_data.product.index')}}"><img src="{{asset('public/icon/icon-table.png')}}" style="width:20px;"> Product</a></li>
                                <li><a class="sub-link" href="{{route('master_data.customer.index')}}"><img src="{{asset('public/icon/icon-table.png')}}" style="width:20px;"> Customer</a></li>
                                <li><a class="sub-link" href="{{route('master_data.supplier.index')}}"><img src="{{asset('public/icon/icon-table.png')}}" style="width:20px;"> Supplier</a></li>
                                <li><a class="sub-link" href=""><img src="{{asset('public/icon/icon-table.png')}}" style="width:20px;"> Import product</a></li>
                                <li><a class="sub-link" href=""><img src="{{asset('public/icon/icon-table.png')}}" style="width:20px;"> Import customer</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link master-menu tab4" href="#"> Transactions<i class="bi small bi-caret-down-fill"></i> </a>
                            <ul id="submenu4" class="submenu collapse">
                                <li><a class="sub-link" href="{{route('transaction.purchase_item.index')}}"><img src="{{asset('public/icon/icon-table.png')}}" style="width:20px;"> Purchase item</a></li>
                                <li><a class="sub-link" href="#"><img src="{{asset('public/icon/icon-table.png')}}" style="width:20px;"> Issue item</a></li>
                                <li><a class="sub-link" href="#"><img src="{{asset('public/icon/icon-table.png')}}" style="width:20px;"> Return item</a></li>
                                <li><a class="sub-link" href="#"><img src="{{asset('public/icon/icon-table.png')}}" style="width:20px;"> POS</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link master-menu tab5" href="#"> Settings<i class="bi small bi-caret-down-fill"></i> </a>
                            <ul id="submenu5" class="submenu collapse">
                                <li><a class="sub-link" href="#"><img src="{{asset('public/icon/icon-table.png')}}" style="width:20px;"> Store Information</a></li>
                                <li><a class="sub-link" href="#"><img src="{{asset('public/icon/icon-table.png')}}" style="width:20px;"> General setting</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                </div>
            </div>
            <!--End sidebar-->
            @endif
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <nav class="navbar navbar-expand-md">
                    <div class="container-fluid">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ml-auto">
                            @guest
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link"  href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                           
                            @else
                                <!-- Authentication Links -->
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        <li>
                                            <a class="dropdown-item" style="color:#0a4293; font-size:14px; background-color:#fafafa;" href="{{route('crud.change_password.index')}}">Change password</a>
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
                
                @yield('content')
        
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                <!-- DataTables -->
                <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
                <!-- Bootstrap JavaScript -->
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
               
                <script src="{{asset('public/js/script.js')}}"></script>
                <!-- App scripts -->
                @stack('scripts')
                </main>
            </div>
        </div>
        <div class="footer">
            <p>Copyright &copy; Back to Office Retailer System v1.0. All rights reserved.</p>
        </div>
    </body>
</html>