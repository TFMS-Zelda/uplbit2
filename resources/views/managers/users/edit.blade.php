@extends('layouts.dashboard')

@section('title', 'information-&-technologies')


@section('content')

@section('titlePosition', 'users/edit')

<style>
    input[type="text"],
    input[type="email"],
    textarea {
        background-color: #E9EFF7;
    }
</style>

<section class="content">
    <div class="container-fluid">
        <h1 class="h3 mb-1 text-gray-800">Editar Usuario</h1>
        <div class="row">

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Usuario</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    {{ $user->name }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-id-card fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Contacto
                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    {{ $user->email_corporate }}
                                    <br>
                                    <i class="fas fa-id-card-alt"></i>
                                    {{ $user->citizenship_card }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-envelope-open-text fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Estado</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h6 mb-0 mr-3 font-weight-bold text-gray-800">
                                            @if ($user->status === 'Activo')
                                            <i class="fas fa-fingerprint"></i>
                                            {{ $user->ugdn }} <span class="badge badge-success">{{ $user->status }}
                                            </span>

                                            @else
                                            <i class="fas fa-fingerprint"></i>
                                            {{ $user->ugdn }} <span class="badge badge-secondary">{{ $user->status }}
                                            </span>

                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-fingerprint fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Historial
                                </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    Fecha de Creación: <br>
                                    {{ $user->created_at }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clock fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                src="{{ asset('/core/undraw/employee-office.svg') }}">

            @if (count($errors) > 0)
            <div class="col-xl-12 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Error:
                                    <p>Algunos campos contienen errores...</p>
                                </div>
                                <i class="fas fa-exclamation-triangle fa-2x text-danger"></i>
                                <hr>
                                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                                    src="{{ asset('/core/undraw/error.svg') }}">

                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>
                                        <a href="#" class="btn btn-ligth btn-sm btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-flag text-gray-800"></i>
                                            </span>
                                            <span class="text">{{ $error }}</span>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-cog fa-spin fa-3x text-danger"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <form action="{{ route('managers.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-12">
                    <div class="card border-left-secondary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">User
                                        {{ $user->id }} </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <h2>{{ $user->name }}</h2>
                                        <br>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <img src="{{ $user->avatar }}"
                                        style="width:150px; height: 150px; float:left; border-radius:50%; margin-right: 25px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <label>Update Profile Image</label>
            <input type="file" name="avatar" required>
            <br>
            <br>
            <p class="h4 mb-1 text-gray-800">User Resume</p>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Nombre:</label>
                            <input type="text" class="form-control" maxlength="128" value="{{ $user->name }}"
                                name="name" required />
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Email:</label>
                            <input type="email" class="form-control" maxlength="128" value="{{ $user->email }}"
                                name="email" required />
                            <small class="form-text text-success">
                                The Email field cannot be duplicated
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Cargo:</label>
                            <input type="text" class="form-control" maxlength="128" value="{{ $user->job_title  }}"
                                name="job_title" required />
                        </div>
                        <div class="form-group col-md-2">
                            <label>*UGDN:</label>
                            <input type="email" class="form-control selectValidationNumber" maxlength="128"
                                value="{{ $user->ugdn }}" name="ugdn" required />
                            <small class="form-text text-success">
                                The UGDN field cannot be duplicated
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password:') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" value="{{ $user->password }}" required autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm"
                    class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password:') }}</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" value="{{ $user->password }}" class="form-control"
                        name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>
            <p class="h4 mb-1 text-gray-800">Lista de Roles</p>


            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <ul class="list-unstyled">
                            @foreach($roles as $role)
                            <li>
                                <label>
                                    {{ Form::checkbox('roles[]', $role->id, null) }}
                                    {{ $role->name }}
                                    <i class="fas fa-angle-right"></i>
                                    <em>{{ $role->description ? : 'Sin descripción' }}</em>

                                </label>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>


        </form>
    </div>
</section>

<script>
    // Validacion: Solo permite escribir caracteres numericos
    $('.selectValidationNumber').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

</script>
@endsection