@extends ('layouts.dashboard')

@section('title', 'information-&-technologies')

@section('content')
@section('titlePosition', 'printers')
<section class="content">
    <div class="container-fluid">
        <h1 class="h3 mb-1 text-gray-800">Printers</h1>
        <p class="mb-4 text-justify">
            La siguiente información se almacena, organiza, mantiene y difunde de manera digital. Esta información es
            de
            acceso privado para usuarios directamente autentificados en el sistema.
            En este sitio encontrara el listado de Monitores corsporativos registrados en el sistema.
        </p>

        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2 bg-success">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                    Impresoras Registradas
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-white">
                                    {{ $printersTotal }}
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

                @can('permission:peripherals.printers.remove-&-disabled-printers')
                <!-- split remove peripherals.printers   -->
                <div class="btn-group dropright">
                    <button type="button" class="btn btn-ligth">
                        <h1 class="h6 mb-1 text-gray-800">Printer</h1>
                        <small class="text-muted">
                            <p class="text-right">Record & History</p>
                        </small>
                    </button>
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropright</span>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('peripherals.printers.remove-&-disabled-printers') }} ">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Impresoras retiradas del inventario
                        </a>
                    </div>
                </div>
                <!-- end split remove peripherals.printers -->
                @endcan

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
                            @foreach($printers as $printer)
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
                                            {{ $printer->input_connector_type }}
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
                                        @if ($printer->status === 'Activo - Asignado')
                                        <h5><span class="badge badge-success">{{ $printer->status }} </span></h5>

                                        @elseif($printer->status === 'Inactivo - No Asignado')
                                        <h5><span class="badge badge-danger">{{ $printer->status }} </span></h5>

                                        @elseif($printer->status === 'En Mantenimiento')
                                        <h5><span class="badge badge-warning">{{ $printer->status }} </span></h5>

                                        @elseif($printer->status === 'Dañado')
                                        <h5><span class="badge badge-black">{{ $printer->status }} </span></h5>

                                        @elseif($printer->status === 'Retirado - Baja de Activo')
                                        <h5><span class="badge badge-primary">{{ $printer->status }} </span></h5>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @can('permission:peripherals.printers.show')
                                    <a href="{{ route('peripherals.printers.show', $printer->id) }}"
                                        class="btn btn-success btn-circle btn-sm">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    @endcan

                                    @can('permission:peripherals.printers.edit')
                                    <a href="{{ route('peripherals.printers.edit', $printer->id)}}"
                                        class="btn btn-warning btn-circle btn-sm">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </a>
                                    @endcan

                                    @can('permission:peripherals.printers.destroy')
                                    <form action="{{ route('peripherals.printers.destroy', $printer->id) }}"
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

                @can('permission:peripherals.printers.create')
                <a href="{{ route('peripherals.printers.create') }}" class="btn btn-secondary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-right"></i>
                    </span>
                    <span class="text">Add Printer</span>
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
          $('#table-printers').DataTable({});
      });
    
    document.onsubmit = function () {
        return confirm('Atencion: {{ Auth::user()->name }}, ¿Esta seguro de eliminar la siguiente impresora del sistema?');}
</script>
@endpush