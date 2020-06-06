@extends ('layouts.dashboard')

@section('title', 'information-&-technologies')

@section('content')
@section('titlePosition', 'companies')
<section class="content">
    <div class="container-fluid">
        <h1 class="h3 mb-1 text-gray-800">Employees</h1>

        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2 bg-success">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                    Empleados Activos
                                </div>
                                <div class="font-weight-bold text-white">{{ $totalEmployeesActivos }} </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-tie fa-2x text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                src="{{ asset('/core/undraw/employee-hire.svg') }}">
        </div>

        <!-- table employees -->
        <div class="card mb-4 py-3 border-left-primary">
            <div class="card-body">
                <div class="table-responsive">
                    <!-- split history users   -->
                    <div class="btn-group dropright">
                        <button type="button" class="btn btn-ligth">
                            <h1 class="h6 mb-1 text-gray-800">Historial de Empleados</h1>
                            <small class="text-muted">
                                <p class="text-right"><i class="fa fa-history" aria-hidden="true"></i></p>
                            </small>
                        </button>
                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        </button>
                        <div class="dropdown-menu">

                            <a class="dropdown-item"
                                href="{{ route('managers.employees.remove-&-disabled-employees') }}">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                Employees Disabled Account
                            </a>
                        </div>
                    </div>
                    <!-- end split hisotry users -->
                    <table class="table table-sm table-striped table-light table-hover table-fixed"
                        id="table-employees">
                        <thead class="thead-primary">
                            <tr class="bg-gradient-primary text-white text-center">
                                <th>ID:</th>
                                <th>Nombre:</th>
                                <th>UGDN:</th>
                                <th>Área:</th>
                                <th>Ubicación:</th>
                                <th>Status</th>
                                <th>Acciones:</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
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

                                    </div>
                                </td>
                                <td>
                                    <div class="mb-0 font-weight-bold text-gray-600">
                                        {{ $employee->work_area }}
                                        <br>
                                        {{ $employee->employee_type }} <br>
                                        Cédula: {{ $employee->citizenship_card }}

                                    </div>
                                </td>
                                <td>
                                    <div class="mb-0 font-weight-bold text-gray-600">
                                        <i class="fa fa-map-marker-alt" aria-hidden="true"></i>
                                        <br>
                                        {{ $employee->country }} / {{ $employee->city }} <br>
                                        <i class="fas fa-phone"></i> {{ $employee->phone }}
                                    </div>
                                </td>
                                <td>
                                    @if ($employee->status === 'Activo')
                                    <h5><span class="badge badge-success">{{ $employee->status }} </span></h5>

                                    @elseif ($employee->status === 'Inactivo') <h5><span
                                            class="badge badge-danger">{{ $employee->status }} </span></h5>
                                    @endif
                                </td>
                                <td>
                                    @can('permission:managers.employees.show')
                                    <a href="{{ route('managers.employees.show', $employee->id) }}"
                                        class="btn btn-success btn-circle btn-sm">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    @endcan

                                    @can('permission:managers.employees.edit')
                                    <a href="{{ route('managers.employees.edit', $employee->id)}}"
                                        class="btn btn-warning btn-circle btn-sm">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </a>
                                    @endcan

                                    @can('permission:managers.employee.destroy')
                                    <form action="{{ route('managers.employees.destroy', $employee->id) }}"
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

                @can('permission:managers.employees.create')
                <a href="{{ route('managers.employees.create') }}" class="btn btn-secondary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-right"></i>
                    </span>
                    <span class="text">Add Employee</span>
                </a>
                @endcan

            </div>
        </div>
        <!-- end table employees -->
    </div>
</section>
@endsection
@push('scripts')
<script src="{{ asset('/core/plugins/DataTables/datatables.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#table-employees').DataTable({
            order: [ [0, 'desc'] ]
        });
    });
    
    document.onsubmit = function () {
        return confirm('Atencion: {{ Auth::user()->name }}, ¿Esta seguro de inhabilitar el siguiente empleado del sistema?');}
</script>
@endpush