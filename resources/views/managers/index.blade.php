@extends ('layouts.dashboard')

@section('title', 'information-&-technologies')

@section('content')
@section('titlePosition', 'managers')
<section class="content">
    <div class="container-fluid">
        <h1 class="h3 mb-1 text-gray-800"> Access Management </h1>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Acuerdo de Nivel
                                    de Servicio (SLA) </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Acuerdo de Nivel
                                    Operacional (OLA)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Contrato de Apoyo
                                    (UC)</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%"
                                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Otros
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                src="{{ asset('/core/undraw/managers.svg') }}">
        </div>

        <!-- split administración users   -->
        <div class="btn-group dropright">
            <button type="button" class="btn btn-ligth">
                <h1 class="h6 mb-1 text-gray-800">Administración</h1>
                <small class="text-muted">
                    <p class="text-right">Users Management System</p>
                </small>
            </button>
            <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="sr-only">Toggle Dropright</span>
            </button>
            <div class="dropdown-menu">

                @can('permission:managers.users.index')
                <a class="dropdown-item" href="{{ route('managers.users.index') }} ">
                    <i class="fas fa-users fa-sm fa-fw mr-2 text-gray-600"></i>
                    Usuarios del sistema
                </a>
                @endcan

                @can('permission:managers.users.index')
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    System Role
                </a>
                @endcan
            </div>
        </div>
        <!-- end split administración users -->

        <!-- split administración employes   -->
        <div class="btn-group dropright">
            <button type="button" class="btn btn-ligth">
                <h1 class="h6 mb-1 text-gray-800">Administración</h1>
                <small class="text-muted">
                    <p class="text-right">Employees</p>
                </small>
            </button>
            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="sr-only">Toggle Dropright</span>
            </button>
            <div class="dropdown-menu">

                @can('permission:managers.employees.index')
                <a class="dropdown-item" href="{{ route('managers.employees.index') }} ">
                    <i class="fas fa-id-card  fa-sm fa-fw mr-2 text-gray-600"></i>
                    Empleados del sistema
                </a>
                @endcan

                @can('permission:managers.users.index')
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    System Role
                </a>
                @endcan
            </div>
        </div>
        <!-- end split administración employes -->

        @can('permission:managers.roles.index')
        <!-- split administración roles   -->
        <div class="btn-group dropright">
            <button type="button" class="btn btn-ligth">
                <h1 class="h6 mb-1 text-gray-800">Administración</h1>
                <small class="text-muted">
                    <p class="text-right">System Roles</p>
                </small>
            </button>
            <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="sr-only">Toggle Dropright</span>
            </button>
            <div class="dropdown-menu">

                @can('permission:managers.roles.index')
                <a class="dropdown-item" href="{{ route('managers.roles.index') }} ">
                    <i class="fas fa-dice-d20  fa-sm fa-fw mr-2 text-gray-600"></i>
                    Roles del sistema
                </a>
                @endcan

            </div>
        </div>
        <!-- end split administración employes -->
        @endcan


</section>

@endsection