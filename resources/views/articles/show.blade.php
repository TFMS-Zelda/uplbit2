@extends('layouts.dashboard')
@section('title', 'information-&-technologies')
@section('content')
@section('titlePosition', 'articles/show')
<section class="content">
    <div class="container-fluid">
        <h1 class="h3 mb-0 text-gray-800">Facturación</h1>
        <h1 class="h3 mb-0 text-gray-800">Provedor {{ $article->provider->name }}</h1>

        <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                src="{{ asset('/core/undraw/invoice.svg') }}">
        </div>

        <div class="row">

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Número de Factura
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $article->invoice_number }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-file-invoice fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total de Factura
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">${{ $article->total_bill }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Compra para el
                                    área
                                    de:</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                            {{ $article->area }}
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Provedor
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $article->provider->name }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-briefcase fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
                aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Detalles</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
                    <p>
                        <ul>
                            <li>
                                <strong>Número de Remision:</strong>
                                {{ $article->remission }}
                            </li>
                            <li>
                                <strong>Número de Cotización:</strong>
                                {{ $article->quotation }}
                            </li>
                            <li>
                                <strong>Fecha de Factura:</strong>
                                {{ Carbon\Carbon::parse($article->date_invoices)->format('l jS \\of F Y ') }}</strong>
                            </li>
                        </ul>
                    </p>
                </div>
            </div>
        </div>
        <h1 class="h3 mb-0 text-gray-800">Observaciones y Descripción</h1>
        <textarea id="observations" disabled>
            {{ $article->observations }}
        </textarea>
        <small>
            <strong>
                Total de Factura: {{ $article->total_in_letters }}
            </strong>
        </small>


        <div class="card shadow mb-4">
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
                aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">
                    Factura Digital: <code>{{ $article->digital_invoice }}</code>
                </h6>

            </a>
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
                    <embed src="/storage/Invoices-articles-providers/{{ $article->digital_invoice }}"
                        style="width:942px; height:768px;" frameborder="0">
                </div>
            </div>
        </div>
        <hr>
        Log...
        <p>
            Registrado en el sistema por el usuario: <strong>{{ $article->user->name }} ~
                {{ $article->user->email }}</strong> <br>
            Articulo registrado en el sistema el día:
            <strong>{{ Carbon\Carbon::parse($article->created_at)->format('l jS \\of F Y ') }}</strong>... <br>
            Última actualización realizada el día:
            <strong>{{ Carbon\Carbon::parse($article->updated_at)->format('l jS \\of F Y ') }}</strong>... <br>
        </p>
</section>
@endsection
@push('scripts')
<!-- import script fixFormatMoneyAutoNumeric  -->
<script src="{{ asset('/core/plugins/ckeditor/ckeditor.js') }}"></script>
<script>
    // CkEditor
    CKEDITOR.config.heigth = 400;
    CKEDITOR.config.width = 'auto';
    CKEDITOR.replace('observations');
</script>
@endpush