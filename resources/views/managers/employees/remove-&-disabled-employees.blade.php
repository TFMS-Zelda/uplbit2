@extends ('layouts.dashboard')

@section('title', 'information-&-technologies')

@section('content')
@section('titlePosition', 'employees/ remove-&-disabled-employees')
<section class="content">
    <div class="container-fluid">
        <h1 class="h3 mb-1 text-gray-800">Empleados retirados | Inhabilitados</h1>
        <p class="mb-4 text-justify">
            La siguiente información se almacena, organiza, mantiene y difunde de manera digital. Esta información es
            de
            acceso privado para usuarios directamente autentificados en el sistema.
            En este sitio encontrara el listado de empleados retirados | Inhabilitados del sistema.
        </p>

        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2 bg-warning">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                    Empleados retirados | inhabilitados del sistema.
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-white">
                                    {{ $employeesRemove }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-lock fa-2x text-white"></i> </div>
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
                    <table class="table table-sm table-striped table-light table-hover table-fixed"
                        id="table-employees">
                        <thead class="thead-dark">
                            <tr class="bg-gradient-primary text-white text-center">
                                <th>ID:</th>
                                <th>Nombre:</th>
                                <th>UGDN:</th>
                                <th>Área:</th>
                                <th>Localización:</th>
                                <th>Acciones:</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employeeRemoveInventary as $employee)
                            <tr class="text-center">
                                <td>
                                    <div class="col-auto text-center">
                                        <i class="fas fa-sort-numeric-down-alt"></i><br>
                                        <i class="fas fa-user"></i>
                                        <br>
                                        <div class="h5 mb-0 font-weight-bold text-muted">{{ $employee->id }} </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="mb-0 font-weight-bold text-gray-600">
                                        <img class="img-fluid rounded-circle"
                                            src='{{ Storage::url('Employees-avatar/'.$employee->profile_avatar )}}'
                                            alt="avatarEmployeeImage" width="40px">
                                        <br>
                                        {{ $employee->name }}
                                        <br>
                                        <i class="fa fa-id-email" aria-hidden="true"></i>
                                        <small>{{ $employee->email_corporate }}</small>
                                    </div>
                                </td>

                                <td>
                                    <div class="mb-0 font-weight-bold text-gray-600">
                                        <i class="fa fa-fingerprint"></i>
                                        <br>
                                        {{ $employee->ugdn }} <br>
                                        {{ $employee->citizenship_card }}
                                    </div>
                                </td>
                                <td>
                                    <div class="mb-0 font-weight-bold text-gray-600">
                                        {{ $employee->work_area }}
                                        <br>
                                        <i class="fas fa-phone"></i> <br>
                                        {{ $employee->phone }}
                                    </div>
                                </td>
                                <td>
                                    <div class="mb-0 font-weight-bold text-gray-600">
                                        <i class="fa fa-map-marker-alt" aria-hidden="true"></i>
                                        <br>
                                        {{ $employee->country }} / {{ $employee->city }} <br>
                                        <div class="h6 mb-0 font-weight-bold text-muted">
                                            <h5><span class="badge badge-danger">{{ $employee->status }}
                                                </span></h5>
                                            Eliminado: {{ $employee->deleted_at }} -
                                            {{ Carbon\Carbon::parse($employee->deleted_at)->format('l jS \\of F Y ') }}
                                        </div>
                                    </div>
                                </td>
                                <td>

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
          $('#table-employees').DataTable();
      });
</script>
@endpush