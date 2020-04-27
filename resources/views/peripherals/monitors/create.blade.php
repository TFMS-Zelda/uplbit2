@extends('layouts.dashboard')

@section('title', 'information-&-technologies')

@section('content')
@section('titlePosition', 'monitors/create')

<style>
    input[type="text"],
    input[type="email"] textarea {
        background-color: #E9EFF7;
    }
</style>
<section class="content">
    <div class="container-fluid">
        <h1 class="h3 mb-1 text-gray-800">Agregar Monitor</h1>
        <p class="mb-4 text-justify">
            Complete el siguiente formulario, recuerde que los campos marcados con <strong>*</strong> son de caracter
            obligatorio.
        </p>

        <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                src="{{ asset('/core/undraw/monitor.svg') }}">
        </div>

        <!-- import partials.errors-validation -->
        @include('partials.errors-validation')
        <!-- close import -->

        <form action="{{ route('peripherals.monitors.store') }}" method="POST">
            @csrf
            <p class="h4 mb-1 text-gray-800">Monitor Resume</p>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Marca:</label>
                            <select class="form-control BrandSelectClass" name="brand" id="brandSelectId"
                                onchange="cargarModelos()" required>
                                <option value="{{ $monitor->brand }}" @if (old($monitor->
                                    brand)=='{{ $monitor->brand }}') selected="selected" @endif>
                                    {{ $monitor->brand }}
                                </option>

                                <option style="font-size: 2pt; background-color: #E9EFF7;" disabled>&nbsp;</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>*Módelo:</label>
                            <select class="form-control" name="model" id="modelSelectId" required>
                                <option value="{{ $monitor->model }}" @if (old($monitor->model)=='{{ $monitor->model }}'
                                    )
                                    selected="selected" @endif>
                                    {{ $monitor->model }}
                                </option>

                                <option style="font-size: 2pt; background-color: #E9EFF7;" disabled>&nbsp;</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label><code>*Serial del Monitor:</code></label>
                            <input type="text" class="form-control" id="serviceTag" maxlength="64" name="serial"
                                placeholder="Enter Serial" value="{{ old('serial') }}" required />
                            <small class="form-text">
                                <code>
                                    The Serial field cannot be duplicated
                               </code>
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Tipo de Pantalla:</label>
                            <select class="form-control" name="screen_type" required>
                                <option value="">Escoger...</option>
                                <option value="TFT">TFT</option>
                                <option value="IPS">IPS</option>
                                <option value="AMOLED">AMOLED</option>
                                <option value="OLED">OLED</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Retro Iluminación:</label>
                            <select class="form-control" name="backlight" required>
                                <option value="">Escoger...</option>
                                <option value="LED">LED</option>
                                <option value="LDC">LDC</option>
                                <option value="PLASMA">PLASMA</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Tipo de Conector:</label>
                            <select class="form-control" name="input_connector_type" required>
                                <option value="">Escoger...</option>
                                <option value="HDMI">HDMI</option>
                                <option value="VGA">VGA</option>
                                <option value="HDMI & VGA">HDMI & VGA</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Formato de Pantalla:</label>
                            <select class="form-control" name="screen_format" required>
                                <option value="">Escoger...</option>
                                <option value="4:3">4:3</option>
                                <option value="16:9">16:9</option>
                                <option value="16:9">16:9</option>
                                <option value="16:10">16:10</option>
                                <option value="21:9">21:9</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Máxima Resolución:</label>
                            <select class="form-control" name="maximum_resolution" required>
                                <option value="">Escoger...</option>
                                <option value="1024 x 768 Pixeles">1024 x 768 Pixeles</option>
                                <option value="1280 x 800 Pixeles">1280 x 800 Pixeles</option>
                                <option value="1280 x 1024 Pixeles">1280 x 1024 Pixeles</option>
                                <option value="1600 x 1200 Pixeles">1600 x 1200 Pixeles</option>
                                <option value="1920 x 1080 Pixeles">1920 x 1080 Pixeles</option>
                                <option value="1920 x 1024 Pixeles">1920 x 1024 Pixeles</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Fuente de Poder:</label>
                            <select class="form-control" name="power_supply" required>
                                <option value="">Escoger...</option>
                                <option value="DC 12v, 100-240V 50/60 HZ">DC 12v, 100-240V 50/60 HZ</option>
                                <option value="Cable 120 V">Cable 120 V</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <p class="h4 mb-1 text-gray-800">Informacion Corporativa</p>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label><code>*Placa Corporativa:</code></label>
                            <input type="text" class="form-control selectValidationNumber" name="license_plate" min="0"
                                maxlength="7" value="{{ old('license_plate') }}" placeholder="Enter 000*" required
                                autofocus>
                            <small class="form-text text-gray-600">
                                <code>The License Plate field cannot be duplicated</code>
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="alert alert-success">
                <p class="h4 mb-1 text-gray-800"></p>
                <i class="fa fa-link" aria-hidden="true"></i>

                <h2>Provider & Article Relation!</h2>
                <p>Seleccione un Provedor para obtener los articulos registrados y relacionados...</p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <h4>*Seleccione un Provedor:</h4>
                                <select class="form-control" name="provider" id="provider">
                                    <option value="">Select Provider</option>
                                    @foreach ($providers as $key => $value)
                                    <option value="{{ $key }}">{{ $value }} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <h4>*Seleccione un Articulo:</h4>
                                <select class="form-control" name="article_id" id="article">
                                    <option value="">Please Select Provider</option>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>*Ubicación del Monitor:</label>
                            <select class="form-control" name="location" required>
                                <option value="">Escoger...</option>
                                <option value="Bogota">Bogota</option>
                                <option value="Cundinamarca - Madrid">Cundinamarca - Madrid</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>*Estado del Monitor:</label>
                            <select class="form-control" name="status" v required>
                                <option value="Inactivo - No Asignado">Inactivo - No Asignado</option>
                            </select>
                            <small>
                                El estado Inactivo - No Asignado es seleccionado por el sistema
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Inicio de Garantía:</label>
                            <input type="date" class="form-control" name="warranty_start" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Fin de Garantía:</label>
                            <input type="date" class="form-control" name="warranty_end" required>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Agregado Por:</label>
                            <select class="form-control" name="user_id" required autofocus>
                                <option value="{{ auth()->user()->id }}">{{ auth()->user()->name }}</option>
                            </select>
                            <small class="form-text text-gray-600">
                                El usuario es detectado automáticamente por el sistema
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <p class="h4 mb-1 text-gray-800">Comentarios</p>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <textarea name="body" class="form-control" required autofocus></textarea>
                            <small class="form-text text-gray-600">
                                Ingrese algun comentario u observación
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Confirmacion Modal, Editar Computer -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEditMonitor">
                Enviar
            </button>
            <!-- Modal -->
            <div class="modal fade" id="modalEditMonitor" tabindex="-1" role="dialog" aria-labelledby="modalEditMonitor"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content card shadow mb-4">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="fa fa-times text-danger" aria-hidden="true"></i>
                                </span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col col-md-12">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-muted text-uppercase mb-1">
                                                    <strong>¿Editar Monitor?</strong>
                                                </div>
                                                <div class="p mb-0 font-weight text-gray-800">
                                                    <p>Atención!
                                                        <br>
                                                        {{ Auth::user()->name }}, ¿Desea actualizar el siguiente Monitor
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-laptop fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Close Modal -->
            <a href="#" class="btn btn-danger">Cancelar</a>
        </form>
    </div>
</section>
@endsection
@push('scripts')
<!-- Custom scripts-->
<script src="{{ asset('/core/js/select-brand-&-model-monitor-fix.js') }}"></script>
@endpush