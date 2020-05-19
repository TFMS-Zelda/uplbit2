@extends ('layouts.dashboard')

@section('title', 'information-&-technologies')
@section('content')

@section('titlePosition', 'companies')
<section class="content">
    <div class="container-fluid">
        <h1 class="h3 mb-1 text-gray-800">Compañias del Sistema</h1>
        <p class="mb-4 text-justify">
            La siguiente información se almacena, organiza, mantiene y difunde de manera digital. Esta información es
            de
            acceso privado para usuarios directamente autentificados en el sistema.
            En este sitio encontrara el listado de las compañias registradas en el sistema.
        </p>



        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2 bg-success">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                    Compañias Registrados
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-white">
                                    {{ $totalCompaniesRegistradas }} </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-landmark fa-2x text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                src="{{ asset('/core/undraw/company.svg') }}">
        </div>

        <div class="card mb-4 py-3 border-left-primary">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-light  table-striped table-bordered table-sm  table-hover"
                        id="table-companies" width="100%" cellspacing="0">
                        <thead>
                            <tr class="bg-gradient-primary text-white text-center">
                                <th>ID:</th>
                                <th>Nombre de la Compañia:</th>
                                <th>Nit:</th>
                                <th>Localización:</th>
                                <th>Contacto:</th>
                                <th>Acciones:</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($companies as $company)
                            <tr class="text-center">
                                <td>
                                    <i class="fas fa-sort-numeric-down-alt"></i><br>
                                    <strong>{{ $company->id }}</strong>
                                </td>
                                <td>
                                    <i class="fa fa-landmark" aria-hidden="true"></i>
                                    <br>
                                    <small>
                                        {{ $company->name }} {{ $company->kind_of_society }}
                                    </small>
                                </td>
                                <td>
                                    <i class="fa fa-id-card" aria-hidden="true"></i>
                                    <br>
                                    <small><strong>{{ $company->nit }}</strong></small>
                                </td>
                                <td>
                                    <i class="fas fa-map-marker-alt"></i><br>
                                    {{ $company->country }} / {{ $company->city }}
                                    <br>
                                    <small>{{ $company->address }}</small>
                                </td>
                                <td>
                                    <div class="h6 mb-0 font-weight-bold text-gray-600">
                                        <i class="fas fa-address-book"></i>
                                        <small> {{ $company->person_contact }}</small>
                                        <br>
                                        <i class="fas fa-envelope-open-text"></i>
                                        <small> <u>{{ $company->email_contact }}</u></small>
                                        <br>
                                        <i class="fas fa-phone-square-alt"></i>
                                        <small>{{ $company->phone_contact }} / Ext:
                                            {{ $company->extension_contact }}</small>
                                    </div>
                                </td>
                                <td>
                                    @can('permission:companies.show')
                                    <a href="{{ route('companies.show', $company->id) }}"
                                        class="btn btn-success btn-circle btn-sm">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    @endcan

                                    @can('permission:companies.edit')
                                    <a href="{{ route('companies.edit', $company->id) }} "
                                        class="btn btn-warning btn-circle btn-sm">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </a>
                                    @endcan

                                    @can('permission:companies.destroy')
                                    <form action="{{ route('companies.destroy', $company->id) }}" method="POST">
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
                    @can('permission:companies.create')
                    <a href="{{ route('companies.create') }}" class="btn btn-secondary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-arrow-right"></i>
                        </span>
                        <span class="text">Add Company</span>
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
          $('#table-companies').DataTable();
      });
        document.onsubmit = function () {
          return confirm('Atencion: {{ Auth::user()->name }}, ¿Esta seguro de eliminar la siguiente compañia del sistema?');
      }
</script>
@endpush