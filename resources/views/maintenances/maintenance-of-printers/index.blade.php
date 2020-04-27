@extends ('layouts.dashboard')

@section('title', 'information-&-technologies')
@section('content')

@section('titlePosition', 'maintenances.maintenance-of-printers')
<section class="content">
    <div class="container-fluid">
        <h1 class="display-4 text-center">
            <i class="fas fa-wrench fa-spin"></i> Mantenimiento de impresoras</h1>
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
                                    {{ $totalMaintenancePrinters }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-print fa-2x text-white"></i>
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
                                <i class="fas fa-print fa-2x text-white"></i>
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
                                <i class="fas fa-print fa-2x text-white"></i>
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
            <a href="{{ route('maintenances.maintenance-of-printers.history') }} "
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-history fa-sm"></i>
                Historial de Mantenimientos</a>
        </div>

        <p class="text-gray-900">
            Actualmente hay <i class="fa fa-print" aria-hidden="true"></i> <strong>{{ $totalPrinters }} </strong>
            impresoras registradas...
        </p>

        <div class="table-responsive">
            <table class="table table-light  table-striped table-bordered table-sm  table-hover" id="table-printers"
                width="100%" cellspacing="0">
                <thead>
                    <tr class="bg-gradient-primary text-white text-center">
                        <th>ID:</th>
                        <th>Marca & Módelo:</th>
                        <th>Location:</th>
                        <th>Caracteristicas:</th>
                        <th>Serial & Placa</th>
                        <th>Estado:</th>
                        <th>Actions:</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($printers as $printer)
                    <tr class="text-center">
                        <td>
                            <div class="col-auto text-center">
                                <i class="fas fa-sort-numeric-down-alt"></i><br>
                                <i class="fas fa-print fa-2x"></i>
                                <br>
                                <div class="h5 mb-0 font-weight-bold text-muted">{{ $printer->id }} </div>
                            </div>
                        </td>
                        <td>
                            <div class="h6 mb-0 font-weight-bold text-muted">{{ $printer->brand }} -
                                {{ $printer->model }}
                            </div>
                            <small>
                                {{ $printer->printer_functions }}
                            </small>
                        </td>
                        <td>
                            <div class="h6 mb-0 font-weight-bold text-muted">
                                <i class="fas fa-map-marker-alt"></i>
                                <br>
                                {{ $printer->location }}
                                
                            </div>
                        </td>
                        <td>
                            <div class="h6 mb-0 font-weight-bold text-muted">{{ $printer->paper_sources }} <br>
                                <small>
                                    {{ $printer->input_capacity }}
                                </small>
                            </div>
                        </td>
                        <td>
                            <div class="h6 mb-0 font-weight-bold text-muted">
                                <h5><span class="badge badge-primary">{{ $printer->license_plate }} </span>
                                </h5>
                                <i class="fas fa-barcode"></i>
                                {{ $printer->serial }}
                            </div>
                        </td>
                        <td>
                            @if ($printer->status === 'Activo - Asignado')
                            <h5><span class="badge badge-success">{{ $printer->status }} </span></h5>

                            @elseif($printer->status === 'Inactivo - No Asignado')
                            <h5><span class="badge badge-primary">{{ $printer->status }} </span></h5>

                            @elseif($printer->status === 'Reportado por Hurto')
                            <h5><span class="badge badge-dark">{{ $printer->status }} </span></h5>

                            @elseif($printer->status === 'Retirado - Baja de Activo')
                            <h5><span class="badge badge-warning">{{ $printer->status }} </span></h5>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                @can('permission:maintenances.maintenance-of-printers.create')
                                <a href="{{ route('maintenances.maintenance-of-printers.create', $printer) }}"
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
          $('#table-printers').DataTable({});
      });
</script>
@endpush