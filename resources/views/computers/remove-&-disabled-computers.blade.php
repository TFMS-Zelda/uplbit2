@extends ('layouts.dashboard')

@section('title', 'information-&-technologies')

@section('content')
@section('titlePosition', 'computers/ remove-&-disabled-computers')
<section class="content">
    <div class="container-fluid">
        <h1 class="h3 mb-1 text-gray-800">Equipos de Computo Retirados</h1>
        <p class="mb-4 text-justify">
            La siguiente información se almacena, organiza, mantiene y difunde de manera digital. Esta información es
            de
            acceso privado para usuarios directamente autentificados en el sistema.
            En este sitio encontrara el listado de las equipos de computo registrados en el sistema.
        </p>

        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2 bg-warning">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                    Equipo de Computo Retirados del inventario
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-white">
                                    {{ $computersRemove }}
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

        <a class="text-dark" href="{{ route('computers.index') }}"><i class='fas fa-hand-point-left'></i>
            Regresar
            Inventario
            Equipos de computo</a>

        <div class="card mb-4 py-3 border-left-primary">
            <div class="card-body">
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
                            @foreach($computersRemoveInventary as $computerRemoveInventary)
                            <tr class="text-center">
                                <td>
                                    <div class="col-auto text-center">
                                        <i class="fas fa-sort-numeric-down-alt"></i><br>
                                        <i class="fas fa-laptop fa-2x"></i>
                                        <br>
                                        <div class="h5 mb-0 font-weight-bold text-muted">
                                            {{ $computerRemoveInventary->id }} </div>

                                    </div>
                                </td>
                                <td>
                                    <div class="h6 mb-0 font-weight-bold text-muted">
                                        {{ $computerRemoveInventary->type_machine }}
                                    </div>
                                    <small>
                                        {{ $computerRemoveInventary->processor }}
                                        {{ $computerRemoveInventary->memory_ram }} -
                                        {{ $computerRemoveInventary->hard_drive }}
                                    </small>
                                </td>
                                <td>
                                    <div class="h6 mb-0 font-weight-bold text-muted">
                                        {{ $computerRemoveInventary->brand }} </div>
                                </td>
                                <td>
                                    <div class="h6 mb-0 font-weight-bold text-muted">
                                        {{ $computerRemoveInventary->model }} <br>
                                        <small>
                                            {{ $computerRemoveInventary->operating_system }}
                                        </small>
                                    </div>
                                </td>
                                <td>
                                    <div class="h6 mb-0 font-weight-bold text-muted">
                                        {{ $computerRemoveInventary->servicetag }}
                                        <br>
                                        <button type="button" class="btn btn-primary btn-sm">
                                            {{ $computerRemoveInventary->license_plate }} <span
                                                class="badge badge-light">Placa</span>
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    <div class="h6 mb-0 font-weight-bold text-muted">
                                        <h5><span class="badge badge-danger">{{ $computerRemoveInventary->status }}
                                            </span></h5>
                                        Eliminado: {{ $computerRemoveInventary->deleted_at }} -
                                        {{ Carbon\Carbon::parse($computerRemoveInventary->deleted_at)->format('l jS \\of F Y ') }}
                                    </div>
                                </td>
                                <td>
                                    <a href="" class="btn btn-secondary btn-circle btn-sm">
                                        <i class='fas fa-arrow-alt-circle-left'></i>
                                    </a>
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
        $('#table-computers').DataTable();
        });
</script>
@endpush