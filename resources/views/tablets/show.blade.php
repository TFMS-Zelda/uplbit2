@extends('layouts.dashboard') @section('title', 'information-&-technologies')
@section('content') @section('titlePosition', 'tablets/show')

<section class="content">
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Descripción Tablet Corporativa {{ $tablet->brand }}
                {{ $tablet->model }} <br>
            </h1>
        </div>

        <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                src="{{ asset('/core/undraw/tablet.svg') }}">
        </div>

        <h1 class="h3 mb-0 text-gray-800"> <i class="fas fa-tablet-alt"></i> Check List</h1>
        <p>
            Tablet Corporativa Marca <strong>{{ $tablet->brand }}</strong> y Módelo
            <strong>{{ $tablet->model }}</strong> de color {{ $tablet->color }}. <br>

            Registrada con el serial: <strong>{{ $tablet->serial }}</strong>. <br>

            Tiene una pantalla <strong>{{ $tablet->screen }}</strong>, con un procesador
            <strong>{{ $tablet->processor }}</strong> y una Memoria Ram de
            <strong>{{ $tablet->memory }}</strong>. <br>

            La camara principal es de <strong>{{ $tablet->camera }}</strong>, la bateria es de
            <strong>{{ $tablet->battery }}</strong>, integrado con el sistema operativo
            <strong>{{ $tablet->operating_system }}</strong>. <br>

            Posee lápiz optico: <strong>{{ $tablet->optical_pencil }}</strong> <br>

            <i class="fas fa-battery-three-quarters"></i> Tiene un cargador Módelo
            <strong>{{ $tablet->charger_model }}</strong> con serial <strong>{{ $tablet->charger_serial }}</strong>.
        </p>
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-sim-card"></i> Plan de Datos</h1>
        <p>
            <ul>
                <li><strong>Sim Card:</strong> {{ $tablet->sim_card }}</li>
                <li><strong>Pin:</strong> {{ $tablet->pin }}</li>
                <li><strong>IMEI:</strong> {{ $tablet->imei }}</li>
                <li><strong>Número de Teléfono:</strong> <i class="fas fa-phone"></i> {{ $tablet->phone_number }}</li>
            </ul>
        </p>



        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-info-circle"></i> Información</h1>
        <p>
            <ul>
                <li> <i class="fas fa-barcode"></i>
                    <strong>Placa Corporativa:</strong>
                    {{ $tablet->license_plate }}
                </li>
                <li>
                    @if ($tablet->status === 'Activo - Asignado')
                    <h5><span class="badge badge-success">{{ $tablet->status }} </->
                    </h5>

                    @elseif($tablet->status === 'Inactivo - No Asignado')
                    <h5><span class="badge badge-danger">{{ $tablet->status }} </span></h5>

                    @elseif($tablet->status === 'Dañado - Reportado')
                    <h5><span class="badge badge-dark">{{ $tablet->status }} </span></h5>
                    @endif
                </li>
                <li>
                    <strong>Garantia:</strong> desde el
                    <strong> {{ Carbon\Carbon::parse($tablet->warranty_start)->format('l jS \\of F Y ') }}</strong>
                    hasta el <strong>{{ Carbon\Carbon::parse($tablet->warranty_end)->format('l jS \\of F Y ') }}
                    </strong>
                </li>
                <li>
                    Se encuentra en la ciudad de <strong>{{ $tablet->location }}</strong>
                </li>
            </ul>
        </p>

        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-file-invoice-dollar"></i> Provedor y Facturación</h1>
        <div class="card shadow mb-4">
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
                aria-expanded="true" aria-controls="collapseCardExample">
                <p class="text-dark">
                    Factura Digital <br>
                    La Tablet Corporativa fue comprada desde el provedor
                    <strong>{{ $tablet->article->provider->name }}</strong>, con el número de factura
                    <strong>{{ $tablet->article->invoice_number }}</strong>, el día
                    {{ Carbon\Carbon::parse($tablet->article->invoice_date)->format('l jS \\of F Y ') }}</strong>
                </p>
            </a>
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
                    <embed src="/storage/Invoices-articles-providers/{{ $tablet->article->digital_invoice }}"
                        style="width:942px; height:768px;" frameborder="0">
                </div>
            </div>
        </div>

        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-history"></i> Historial y Trazabilidad</h1>
        <p> Acontinuación encontrara la trazabilidad de la Tablet Corporativa desde el día
            <strong>{{ Carbon\Carbon::parse($tablet->created_at)->format('l jS \\of F Y ') }}</strong>, fecha en
            la cúal se registro en el sistema.
        </p>
        <div class="row">
            <div class="col-md-12">
                <div class="form-row">

                    <div class="alert alert-secondary form-group col-md-12">
                        <!-- timeline comments -->
                        <div class="container">
                            @foreach ($tablet->comments as $comment)
                            <ul class="timeline">
                                <li>
                                    <!-- begin timeline-time -->
                                    <div class="timeline-time">
                                        <span class="date">
                                            {{ $comment->created_at->diffForHumans() }}</span>
                                        <span class="time">{{ $tablet->created_at->toDateTimeString() }}
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
                                            <br>

                                        </div>
                                        <div class="timeline-content">

                                            <div class="text-xm text-justify bg-gray-100">
                                                <p class="text-gray-800">{{ $comment->body }} </p>
                                            </div>
                                        </div>
                                        <div class="timeline-likes">
                                            <div class="stats-right">
                                                <span class="stats-text">{{ $tablet->id }}</span>
                                                <span class="stats-text">Ultima Actualizacion
                                                    <span class="time">{{ $tablet->created_at->toDateTimeString() }}
                                                    </span>
                                                </span>
                                                <br>

                                            </div>
                                            <div class="stats">
                                                <span class="stats-total">
                                                    <i class="fas fa-bell"></i>
                                                </span>
                                                <i class="fas fa-tablet"></i>
                                                <span class="stats-total">{{ $tablet->license_plate }}
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