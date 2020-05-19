@extends ('layouts.dashboard')

@section('title', 'information-&-technologies')

@section('content')
@section('titlePosition', 'tablets')
<section class="content">
    <div class="container-fluid">
        <h1 class="h3 mb-1 text-gray-800">Tablets Corporativas</h1>
        <p class="mb-4 text-justify">
            La siguiente información se almacena, organiza, mantiene y difunde de manera digital. Esta información es
            de
            acceso privado para usuarios directamente autentificados en el sistema.
            En este sitio encontrara el listado de las tablets corporativas registradas en el sistema.
        </p>

        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2 bg-success">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                    Tablets Registradas
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-white">
                                    {{ $tabletsAsignados }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-tablet fa-2x text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                src="{{ asset('/core/undraw/tablet.svg') }}">
        </div>

        <div class="card mb-4 py-3 border-left-primary">
            <div class="card-body">

                @can('permission:tablets.remove-tablets')
                <!-- split remove computers   -->
                <div class="btn-group dropright">
                    <button type="button" class="btn btn-ligth">
                        <h1 class="h6 mb-1 text-gray-800">Tablet</h1>
                        <small class="text-muted">
                            <p class="text-right">Record & History</p>
                        </small>
                    </button>
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropright</span>
                    </button>
                    <div class="dropdown-menu">

                        @can('permission:tablets.remove-&-disabled-tablets')
                        <a class="dropdown-item" href="{{ route('tablets.remove-&-disabled-tablets') }} ">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Tablets corporativas retiradas del inventario
                        </a>
                        @endcan

                    </div>
                </div>
                <!-- end split remove tablets -->
                @endcan

                <div class="table-responsive">
                    <table class="table table-light  table-striped table-bordered table-sm  table-hover"
                        id="table-tablets" width="100%" cellspacing="0">
                        <thead>
                            <tr class="bg-gradient-primary text-white text-center">
                                <th>ID:</th>
                                <th>Marca & Módelo:</th>
                                <th>Procesador & Memoria:</th>
                                <th>Características:</th>
                                <th>Imei & Pin</th>
                                <th>Estado:</th>
                                <th>Acciones:</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tablets as $tablet)
                            <tr class="text-center">
                                <td>
                                    <div class="col-auto text-center">
                                        <i class="fas fa-sort-numeric-down-alt"></i><br>
                                        <i class="fas fa-tablet fa-2x"></i>
                                        <br>
                                        <div class="h5 mb-0 font-weight-bold text-muted">{{ $tablet->id }} </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="h6 mb-0 font-weight-bold text-muted">{{ $tablet->brand }}
                                    </div>
                                    <small>
                                        {{ $tablet->model }} - {{ $tablet->color }}, <strong>Serial</strong>:
                                        {{ $tablet->serial }}
                                    </small>
                                </td>
                                <td>
                                    <div class="h6 mb-0 font-weight-bold text-muted">
                                        {{ $tablet->processor }} - {{ $tablet->memory }}
                                    </div>
                                </td>
                                <td>
                                    <div class="h6 mb-0 font-weight-bold text-muted">{{ $tablet->camera }} <br>
                                        <small>
                                            {{ $tablet->screen }}
                                        </small>
                                    </div>
                                </td>
                                <td>
                                    <div class="h6 mb-0 font-weight-bold text-muted">
                                        <h5><span class="badge badge-secondary">{{ $tablet->imei }} </span>
                                        </h5>
                                        <i class="fas fa-barcode"></i>
                                        Pin: {{ $tablet->pin }}

                                    </div>
                                </td>
                                <td>
                                    @if ($tablet->status === 'Activo - Asignado')
                                    <h5><span class="badge badge-success">{{ $tablet->status }} </span></h5>

                                    @elseif($tablet->status === 'Inactivo - No Asignado')
                                    <h5><span class="badge badge-danger">{{ $tablet->status }} </span></h5>

                                    @elseif($tablet->status === 'Dañado - Reportado')
                                    <h5><span class="badge badge-dark">{{ $tablet->status }} </span></h5>
                                    @endif
                                </td>
                                <td>
                                    @can('permission:tablets.show')
                                    <a href="{{ route('tablets.show', $tablet->id) }}"
                                        class="btn btn-success btn-circle btn-sm">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    @endcan

                                    @can('permission:tablets.edit')
                                    @if ($tablet->status === 'Activo - Asignado')

                                    @else
                                    <a href="{{ route('tablets.edit', $tablet->id)}}"
                                        class="btn btn-warning btn-circle btn-sm" disabled>
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </a>
                                    @endif
                                    @endcan

                                    @can('tablets.destroy')
                                    <form action="{{ route('tablets.destroy', $tablet->id) }}" method="POST">
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

                @can('permission:tablets.create')
                <a href="{{ route('tablets.create') }}" class="btn btn-secondary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-right"></i>
                    </span>
                    <span class="text">Add Tablet</span>
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
        $('#table-tablets').DataTable({});
    });
    
    document.onsubmit = function () {
        return confirm('Atencion: {{ Auth::user()->name }}, ¿Esta seguro de eliminar el siguiente equipo de computo del sistema?');}
</script>
@endpush