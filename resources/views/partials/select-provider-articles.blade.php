<div class="row">
    <div class="col-md-12">
        <div class="form-row">
            <div class="form-group col-md-12">
                @if($articles->isEmpty())
                <div class="text-center">
                    <div class="error mx-auto" data-text="103">
                        <p>104</p>
                    </div>
                    <p class="lead text-gray-800 mb-5">Error Articles No Found</p>
                    <p class="text-gray-800 mb-0">No se ha encotrado un Articulo registrado en el sistema,
                        primero agrege una Articulo.
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                            src="{{ asset('/core/undraw/error-feeling.svg') }}">
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

                <div class="card mb-4 py-3 border-left-dark">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-light  table-striped table-bordered table-sm  table-hover"
                                id="table-articles" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="bg-gradient-dark text-white text-center">
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
                            <input type="hidden" class="form-control" id="writeSelectIdArticle" name="article_id"
                                required readonly>
                        </div>
                        <!-- end hidden id_article -->

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-row">

                                    <div class="form-group col-md-4">
                                        <label><i class="fa fa-angle-double-right" aria-hidden="true"> </i>
                                            Provedor</label>
                                        <input type="text" class="form-control" maxlength="64" id="writeSelectProvider"
                                            placeholder="Push Table" readonly />

                                    </div>

                                    <div class="form-group col-md-4">
                                        <label><i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                            Número de Factura: </i></label>
                                        <input type="text" class="form-control" maxlength="64"
                                            id="writeSelectInvoiceNumber" placeholder="Push Table" readonly />

                                    </div>
                                    <div class="form-group col-md-4">
                                        <label><i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                            Valor de Factura</label>
                                        <input type="text" class="form-control" maxlength="64"
                                            id="writeSelectInvoiceTotal" placeholder="Push Table" readonly />

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-warning">
                            <small class="form-text text-gray-600">
                                Seleccione un Id de la Tabla Invoice Provider, donde podra encontrar los
                                datos del provedor y
                                la facturacioón correspondiente
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