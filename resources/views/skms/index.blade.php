@extends ('layouts.dashboard')

@section('title', 'information-&-technologies')

@section('content')
@section('titlePosition', 'SKMS')

<section class="content">
    <div class="container-fluid">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
              <h1 class="display-4">SKMS - Gestión del conocimiento</h1>
              <p class="lead">Depósito central de datos, información & conocimiento</p>
            </div>
          </div>


        <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 20rem;"
                src="{{ asset('/core/undraw/book.svg') }}">
        </div>

                @can('permission:skms.create')
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Árticulos Helpfile Knowledge</h1>
                    <a href="{{ route('skms.create') }}"
                        class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm"><i class="fas fa-puzzle-piece fa-sm"></i>
                        Add Helpfile Knowledge...</a>
                </div>
                @endcan

                <p class="text-gray-900">
                    Actualmente hay <i class="fa fa-file" aria-hidden="true"></i> <strong>{{  $articlesKnowledge }} </strong>
                    Árticulo Helpfile Knowledge...
                </p>

                <div class="table-responsive">
                    <table class="table table-light  table-striped table-bordered table-sm  table-hover" id="table-skms"
                        width="100%" cellspacing="0">
                        <thead>
                            <tr class="bg-gradient-primary text-white text-center">
                                <th>ID:</th>
                                <th>Nombre & Clasificación Knowledge:</th>
                                <th>Categoría:</th>
                                <th>Fecha de creación </th>
                                <th>Nível de Impacto:</th>
                                <th>Código del Documento:</th>
                                <th>Estado</th>
                                <th>Actions:</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($skms as $skms_item)
                            <tr class="text-center">
                                <td>
                                    <div class="col-auto text-center">
                                        <i class="fas fa-sort-numeric-down-alt"></i><br>
                                        <i class="fas fa-file"></i>
                                       <strong> {{ $skms_item->id }}</strong>
                                    </div>
                                </td>
                                <td>
                                    <div class="h6 mb-0 font-weight-bold text-muted">
                                        {{ $skms_item->name_file }} <br>

                                       <small> <code>{{ $skms_item->classification_file }}</code></small>

                                    </div>
                                </td>
                                <td>
                                    <div class="h6 mb-0 font-weight-bold text-muted">
                                     {{ $skms_item->category_file }}
                                    </div>
                                </td>
                                <td>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <span class="badge badge-primary">{{ $skms_item->creation_date }}</span>
                                </td>
                                <td>
                                    <div class="h6 mb-0 font-weight-bold text-muted">
                                        @if ($skms_item->impact_level == 'Alto' )
                                        <i class="fa fa-bug" aria-hidden="true"></i>
                                        <h5><span class="badge badge-danger">{{ $skms_item->impact_level }}</span></h5>
                                        @elseif ($skms_item->impact_level == 'Medio' )
                                        <i class="fa fa-bug" aria-hidden="true"></i>
                                        <h5><span class="badge badge-warning">{{ $skms_item->impact_level }}</span></h5>
                                        @else
                                        <i class="fa fa-bug" aria-hidden="true"></i>
                                        <h5><span class="badge badge-primary">{{ $skms_item->impact_level }}</span></h5>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <i class="fa fa-barcode" aria-hidden="true"></i>
                                    <div class="h6 mb-0 font-weight-bold text-muted">
                                        {{ $skms_item->code_file }}
                                    </div>
                                </td>
                                <td>
                                    @if ($skms_item->status == 'Aprovado')
                                    <h5><span class="badge badge-primary">
                                        <i class="fas fa-check-circle"></i>
                                        &nbsp;{{ $skms_item->status }}
                                        </span>
                                    </h5>
                                    @elseif ($skms_item->status == 'En revision')
                                    <h5><span class="badge badge-warning">
                                        <i class="fas fa-exclamation-circle"></i>&nbsp;{{ $skms_item->status }}
                                        </span>
                                    </h5>
                                    @else
                                    <h5><span class="badge badge-danger">
                                        <i class="fas fa-window-close"></i>
                                        &nbsp;{{ $skms_item->status }}
                                        </span>
                                    </h5>
                                    @endif
                                        <div class="h6 mb-0 font-weight-bold text-muted">
                                            Última actualización realizada: <br> {{ $skms_item->updated_at->diffForHumans() }}
                                        </div>

                                </td>
                                <td>
                                    @can('permission:skms.show')
                                    <a href="{{ route('skms.show', $skms_item->id) }}"
                                        class="btn btn-success btn-circle btn-sm">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    @endcan

                                    @can('permission:skms.edit')
                                    @if ($skms_item->status === 'En revision')

                                    @else
                                    <a href=""
                                        class="btn btn-warning btn-circle btn-sm" disabled>
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </a>
                                    @endif
                                    @endcan

                                    @can('skms.destroy')
                                    {{-- <form action="{{ route('skms.destroy', $skms->id) }}" method="POST"> --}}
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-circle btn-sm">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    {{-- </form> --}}
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

    </div>
</section>

@endsection
@push('scripts')
<script src="{{ asset('/core/plugins/DataTables/datatables.min.js') }}"></script>

<script>
    $(document).ready(function () {
        $('#table-skms').DataTable({
            order: [ [0, 'desc'] ]
        });
    });
</script>
@endpush
