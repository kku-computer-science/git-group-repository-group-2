<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>
    <base href="{{ \URL::to('/') }}">
    <link href="img/Newlogo.png" rel="shortcut icon" type="image/x-icon" />

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Include Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<<<<<<< HEAD
    <!-- Flag Icon CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.1.0/css/flag-icon.min.css" rel="stylesheet">

    <!-- plugins:css -->
=======
    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('plugins/ijaboCropTool/ijaboCropTool.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styleadmin.css') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Vendor Styles -->
>>>>>>> c1a2cdf63af96119ce5aad2bdbeaed9987827f05
    <link rel="stylesheet" href="{{asset('vendors/feather/feather.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/ti-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/typicons/typicons.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/simple-line-icons/css/simple-line-icons.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/css/vendor.bundle.base.css')}}">

    <!-- Plugin Styles -->
    <link rel="stylesheet" href="{{asset('js/select.dataTables.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <style>
        .navbar-menu-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .navbar-nav.ms-auto {
            display: flex;
            align-items: center;
            margin-left: auto;
        }

        .nav-item.dropdown {
            margin-left: 10px;
        }

        .navbar-brand-wrapper .navbar-toggler {
            border: none;
        }

        .navbar-nav .nav-item {
            margin-right: 15px;
        }

        .navbar-nav .nav-item a {
            font-weight: 500;
            color: #343a40;
        }
    </style>
</head>

<body>
    <div class="container-scroller sidebar-dark">
        <!-- Navbar -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div class="me-3">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-top justify-content-between">
                <ul class="navbar-nav">
                    <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
<<<<<<< HEAD
                        <h1 class="welcome-text">{{trans('message.ResearchInformationManagementSystem')}}<span
                                class="text-black fw-bold"></span></h1>
                        <h3 class="welcome-sub-text"> </h3>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item d-none d-lg-block">
                        <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
                            <span class="input-group-addon input-group-prepend border-right">
                                <span class="icon-calendar input-group-text calendar-icon"></span>
                            </span>
                            <input type="text" class="form-control">
                        </div>
                    </li>
                    <li class="nav-item">
                        <form class="search-form" action="#">
                            <i class="icon-search"></i>
                            <input type="search" class="form-control" placeholder="Search Here" title="Search here">
                        </form>
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link count-indicator" id="countDropdown" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="icon-bell"></i>
                            <span class="count"></span>
                        </a>
                    </li> -->
                    <!-- <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="img-xs rounded-circle" src="{{ Auth::user()->picture }}"
                                alt="User profile picture">
                        </a>
                    </li> -->
                    <!-- <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="img-md rounded-circle" src="{{ Auth::user()->picture }}"
                                    alt="Profile image">
                                <p class="mb-1 mt-3 font-weight-semibold">{{ Auth::user()->name }}</p>
                                <p class="fw-light text-muted mb-0"></p>
                            </div>
                            <a class="dropdown-item"><i
                                    class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My
                                Profile <span class="badge badge-pill badge-danger">1</span></a>
                            <a class="dropdown-item"><i
                                    class="dropdown-item-icon mdi mdi-message-text-outline text-primary me-2"></i>
                                Messages</a>
                            <a class="dropdown-item"><i
                                    class="dropdown-item-icon mdi mdi-calendar-check-outline text-primary me-2"></i>
                                Activity</a>
                            <a class="dropdown-item"><i
                                    class="dropdown-item-icon mdi mdi-help-circle-outline text-primary me-2"></i>
                                FAQ</a>
                            <a class="dropdown-item"><i
                                    class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a> -->
                    <li class="nav-item d-none d-sm-inline-block">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); 
                        document.getElementById ('logout-form').submit();"> {{trans('message.Logout')}} <i class="mdi mdi-logout"></i></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
            </div>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-bs-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
=======
                        <h1 class="welcome-text">Research Information Management System</h1>
                    </li>
                </ul>
