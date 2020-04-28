@extends ('layouts.dashboard')

@section('title', 'information-&-technologies')

@section('content')
@section('titlePosition', 'computers/ remove-&-disabled-printers')
<section class="content">
    <div class="container-fluid">
        <h1 class="h3 mb-1 text-gray-800">Impresoras retiradas del sistema</h1>
        <p class="mb-4 text-justify">
            La siguiente información se almacena, organiza, mantiene y difunde de manera digital. Esta información es
            de
            acceso privado para usuarios directamente autentificados en el sistema.
            En este sitio encontrara el listado de las impresoras retiradas del sistema.
        </p>

        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2 bg-warning">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                    Impresoras Retirados
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-white">
                                    {{ $printersRemove }}
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

        <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                src="{{ asset('/core/undraw/photocopy.svg') }}">
        </div>

        <div class="card mb-4 py-3 border-left-primary">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-light  table-striped table-bordered table-sm  table-hover"
                        id='table-printers'>
                        <thead>
                            <tr class="bg-gradient-primary text-white text-center">
                                <th>ID:</th>
                                <th>Marca:</th>
                                <th>Módelo:</th>
                                <th>Placa</th>
                                <th>Estado:</th>
                                <th>Acciones:</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($printersRemoveInventary as $printer)
                            <tr class="text-center">
                                <td>
                                    <div class="col-auto text-center">
                                        <i class="fas fa-print fa-2x"></i>
                                        <br>
                                        <div class="h5 mb-0 font-weight-bold text-muted">{{ $printer->id }} </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="h6 mb-0 font-weight-bold text-muted">{{ $printer->brand }}<br>
                                        <small>
                                            {{ $printer->resolution }}, {{ $printer->serial }}, <br>
                                            {{ $printer->printer_functions }}
                                            <br>
                                        </small>
                                    </div>
                                </td>
                                <td>
                                    <div class="h6 mb-0 font-weight-bold text-muted">{{ $printer->model }} </div>
                                </td>
                                <td>
                                    <div class="h6 mb-0 font-weight-bold text-muted">
                                        <button type="button" class="btn btn-primary">
                                            {{ $printer->license_plate }} <span class="badge badge-light">Placa</span>
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    <div class="h6 mb-0 font-weight-bold text-muted">
                                        <div class="h6 mb-0 font-weight-bold text-muted">
                                            <h5><span class="badge badge-danger">{{ $printer->status }} </span></h5>
                                            Eliminado: {{ $printer->deleted_at }} -
                                            {{ Carbon\Carbon::parse($printer->deleted_at)->format('l jS \\of F Y ') }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a class='btn btn-secondary' href="">
                                        <i class="fa fa-check" aria-hidden="true"></i>
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
          $('#table-printers').DataTable();
      });
</script>
@endpush