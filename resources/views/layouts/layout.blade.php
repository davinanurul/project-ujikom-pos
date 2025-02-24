<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>LARAVEL-POS | @yield('title')</title>

    <!-- Bootstrap -->
    <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link href="{{ asset('asset') }}/dist/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('asset') }}/dist/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('asset') }}/dist/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- jQuery custom content scroller -->
    <link href="{{ asset('asset') }}/dist/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css"
        rel="stylesheet" />
    <!-- Custom Theme Style -->
    <link href="{{ asset('asset') }}/dist/build/css/custom.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- jQuery (Hanya Sekali) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <!-- Bootstrap Bundle JS (Termasuk Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Datatables -->

    <link href="{{ asset('asset') }}/dist/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('asset') }}/dist/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css"
        rel="stylesheet">
    <link href="{{ asset('asset') }}/dist/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css"
        rel="stylesheet">
    <link href="{{ asset('asset') }}/dist/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css"
        rel="stylesheet">
    <link href="{{ asset('asset') }}/dist/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css"
        rel="stylesheet">

    <style>
        #menu_toggle {
            display: flex;
            align-items: center;
            gap: 15px;
            white-space: nowrap;
        }

        .menu-title {
            font-size: 25px;
            line-height: 1;
            font-weight: bold;
        }
    </style>
</head>

<body class="nav-md" style="background-color: #fff">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col menu_fixed">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.html" class="site_title">POINT OF SALES</a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="{{ asset('asset') }}/dist/build/images/img.jpg" alt=""
                                class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2>{{ Auth::user()->user_nama }}</h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <ul class="nav side-menu">
                                <li>
                                    <a class="nav-link" href="{{ route('dashboard')}}">
                                        <i class="fa fa-home"></i> Home
                                    </a>
                                </li>
                                <li><a><i class="fa fa-cube"></i> Kelola Produk <span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('kategori.index')}}">Kategori</a></li>
                                        <li><a href="#">Produk</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-desktop"></i>Transaksi <span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="#">Daftar Peminjaman</a>
                                        </li>
                                        <li><a href="#">Pengembalian Barang</a>
                                        </li>
                                        <li><a href="#">Barang Belum
                                                Kembali</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-table"></i> Laporan <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="#">Laporan Daftar Barang</a></li>
                                        <li><a href="#">Laporan Pengembalian Barang</a></li>
                                        <li><a href="#">Laporan Status Barang</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-bar-chart-o"></i> Referensi<span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('supplier.index')}}">Supplier</a></li>
                                        <li><a href="#">User</a></li>
                                        <li><a href="#">Satuan</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /sidebar menu -->
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle">
                        <a id="menu_toggle">
                            <i class="fa fa-bars"></i>
                            <span class="menu-title">@yield('title')</span>
                        </a>
                    </div>
                    <nav class="nav navbar-nav">
                        <ul class=" navbar-right">
                            <li class="nav-item dropdown open" style="padding-left: 15px;">
                                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true"
                                    id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('asset') }}/dist/build/images/img.jpg" alt="">

                                </a>
                                <div class="dropdown-menu dropdown-usermenu pull-right"
                                    aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="javascript:;"> Profile</a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <span class="badge bg-red pull-right">50%</span>
                                        <span>Settings</span>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">Help</a>
                                    <!-- Link untuk Logout -->
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out pull-right"></i> Log Out
                                    </a>

                                    <!-- Formulir untuk Logout -->
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                            <li role="presentation" class="nav-item dropdown open">
                                <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1"
                                    data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="badge bg-green">6</span>
                                </a>
                                <ul class="dropdown-menu list-unstyled msg_list" role="menu"
                                    aria-labelledby="navbarDropdown1">
                                    <li class="nav-item">
                                        <a class="dropdown-item">
                                            <span class="image"><img src="images/img.jpg"
                                                    alt="Profile Image" /></span>
                                            <span>
                                                <span>John Smith</span>
                                                <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                                Film festivals used to be do-or-die moments for movie makers. They were
                                                where{{ asset('asset') }}/dist.
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="dropdown-item">
                                            <span class="image"><img src="images/img.jpg"
                                                    alt="Profile Image" /></span>
                                            <span>
                                                <span>John Smith</span>
                                                <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                                Film festivals used to be do-or-die moments for movie makers. They were
                                                where{{ asset('asset') }}/dist.
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="dropdown-item">
                                            <span class="image"><img src="images/img.jpg"
                                                    alt="Profile Image" /></span>
                                            <span>
                                                <span>John Smith</span>
                                                <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                                Film festivals used to be do-or-die moments for movie makers. They were
                                                where{{ asset('asset') }}/dist.
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="dropdown-item">
                                            <span class="image"><img src="images/img.jpg"
                                                    alt="Profile Image" /></span>
                                            <span>
                                                <span>John Smith</span>
                                                <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                                Film festivals used to be do-or-die moments for movie makers. They were
                                                where{{ asset('asset') }}/dist.
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <div class="text-center">
                                            <a class="dropdown-item">
                                                <strong>See All Alerts</strong>
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
                    <div class="page-title">
                        <div class="content" style="margin-top: 6%">
                            @yield('content')
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

    <!-- jQuery -->
    <script src="{{ asset('asset') }}/dist/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('asset') }}/dist/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="{{ asset('asset') }}/dist/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="{{ asset('asset') }}/dist/vendors/nprogress/nprogress.js"></script>
    <!-- jQuery custom content scroller -->
    <script src="{{ asset('asset') }}/dist/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js">
    </script>
    <!-- Datatables -->
    <script src="{{ asset('asset') }}/dist/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('asset') }}/dist/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="{{ asset('asset') }}/dist/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('asset') }}/dist/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="{{ asset('asset') }}/dist/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="{{ asset('asset') }}/dist/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('asset') }}/dist/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('asset') }}/dist/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="{{ asset('asset') }}/dist/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="{{ asset('asset') }}/dist/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('asset') }}/dist/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="{{ asset('asset') }}/dist/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="{{ asset('asset') }}/dist/vendors/jszip/dist/jszip.min.js"></script>
    <script src="{{ asset('asset') }}/dist/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="{{ asset('asset') }}/dist/vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{ asset('asset') }}/dist/build/js/custom.min.js"></script>
</body>

</html>
