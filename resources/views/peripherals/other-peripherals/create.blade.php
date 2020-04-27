@extends('layouts.dashboard')

@section('title', 'information-&-technologies')

@section('content')
@section('titlePosition', 'other-peripherals/create')

<style>
    input[type="text"],
    input[type="email"] textarea {
        background-color: #E9EFF7;
    }
</style>

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


        <form action="{{ route('peripherals.other-peripherals.store') }}" method="POST">
            @csrf

            <p class="h4 mb-1 text-gray-800">Peripherals Resume</p>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Tipo de Perisférico:</label>
                            <select class="form-control TipoDePerisfericoSeleccionado" name="type_device"
                                id="TipoDePerisfericoSeleccionado" onchange="cargarPerisferico();" required>
                                <option value="">Seleccione...</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Perisférico:</label>
                            <select id="perisferico" class="form-control" required name="type_other_peripherals">
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
                            <input type="text" class="form-control" maxlength="7" name="license_plate"
                                placeholder="Enter 000*" value="{{ old('license_plate') }}" required />
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
                                <option value="UPL Oficina - Bogota">UPL Oficina - Bogota</option>
                                <option value="UPL Oficina - Planta Madrid">UPL Oficina - Planta Madrid</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Estado:</label>
                            <select class="form-control" name="status" required autofocus>
                                <option value="">Escoger...</option>
                                <option value="Activo - Asignado">Activo</option>
                            </select>
                            <small class="form-text text-gray-600">
                                El estado es Activo por defecto
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            @if($articles->isEmpty())
                            <!-- 101 Error compañia no creada en el sistema -->
                            <div class="text-center">
                                <div class="error mx-auto" data-text="104">
                                    <p>104</p>
                                </div>
                                <p class="lead text-gray-800 mb-5">Error Articles No Found</p>
                                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                                    src="{{ asset('/core/undraw/error-feeling.svg') }}">
                                <br>
                                <p class="text-gray-800 mb-0">No se ha encotrado un Articulo registrado en el sistema,
                                    primero agrege una Articulo.

                                </p>

                                <a href="{{ route('articles.create') }}">&larr; Back to articles</a>
                            </div>
                            @else

                            <p class="h4 mb-1 text-gray-800">Invoice Provider</p>
                            <div class="alert alert-info">
                                <small class="form-text text-gray-600">
                                    Acontinuación relacionara los datos de facturación correspondiente a la compra del
                                    equipo de computo que va a registar
                                    en el sistema...
                                </small>
                            </div>

                            <div class="card mb-4 py-3 border-left-primary">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table
                                            class="table table-light  table-striped table-bordered table-sm  table-hover"
                                            id="table-articles" width="100%" cellspacing="0">
                                            <thead>
                                                <tr class="bg-gradient-primary text-white text-center">
                                                    <th></th>
                                                    <th><i class="fas fa-sort-numeric-down-alt"></i> ID:</th>
                                                    <th><i class="fa fa-landmark" aria-hidden="true"></i> ¿De que
                                                        Provedor?</th>
                                                    <th><i class="fa fa-file-invoice-dollar" aria-hidden="true"></i>
                                                        Número de
                                                        Factura</th>
                                                    <th><i class="fas fa-search-dollar"></i> Valor de Factura</th>
                                                    <th>Fecha de Factura</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($articles as $article)
                                                <tr class="text-center">
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-outline-primary btn-sm">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </td>
                                                    <th>{{ $article->id }}</th>
                                                    <td>{{ $article->provider->name }}</td>
                                                    <td>{{ $article->invoice_number }}</td>
                                                    <td>{{ $article->total_bill }}</td>
                                                    <td>
                                                        {{ Carbon\Carbon::parse($article->invoice_date)->format('l jS \\of F Y ') }}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="spinner-grow text-primary" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <div class="spinner-grow text-secondary" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <div class="spinner-grow text-success" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <div class="spinner-grow text-danger" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <div class="spinner-grow text-warning" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <div class="spinner-grow text-info" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <div class="spinner-grow text-light" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>

                                    <!-- hidden id_article -->
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" id="writeSelectIdArticle"
                                            name="article_id" required readonly>
                                    </div>
                                    <!-- end hidden id_article -->

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-row">

                                                <div class="form-group col-md-4">
                                                    <label><i class="fa fa-angle-double-right" aria-hidden="true"> </i>
                                                        Provedor</label>
                                                    <input type="text" class="form-control" maxlength="64"
                                                        id="writeSelectProvider" placeholder="Push Table" readonly />

                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label><i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                                        Número de Factura </i></label>
                                                    <input type="text" class="form-control" maxlength="64"
                                                        id="writeSelectInvoiceNumber" placeholder="Push Table"
                                                        readonly />

                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label><i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                                        Valor de Factura</label>
                                                    <input type="text" class="form-control" maxlength="64"
                                                        id="writeSelectInvoiceTotal" placeholder="Push Table"
                                                        readonly />

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="alert alert-warning">
                                        <small class="form-text text-gray-600">
                                            Seleccione un <code>Id</code> de la Tabla Invoice Provider, donde podra
                                            encontrar los
                                            datos de provedor y
                                            la facturación correspondiente
                                            a la compra del equipo de computo que va registrar en el sistema...
                                        </small>
                                    </div>

                                </div>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Inicio de Garantía:</label>
                            <input type="date" class="form-control" name="warranty_start" autofocus>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Fin de Garantía:</label>
                            <input type="date" class="form-control" name="warranty_end" autofocus>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>*Inicio de Garantía:</label>
                            <input type="date" class="form-control" name="warranty_start" autofocus>
                        </div>
                        <div class="form-group col-md-4">
                            <label>*Fin de Garantía:</label>
                            <input type="date" class="form-control" name="warranty_end" autofocus>
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

            <!-- Confirmacion Modal, Agregar Printer -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreatePrinter">
                Agregar
            </button>
            <!-- Modal -->
            <div class="modal fade" id="modalCreatePrinter" tabindex="-1" role="dialog"
                aria-labelledby="modalCreatePrinter" aria-hidden="true">
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
                                                    ¿Agregar Printer?
                                                </div>
                                                <div class="p mb-0 font-weight text-gray-800">
                                                    <p>Atención!
                                                        <br>
                                                        {{ Auth::user()->name }} <br>
                                                        ¿Desea registar la anterior impresora en el sistema?
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-print fa-2x text-gray-300"></i>
                                            </div>
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

