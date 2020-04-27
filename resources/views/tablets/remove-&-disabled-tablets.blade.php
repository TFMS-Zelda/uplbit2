@extends ('layouts.dashboard')

@section('title', 'information-&-technologies')

@section('content')
@section('titlePosition', 'tablets/ remove-&-disabled-tablets')
<section class="content">
    <div class="container-fluid">
        <h1 class="h3 mb-1 text-gray-800">Tablets cooporativas Retiradas</h1>
        <p class="mb-4 text-justify">
            La siguiente información se almacena, organiza, mantiene y difunde de manera digital. Esta información es
            de
            acceso privado para usuarios directamente autentificados en el sistema.
            En este sitio encontrara el listado de las tablets cooporativas retiradas del inventario en el sistema.
        </p>

        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2 bg-warning">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                    Tablets cooporativas retiradas
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-white">
                                    {{ $tabletsRetiradas }}
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
                src="{{ asset('/core/undraw/laptop-index.svg') }}">
        </div>

        <div class="card mb-4 py-3 border-left-primary">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-light  table-striped table-bordered table-sm  table-hover"
                        id="table-computers" width="100%" cellspacing="0">
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
                            @foreach($tabletsRemoveInventary as $tablet)
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
                                    <div class="h6 mb-0 font-weight-bold text-muted">
                                        <i class="fa fa-phone" aria-hidden="true"></i> {{ $tablet->phone_number }}
                                    </div>

                                    @elseif($tablet->status === 'Inactivo - No Asignado')
                                    <h5><span class="badge badge-primary">{{ $tablet->status }} </span></h5>
                                    <div class="h6 mb-0 font-weight-bold text-muted">
                                        <i class="fa fa-phone" aria-hidden="true"></i> {{ $tablet->phone_number }}
                                    </div>

                                    @elseif($tablet->status === 'Reportado por Hurto')
                                    <h5><span class="badge badge-dark">{{ $tablet->status }} </span></h5>
                                    <div class="h6 mb-0 font-weight-bold text-muted">
                                        <i class="fa fa-phone" aria-hidden="true"></i> {{ $tablet->phone_number }}
                                    </div>

                                    @elseif($tablet->status === 'Retirado - Baja de Activo')
                                    <h5><span class="badge badge-warning">{{ $tablet->status }} </span></h5>
                                    <div class="h6 mb-0 font-weight-bold text-muted">
                                        <i class="fa fa-phone" aria-hidden="true"></i> {{ $tablet->phone_number }}
                                    </div>
                                    @endif
                                </td>
                                <td>
                                    <a href="" class="btn btn-primary">Re-Asignar Inventarios</a>
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