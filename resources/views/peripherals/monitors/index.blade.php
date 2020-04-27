@extends ('layouts.dashboard')

@section('title', 'information-&-technologies')

@section('content')
@section('titlePosition', 'companies')
<section class="content">
    <div class="container-fluid">
        <h1 class="h3 mb-1 text-gray-800">Monitores</h1>
        <p class="mb-4 text-justify">
            La siguiente información se almacena, organiza, mantiene y difunde de manera digital. Esta información es
            de
            acceso privado para usuarios directamente autentificados en el sistema.
            En este sitio encontrara el listado de Monitores corporativos registrados en el sistema.
        </p>

        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2 bg-success">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                    Monitores Registrados
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-white">
                                    {{ $totalMonitor }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-tv fa-2x text-white" aria-hidden="true"></i>
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
                            @foreach($monitors as $monitor)
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
                                        @if ($monitor->status === 'Activo - Asignado')
                                        <h5><span class="badge badge-success">{{ $monitor->status }} </span></h5>

                                        @elseif($monitor->status === 'Inactivo - No Asignado')
                                        <h5><span class="badge badge-danger">{{ $monitor->status }} </span></h5>

                                        @elseif($monitor->status === 'En Mantenimiento')
                                        <h5><span class="badge badge-warning">{{ $monitor->status }} </span></h5>

                                        @elseif($monitor->status === 'Dañado')
                                        <h5><span class="badge badge-black">{{ $monitor->status }} </span></h5>

                                        @elseif($monitor->status === 'Retirado - Baja de Activo')
                                        <h5><span class="badge badge-primary">{{ $monitor->status }} </span></h5>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @can('permission:peripherals.monitors.show')
                                    <a href="{{ route('peripherals.monitors.show', $monitor->id) }}"
                                        class="btn btn-success btn-circle btn-sm">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    @endcan

                                    @can('permission:peripherals.monitors.edit')
                                    <a href="{{ route('peripherals.monitors.edit', $monitor->id)}}"
                                        class="btn btn-warning btn-circle btn-sm">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </a>
                                    @endcan

                                    @can('permission:peripherals.monitors.destroy')
                                    <form action="{{ route('peripherals.monitors.destroy', $monitor->id) }}"
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

                @can('permission:peripherals.monitors.create')
                <a href="{{ route('peripherals.monitors.create') }}" class="btn btn-secondary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-right"></i>
                    </span>
                    <span class="text">Add monitor</span>
                </a>
                @endcan
            </div>
        </div>
</section>
@endsection
@push('scripts')
<script src="{{ asset('/core/plugins/DataTables/datatables.min.js') }}"></script>

<script>
   $(document).ready(function () {
          $('#table-monitors').DataTable({});
      });
    
    document.onsubmit = function () {
        return confirm('Atencion: {{ Auth::user()->name }}, ¿Esta seguro de eliminar el siguiente perisferico: monitor del sistema?');}
</script>
@endpush