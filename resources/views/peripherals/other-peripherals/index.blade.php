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
                <div class="table-responsive">
                    <table class="table table-sm table-striped table-light table-hover table-fixed"
                        id="table-other-peripherals">
                        <thead>
                            <tr class="bg-gradient-primary text-white text-center">
                                <th>ID:</th>
                                <th>Tipo de Perisferico:</th>
                                <th>Perisferico</th>
                                <th>Marca:</th>
                                <th>Módelo</th>
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
                                        {{ $otherPeripheral->type_machine }}
                                    </div>
                                </td>

                                <td>
                                    <div class="h6 mb-0 font-weight-bold text-muted">{{ $otherPeripheral->brand }}
                                    </div>
                                    <small>
                                        {{ $otherPeripheral->processor }} <br>
                                        {{ $otherPeripheral->memory_ram }} - {{ $otherPeripheral->hard_drive }}
                                    </small>
                                </td>
                                <td>
                                    <div class="h6 mb-0 font-weight-bold text-muted">{{ $otherPeripheral->model }} <br>
                                        <small>
                                            {{ $otherPeripheral->operating_system }}
                                        </small>
                                    </div>
                                </td>
                                <td>
                                    <div class="h6 mb-0 font-weight-bold text-muted">{{ $otherPeripheral->servicetag }}
                                        <br>
                                        <button type="button" class="btn btn-primary btn-sm">
                                            {{ $otherPeripheral->license_plate }} <span
                                                class="badge badge-light">Placa</span>
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
        $("#table-other-peripherals").DataTable({
            dom: "lBtipr",
            buttons: {
                dom: {
                    button: {
                        tag: "button",
                        className: "btn btn-primary"
                    }
                }
            }
        });
    });
    
    document.onsubmit = function () {
        return confirm('Atencion: {{ Auth::user()->name }}, ¿Esta seguro de eliminar el siguiente perisferico del sistema?');}
</script>
@endpush