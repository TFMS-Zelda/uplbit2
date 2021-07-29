<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{public_path('/core/css/bulma.css')}}">

    <title>
        Paz y Salvo {{ $employee->name }}
    </title>
</head>

<body>
    <img src="{{ public_path('/core/image/logoUpl.jpg') }}" alt="logoUpl" style="width: 10rem;">
    <section class="hero is-ligth">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Paz y Salvo
                </h1>
                <h2 class="subtitle">
                    {{ $employee->name }}
                    <br>
                    {{ $employee->email_corporate }}
                    <br>
                    {{ $employee->job_title }}
                    <br>
                    {{ $employee->ugdn }}
                </h2>
            </div>
        </div>
    </section>

    @if ($computers->isNotEmpty() || $tablets->isNotEmpty() || $monitors->isNotEmpty() || $perisfericos->isNotEmpty())
    <div class="notification is-danger is-light">
        <h1 class="title">Denegado!, No puede generar este Paz y Salvo!</h1>
        <h2 class="subtitle">Observaciones:</h2>
        <p>
            Actualmente se registra en el sistema los siguientes recursos tecnológicos relacionados con el empleado
            <strong>{{ $employee->name }}</strong>

        </p>
        @if ($computers->isEmpty())
        <div class="notification is-success is-light">
            <strong> No tiene devoluciones pendientes por recursos de equipos de computo.</strong>
        </div>
        @else
        <div class="notification is-primary is-light">
            <h3 class="title is-3">Equipo de computo</h3>
            <h2 class="subtitle">
                Se asigna {{ $computersCount }} Cí
            </h2>
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
                    @foreach ($computers as $computer)
                    <tr>
                        <td class="has-text-centered">{{ $computer->id }}</td>
                        <td class="has-text-centered">{{ $computer->type_machine }}: {{ $computer->brand }} <br>
                            {{ $computer->model }}
                            <span class="tag is-link is-light"><strong>
                                    ServiceTag: {{ $computer->servicetag }}</strong></span>
                        </td>
                        <td class="has-text-centered">{{ $computer->operating_system }}<br>
                            {{ $computer->processor }} {{ $computer->memory_ram }}
                            <br>
                            {{ $computer->hard_drive }}
                        </td>
                        <td class="has-text-centered">
                            <span class="tag is-link is-light"><strong>
                                    Placa: {{ $computer->license_plate }}</strong></span> <br>
                            {{ $computer->status }}

                        </td>
                        <td class="has-text-centered">
                            <span class="tag is-link is-light"><strong>Modelo:
                                    {{ $computer->charger_model }}</strong></span>
                            <span class="tag is-link is-light"><strong>Serial:
                                    {{ $computer->charger_serial }}</strong></span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        @if ($tablets->isEmpty())
        <div class="notification is-success is-light">
            <strong> No tiene devoluciones pendientes por recursos de tablets corporativas</strong>
        </div>
        @else
        <div class="notification is-link is-light">
            <h3 class="title is-3">Tablet Corporativa</h3>
            <h2 class="subtitle">
                Se asigna {{ $tabletsCount }} Cí
            </h2>
            <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                <thead>
                    <tr>
                        <th class="has-text-centered"><abbr>Activo:</abbr></th>
                        <th class="has-text-centered">Marca y Módelo:</th>
                        <th class="has-text-centered"><abbr>Características:</abbr></th>
                        <th class="has-text-centered"><abbr>Placa Corporativa:</abbr></th>
                        <th class="has-text-centered"><abbr>Plan de Datos:</abbr></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tablets as $tablet)
                    <tr>
                        <td class="has-text-centered">{{ $tablet->id }}</td>
                        <td class="has-text-centered">{{ $tablet->brand }}: {{ $tablet->model }} <br>
                            <span class="tag is-link is-light"><strong>
                                    Serial: {{ $tablet->serial }}</strong></span>
                        </td>
                        <td class="has-text-centered">{{ $tablet->operating_system }}<br>
                            {{ $tablet->processor }} {{ $tablet->memory }}
                            <br>
                            {{ $tablet->screen }}
                        </td>
                        <td class="has-text-centered">
                            <span class="tag is-link is-light"><strong>
                                    Placa: {{ $tablet->license_plate }}</strong></span> <br>
                            {{ $tablet->status }}

                        </td>
                        <td class="has-text-centered">
                            <span class="tag is-link is-light"><strong>IMEI:
                                    {{ $tablet->imei }}</strong></span>
                            <span class="tag is-link is-light"><strong>Número de Teléfono:
                                    {{ $tablet->phone_number }}</strong></span> <br>
                            <span class="tag is-link is-light"><strong>SimCard:
                                    {{ $tablet->sim_card }}</strong></span>
                            <span class="tag is-danger is-light"><strong>Pin:
                                    {{ $tablet->pin }}</strong></span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        @if ($monitors->isEmpty())
        <div class="notification is-success is-light">
            <strong> No tiene devoluciones pendientes por monitores corporativos.</strong>
        </div>
        @else
        <div class="notification is-warning is-light">
            <h3 class="title is-3">Monitor Corporativo</h3>
            <h2 class="subtitle">
                Se asigna {{ $monitorsCount }} Cí
            </h2>
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
                    @foreach ($monitors as $monitor)
                    <tr>
                        <td class="has-text-centered">{{ $monitor->id }}</td>
                        <td class="has-text-centered">{{ $monitor->brand }}: {{ $monitor->model }} <br>
                            <span class="tag is-link is-light"><strong>
                                    Serial: {{ $monitor->serial }}</strong></span>
                        </td>
                        <td class="has-text-centered">{{ $monitor->screen_type }}
                            <br>
                            {{ $monitor->screen_format }} {{ $monitor->backlight }}
                            <br>
                            {{ $monitor->input_connector_type }}
                        </td>
                        <td class="has-text-centered">
                            <span class="tag is-link is-light">
                                <strong>
                                    Placa: {{ $monitor->license_plate }}
                                </strong>
                            </span>
                            <br>
                            {{ $monitor->status }}
                        </td>
                        <td class="has-text-centered">
                            <span class="tag is-link is-light">
                                <strong>Cargador:
                                    {{ $monitor->power_supply }}
                                </strong>
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        @if ($perisfericos->isEmpty())
        <div class="notification is-success is-light">
            <strong> No tiene devoluciones pendientes por recursos de perisféricos.</strong>
        </div>
        @else
        <div class="notification is-black is-light">
            <h3 class="title is-3">Perisférico Corporativo</h3>
            <h2 class="subtitle">
                Se le asignan {{ $perisfericosCount }} Cí
            </h2>
            <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                <thead>
                    <tr>
                        <th class="has-text-centered"><abbr>Activo:</abbr></th>
                        <th class="has-text-centered">Tipo de Perisférico:</th>
                        <th class="has-text-centered"><abbr>Marca y Módelo:</abbr></th>
                        <th class="has-text-centered"><abbr>Placa Corporativa:</abbr></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($perisfericos as $perisferico)
                    <tr>
                        <td class="has-text-centered">{{ $perisferico->id }}</td>
                        <td class="has-text-centered">{{ $perisferico->type_device }}:
                            {{ $perisferico->type_other_peripherals }} <br>
                            <span class="tag is-link is-light"><strong>
                                    Serial: {{ $perisferico->serial }}</strong></span>
                        </td>
                        <td class="has-text-centered">{{ $perisferico->brand }}<br>
                            {{ $perisferico->model }}
                        </td>
                        <td class="has-text-centered">
                            <span class="tag is-link is-light"><strong>
                                    Placa: {{ $perisferico->license_plate }}</strong></span> <br>
                            {{ $perisferico->status }}

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
    @else
    <div class="notification is-success is-light">
        <p class="has-text-black has-text-justified">
            El área de Información y Tecnología de <strong>United Phosphorus Ltd</strong> certifica que el
            usuario <strong>{{ $employee->name }}</strong> identificada con el número de cedula
            <strong>{{ $employee->citizenship_card }}</strong> se encuentra a paz y salvo con
            el área por concepto de asignación de activos fijos y recursos tecnologícos que le fueron proporcionados
            el día <strong>{{ Carbon\Carbon::parse($employee->created_at)->format('l jS \\of F Y ') }}</strong>,
            fecha en la cual el empleado a sido registrado en el sistema.
            <br>
            <br>
            El presente certificado se expide a solicitud en la ciudad de Bogotá el día
            <strong>{{ Carbon\Carbon::now()->format('l jS \\of F Y ') }}</strong>.
        </p>
    </div>
    <section class="hero is-ligth">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Entrega
                </h1>
                <h2 class="subtitle">
                    Federico Rubio Andrade
                    <br>
                    federico.rubio@upl-ltd.com
                    <br>
                    Information Technology/Bogota
                    <br>
                    20011781
                </h2>
            </div>
        </div>
    </section>
    <section class="hero is-ligth">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Entrega
                </h1>
                <h2 class="subtitle">
                    Víctor Andres Tuiran
                    <br>
                    victor.tuiran@upl-ltd.com
                    <br>
                    Information Technology/Bogota
                    <br>
                    30010039
                </h2>
            </div>
        </div>
    </section>
    @endif

    <footer class="footer">
        <div class="content has-text-centered">
            <p>
                <strong>Uniphos Plant Limited</strong>, <a>Información y Tecnología</a>. Operational Level
                Agreement,
                Descargado Digitalmente.
                <p class="title">2021</p>
            </p>
        </div>
    </footer>

</body>

</html>
