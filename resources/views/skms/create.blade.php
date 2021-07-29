@extends ('layouts.dashboard')
@section('title', 'information-&-technologies')
@section('content')
@section('titlePosition', 'computers/create')

<section class="content">
    <div class="container-fluid">
        <h1 class="h3 mb-1 text-gray-800">Agregar Articulo Helpfile</h1>
        <p class="mb-4 text-justify">
            Complete el siguiente formulario, recuerde que los campos marcados con <strong>*</strong> son de caracter
            obligatorio.
        </p>

        <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;"
                src="{{ asset('/core/undraw/add_files.svg') }}">
        </div>

        <!-- import partials.errors-validation -->
        @include('partials.errors-validation')
        <!-- close import -->

        <!-- start form companies.store -->
        <form action="{{ route('skms.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <p class="h4 mb-1 text-gray-800">Resumen & Clasificación</p>

            <div class="alert bg-gradient-light">
                <p class="h4 mb-1 text-gray-800"></p>
                <i class="fa fa-lightbulb" aria-hidden="true"></i>

                <h2><i>Clasificación Árticulo Helpfile Knowledge</i>!</h2>
                <p>*Seleccione el tipo de clasificación del documento!</p>
                <div class="row">
                    <div class="form-group col-md-12">
                        <select name="classification_file" class="form-control" required>
                            <option value="">Escoger...</option>
                            <option value="KEDB (Error conocido)" {{ old('classification_file') == 'KEDB (Error conocido)' ? 'selected' : '' }}>
                                KEDB (Error conocido)
                            </option>
                            <option value="CMS (Contiene información de una gestión de la configuración).A.CMS (Contiene información de una gestión de la configuración)" {{ old('classification_file') == 'S.A.S' ? 'selected' : '' }}>
                                CMS (Contiene información de una gestión de la configuración)
                            </option>
                            <option value="CMDB (Hace parte de un componentes de hardware y software)" {{ old('classification_file') == 'CMDB (Hace parte de un componentes de hardware y software)' ? 'selected' : '' }}>
                                CMDB (Hace parte de un componentes de hardware y software)
                            </option>
                            <option value="Incidente (Interrupción no planificada a un servicio de TI)" {{ old('classification_file') == 'Incidente (Interrupción no planificada a un servicio de TI)' ? 'selected' : '' }}>
                                Incidente (Interrupción no planificada a un servicio de TI)
                            </option>
                            <option value="Proceso" {{ old('classification_file') == 'Proceso' ? 'selected' : '' }}>
                                Proceso
                            </option>
                            <option value="Conocimiento de fuentes externas" {{ old('classification_file') == 'Conocimiento de fuentes externas' ? 'selected' : '' }}>
                                Conocimiento de fuentes externas
                            </option>
                        </select>
                    </div>
                </div>

                <p>*Seleccione la categoría del documento a vincular!</p>
                <div class="row">
                    <div class="form-group col-md-12">
                        <select name="category_file" class="form-control" required>
                            <option value="">Escoger...</option>
                            <option value="Infraestructura, Redes & Equipos Activos" {{ old('category_file') == 'Infraestructura, Redes & Equipos Activos' ? 'selected' : '' }}>
                                Infraestructura, Redes & Equipos Activos
                            </option>
                            <option value="Hardware, Mantenimiento de equipos de computo" {{ old('category_file') == 'Hardware, Mantenimiento de equipos de computo' ? 'selected' : '' }}>
                                Hardware, Mantenimiento de equipos de computo
                            </option>
                            <option value="Software, Sistema Operativo, Sop & Fix" {{ old('category_file') == 'Software, Sistema Operativo, Sop & Fix' ? 'selected' : '' }}>
                                Software, Sistema Operativo, Sop & Fix
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>*Nombre del Árticulo Helpfile Knowledge:</label>
                            <input type="text" class="form-control" name="name_file" maxlength="128"
                                value="{{ old('servicetag') }}" placeholder="Ingrese Nombre Knowledge" required autofocus
                                onkeyup="javascript:this.value=this.value.toUpperCase();">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Fecha de creación:</label>
                            <input type="date" class="form-control" name="creation_date"
                                value="{{ old('creation_date') }}" required autofocus>
                        </div>
                    </div>
                </div>
            </div>

            <p> <i class="fa fa-bug" aria-hidden="true"></i>
                *Nível de impacto:
            </p>
                <div class="row">
                    <div class="form-group col-md-2">
                        <select name="impact_level" class="form-control" required>
                            <option value="">Escoger...</option>
                            <option value="Bajo" {{ old('impact_level') == 'Bajo' ? 'selected' : '' }}>
                                Bajo
                            </option>
                            <option value="Medio" {{ old('impact_level') == 'Medio' ? 'selected' : '' }}>
                                Medio
                            </option>
                            <option value="Alto" {{ old('impact_level') == 'Alto' ? 'selected' : '' }}>
                                Alto
                            </option>
                        </select>
                    </div>
                </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>*Creado Por:</label>
                            <select class="form-control" name="user_id" required autofocus>
                                <option value="{{ auth()->user()->id }}">{{ auth()->user()->name }}</option>
                            </select>
                            <code>
                                <small class="form-text text-red-600">
                                    El usuario es detectado automáticamente por el sistema...
                                </small>
                            </code>
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
                            <code>
                                <small class="form-text text-gray-600">
                                    Ingrese algun comentario u observación...
                                </small>
                            </code>
                        </div>
                    </div>
                </div>
            </div>


            <i class="fa fa-file" aria-hidden="true"></i>

            <h2><i>Importar Árticulo Helpfile Knowledge</i></h2>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>*Número o codigo del Árticulo Helpfile Knowledge:</label>
                            <input type="text" class="form-control" name="code_file" maxlength="128"
                                value="{{ old('code_file') }}" placeholder="Enter Number o Code" required autofocus
                                onkeyup="javascript:this.value=this.value.toUpperCase();">
                           <code>
                            <small class="form-text text-gray-600">
                                The  code number field cannot be duplicated
                            </small>
                           </code>
                        </div>
                    </div>

                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 10rem;"
                        src="{{ asset('/core/undraw/share-link.svg') }}">

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="alert alert-warning">
                                <small class="form-text text-muted">
                                    Importe el documento Helpfile Knowledge. <br>
                                    <strong>Nota:</strong> Solo esta permitido en formado PDF con un
                                    tamaño máximo de 5 MB
                                </small>
                            </div>

                            <br>
                            <input type="file" class="form-control col-md-12" name="digital_file"
                                accept="file/PDF, image/PDF" required>
                        </div>
                    </div>
                    <p> <i class="fa fa-flag" aria-hidden="true"></i>
                        *Estado:
                    </p>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <select name="status" class="form-control" required>
                                    <option value="En revision" {{ old('status') == 'En revision' ? 'selected' : '' }}>
                                        En revision
                                    </option>
                                </select>
                                <code>
                                    <small class="form-text text-red-600">
                                        El Estado "En revision" es definido automaticamente...
                                    </small>
                                </code>
                            </div>
                        </div>
                </div>

            </div>


            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreateSkms">
                Enviar
            </button>

            <!-- Modal  modalCreateSkms-->
            <div aria-hidden="true" aria-labelledby="modalCreateSkms" class="modal fade" id="modalCreateSkms"
                role="dialog" tabindex="-1">
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
                                                    ¿Articulo Helpfile Knowledge?
                                                </div>
                                                <div class="p mb-0 font-weight text-gray-800">
                                                    <p>
                                                        Atención!
                                                        <br>
                                                        {{ Auth::user()->name }}
                                                        <br>
                                                        ¿Desea registrar el siguiente Árticulo Helpfile Knowledge en la SKMS del sistema?
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-file fa-2x text-gray-300">
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
    </div>


</section>
@endsection
