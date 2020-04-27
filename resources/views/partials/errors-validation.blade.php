@if (count($errors) > 0)
<!-- error alert -->
<div role="alert" class="alert alert-danger alert-dismissible">
    <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span
            aria-hidden="true">×</span></button>
    <h2 class="alert-heading">Error!</h2>
    <p>
        Tiene errores de validación en el formulario.</p>
    <hr>
   
    <p>
        <h4>Por favor, corriga los siguientes errores:</h4>
        <img class="img-fluid" style="width: 50px;"
        src="{{ asset('/core/undraw/error-cloud.svg') }}"> <br>
    </p>
    <ul>
        @foreach ($errors->all() as $error)
        <li><u>{{ $error }}</u></li>
        @endforeach
        <hr>
    </ul>
</div>
@endif