<script>
    // Validacion: Solo permite escribir caracteres numericos
    $('.selectValidationNumber').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    $(document).ready(function () {
        $('#table-articles').DataTable();
    });

    // script  mediante un click en la tabla captura todos los valores y los pasa por un arreglo
    var table = document.getElementById('table-articles');

    for (var i = 1; i < table.rows.length; i++) {
        table.rows[i].onclick = function () {
            document.getElementById("writeSelectIdArticle").value = this.cells[1].innerHTML;
            document.getElementById("writeSelectProvider").value = this.cells[2].innerHTML;
            document.getElementById("writeSelectInvoiceNumber").value = this.cells[3].innerHTML;
            document.getElementById("writeSelectInvoiceTotal").value = this.cells[4].innerHTML;

        };

        function cargarElTipoDePerisfericoSeleccionado() {
            var array = ["Entrada", "Salida", "Mixto", "Almacenamiento", "Comunicacion"];
            array.sort();
            addOptions("TipoDePerisfericoSeleccionado", array);
        }

        //Función para agregar opciones a un <select>.
        function addOptions(domElement, array) {
            var selector = document.getElementsByClassName(domElement)[0];
            for (TipoDePerisfericoSeleccionado in array) {
                var opcion = document.createElement("option");
                opcion.text = array[TipoDePerisfericoSeleccionado];
                // Añadimos un value a los option para hacer mas facil escoger los perisfericos
                opcion.value = array[TipoDePerisfericoSeleccionado].toLowerCase()
                selector.add(opcion);
            }
        }

        function cargarPerisferico() {
            // Objeto de tipoDePerisfericos con perisfericos
            var listaPerisfericos = {
                entrada: ["Teclado", "Mouse"],
                salida: ["Video Beam"],
                mixto: ["Unidad de DVD"],
                almacenamiento: ["Disco Duro Extraible", "USB",],
                comunicacion: ["Acces Point", "Router", "Swicth", "Modem", "Nic"]
            }

            var tipoPerisfericos = document.getElementById('TipoDePerisfericoSeleccionado')
            var perisfericos = document.getElementById('perisferico')
            var perisfericoSeleccionado = tipoPerisfericos.value

            // Se limpian los perisfericos
            perisfericos.innerHTML = '<option value="">Seleccione un Perisferico...</option>'

            if (perisfericoSeleccionado !== '') {
                // Se seleccionan los perisfericos y se ordenan
                perisfericoSeleccionado = listaPerisfericos[perisfericoSeleccionado]
                perisfericoSeleccionado.sort()

                // Insertamos los perisfericos
                perisfericoSeleccionado.forEach(function (perisferico) {
                    let opcion = document.createElement('option')
                    opcion.value = perisferico
                    opcion.text = perisferico
                    perisfericos.add(opcion)
                });
            }

        }

        cargarElTipoDePerisfericoSeleccionado();
    }
</script>
@endsection