<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{public_path('/core/css/bulma.css')}}">

    <title>
        Reporte de Mantenimiento
    </title>
</head>

<body>
    <img src="{{ public_path('/core/image/logoUpl.jpg') }}" alt="logoUpl" style="width: 10rem;">
    <section class="hero is-ligth">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Reporte de Mantenimiento
                </h1>
                <h2 class="subtitle">
                    {{ Carbon\Carbon::parse($historyMaintenance->maintenance_date)->format('l jS \\of F Y ') }} <br>
                    {{ $historyMaintenance->maintenance_type }} <br>
                    N° {{ $historyMaintenance->id }}
                    <br>
                    {{ $historyMaintenance->responsible_maintenance }}</h4>
                </h2>


            </div>
        </div>
    </section>

    <div class="notification is-primary is-light">
        <h1 class="title">Activo Afectado!</h1>
        <h2 class="subtitle">Equipo de computo</h2>
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
                <tr>
                    <th class="has-text-centered"><abbr>Activo:</abbr></th>
                    <th class="has-text-centered">Marca y Módelo:</th>
                    <th class="has-text-centered"><abbr>Características:</abbr></th>
                    <th class="has-text-centered"><abbr>Placa Corporativa:</abbr></th>
                    <th class="has-text-centered"><abbr>Cargador:</abbr></th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td class="has-text-centered">{{ $historyMaintenance->computer->id }}</td>
                    <td class="has-text-centered">{{ $historyMaintenance->computer->type_machine }}:
                        {{ $historyMaintenance->computer->brand }} <br>
                        {{ $historyMaintenance->computer->model }}
                        <span class="tag is-link is-light"><strong>
                                ServiceTag: {{ $historyMaintenance->computer->servicetag }}</strong></span>
                    </td>
                    <td class="has-text-centered">{{ $historyMaintenance->computer->operating_system }}<br>
                        {{ $historyMaintenance->computer->processor }} {{ $historyMaintenance->computer->memory_ram }}
                        <br>
                        {{ $historyMaintenance->computer->hard_drive }}
                    </td>
                    <td class="has-text-centered">
                        <span class="tag is-link is-light"><strong>
                                Placa: {{ $historyMaintenance->computer->license_plate }}</strong></span> <br>
                        {{ $historyMaintenance->computer->status }}

                    </td>
                    <td class="has-text-centered">
                        <span class="tag is-link is-light"><strong>Modelo:
                                {{ $historyMaintenance->computer->charger_model }}</strong></span>
                        <span class="tag is-link is-light"><strong>Serial:
                                {{ $historyMaintenance->computer->charger_serial }}</strong></span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="notification is-black is-light">
        <h1 class="title">Descripcion del Mantenimiento</h1>
        <p class="has-text-black has-text-justified">
            {{ $historyMaintenance->maintenance_description }}
        </p>
    </div>

    <div class="notification is-black is-light">
        <h1 class="title">Observaciones</h1>
        <p class="has-text-black has-text-justified">
            {{ $historyMaintenance->observations }}
        </p>
    </div>

    <section class="hero is-ligth">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Entrega
                </h1>
                <h2 class="subtitle">
                    {{ $historyMaintenance->user->name }}
                    <br>
                    {{ $historyMaintenance->user->email }} <br>
                    Information Technology/Bogota
                    <br>
                    {{ $historyMaintenance->user->ugdn }} </h2>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="content has-text-centered">
            <p>
                <strong>Uniphos Plant Limited</strong>, <a>Información y Tecnología</a>. Operational Level
                Agreement,
                Descargado Digitalmente.
                <p class="title">2020</p>
            </p>
        </div>
    </footer>

</body>

</html>