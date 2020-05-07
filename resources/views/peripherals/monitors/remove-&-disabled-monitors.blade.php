@extends ('layouts.dashboard')

@section('title', 'information-&-technologies')

@section('content')
@section('titlePosition', 'computers/ remove-&-disabled-monitors')
<section class="content">
    <div class="container-fluid">
        <h1 class="h3 mb-1 text-gray-800">Monitores retirados del sistema</h1>
        <p class="mb-4 text-justify">
            La siguiente información se almacena, organiza, mantiene y difunde de manera digital. Esta información es
            de
            acceso privado para usuarios directamente autentificados en el sistema.
            En este sitio encontrara el listado de los monitores retirados del sistema.
        </p>

        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2 bg-warning">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                    Monitores Retirados
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-white">
                                    12
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-monitor fa-2x text-white"></i>
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
                    <table class="table table-sm table-striped table-light table-hover table-fixed" id="table-monitors">
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
                            @foreach($monitorsRemoveInventary as $monitor)
                            <tr class="text-center">
                                <td>
                                    <div class="col-auto text-center">
                                        <i class="fas fa-tv fa-2x"></i>
                                        <br>
                                        <div class="h5 mb-0 font-weight-bold text-muted">{{ $monitor->id }} </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="h6 mb-0 font-weight-bold text-muted">{{ $monitor->brand }} <br>
                                        <small>
                                            {{ $monitor->screen_type }}, {{ $monitor->screen_format }} ,
                                            {{ $monitor->backlight }}
                                            <br>
                                            {{ $monitor->input_connector_type }}
                                        </small>
                                    </div>
                                </td>
                                <td>
                                    <div class="h6 mb-0 font-weight-bold text-muted">{{ $monitor->model }} </div>
                                </td>
                                <td>
                                    <div class="h6 mb-0 font-weight-bold text-muted">
                                        <button type="button" class="btn btn-primary">
                                            {{ $monitor->license_plate }} <span class="badge badge-light">Placa</span>
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    <div class="h6 mb-0 font-weight-bold text-muted">
                                        <h5><span class="badge badge-danger">{{ $monitor->status }} </span></h5>
                                        Eliminado: {{ $monitor->deleted_at }} -
                                        {{ Carbon\Carbon::parse($monitor->deleted_at)->format('l jS \\of F Y ') }}
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('peripherals.monitors.show', $monitor->id) }}"
                                        class="btn btn-success btn-circle btn-sm">
                                        <i class="fas fa-info-circle"></i>
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
          $('#table-monitors').DataTable();
      });
</script>
@endpush