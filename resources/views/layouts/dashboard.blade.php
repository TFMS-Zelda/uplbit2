<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta content="IE=Edge;chrome=35+" https-equiv="X-UA-Compatible" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="author" content="Victor Tuiran" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="Content-Language" content="es" />
    <meta name="copyright" content="Uniphos Plant Limited - Colombia" />
    <title>UPL Bit - @yield('title')</title>
    <!-- Custom styles for this template-->
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />

    @stack('sass')
</head>

<body>
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-cog fa-spin"></i>
                </div>
                <div class="sidebar-brand-text mx-3">
                    UplBit <sup>2</sup>
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0" />

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link"
                    href="{{ route('information-&-technologies.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider" />

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Components</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Core</h6>
                        <a class="collapse-item" href="{{ route('companies.index') }}">Compañias</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Configuration Item</span>
                </a>
                <div id="collapseUtilities" class="collapse show" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Ci:</h6>

                        <a class="collapse-item" href="{{ route('computers.index') }}">
                            <i class="fas fa-laptop"></i>
                            Equipos de computo
                        </a>

                        <a class="collapse-item" href="{{ route('tablets.index') }}">
                            <i class="fas fa-tablet"></i>
                            Tablets
                        </a>

                        <a class="collapse-item" href="{{ route('peripherals.printers.index') }}">
                            <i class="fas fa-print"></i>
                            Impresoras
                        </a>

                        <a class="collapse-item" href="{{ route('peripherals.monitors.index') }}">
                            <i class="fas fa-tv"></i>
                            Monitores
                        </a>
                        <hr />

                        <a class="collapse-item" href="{{
                                    route('peripherals.other-peripherals.index')
                                }}">
                            <i class="fas fa-asterisk"></i>
                            Otros Perisfericos
                        </a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider" />

            <!-- Heading -->
            <div class="sidebar-heading">
                Complementos
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Documents</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Complementos:</h6>

                        @can('permission:checklists.index')
                        <a class="collapse-item" href="{{ route('documents.checklists.index') }}">Check List</a>
                        @endcan

                        <a class="collapse-item" href="{{
                                    route('documents.peace-&-saves.index')
                                }}">Paz y Salvo</a>
                    </div>
                </div>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="{{ route('managers.index') }}">
                    <i class="fas fa-users"></i>
                    <span>Access Management</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="{{
                            route('relationship-&-configurations.index')
                        }}">
                    <i class="fas fa-location-arrow"></i>
                    <span>Relationship Configuration</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block" />

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2" />
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item  -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-2x fa-laptop-house"></i>
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Almacen y tecnología
                                </h6>

                                @can('can:permission:providers.index')
                                <a class="dropdown-item d-flex align-items-center"
                                    href="{{ route('providers.index') }}">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">
                                            Service Design
                                        </div>
                                        <span><i class="fas fa-shopping-cart"></i>
                                            Gestión de Provedores!</span>
                                    </div>
                                </a>
                                @endcan

                                <a class="dropdown-item d-flex align-items-center" href="{{ route('articles.index') }}">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">
                                            Shop!
                                        </div>
                                        <span><i class="fa fa-link" aria-hidden="true"></i>
                                            Articles Relation
                                        </span>
                                    </div>
                                </a>

                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">
                                            Vacio
                                        </div>
                                        <span class="font-weight-bold">Vacio!</span>
                                    </div>
                                </a>

                                <a class="dropdown-item text-center small text-gray-500" href="{{ route('home') }} ">
                                    Home
                                </a>
                            </div>
                        </li>

                        <!-- Nav Item Mantenimientos -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-2x fa-wrench fa-spin"></i>
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Gestión de la Disponibilidad
                                </h6>

                                @can('can:permission:maintenances.index')
                                <a class="dropdown-item d-flex align-items-center"
                                    href="{{ route('maintenances.index') }}">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-dark">
                                            <i class="fas fa-book text-white"></i>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="small text-gray-500">
                                            Maintenance Element
                                            Configuration
                                        </div>
                                        <i class="fa fa-file-contract" aria-hidden="true"></i>
                                        <span>Bitacora de
                                            Mantenimientos!</span>
                                    </div>
                                </a>
                                @endcan

                                <a class="dropdown-item text-center small text-gray-500"
                                    href="{{ route('home') }} ">Home</a>
                            </div>
                        </li>
                        <!-- close Nav SKMS  -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-2x fa-database"></i>
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Gestión del conocimiento
                                </h6>

                                @can('can:permission:skms.index')
                                <a class="dropdown-item d-flex align-items-center"
                                    href="{{ route('skms.index') }}">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-dark">
                                            <i class="fas fa-book text-white"></i>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="small text-gray-500">
                                           SKMS
                                        </div>
                                        <i class="fa fa-file-contract" aria-hidden="true"></i>
                                        <span>Repositorio Principal de Información!</span>
                                    </div>
                                </a>
                                @endcan

                                <a class="dropdown-item text-center small text-gray-500"
                                    href="{{ route('home') }} ">Home</a>
                            </div>
                        </li>

                        <!-- close Nav Item Mantenimientos -->

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name
                                    }}</span>
                                <img class="img-profile rounded-circle" src="{{ Auth::user()->avatar }} " />
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="card mb-4 py-3 border-bottom-primary">
                        <div class="row">
                            <div class="col">
                                <span class="float-left"><video id="video" autoplay playsinline autobuffer muted loop>
                                        <source src="https://www.upl-ltd.com/images/UPL_header-logo.mp4"
                                            type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"' />
                                    </video></span>
                            </div>
                        </div>
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">
                                Information-&-technologies/
                                @yield('titlePosition')
                            </h1>
                        </div>
                    </div>
                    <main id="app">
                        @yield('content')
                    </main>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Upl Colombia;
                            information-&-technologies</span>
                        <div class="text-center">
                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 10rem;"
                                src="{{ asset('/core/undraw/2020.svg') }}" />
                        </div>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Ready to Leave?
                    </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Select "Logout" below if you are ready to end your
                    current session.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">
                        Cancel
                    </button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Custom scripts for all pages-->
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @include('sweetalert::alert') @stack('scripts')
</body>

</html>
