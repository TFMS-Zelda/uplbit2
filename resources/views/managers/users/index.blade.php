@extends ('layouts.dashboard')

@section('title', 'information-&-technologies')

@section('content')
@section('titlePosition', 'companies')
<section class="content">
    <div class="container-fluid">
        <h1 class="h3 mb-1 text-gray-800">Users System Administration</h1>

        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2 bg-success">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                    Usuarios Activos
                                </div>
                                <div class="font-weight-bold text-white">10</div>
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
                src="{{ asset('/core/undraw/dev-user.svg') }}">
        </div>

        <!-- table users -->
        <div class="card mb-4 py-3 border-left-primary">
            <div class="card-body">
                <div class="table-responsive">
                    <!-- split history users   -->
                    <div class="btn-group dropright">
                        <button type="button" class="btn btn-ligth">
                            <h1 class="h6 mb-1 text-gray-800">Historial de Usuarios</h1>
                            <small class="text-muted">
                                <p class="text-right"><i class="fa fa-history" aria-hidden="true"></i></p>
                            </small>
                        </button>
                        <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        </button>
                        <div class="dropdown-menu">

                            <a class="dropdown-item" href="#">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                Users Disabled Account
                            </a>
                        </div>
                    </div>
                    <!-- end split hisotry users -->
                    <table class="table table-light  table-striped table-bordered table-sm  table-hover" id="table-user"
                        width="100%" cellspacing="0">
                        <thead>
                            <tr class="bg-gradient-primary text-white text-center">
                                <th>ID:</th>
                                <th>Nombre:</th>
                                <th>UGDN:</th>
                                <th>Job Title</th>
                                <th>Acciones:</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr class="text-center">
                                <td>
                                    <i class="fas fa-sort-numeric-down-alt"></i>
                                    {{ $user->id }}
                                </td>
                                <td>
                                    <div class="mb-0 font-weight-bold text-gray-600">
                                        <img class="img-fluid rounded-circle" src="{{ $user->avatar }}"
                                            alt="avatarEmployeeImage" width="40px">
                                        <br>
                                        {{ $user->name }}
                                        <br>
                                        <i class="fa fa-id-email" aria-hidden="true"></i>
                                        <small>{{ $user->email }}</small>
                                    </div>

                                </td>
                                <td>
                                    <div class="mb-0 font-weight-bold text-gray-600">
                                        <i class="fa fa-fingerprint"></i>
                                        <br>
                                        {{ $user->ugdn }}
                                        <br>
                                        @if ( $user->status === 'Activo')
                                        <span class="badge badge-success">{{ $user->status }} </span>
                                        @else
                                        <span class="badge badge-danger">{{ $user->status }} </span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="h6 mb-0 font-weight-bold text-gray-800">
                                        <i class="fab fa-battle-net"></i><br>
                                        <small> {{ $user->job_title }}</small>
                                    </div>
                                </td>
                                <td>
                                    @can('permission:managers.users.show')
                                    <a href="{{ route('managers.users.show', $user->id) }}"
                                        class="btn btn-success btn-circle btn-sm">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    @endcan

                                    @can('permission:managers.users.show')
                                    <a href="{{ route('managers.users.edit', $user->id)}}"
                                        class="btn btn-warning btn-circle btn-sm">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </a>
                                    @endcan

                                    @can('permission:managers.employee.destroy')
                                    <form action="{{ route('managers.users.destroy', $user->id) }}" method="POST">
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

                @can('permission:magers.users.create')
                <a href="#" class="btn btn-secondary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-right"></i>
                    </span>
                    <span class="text">Add User</span>
                </a>
                @endcan

            </div>
        </div>
        <!-- end table users -->

    </div>
</section>
<script>
    $(document).ready(function () {
        $('#table-user').DataTable();
    });

    // Eliminacion User
    document.onsubmit = function () {
        return confirm('Atencion: {{ Auth::user()->name }}, ¿Esta seguro de eliminar el siguiente usuario del sistema?');
    }

</script>
@endsection