>>>>>>> c1a2cdf63af96119ce5aad2bdbeaed9987827f05

                <nav class="navbar navbar-expand-lg">
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <!-- Language Switcher -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-globe"></i>
                                    @if (App::getLocale() == 'en') English @else ภาษาไทย @endif
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{ url('lang/en') }}">English</a></li>
                                    <li><a class="dropdown-item" href="{{ url('lang/th') }}">ภาษาไทย</a></li>
                                </ul>
                            </li>

                            <!-- Date Picker -->
                            <li class="nav-item">
                                <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
                                    <span class="input-group-addon input-group-prepend border-right">
                                        <span class="icon-calendar input-group-text calendar-icon"></span>
                                    </span>
                                    <input type="text" class="form-control">
                                </div>
                            </li>

                            <!-- Search -->
                            <li class="nav-item">
                                <form class="search-form" action="#">
                                    <i class="icon-search"></i>
                                    <input type="search" class="form-control" placeholder="Search Here" title="Search here">
                                </form>
                            </li>

                            <!-- Logout -->
                            <li class="nav-item d-none d-sm-inline-block">
                                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }} <i class="mdi mdi-logout"></i>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </nav>
        <!-- Navbar End -->

        <div class="container-fluid page-body-wrapper">
            <!-- Sidebar -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('dashboard*')) ? 'active' : '' }}"
                            href="{{ route('dashboard')}}">
                            <i class="menu-icon mdi mdi-grid-large"></i>
                            <span class="menu-title">{{trans('message.Dashboard')}}</span>
                        </a>
                    </li>
                    <li class="nav-item nav-category">{{trans('message.Profile')}}</li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('admin/profile*')) ? 'active' : '' }}"
                            href="{{ route('profile')}}">
                            <i class="menu-icon mdi mdi-account-circle-outline"></i>
                            <span class="menu-title">{{trans('message.UserProfile')}}</span>

                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link {{ (request()->is('admin/settings*')) ? 'active' : '' }}"
                            href="{{ route('settings')}}">
                            <i class="menu-icon mdi mdi mdi-settings-outline"></i>
                            <span class="menu-title">Settings</span>

                        </a>
                    </li> -->
                    <li class="nav-item nav-category">{{trans('message.Options')}}</li>
                    @can('funds-list')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('funds.index')}}">
                            <i class="menu-icon mdi mdi-file-document-box-outline"></i>
                            <span class="menu-title">{{trans('message.ManageFund')}}</span>

                        </a>
                    </li>
                    @endcan
                    @can('projects-list')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('researchProjects.index')}}">
                            <i class="menu-icon mdi mdi-book-outline"></i>
                            <span class="menu-title">{{trans('message.ResearchProj')}}</span>

                        </a>
                    </li>
                    @endcan
                    @can('groups-list')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('researchGroups.index')}}">
                            <i class="menu-icon mdi mdi-view-dashboard-outline"></i>
                            <span class="menu-title">{{trans('message.ResearchGroup')}}</span>

                        </a>
                    </li>
                    @endcan
                    @can('papers-list')
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#ManagePublications" aria-expanded="false" aria-controls="ManagePublications">
                            <i class="menu-icon mdi mdi-book-open-page-variant"></i>
                            <span class="menu-title">{{trans('message.ManagePublications')}}</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ManagePublications">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{ route('papers.index')}}">{{trans('message.Publishedresearch')}}</a></li>
                                <li class="nav-item"> <a class="nav-link" href="/books">{{trans('message.Book')}}</a></li>
                                <li class="nav-item"> <a class="nav-link" href="/patents">{{trans('message.OtherAcademicWorks')}}</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        @foreach (Config::get('languages') as $lang => $language)
                        @if ($lang != App::getLocale())
                        <a class="nav-link" href="{{ route('langswitch', $lang) }}">
                        <span
                        class="flag-icon flag-icon-{{$language['flag-icon']}}"></span>
                            <span class="menu-title">{{$language['display']}}</span>   
                        @endif
                        @endforeach
                        </a>
                    @endcan
                    @can('export')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('exportfile')}}">
                            <i class="menu-icon mdi mdi-file-export"></i>
                            <span class="menu-title">Export</span>
                        </a>
                    </li>
                    @endcan
                    @can('user-list')
                    <li class="nav-item nav-category">Admin</li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.index')}}">
                            <i class="menu-icon mdi mdi-account-multiple-outline"></i>
                            <span class="menu-title">Users</span>

                        </a>
                    </li>
                    @endcan
                    @can('role-list')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('roles.index')}}">
                            <i class="menu-icon mdi mdi-chart-gantt"></i>
                            <span class="menu-title">Roles</span>

                        </a>
                    </li>
                    @endcan
                    @can('permission-list')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('permissions.index')}}">
                            <i class="menu-icon mdi mdi-checkbox-marked-circle-outline"></i>
                            <span class="menu-title">Permission</span>

                        </a>
                    </li>
                    @endcan
                    @can('departments-list')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('departments.index')}}">
                            <i class="menu-icon mdi mdi-animation-outline"></i>
                            <span class="menu-title">Departments</span>

                        </a>
                    </li>
                    @endcan

                    @can('programs-list')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('programs.index')}}">
                            <i class="menu-icon mdi mdi-format-list-bulleted"></i>
                            <span class="menu-title">Manage Programs</span>

                        </a>
                    </li>
                    @endcan
                    @can('expertises-list')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('experts.index')}}">
                            <i class="menu-icon mdi mdi-buffer"></i>
                            <span class="menu-title">Manage Expertise</span>

                        </a>
                    </li>
                    @endcan
                    @can('expertises-list')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('image_management.index')}}">
                            <i class="menu-icon mdi mdi-satellite"></i>
                            <span class="menu-title">Manange Image</span>

                        </a>
                    </li>
                    @endcan
                </ul>
            </nav>

            <!-- Content Wrapper. Contains page content -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    </div>
                </footer>
            </div>

        </div>
    </div>
    <!-- plugins:js -->
    <script src="{{asset('vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{asset('vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('vendors/progressbar.js/progressbar.min.js')}}"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('js/off-canvas.js')}}"></script>
    <script src="{{asset('js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('js/template.js')}}"></script>
    <script src="{{asset('js/settings.js')}}"></script>
    <script src="{{asset('js/todolist.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{asset('js/dashboard.js')}}"></script>
    <script src="{{asset('js/Chart.roundedBarCharts.js')}}"></script>
    <!-- End custom js for this page-->

    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('plugins/ijaboCropTool/ijaboCropTool.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

    @yield('javascript')


</body>

</html>