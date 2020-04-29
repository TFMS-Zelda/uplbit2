@extends ('layouts.dashboard')

@section('title', 'information-&-technologies')
@section('content')

@section('titlePosition', 'maintenances.maintenance-of-computers')
<section class="content">
    <div class="container-fluid">
        <h1 class="display-4 text-center">Mantenimiento de perisféricos</h1>
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
                                    {{ $totalMaintenance }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-asterisk fa-2x text-white"></i>
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
                                <i class="fas fa-asterisk fa-2x text-white"></i>
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
                                <i class="fas fa-asterisk fa-2x text-white"></i>
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
            <a href="{{ route('maintenances.maintenance-of-other-peripherals.history') }} "
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-history fa-sm"></i>
                Historial de Mantenimientos</a>
        </div>

        <p class="text-gray-900">
            Actualmente hay <i class="fa fa-asterisk" aria-hidden="true"></i>
            <strong>{{ $totalOtherPeripherals }}</strong>
            perisfericos registrados...
        </p>

        <div class="table-responsive">
            <table class="table table-sm table-striped table-light table-hover table-fixed"
                id="table-other-peripherals">
                <thead>
                    <tr class="bg-gradient-primary text-white text-center">
                        <th>ID:</th>
                        <th>Tipo de Perisferico:</th>
                        <th>Marca</th>
                        <th>Módelo:</th>
                        <th>Placa corporativa</th>
                        <th>Estado:</th>
                        <th>Acciones:</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($OtherPeripherals as $otherPeripheral)
                    <tr class="text-center">
                        <td>
                            <div class="col-auto text-center">
                                <i class="fas fa-asterisk fa-2x"></i>
                                <br>
                                <div class="h5 mb-0 font-weight-bold text-muted">{{ $otherPeripheral->id }}
                                </div>

                            </div>
                        </td>
                        <td>
                            <div class="h6 mb-0 font-weight-bold text-muted">
                                {{ $otherPeripheral->type_device }} -
                                {{ $otherPeripheral->type_other_peripherals }}
                            </div>
                        </td>

                        <td>
                            <div class="h6 mb-0 font-weight-bold text-muted">{{ $otherPeripheral->brand }}
                            </div>
                            <small>
                                Serial: {{ $otherPeripheral->serial }}
                            </small>
                        </td>
                        <td>
                            <div class="h6 mb-0 font-weight-bold text-muted">{{ $otherPeripheral->model }}
                            </div>
                        </td>
                        <td>
                            <div class="h6 mb-0 font-weight-bold text-muted">
                                <button type="button" class="btn btn-primary btn-sm">
                                    {{ $otherPeripheral->license_plate }} <span class="badge badge-light">Placa</span>
                                </button>
                            </div>
                        </td>
                        <td>

                            @if ($otherPeripheral->status === 'Activo - Asignado')
                            <i class='fas fa-award'></i> {{ $otherPeripheral->status }}

                            @elseif($otherPeripheral->status === 'Inactivo - No Asignado')
                            <h5><span class="badge badge-danger">{{ $otherPeripheral->status }} </span></h5>

                            @elseif($otherPeripheral->status === 'Reportado por Hurto')
                            <i class='fas fa-ban' style='color: #e7330d'></i>
                            <div class="alert alert-dark" role="alert">
                                A simple dark alert—check it out!
                            </div>

                            @elseif($otherPeripheral->status === 'Retirado - Baja de Activo')
                            <h5><span class="badge badge-black">{{ $otherPeripheral->status }} </span></h5>
                            @endif

                        </td>
                        <td>
                            <div class="btn-group">
                                @can('permission:maintenances.maintenance-of-other-peripherals.create')
                                <a href="{{ route('maintenances.maintenance-of-other-peripherals.create', $otherPeripheral->id) }}"
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
          $('#table-other-peripherals').DataTable({});
      });
</script>
@endpush