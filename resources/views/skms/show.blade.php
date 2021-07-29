@extends('layouts.dashboard') @section('title', 'information-&-technologies')
@section('content') @section('titlePosition', 'skms/show')

<section class="content">
    <div class="container-fluid">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <button type="button" class="btn btn-primary">
                    Árticulo Helpfile Knowledge <span class="badge badge-light">9</span>
                    <span class="sr-only">{{ $skms->id }}</span>
                  </button>
              <h1 class="display-4">{{ $skms->name_file }}</h1>
              <p class="lead">{{ $skms->classification_file }}</p>
            </div>
          </div>

          <h1 class="h3 mb-0 text-gray-800"> <i class="fas fa-compress-alt"></i> Fuente de información:</h1>
          <p>
            <i class="fa fa-file"></i> Árticulo Helpfile Knowledge: <strong>{{ $skms->name_file }}</strong> clasificado como
            <strong>{{ $skms->classification_file }}</strong>. <br>

            Hace relación a la categoría de : <strong>{{ $skms->category_file }}</strong> registrado en la SKMS con el
            código <i class="fa fa-barcode"></i> <strong>{{ $skms->code_file }}</strong> <br>
          </p>

          <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-laptop"></i>Métricas KPI</h1>
          @if ($skms->status === 'En revision')
          <div class="alert alert-warning" role="alert">
            <h4 class="alert-heading">Atención!</h4>
            <i class="fa fa-bullhorn"></i>
            <p>El árticulo <u>{{ $skms->name_file }}</u> para {{ $skms->classification_file }}
                esta en estado de   <i class="fas fa-exclamation-circle"></i>&nbsp;<code>{{ $skms->status }}</code>
                </h5>
            </p>
            <hr>
          </div>
          @elseif ($skms->status === 'Aprovado')
          <div class="alert alert-primary" role="alert">
            <h4 class="alert-heading">Atención!</h4>
            <i class="fa fa-bullhorn"></i>
            <p>El árticulo <u>{{ $skms->name_file }}</u> para {{ $skms->classification_file }}
                esta en estado de   <i class="fas fa-exclamation-circle"></i>&nbsp;<code>{{ $skms->aprovado }}</code>
                </h5>
            </p>
            <hr>
            <p class="mb-0">Contacte al usuario autorizado para el cambio de estado.</p>
          </div>
          @endif

        <p class="mb-0">
            <i class="fa fa-user"></i>
            Árticulo Helpfile Knowledge realizado por:  <strong>{{ $skms->user->name }}</strong>
        </p>
        <p class="mb-0">
            <i class="fa fa-calendar"></i>
            Fecha de creación del Árticulo Helpfile Knowledge :  <strong>{{ $skms->creation_date }}</strong>
        </p>

    </div>
</section>


@endsection
