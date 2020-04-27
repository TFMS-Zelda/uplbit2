@extends ('layouts.dashboard')

@section('title', 'information-&-technologies')

@section('content')
@section('titlePosition', 'maintenances')
<section class="content">
    <div class="container-fluid">
        <h1 class="display-4 text-center">Bitacora de Mantenimientos</h1>

        <div class="row">

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">
                                    Total de Mantenimientos Registrados
                                </div>
                                <div class="h4 mb-0 font-weight-bold">
                                    {{ $totalMaintenanceComputer + $totalMaintenancePrinter }} 
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-wrench fa-spin fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">
                                    Mantenimiento Preventivos Registrados
                                </div>
                                <div class="h5 mb-0 font-weight-bold">

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-cog fa-2x fa-spin"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">
                                    Mantenimientos Correctivos Registrados
                                </div>
                                <div class="h5 mb-0 font-weight-bold">

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-cog fa-2x fa-spin"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">
                                    Reportes por Garantia Registrados
                                </div>
                                <div class="h5 mb-0 font-weight-bold">

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-sync fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- split  maintenances.computers  -->
        <div class="btn-group dropright">
            <button type="button" class="btn btn-ligth">
                <h1 class="h6 mb-1 text-gray-800">Mantenimiento</h1>
                <small class="text-muted">
                    <p class="text-right">Equipos de Computo
                        <i class="fas fa-laptop"></i>
                    </p>
                </small>
            </button>
            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="sr-only">Toggle Dropright</span>
            </button>
            <div class="dropdown-menu">

                @can('permission:maintenances.maintenance-of-computers.index')
                <a class="dropdown-item" href="{{ route('maintenances.maintenance-of-computers.index') }} ">
                    <i class="fas fa-laptop  fa-sm fa-fw mr-2 text-gray-600"></i>
                    Reporte & Mantenimientos
                </a>
                @endcan

                <div class="dropdown-divider"></div>
                @can('permission:maintenances.maintenance-of-computers.history')
                <a class="dropdown-item" href="{{ route('maintenances.maintenance-of-computers.history') }} ">
                    <i class="fas fa-history  fa-sm fa-fw mr-2 text-gray-600"></i>
                    Historial de Mantenimientos
                </a>
                @endcan

                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('information-&-technologies.dashboard') }}" >
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Regresar a information & technologies 
                </a>
            </div>
        </div>
        <!-- end split maintenances.computers -->

        
        <!-- split  maintenances.printers  -->
        <div class="btn-group dropright">
            <button type="button" class="btn btn-ligth">
                <h1 class="h6 mb-1 text-gray-800">Mantenimiento</h1>
                <small class="text-muted">
                    <p class="text-right">Impresoras
                        <i class="fas fa-print"></i>
                    </p>
                </small>
            </button>
            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="sr-only">Toggle Dropright</span>
            </button>
            <div class="dropdown-menu">

                @can('permission:maintenances.maintenance-of-printers.index')
                <a class="dropdown-item" href="{{ route('maintenances.maintenance-of-printers.index') }} ">
                    <i class="fas fa-print  fa-sm fa-fw mr-2 text-gray-600"></i>
                    Reporte & Mantenimientos
                </a>
                @endcan

                <div class="dropdown-divider"></div>
                @can('permission:maintenances.maintenance-of-computers.history')
                <a class="dropdown-item" href="{{ route('maintenances.maintenance-of-computers.history') }} ">
                    <i class="fas fa-history  fa-sm fa-fw mr-2 text-gray-600"></i>
                    Historial de Mantenimientos
                </a>
                @endcan

                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('information-&-technologies.dashboard') }}" >
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Regresar a information & technologies 
                </a>
            </div>
        </div>
        <!-- end split maintenances.printers -->

    </div>
</section>
@endsection