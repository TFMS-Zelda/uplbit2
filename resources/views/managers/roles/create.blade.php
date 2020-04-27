@extends('layouts.dashboard')

@section('title', 'information-&-technologies')

@section('content')
@section('titlePosition', 'computers/create')

<style>
    input[type="text"],
    input[type="email"],
    textarea {
        background-color: #E9EFF7;
    }
</style>

<section class="content">
    <div class="container-fluid">
        <h1 class="h3 mb-1 text-gray-800">Agregar Role</h1>
        <p class="mb-4 text-justify">
            Complete el siguiente formulario, recuerde que los campos marcados con <strong>*</strong> son de caracter
            obligatorio.
        </p>

        <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                src="{{ asset('/core/undraw/access-role.svg') }}">

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

        <form action="{{ route('managers.roles.store') }}" method="POST">
            @csrf
            <p class="h4 mb-1 text-gray-800">Role Resume</p>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Nombre :</label>
                            <input type="text" class="form-control" maxlength="128" name="name" placeholder="Enter Name"
                                value="{{ old('name') }}" required />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">

                            <i class="fas fa-question-circle"></i>
                            <label>*Slug:</label>
                            <input type="text" class="form-control" maxlength="128" name="slug" placeholder="Enter Slug"
                                value="{{ old('slug') }}" required />
                            <small class="form-text text-gray-600">
                                Slug: Ingrese una url amigable para indicar el role...
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>*Descripcion:</label>

                            <textarea name="description" class="form-control" id="" cols="30"></textarea>
                        </div>

                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <p class="h5 mb-1 text-gray-800">Lista de Permisos del Sistema</p>

                </div>
                <div class="card-body">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex expedita quae illo, similique
                        assumenda quasi amet magni odit quibusdam quod tempora obcaecati delectus iure nulla eum vel.
                        Illo, inventore fugit.
                    </p>

                    <ul class="list-unstyled">
                        @foreach($permissions as $permission)
                        <li>
                            <i class="fas fa-sort-numeric-down"></i>
                            {{ Form::checkbox('permissions[]', $permission->id, null) }} -
                            <code>{{ $permission->name }}</code>: <b> {{ $permission->slug }}</b>
                            <br>
                            {{ $permission->description }}
                            <hr>

                        </li>
                        @endforeach
                    </ul>

                </div>
            </div>
            <div class="form-group">
                {{ Form::submit('Guardar', ['class' => 'btn btn-sm btn-primary']) }}
                
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