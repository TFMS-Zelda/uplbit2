@extends ('layouts.dashboard')

@section('title', 'information-&-technologies')

@section('content')
@section('titlePosition', 'roles')
<section class="content">
    <div class="container-fluid">
        <h1 class="h3 mb-1 text-gray-800">Roles</h1>

        <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                src="{{ asset('/core/undraw/role.svg') }}">
        </div>
        <div class="card mb-4 py-3 border-left-secondary">
            <div class="card-body">
                <!-- end split hisotry users -->
                <table class="table table-sm table-striped table-light table-hover table-fixed" id="table-roles">
                    <thead class="thead-dark">
                        <tr class="bg-gradient-primary text-white text-center">
                            <th>ID:</th>
                            <th>Nombre:</th>
                            <th>Audit:</th>
                            <th>Acciones:</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                        <tr class="text-center">
                            <td>
                                <i class="fas fa-sort-numeric-down-alt"></i>
                                {{ $role->id }}
                            </td>
                            <td>
                                <i class="fa fa-user-secret" aria-hidden="true"></i>
                                <br>
                                <small>
                                    <b> {{ $role->name }}</b> <br>
                                    {{ $role->slug }} / {{ $role->description }}
                                </small>
                            </td>
                            <td>
                                <i class="fa fa-history" aria-hidden="true"></i>
                                <br>
                                <small>
                                    <b>Fecha de creación:</b> <br>
                                    {{ $role->created_at }}
                                </small>
                            </td>
                            <td>
                                @can('permission:managers.employees.show')
                                <a href="{{ route('managers.roles.show', $role->id) }}"
                                    class="btn btn-success btn-circle btn-sm">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                @endcan

                                @can('permission:managers.employees.edit')
                                <a href="{{ route('managers.roles.edit', $role->id)}}"
                                    class="btn btn-warning btn-circle btn-sm">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </a>
                                @endcan

                                @can('permission:managers.employee.destroy')
                                <form action="{{ route('managers.roles.destroy', $role->id) }}" method="POST">
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
                @can('permission:managers.employees.create')
                <a href="{{ route('managers.roles.create') }}" class="btn btn-secondary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-right"></i>
                    </span>
                    <span class="text">Add Role</span>
                </a>
                @endcan
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {
        $('#table-roles').DataTable()
    })

    // Eliminacion de un Employee
    document.onsubmit = function () {
        return confirm('Atencion: {{ Auth::user()->name }}, ¿Esta seguro de eliminar el siguiente empleado del sistema?');
    }
</script>
@endsection