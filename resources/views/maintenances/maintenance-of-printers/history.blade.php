@extends ('layouts.dashboard')

@section('title', 'information-&-technologies')
@section('content')

@section('titlePosition', 'maintenances.maintenance-of-printers.history')
<section class="content">
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Historial de Mantenimiento de impresoras</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2 bg-success">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                    Impresoras Registradas
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-white">
                                    {{ $totalMaintenances }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-print fa-2x text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4 py-3 border-left-primary">
            <div class="card-body">
                <nav class="navbar navbar-expand navbar-light bg-light mb-4">
                    <a class="navbar-brand" href="#">Navbar</a>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Menu
                            </a>
                            <div class="dropdown-menu dropdown-menu-right animated--grow-in"
                                aria-labelledby="navbarDropdown">

                                @can('permission:maintenances.maintenance-of-printers.history')
                                <a class="dropdown-item"
                                    href="{{ route('maintenances.maintenance-of-printers.index') }}"><i
                                        class="fas fa-bug" aria-hidden="true"></i>
                                    Reportar Mantenimiento de impresora</a>
                                @endcan

                                @can('permission:maintenances.index')
                                <a class="dropdown-item" href="{{ route('maintenances.index') }}">
                                    <i class="fas fa-home"></i>
                                    Regresar a la Bitacora
                                    de mantenimiento</a>
                                @endcan

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('information-&-technologies.dashboard') }}">
                                    Regresar Dashboard information & technologies
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>

                <div class="table-responsive">
                    <table class="table table-light  table-striped table-bordered table-sm  table-hover"
                        id="table-printers" width="100%" cellspacing="0">
                        <thead>
                            <tr class="bg-gradient-primary text-white text-center">
                                <th>ID:</th>
                                <th>Impresora:</th>
                                <th>Tipo de Mantenimiento & Placa</th>
                                <th>Responsible:</th>
                                <th>Register Log!</th>
                                <th>Acciones:</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($historyMaintenances as $historyMaintenance)
                            <tr class="text-center">
                                <td>
                                    <div class="col-auto text-center">
                                        <i class="fas fa-sort-numeric-down-alt"></i><br>
                                        <i class="fas fa-wrench fa-spin"></i>
                                        <br>
                                        <div class="h5 mb-0 font-weight-bold text-muted">
                                            {{ $historyMaintenance->id }}
                                        </div>

                                    </div>
                                </td>
                                <td>
                                    <div class="h6 mb-0 font-weight-bold text-muted">
                                        {{ $historyMaintenance->printer->id }} <i class="fas fa-angle-right"></i>
                                        <i class="fas fa-print"></i> {{ $historyMaintenance->printer->brand }},
                                    </div>
                                    <small>
                                        {{ $historyMaintenance->printer->model }}
                                        {{ $historyMaintenance->printer->proccesor }} -
                                        {{ $historyMaintenance->printer->memory_ram }}
                                        <br>
                                        {{ $historyMaintenance->printer->servicetag }}
                                    </small>
                                </td>
                                <td>
                                    <div class="h6 mb-0 font-weight-bold text-muted">
                                        <i class="fas fa-wrench"></i>
                                        {{ $historyMaintenance->maintenance_type }}
                                        <br>
                                        {{ $historyMaintenance->printer->license_plate }}

                                        <i class="fa fa-barcode" aria-hidden="true"></i>
                                        @if ($historyMaintenance->printer->status === 'Activo - Asignado')
                                        <h5><span class="badge badge-success">{{ $historyMaintenance->printer->status }}
                                            </span>
                                        </h5>

                                        @elseif($historyMaintenance->printer->status === 'Inactivo - No Asignado')
                                        <h5><span class="badge badge-primary">{{ $historyMaintenance->printer->status }}
                                            </span>
                                        </h5>

                                        @elseif($historyMaintenance->printer->status === 'Reportado por Hurto')
                                        <h5><span class="badge badge-dark">{{ $historyMaintenance->printer->status }}
                                            </span>
                                        </h5>

                                        @elseif($historyMaintenance->printer->status === 'Retirado - Baja de Activo')
                                        <h5><span class="badge badge-warning">{{ $historyMaintenance->printer->status }}
                                            </span>
                                        </h5>
                                        @endif

                                    </div>
                                </td>
                                <td>
                                    <div class="h6 mb-0 font-weight-bold text-muted">
                                        <i class="fa fa-landmark" aria-hidden="true"></i>
                                        <br>
                                        <small>
                                            {{ $historyMaintenance->responsible_maintenance }}
                                        </small>
                                    </div>
                                </td>
                                <td>
                                    <div class="h6 mb-0 font-weight-bold text-muted">
                                        <i class="fa fa-fingerprint"></i> <br>
                                        <small>{{ $historyMaintenance->user->name }}</small> <br>
                                        {{ $historyMaintenance->created_at }}
                                        <small><br>{{ $historyMaintenance->created_at->diffForHumans() }}</small>
                                    </div>
                                </td>

                                <td>
                                    @can('permission:maintenances.maintenance-of-printers.show')
                                    <a href="{{ route('maintenances.maintenance-of-printers.show', $historyMaintenance) }} "
                                        class="btn btn-success btn-circle btn-sm">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    @endcan

                                    @can('permission:maintenances.maintenance-of-printers.edit')
                                    <a href="{{ route('maintenances.maintenance-of-printers.edit', $historyMaintenance->id) }}"
                                        class="btn btn-warning btn-circle btn-sm">
                                        <i class="fa fa-highlighter" aria-hidden="true"></i>
                                    </a>
                                    @endcan

                                    @can('permission:reports.maintenance-of-printers.download')
                                    <a href="{{ route('reports.maintenance-of-printers.download', $historyMaintenance ) }}"
                                        class="btn btn-dark btn-circle btn-sm">
                                        <i class="fa fa-file-pdf" aria-hidden="true"></i>
                                    </a>
                                    @endcan

                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script src="{{ asset('/core/plugins/DataTables/datatables.min.js') }}"></script>

<script>
    $(document).ready(function () {
      $('#table-printers').DataTable({});
  });
</script>
@endpush