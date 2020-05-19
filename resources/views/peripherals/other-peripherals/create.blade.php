@extends('layouts.dashboard')

@section('title', 'information-&-technologies')

@section('content')
@section('titlePosition', 'other-peripherals/create')

<section class="content">
    <div class="container-fluid">
        <h1 class="h3 mb-1 text-gray-800">Others Peripherals</h1>
        <p class="mb-4 text-justify">
            Complete el siguiente formulario, recuerde que los campos marcados con <strong>*</strong> son de caracter
            obligatorio.
        </p>

        <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                src="{{ asset('/core/undraw/other-peripherals.svg') }}">
        </div>

        <!-- import partials.errors-validation -->
        @include('partials.errors-validation')
        <!-- close import -->

        <form action="{{ route('peripherals.other-peripherals.store') }}" method="POST">
            @csrf

            <p class="h4 mb-1 text-gray-800">Peripherals Resume</p>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Tipo de Perisferico:</label>
                            <select class="form-control BrandSelectClass" name="type_device" id="brandSelectId"
                                onchange="cargarModelos()" required>
                                <option value="">Seleccione...</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>*Perisferico:</label>
                            <select class="form-control" name="type_other_peripherals" id="modelSelectId" required>
                                <option value="">Seleccione...</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Marca:</label>
                            <input type="text" class="form-control" maxlength="128" name="brand"
                                placeholder="Enter Brand" value="{{ old('brand') }}" required />
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Modelo:</label>
                            <input type="text" class="form-control" maxlength="128" name="model"
                                placeholder="Enter Model" value="{{ old('model') }}" required />
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Serial:</label>
                            <input type="text" class="form-control" maxlength="128" name="serial"
                                placeholder="Enter Serial" value="{{ old('serial') }}" required />
                            <small class="form-text text-gray-600">
                                The Serial field cannot be duplicated
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <p class="h4 mb-1 text-gray-800">Información Corporativa</p>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label><code>*Placa Corporativa:</code></label>
                            <input type="text" class="form-control selectValidationNumber" maxlength="7"
                                name="license_plate" placeholder="Enter 000*" value="{{ old('license_plate') }}"
                                required />
                            <small class="form-text text-gray-600">
                                <code>The Placa field cannot be duplicated</code>
                            </small>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Localización:</label>
                            <select class="form-control" name="location" required>
                                <option value="">Escoger...</option>
                                <option value="UPL Oficina - Bogota"
                                    {{ old('location') == 'UPL Oficina - Bogota' ? 'selected' : ''}}>
                                    UPL Oficina - Bogota</option>
                                <option value="UPL Oficina - Planta Madrid"
                                    {{ old('location') == 'UPL Oficina - Planta Madrid' ? 'selected' : ''}}>
                                    UPL Oficina - Planta Madrid</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Estado:</label>
                            <select class="form-control" name="status" required autofocus>
                                <option value="Inactivo - No Asignado"
                                    {{ old('status') == 'Inactivo - No Asignado' ? 'selected' : ''}}>Inactivo - No
                                    Asignado
                                </option>
                            </select>
                            <small class="form-text text-gray-600">
                                El estado es Inactivo - No Asignado por defecto
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="alert alert-primary">
                <p class="h4 mb-1 text-gray-800">Provider & Article Relation</p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="provider">*Seleccione un Provedor:</label>
                                <select class="form-control" name="provider" id="provider">
                                    <option value="">Select Provider</option>
                                    @foreach ($providers as $key => $value)
                                    <option value="{{ $key }}">{{ $value }} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="provider">*Seleccione un Articulo:</label>
                                <select class="form-control" name="article_id" id="article">
                                    <option value="">Please Select Provider</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Inicio de Garantía:</label>
                            <input type="date" class="form-control" value="{{ old('warranty_start') }}"
                                name="warranty_start" autofocus>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Fin de Garantía:</label>
                            <input type="date" class="form-control" value="{{ old('warranty_end') }}"
                                name="warranty_end" autofocus>
                        </div>
                    </div>
                </div>
            </div>

            <p class="h4 mb-1 text-gray-800">Descripción & características</p>
            <small>Detalle acontinuación la descripcion del perisferico adquirido...</small>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <textarea class="form-control" id="description" name="description_of_characteristics"
                                maxlength="1024" required
                                autofocus>{{ old('description_of_characteristics') }}</textarea>
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

            <!-- Confirmacion Modal, Agregar Printer -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreateOthePeripherals">
                Agregar
            </button>
            <!-- Modal -->
            <div class="modal fade" id="modalCreateOthePeripherals" tabindex="-1" role="dialog"
                aria-labelledby="modalCreateOthePeripherals" aria-hidden="true">
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
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    ¿Agregar Perisferico?
                                                </div>
                                                <div class="p mb-0 font-weight text-gray-800">
                                                    <p>Atención!
                                                        <br>
                                                        {{ Auth::user()->name }} <br>
                                                        ¿Desea registar el anterior perisferico en el sistema?
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fa fa-search-minus fa-2x" aria-hidden="true"></i> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Registrar</button>
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
<script src="{{ asset('/core/js/select-brand-&-model-otherPeripheral-fix.js') }}"></script>
<script src="{{ asset('/core/plugins/ckeditor/ckeditor.js') }}"></script>
<script>
    // CkEditor
    CKEDITOR.config.heigth = 400;
    CKEDITOR.config.width = 'auto';
    CKEDITOR.replace('description');
</script>
<script src="{{ asset('/core/js/selectValidationNumber.js') }}"></script>
@endpush