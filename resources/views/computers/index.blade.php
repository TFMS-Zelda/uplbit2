@extends ('layouts.dashboard')

@section('title', 'information-&-technologies')

@section('content')
@section('titlePosition', 'computers')

<section class="content">
    <div class="container-fluid">
        <h1 class="h3 mb-1 text-gray-800">Equipos de Computo</h1>
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
                                    Equipo de Computo Registrados
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-white">
                                    {{ $totalComputerInStock }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-laptop fa-2x text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                src="{{ asset('/core/undraw/laptop-index.svg') }}">
        </div>

        <div class="card mb-4 py-3 border-left-primary">
            <div class="card-body">
                <nav class="navbar navbar-expand navbar-light bg-light mb-4">
                    <a class="navbar-brand" href="#">Reportes</a>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Seleccione
                            </a>
                            <div class="dropdown-menu dropdown-menu-right animated--grow-in"
                                aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{ route('computers.export.excel') }}">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Total de Equipos de computo del inventario
                                </a>

                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Total de Equipos de computo asignados del inventario
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Total de Equipos de computo sin asignar del inventario
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><i class='fas fa-history'></i> Reporte total de
                                    equipos de computo eliminados
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>

                @can('permission:computers.remove-computers')
                <!-- split remove computers   -->
                <div class="btn-group dropright">
                    <button type="button" class="btn btn-ligth">
                        <h1 class="h6 mb-1 text-gray-800">Computer</h1>
                        <small class="text-muted">
                            <p class="text-right">Record & History</p>
                        </small>
                    </button>
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropright</span>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('computers.remove-&-disabled-computers') }} ">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Equipos de computo retirados del inventario
                        </a>
                    </div>
                </div>
                <!-- end split remove computers -->
                @endcan

                <div class="table-responsive">
                    <table class="table table-light  table-striped table-bordered table-sm  table-hover"
                        id="table-computers" width="100%" cellspacing="0">
                        <thead>
                            <tr class="bg-gradient-primary text-white text-center">
                                <th>ID:</th>
                                <th>Tipo de Máquina:</th>
                                <th>Marca:</th>
                                <th>Módelo:</th>
                                <th>ServiceTag & Placa</th>
                                <th>Estado:</th>
                                <th>Acciones:</th>
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
                                    @endif
                                </td>
                                <td>
                                    @can('permission:computers.show')
                                    <a href="{{ route('computers.show', $computer->id) }}"
                                        class="btn btn-success btn-circle btn-sm">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    @endcan

                                    @can('permission:computers.edit')
                                    @if ($computer->status === 'Activo - Asignado')

                                    @else
                                    <a href="{{ route('computers.edit', $computer->id)}}"
                                        class="btn btn-warning btn-circle btn-sm" disabled>
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </a>
                                    @endif
                                    @endcan

                                    @can('computer.destroy')
                                    <form action="{{ route('computers.destroy', $computer->id) }}" method="POST">
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

                @can('permission:computers.create')
                <a href="{{ route('computers.create') }}" class="btn btn-secondary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-right"></i>
                    </span>
                    <span class="text">Add Computer</span>
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
        $('#table-computers').DataTable({});
        });
        
        document.onsubmit = function () {
        return confirm('Atencion: {{ Auth::user()->name }}, ¿Esta seguro de eliminar el siguiente equipo de computo del sistema?');}
</script>
@endpush