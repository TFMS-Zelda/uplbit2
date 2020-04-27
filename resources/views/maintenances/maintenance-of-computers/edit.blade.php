@extends ('layouts.dashboard')

@section('title', 'information-&-technologies')
@section('content')

@section('titlePosition', 'maintenances.maintenance-of-computers/edit')

<style>
    input[type="text"],
    input[type="email"],
    textarea {
        background - color: #E9EFF7;
    }

    section {
        padding: 1rem;
    }

    .bg-primary {
        color: #fff;
    }

    .bg-gray {
        background-color: #cccccc;
    }
</style>

<section class="content">

    <div class="text-center">
        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
            src="{{ asset('/core/undraw/progress.svg') }}">
    </div>

    <section class="bg-primary text-center">
        <div class="container">
            <h2> <i class="fas fa-wrench"></i> EDITAR MANTENIMIENTO EQUIPO DE COMPUTO N° {{ $historyMaintenance->id }}
            </h2>
        </div>
        <!-- /.container-->
    </section>

    <section>
        <div class="container">
            <div class="alert alert-warning" role="alert">
                <h4 class="alert-heading">
                    <i class="fa fa-bell" aria-hidden="true"></i>
                    Nota!
                </h4>
                <p class="mb-0">
                    {{ Auth::user()->name }}, a continuación editara un mantenimiento registrado del equipo de computo:
                    <em>{{ $historyMaintenance->computer->brand }} {{ $historyMaintenance->computer->model }}</em> <br>
                    ServiceTag Serial: <strong>{{ $historyMaintenance->computer->servicetag }}</strong> <br>
                    Placa corporativa: <strong>{{ $historyMaintenance->computer->license_plate }}</strong>
                    <hr>
                    Log... Última fecha de actualización:
                    {{ $historyMaintenance->computer->updated_at->diffForHumans() }},
                    {{ Carbon\Carbon::parse($historyMaintenance->computer->updated_at)->format('l jS \\of F Y ') }}
                </p>
            </div>
        </div>
        <p class="mb-4 text-justify">
            Complete el siguiente formulario, recuerde que los campos marcados con <strong>*</strong> son de caracter
            obligatorio, puede omitir adjuntar un soporte de mantenimiento si no aplica.
        </p>
    </section>

    <!-- import partials.errors-validation -->
    @include('partials.errors-validation')
    <!-- close import -->

    <form action="{{ route('maintenances.maintenance-of-computers.update', $historyMaintenance->id) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-12">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>
                            *Fecha de Mantenimiento & actualización
                        </label>
                        {{ Form::date('maintenance date', new \DateTime(), ['class' => 'form-control', 'readonly'] ) }}
                    </div>

                    <div class="form-group col-md-6">
                        <label>*Tipo de Mantenimiento:</label>
                        <select class="form-control" name="maintenance_type" required autofocus>
                            <option value="Mantenimiento Preventivo"
                                {{ old('maintenance_type', $historyMaintenance->maintenance_type) == 'Mantenimiento Preventivo' ? 'selected' : ''}}>
                                Mantenimiento Preventivo
                            </option>
                            <option value="Mantenimiento Correctivo"
                                {{ old('maintenance_type', $historyMaintenance->maintenance_type) == 'Mantenimiento Correctivo' ? 'selected' : ''}}>
                                Mantenimiento Correctivo
                            </option>
                            <option value="Reporte por Garantia"
                                {{ old('maintenance_type', $historyMaintenance->maintenance_type) == 'Reporte por Garantia' ? 'selected' : ''}}>
                                Reporte por Garantia
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <p class="h4 mb-1 text-gray-800"><i class="fas fa-wrench"></i> Maintance Description</p>
        <small>Describa el mantenimiento realizado:</small>

        <div class="row">
            <div class="col-md-12">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <textarea class="form-control" maxlength="512" name="maintenance_description"
                            required>{{ $historyMaintenance->maintenance_description }}</textarea>
                    </div>
                   
                </div>
            </div>
        </div>


        <div class="alert alert-primary" role="alert">
            <h4 class="alert-heading">
                <i class="fa fa-bell" aria-hidden="true"></i>
                Nota!
            </h4>
            <p class="mb-0">
                {{ Auth::user()->name }}, si es un reporte por garantía, indique el nombre del provedor quien efectuó el
                proceso de mantenimiento o el reemplazo de algún componente...
            </p>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>*Mantenimiento Realizado por:</label>
                            <input type="text" class="form-control" name="responsible_maintenance" maxlength="128"
                                value="{{ $historyMaintenance->responsible_maintenance }}" placeholder="Enter Name"
                                required autofocus>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <p class="h4 mb-1 text-gray-800"><i class="fas fa-wrench"></i> Observations</p>
        <small>Si se reporto alguna observación describala:</small>
        <div class="row">
            <div class="col-md-12">
                <div class="form-row">
                    <div class="form-group col-md-12"><textarea class="form-control" name="observations" maxlength="512"
                            required>{{ $historyMaintenance->observations }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 10rem;"
            src="{{ asset('/core/undraw/share-link.svg') }}">

        <p class="h4 mb-1 text-gray-800"><i class="fas fa-cloud"></i> Attachments</p>
        <div class="form-row">
            <div class="form-group col-md-12">
                <div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading">
                        <i class="fa fa-bell" aria-hidden="true"></i>
                        Nota!
                    </h4>
                    <p class="mb-0">
                        {{ Auth::user()->name }}, a continuación debe adjuntar nuevamente el reporte del proceso de
                        mantenimiento
                        realizado y entregado por el soporte técnico. <br>
                        Si no aplica, puede omitir este proceso...
                    </p>
                    <input type="file" class="form-control col-md-8" name="attachments" accept="file/PDF, image/PDF">
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>*Agregado Por:</label>
                        <select class="form-control" name="user_id" required autofocus>
                            <option value="{{ auth()->user()->id }}">{{ auth()-> user() -> name}}</option>
                        </select>
                        <small class="form-text text-gray-600">
                            El usuario es detectado automáticamente por el sistema
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <p class="h4 mb-1 text-gray-800"><i class="fas fa-laptop"></i> Equipo de computo</p>

        <div class="row">
            <div class="col-md-12">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <select class="form-control" name="computer_id" required autofocus>
                            <option value="{{ $historyMaintenance->computer->id }} ">
                                {{ $historyMaintenance->computer->brand}}
                                - {{ $historyMaintenance->computer->model }},
                                {{ $historyMaintenance->computer->servicetag }}
                            </option>
                        </select>
                        <small class="form-text text-gray-600">
                            El Equipo de computo es detectado automáticamente por el sistema, la placa corporativa de el
                            equipo de computo
                            es <strong><code>{{ $historyMaintenance->computer->license_plate }} </code></strong>...
                        </small>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalUpdateMaintanceComputer">
            Enviar
        </button>


        <!-- Modal -->
        <div aria-hidden="true" aria-labelledby="modalUpdateMaintanceComputer" class="modal fade"
            id="modalUpdateMaintanceComputer" role="dialog" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content card shadow mb-4">
                    <div class="modal-header">
                        <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                            <span aria-hidden="true">
                                <i aria-hidden="true" class="fa fa-times text-danger">
                                </i>
                            </span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col col-md-12">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                ¿Actualizar Mantenimiento de equipo de computo?
                                            </div>
                                            <div class="p mb-0 font-weight text-gray-800">
                                                <p>
                                                    Atención!
                                                    <br>
                                                    {{ Auth::user()->name }}
                                                    <br>
                                                    ¿Desea actualizar el siguiente mantenimiento de equipo de computo?
                                                    <div class="alert alert-warning" role="alert">
                                                        <h4 class="alert-heading">
                                                            <i class="fa fa-bell" aria-hidden="true"></i>
                                                            Nota!
                                                        </h4>
                                                        <p class="mb-0">
                                                            a continuación actualizara el registro del
                                                            mantenimiento al equipo de computo:
                                                            <em>{{ $historyMaintenance->computer->brand }}
                                                                {{ $historyMaintenance->computer->model }}</em> <br>
                                                            ServiceTag Serial:
                                                            <strong>{{ $historyMaintenance->computer->servicetag }}</strong>
                                                            <br>
                                                            Placa corporativa:
                                                            <strong>{{ $historyMaintenance->computer->license_plate }}</strong>

                                                        </p>
                                                    </div>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-laptop fa-2x text-gray-300">
                                            </i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary">Confirmar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Close Modal -->
        <a href="#" class="btn btn-danger">Cancelar</a>
    </form>

</section>
@endsection