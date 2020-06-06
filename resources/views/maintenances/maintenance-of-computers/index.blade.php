@extends ('layouts.dashboard')

@section('title', 'information-&-technologies')
@section('content')

@section('titlePosition', 'maintenances.maintenance-of-computers')
<section class="content">
    <div class="container-fluid">
        <h1 class="display-4 text-center">Mantenimiento de equipos de computo</h1>
        <div class="row">

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2 bg-success">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                    Total de Mantenimientos Registrados
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-white">
                                    {{ $totalMaintenances }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-laptop fa-2x text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2 bg-info">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                    Mantenimiento Preventivos Registrados
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-white">
                                    {{ $totalMaintenancesPreventivo }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-laptop fa-2x text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2 bg-warning">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                    Mantenimientos Correctivos Registrados
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-white">
                                    {{ $totalMaintenancesCorrectivo }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-laptop fa-2x text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2 bg-danger">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                    Reportes por Garantia Registrados
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-white">
                                    {{ $totalReportesGarantia }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-bug fa-2x text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="{{ route('maintenances.maintenance-of-computers.history') }} "
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-history fa-sm"></i>
                Historial de Mantenimientos</a>
        </div>

        <p class="text-gray-900">
            Actualmente hay <i class="fa fa-laptop" aria-hidden="true"></i> <strong>{{ $totalComputers }} </strong>
            equipos de computo registrados...
        </p>


        <div class="table-responsive">
            <table class="table table-light  table-striped table-bordered table-sm  table-hover" id="table-computers"
                width="100%" cellspacing="0">
                <thead>
                    <tr class="bg-gradient-primary text-white text-center">
                        <th>ID:</th>
                        <th>Tipo de Máquina:</th>
                        <th>Marca:</th>
                        <th>Módelo:</th>
                        <th>ServiceTag & Placa</th>
                        <th>Estado:</th>
                        <th>Actions:</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($computers as $computer)
                    <tr class="text-center">
                        <td>
                            <div class="col-auto text-center">
                                <i class="fas fa-sort-numeric-down-alt"></i><br>
                                <i class="fas fa-laptop fa-2x"></i>
                                <br>
                                <div class="h5 mb-0 font-weight-bold text-muted">{{ $computer->id }} </div>

                            </div>
                        </td>
                        <td>
                            <div class="h6 mb-0 font-weight-bold text-muted">{{ $computer->type_machine }}
                            </div>
                            <small>
                                {{ $computer->processor }}
                                {{ $computer->memory_ram }} - {{ $computer->hard_drive }}
                            </small>
                        </td>
                        <td>
                            <div class="h6 mb-0 font-weight-bold text-muted">{{ $computer->brand }} </div>
                        </td>
                        <td>
                            <div class="h6 mb-0 font-weight-bold text-muted">{{ $computer->model }} <br>
                                <small>
                                    {{ $computer->operating_system }}
                                </small>
                            </div>
                        </td>
                        <td>
                            <div class="h6 mb-0 font-weight-bold text-muted">
                                <h5><span class="badge badge-primary">{{ $computer->license_plate }} </span>
                                </h5>
                                <i class="fas fa-barcode"></i>
                                {{ $computer->servicetag }}

                            </div>
                        </td>
                        <td>
                            @if ($computer->status === 'Activo - Asignado')
                            <h5><span class="badge badge-success">{{ $computer->status }} </span></h5>

                            @elseif($computer->status === 'Inactivo - No Asignado')
                            <h5><span class="badge badge-danger">{{ $computer->status }} </span></h5>

                            @elseif($computer->status === 'Dañado - Reportado')
                            <h5><span class="badge badge-dark">{{ $computer->status }} </span></h5>

                            @elseif($computer->status === 'Retirado - Baja de Activo')
                            <h5><span class="badge badge-warning">{{ $computer->status }} </span></h5>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">

                                @can('permission:maintenances.maintenance-of-computers.create')
                                <a href="{{ route('maintenances.maintenance-of-computers.create', $computer->id) }}"
                                    title="Reportar Mantenimiento"
                                    class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                                    <i class="fas fa-bug fa-sm text-white"></i>
                                </a>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
</section>
@endsection
@push('scripts')
<script src="{{ asset('/core/plugins/DataTables/datatables.min.js') }}"></script>

<script>
    $(document).ready(function () {
          $('#table-computers').DataTable({});
      });
</script>
@endpush