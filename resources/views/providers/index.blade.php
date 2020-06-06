@extends ('layouts.dashboard')

@section('title', 'information-&-technologies')

@section('content')
@section('titlePosition', 'providers')
<section class="content">
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-1 text-gray-800">Provedores del Sistema</h1>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2 bg-success">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                    Provedores Registrados
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-white">
                                    {{ $totalProviderRegistrados }} </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-briefcase fa-2x text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                src="{{ asset('/core/undraw/deliveries.svg') }}">
        </div>

        <div class="card mb-4 py-3 border-left-primary">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-light  table-striped table-bordered table-sm  table-hover"
                        id="table-providers" width="100%" cellspacing="0">
                        <thead>
                            <tr class="bg-gradient-primary text-white text-center">
                                <th>ID:</th>
                                <th>Nombre del Provedor:</th>
                                <th>Nit:</th>
                                <th>Location:</th>
                                <th>Contact</th>
                                <th>Acciones:</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($providers as $provider)
                            <tr class="text-center">
                                <td>
                                    <div class="h5 mb-0 font-weight-bold text-muted">
                                        <i class="fas fa-sort-numeric-down-alt"></i><br>
                                        <strong>{{ $provider->id }}</strong>
                                    </div>
                                </td>
                                <td>
                                    <i class="fa fa-landmark" aria-hidden="true"></i>
                                    <br>
                                    <div class="h6 mb-0 font-weight-bold text-muted">
                                        {{ $provider->name }} {{ $provider->kind_of_society }}
                                    </div>
                                </td>
                                <td>
                                    <i class="fa fa-id-card" aria-hidden="true"></i>
                                    <br>
                                    <div class="h6 mb-0 font-weight-bold text-muted">
                                        {{ $provider->nit }}
                                    </div>
                                </td>
                                <td>
                                    <i class="fas fa-map-marker-alt"></i><br>
                                    {{ $provider->country }} / {{ $provider->city }}
                                    <br>
                                    <small>{{ $provider->address }}</small>
                                </td>
                                <td>

                                    <i class="fas fa-address-book"></i>
                                    <small> {{ $provider->sales_representative }}</small>
                                    <br>
                                    <i class="fas fa-envelope-open-text"></i>
                                    <small> <u>{{ $provider->email_contact }}</u></small>
                                    <br>
                                    <i class="fas fa-phone-square-alt"></i>
                                    <small>
                                        {{ $provider->phone_contact }} Ext:
                                        {{ $provider->extension_contact }}
                                    </small>


                                </td>

                                <td>
                                    @can('permission:providers.show')
                                    <a href="{{ route('providers.show', $provider->id) }}"
                                        class="btn btn-success btn-circle btn-sm">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    @endcan

                                    @can('permission:providers.edit')
                                    <a href="{{ route('providers.edit', $provider->id) }} "
                                        class="btn btn-warning btn-circle btn-sm">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </a>
                                    @endcan

                                    @can('permission:providers.destroy')
                                    <form action="{{ route('providers.destroy', $provider->id) }}" method="POST">
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
                    @can('permission:providers.create')
                    <a href="{{ route('providers.create') }}" class="btn btn-secondary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-arrow-right"></i>
                        </span>
                        <span class="text">Add Provider</span>
                    </a>
                    @endcan
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
          $('#table-providers').DataTable();
      });
        document.onsubmit = function () {
          return confirm('Atencion: {{ Auth::user()->name }}, ¿Esta seguro de eliminar el siguiente provedor del sistema?');
      }
</script>
@endpush