@extends ('layouts.dashboard')

@section('title', 'information-&-technologies')

@section('content')
@section('titlePosition', 'other-peripherals')
<section class="content">
    <div class="container-fluid">
        <h1 class="h3 mb-1 text-gray-800">Otros Perfisfericos</h1>
        <p class="mb-4 text-justify">
            La siguiente información se almacena, organiza, mantiene y difunde de manera digital. Esta información es
            de
            acceso privado para usuarios directamente autentificados en el sistema.
            En este sitio encontrara el listado de las equipos de computo registrados en el sistema.
        </p>

        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2 bg-success">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                    Otros Perfisfericos Registrados
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-white">

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-asterisk fa-2x text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                src="{{ asset('/core/undraw/other-peripherals.svg') }}">
        </div>

        {{-- table other-peripherals --}}
        <div class="card mb-4 py-3 border-left-primary">
            <div class="card-body">

                @can('permission:peripherals.other-peripherals.remove-&-disabled-other-peripherals')
                <!-- split remove peripherals.monitors   -->
                <div class="btn-group dropright">
                    <button type="button" class="btn btn-ligth">
                        <h1 class="h6 mb-1 text-gray-800">Otros Perisfericos</h1>
                        <small class="text-muted">
                            <p class="text-right">Record & History</p>
                        </small>
                    </button>
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropright</span>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item"
                            href="{{ route('peripherals.other-peripherals.remove-&-disabled-other-peripherals') }} ">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            * Otros Perisfericos retirados del inventario
                        </a>
                    </div>
                </div>
                <!-- end split remove peripherals.monitors -->
                @endcan

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
                            @foreach($otherPeripherals as $otherPeripheral)
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
                                            {{ $otherPeripheral->license_plate }} <span
                                                class="badge badge-light">Placa</span>
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    @if ($otherPeripheral->status === 'Activo - Asignado')
                                    <h5><span class="badge badge-success">{{ $otherPeripheral->status }} </span></h5>

                                    @elseif($otherPeripheral->status === 'Inactivo - No Asignado')
                                    <h5><span class="badge badge-danger">{{ $otherPeripheral->status }} </span></h5>

                                    @elseif($otherPeripheral->status === 'Dañado - Reportado')
                                    <h5><span class="badge badge-dark">{{ $otherPeripheral->status }} </span></h5>
                                    @endif
                                </td>
                                <td>

                                    @can('permission:peripherals.other-peripherals.show')
                                    <a href="{{ route('peripherals.other-peripherals.show', $otherPeripheral->id) }}"
                                        class="btn btn-success btn-circle btn-sm">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    @endcan

                                    @can('permission:peripherals.other-peripherals.edit')
                                    @if ($otherPeripheral->status === 'Activo - Asignado')

                                    @else
                                    <a href="{{ route('peripherals.other-peripherals.edit', $otherPeripheral->id)}}"
                                        class="btn btn-warning btn-circle btn-sm" disabled>
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </a>
                                    @endif
                                    @endcan

                                    @can('permission:peripherals.other-peripherals.destroy')
                                    <form
                                        action="{{ route('peripherals.other-peripherals.destroy', $otherPeripheral->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-circle btn-sm">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                    @endcan


                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @can('permission:peripherals.other-peripherals.create')
                <a href="{{ route('peripherals.other-peripherals.create') }}" class="btn btn-secondary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-right"></i>
                    </span>
                    <span class="text">Add Other Peripherals</span>
                </a>
                @endcan
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script src="{{ asset('/core/plugins/DataTables/datatables.min.js') }}"></script>
<script>

    $(document).ready(function () {
        $('#table-other-peripherals').DataTable({
            order: [ [0, 'ASC'] ]
            });
        });

    document.onsubmit = function () {
        return confirm('Atencion: {{ Auth::user()->name }}, ¿Esta seguro de eliminar el siguiente perisferico del sistema?');}
</script>
@endpush
