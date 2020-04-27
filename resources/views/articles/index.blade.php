@extends ('layouts.dashboard')

@section('title', 'information-&-technologies')

@section('content')
@section('titlePosition', 'companies')
<section class="content">
    <div class="container-fluid">
        <h1 class="h3 mb-1 text-gray-800">Articulos Registrados</h1>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2 bg-success">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                    Total de Compras
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-white">
                                    {{ $totalArticlesRegister }} </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-cart-arrow-down fa-2x text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2 bg-info">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Costo Total
                                    Registrado
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-white">$215,000</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                src="{{ asset('/core/undraw/company.svg') }}">
        </div>

        <div class="card mb-4 py-3 border-left-primary">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="table-responsive">
                        <table class="table table-light  table-striped table-bordered table-sm  table-hover"
                            id="table-articles" width="100%" cellspacing="0">
                            <thead>
                                <tr class="bg-gradient-primary text-white text-center">
                                    <th>ID:</th>
                                    <th>Provedor:</th>
                                    <th>Número de Factura:</th>
                                    <th>Valor de Factura:</th>
                                    <th>Fecha de Factura</th>
                                    <th>¿Registrado Por?:</th>
                                    <th>Acciones:</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($articles as $article)
                                <tr class="text-center">
                                    <td>
                                        <i class="fas fa-sort-numeric-down-alt"></i><br>
                                        <strong>{{ $article->id }}</strong>

                                    </td>
                                    <td>
                                        <i class="fa fa-landmark" aria-hidden="true"></i>
                                        <br>
                                        <small>
                                            {{ $article->provider->name }} {{ $article->provider->kind_of_society }}
                                        </small>
                                    </td>

                                    <td>
                                        <i class="fas fa-cart-arrow-down fa-1x text-muted"></i> <br>
                                        <small><b>Invoice: {{ $article->invoice_number }} </b></small>

                                    </td>
                                    <td>
                                        <code> <i class="fas fa-dollar-sign"></i> {{ $article->total_bill }}</code>

                                    </td>
                                    <td>
                                        <div class="mb-0 font-weight-bold text-gray-700">
                                            <i class="fas fa-clock"></i><br>
                                            <small>{{ Carbon\Carbon::parse($article->invoice_date)->format('l jS \\of F Y ') }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <img src="{{ $article->user->avatar }}" class="rounded" alt="profile-image"
                                            width="35px">
                                        <small><u>{{ $article->user->name }}</u></small><br>
                                        <i class="fas fa-history"></i>
                                        <small>{{ $article->created_at->diffForHumans() }}</small>

                                    </td>
                                    <td>
                                        @can('permission:articles.show')
                                        <a href="{{ route('articles.show', $article->id) }}"
                                            class="btn btn-success btn-circle btn-sm">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                        @endcan


                                        @can('permission:articles.edit')
                                        <a href="{{ route('articles.edit', $article->id) }}"
                                            class="btn btn-warning btn-circle btn-sm">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </a>
                                        @endcan

                                        @can('permission:articles.destroy')
                                        <form action="{{ route('articles.destroy', $article->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-circle btn-sm">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @can('permission:articles.create')
                    <a href="{{ route('articles.create') }}" class="btn btn-secondary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-arrow-right"></i>
                        </span>
                        <span class="text">Add Article</span>
                    </a>
                    @endcan
                </div>
            </div>
        </div>
</section>
@endsection
@push('scripts')
<script src="{{ asset('/core/plugins/DataTables/datatables.min.js') }}"></script>
<script>
    $(document).ready(function () {
          $('#table-articles').DataTable();
      });
        document.onsubmit = function () {
          return confirm('Atencion: {{ Auth::user()->name }}, ¿Esta seguro de eliminar el siguiente articulo del sistema?');
      }
  </script>
@endpush