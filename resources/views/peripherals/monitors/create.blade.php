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
                                <option value="">Seleccione...</option>

                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>*Módelo:</label>
                            <select class="form-control" name="model" id="modelSelectId" required>
                                <option value="">Seleccione...</option>
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
                            <input type="text" class="form-control" maxlength="64" name="serial"
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
                                <option value="TFT" {{ old('screen_type') == 'TFT' ? 'selected' : ''}}>TFT</option>
                                <option value="IPS" {{ old('screen_type') == 'IPS' ? 'selected' : ''}}>IPS</option>
                                <option value="AMOLED" {{ old('screen_type') == 'AMOLED' ? 'selected' : ''}}>AMOLED
                                </option>
                                <option value="OLED" {{ old('screen_type') == 'OLED' ? 'selected' : ''}}>OLED</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Retro Iluminación:</label>
                            <select class="form-control" name="backlight" required>
                                <option value="">Escoger...</option>
                                <option value="LED" {{ old('backlight') == 'LED' ? 'selected' : ''}}>LED</option>
                                <option value="LDC" {{ old('backlight') == 'LDC' ? 'selected' : ''}}>LDC</option>
                                <option value="PLASMA" {{ old('backlight') == 'PLASMA' ? 'selected' : ''}}>PLASMA
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Tipo de Conector:</label>
                            <select class="form-control" name="input_connector_type" required>
                                <option value="">Escoger...</option>
                                <option value="HDMI" {{ old('input_connector_type') == 'HDMI' ? 'selected' : ''}}>HDMI
                                </option>
                                <option value="VGA" {{ old('input_connector_type') == 'VGA' ? 'selected' : ''}}>VGA
                                </option>
                                <option value="HDMI & VGA"
                                    {{ old('input_connector_type') == 'HDMI & VGA' ? 'selected' : ''}}>
                                    HDMI & VGA</option>
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
                                <option value="4:3" {{ old('screen_format') == '4:3' ? 'selected' : ''}}>4:3</option>
                                <option value="16:9" {{ old('screen_format') == '16:9' ? 'selected' : ''}}>16:9</option>
                                <option value="16:10" {{ old('screen_format') == '16:10' ? 'selected' : ''}}>16:10
                                </option>

                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Máxima Resolución:</label>
                            <select class="form-control" name="maximum_resolution" required>
                                <option value="">Escoger...</option>
                                <option value="1024 x 768 Pixeles"
                                    {{ old('maximum_resolution') == '1024 x 768 Pixeles' ? 'selected' : ''}}>1024 x 768
                                    Pixeles
                                </option>
                                <option value="1280 x 800 Pixeles"
                                    {{ old('maximum_resolution') == '1280 x 800 Pixeles' ? 'selected' : ''}}>1280 x 800
                                    Pixeles
                                </option>
                                <option value="1280 x 1024 Pixeles"
                                    {{ old('maximum_resolution') == '1280 x 1024 Pixeles' ? 'selected' : ''}}>1280 x
                                    1024
                                    Pixeles</option>
                                <option value="1600 x 1200 Pixeles"
                                    {{ old('maximum_resolution') == '1600 x 1200 Pixeles' ? 'selected' : ''}}>1600 x
                                    1200
                                    Pixeles</option>
                                <option value="1920 x 1080 Pixeles"
                                    {{ old('maximum_resolution') == '1920 x 1080 Pixeles' ? 'selected' : ''}}>1920 x
                                    1080
                                    Pixeles</option>
                                <option value="1920 x 1024 Pixeles"
                                    {{ old('maximum_resolution') == '1920 x 1024 Pixeles' ? 'selected' : ''}}>1920 x
                                    1024
                                    Pixeles</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Fuente de Poder:</label>
                            <select class="form-control" name="power_supply" required>
                                <option value="">Escoger...</option>
                                <option value="DC 12v, 100-240V 50/60 Hz"
                                    {{ old('power_supply') == 'DC 12v, 100-240V 50/60 Hz' ? 'selected' : ''}}>DC 12v,
                                    100-240V 50/60 Hz
                                <option value="Cable 120 V" {{ old('power_supply') == 'Cable 120 V' ? 'selected' : ''}}>
                                    Cable 120 V
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
                                <option value="Bogota" {{ old('location') == 'Bogota' ? 'selected' : ''}}>Bogota
                                </option>
                                <option value="Cundinamarca - Madrid"
                                    {{ old('location') == 'Cundinamarca - Madrid' ? 'selected' : ''}}>Cundinamarca -
                                    Madrid</option>
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
                            <select class="form-control" name="status" required>
                                <option value="Inactivo - No Asignado"
                                    {{ old('status') == 'Inactivo - No Asignado' ? 'selected' : ''}}>Inactivo - No
                                    Asignado
                                </option>
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
                            <input type="date" class="form-control" name="warranty_start"
                                value="{{ old('warranty_start') }}" required autofocus>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Fin de Garantía:</label>
                            <input type="date" class="form-control" name="warranty_end"
                                value="{{ old('warranty_end') }}" required autofocus>
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
                            <textarea name="body" class="form-control" required autofocus>{{ old('body') }}</textarea>
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
<script src="{{ asset('/core/js/selectValidationNumber.js') }}"></script>
@endpush