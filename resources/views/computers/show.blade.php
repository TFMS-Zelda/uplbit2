@extends('layouts.dashboard') @section('title', 'information-&-technologies')
@section('content') @section('titlePosition', 'computers/show')

<section class="content">
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Descripción Equipo de computo {{ $computer->brand }}
                {{ $computer->model }} <br>
            </h1>
        </div>

        <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                src="{{ asset('/core/undraw/computer.svg') }}">
        </div>

        <h1 class="h3 mb-0 text-gray-800"> <i class="fas fa-compress-alt"></i> Check List</h1>
        <p>
            Equipo de computo Marca: <strong>{{ $computer->brand }}</strong> y Módelo
            <strong>{{ $computer->model }}</strong>. <br>

            Registrado con el ServiceTag: <strong>{{ $computer->servicetag }}</strong> y Codigo Express
            <strong>{{ $computer->servicecode }}</strong> <br>

            Posee un sistema operativo <strong>{{ $computer->operating_system }}</strong>, con una capacidad
            de
            <strong>{{ $computer->hard_drive }}</strong> de almacenamiento interno. <br>

            Tiene un Procesador <strong>{{ $computer->processor }}</strong> y una Memoria Ram de
            <strong>{{ $computer->memory_ram }}</strong>. <br>

            <i class="fas fa-battery-three-quarters"></i> El equipo de computo tiene un cargador Módelo
            <strong>{{ $computer->charger_model }}</strong> con serial <strong>{{ $computer->charger_serial }}</strong>.
        </p>
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-laptop"></i> Configuración</h1>
        <p>
            <ul>
                <li><strong>Hostname:</strong> {{ $computer->hostname }}</li>
                <li><strong>Grupo de Trabajo:</strong> {{ $computer->workgroup }}</li>
                <li><strong>Dominio:</strong> {{ $computer->domain_name }}</li>
                <li><strong>Licenciamiento:</strong> {{ $computer->license }}</li>
            </ul>
        </p>
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-info-circle"></i> Información</h1>
        <p>
            <ul>
                <li> <i class="fas fa-barcode"></i>
                    <strong>Placa Corporativa:</strong>
                    {{ $computer->license_plate }}
                </li>
                <li>
                    @if ($computer->status === 'Activo - Asignado')
                    <h5><span class="badge badge-success">{{ $computer->status }} </span></h5>

                    @elseif($computer->status === 'Inactivo - No Asignado')
                    <h5><span class="badge badge-danger">{{ $computer->status }} </span></h5>

                    @elseif($computer->status === 'Dañado - Reportado')
                    <h5><span class="badge badge-dark">{{ $computer->status }} </span></h5>
                    @endif
                </li>
                <li>
                    <strong>Garantia:</strong> desde el
                    <strong> {{ Carbon\Carbon::parse($computer->warranty_start)->format('l jS \\of F Y ') }}</strong>
                    hasta el <strong>{{ Carbon\Carbon::parse($computer->warranty_end)->format('l jS \\of F Y ') }}
                    </strong>
                </li>
            </ul>
        </p>

        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-file-invoice-dollar"></i> Provedor y Facturación</h1>


        @if (is_null($computer->article_id))
        <div class="alert alert-danger">
            <p class="h4 mb-1 text-gray-800"></p>
            <i class="fa fa-bell fa-2x" aria-hidden="true"></i>

            <h2>Provider & Article No Encontrado!</h2>
            <p>El siguiente equipo de computo no presenta ninguna compra relacionada con
                un provedor de TI...</p>
        </div>

        @else
        <div class="card shadow mb-4">
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
                aria-expanded="true" aria-controls="collapseCardExample">
                <p class="text-dark">
                    Factura Digital <br>
                    El equipo de computo a sido comprado desde el provedor
                    <strong>{{ $computer->article->provider->name }}</strong>, con el número de factura
                    <strong>{{ $computer->article->invoice_number }}</strong>, el día
                    {{ Carbon\Carbon::parse($computer->article->invoice_date)->format('l jS \\of F Y ') }}</strong>
                </p>
            </a>

            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
                    <embed src="/storage/Invoices-articles-providers/{{ $computer->article->digital_invoice }}"
                        style="width:942px; height:768px;" frameborder="0">
                </div>
            </div>

        </div>
        @endif


        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-history"></i> Historial y Trazabilidad</h1>
        <p> Acontinuación encontrara la trazabilidad del equipo de computo desde el día
            <strong>{{ Carbon\Carbon::parse($computer->created_at)->format('l jS \\of F Y ') }}</strong>, fecha en
            la cúal el equipo de computo se registro en el sistema.
        </p>
        <div class="row">
            <div class="col-md-12">
                <div class="form-row">

                    <div class="alert alert-secondary form-group col-md-12">
                        <!-- timeline comments -->
                        <div class="container">
                            @foreach ($computer->comments as $comment)
                            <ul class="timeline">
                                <li>
                                    <!-- begin timeline-time -->
                                    <div class="timeline-time">
                                        <span class="date">
                                            {{ $comment->created_at->diffForHumans() }}</span>
                                        <span class="time">{{ $computer->created_at->toDateTimeString() }}
                                        </span>
                                    </div>
                                    <!-- end timeline-time -->
                                    <!-- begin timeline-icon -->
                                    <div class="timeline-icon">
                                        <a href="javascript:;">&nbsp;</a>
                                    </div>
                                    <!-- end timeline-icon -->
                                    <!-- begin timeline-body -->
                                    <div class="timeline-body">
                                        <div class="timeline-header">
                                            <span class="userimage"><img src="{{ $comment->user->avatar }} "
                                                    alt=""></span>
                                            <span class="username"><a href="javascript:;">{{ $comment->user->name }}
                                                </a>
                                                <small></small></span>
                                            <span class="pull-right text-muted">
                                                {{ $comment->user->email }}
                                            </span>
                                        </div>
                                        <div class="timeline-content">

                                            <div class="text-xm text-justify bg-gray-100">
                                                <p class="text-gray-800">{{ $comment->body }} </p>
                                            </div>

                                        </div>
                                        <div class="timeline-likes">
                                            <div class="stats-right">
                                                <span class="stats-text">{{ $computer->id }}</span>
                                                <span class="stats-text">Ultima Actualizacion
                                                    <span class="time">{{ $computer->created_at->toDateTimeString() }}
                                                    </span>

                                                </span>
                                            </div>
                                            <div class="stats">
                                                <span class="stats-total">
                                                    <i class="fas fa-bell"></i>
                                                </span>
                                                <i class="fas fa-laptop"></i>
                                                <span class="stats-total">{{ $computer->license_plate }}
                                                </span>
                                            </div>
                                        </div>
                                        <small>
                                            Comment {{ $comment->id }}
                                        </small>
                                    </div>
                                    <!-- end timeline-body -->
                                </li>
                            </ul>
                            @endforeach

                        </div>
                        <!-- end timeline -->
                    </div>
                    <!-- end comentarios -->
                </div>
            </div>
        </div>

    </div>
</section>
@endsection