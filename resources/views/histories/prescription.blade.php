<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'Laravel') }} | Recetas</title>
    <style>
        @page { size: A4 }

        @page {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11pt;
            text-align: justify;
            margin-top: 2cm;
            margin-bottom: 2.5cm;
            margin-inside: 1.5cm;
            margin-outside: 1.5cm;
        }

        @page {
            border-top: 0.5pt black dotted;
        }


        @page {
            @top {
                font-size: 8pt;
                font-style: italic;
                content: flow(header);
            }

            @bottom {
                font-size: 9pt;
                content: "Página " counter(page) " de " counter(pages)
            }
        }


        header { prince-flow: static(header, start) }

        body {
            font-family: Arial, Helvetica, sans-serif;
            padding-top: 5px;
        }

        table.logo, table.logo tr, table.logo td {
            border: none;
        }

        .centro {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            border: solid 1px black;
            width: 100%;
        }

        table tr {
            height: 30px;
        }

        table tr.sign {
            height: 60px;
        }

        td {
            border: solid thin black;
            padding-left: 5px;
            font-size: 10pt;
        }

        table th {
            text-align: left;
            padding-left: 10px;
            background-color: #cdcdcd;
            border: solid thin black;
            text-transform: uppercase;
        }

        h2 {
            text-align: center;
        }

        .title {
            display: block;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 8pt;
            text-transform: uppercase;
            text-align: right;
        }

        span.office {
            display: block;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            font-size: 6pt;
        }

        ul li, ol li {
            padding-bottom: 13px;
        }

        p.item {
            margin-left: 23px;
            text-align: justify;
        }

        strong {
            text-transform: uppercase;
        }

        h1, h2, h3, h4, h5, h6 {
            text-transform: uppercase;
        }

        .footer {
            position: relative;
            right: 0;
            bottom: 0;
            left: 0;
            padding: 1rem;
            text-align: center;
        }

        .font-8 {
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            font-size: 8pt;
            padding-top: 50px;
        }
    </style>
</head>
<body>
    <header>
        <table class="logo">
            <tr>
                <td><img src="{{ public_path('img/medicure-logo.png') }}" width="50"></td>
                <td>
                    <span class="title">
                        {{ config('app.owner', 'Yoel Diomedez Apps') }}  <br>
                        "{{ config('app.name', 'Laravel') }}"
                    </span>
                </td>
            </tr>
        </table>
    </header>
    
    <h2>Receta Única Estandarizada</h2>

    <table class="logo">
        <tr>
            <td>
                <strong>Nombres y Apellidos:</strong>
                {{ $recipe->patient->names }} {{ $recipe->patient->surnames }} 
            </td>
            <td style="text-align: right;">
                <strong>Fecha y Hora:</strong>    
                {{ Carbon\Carbon::parse($recipe->created_at)->format('d/m/Y H:m') }}
            </td>
        </tr>
    </table>

    <h4>1. Tratamiento</h4>

    <p>{{ $recipe->record->treatment }}</p>    

    <table>
        <thead>
            <tr>
                <th>Medicamentos</th>
                <th>Presentación</th>
                <th>Cantidad</th>
                <th>Observación</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($recipe->prescriptions as $prescription)
                <tr>
                    <td>{{ $prescription->drug }}</td>
                    <td>{{ $prescription->shape }}</td>
                    <td>{{ $prescription->amount }}</td>
                    <td>{{ $prescription->note }}</td>
                </tr> 
            @empty
                <tr>
                    <td colspan="4" style="text-align: center;">Receta en proceso.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    

    <h4>2. Indicaciones</h4>
    
    <p>{{ $recipe->record->instruction }}</p>

    <table>
        <thead>
            <tr>
                <th>Medicamentos</th>
                <th>Dosis</th>
                <th>Vía</th>
                <th>Frecuencia</th>
                <th>Duración</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($recipe->prescriptions as $prescription)
                <tr>
                    <td>{{ $prescription->drug }}</td>
                    <td>{{ $prescription->dose }}</td>
                    <td>{{ $prescription->route }}</td>
                    <td>{{ $prescription->frequency }}</td>
                    <td>{{ $prescription->term }}</td>
                </tr> 
            @empty
                <tr>
                    <td colspan="5"  style="text-align: center;">Receta en proceso.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <table class="logo footer" >
        <tr>
            <td class="font-8">
                ____________________________ <br>

                {{ $recipe->employee->patient->names }}
                {{ $recipe->employee->patient->surnames }} <br>

                {{ $recipe->employee->specialty }} <br>
                <strong>CMP:</strong> {{ $recipe->employee->cmp }} -
                <strong>RNE:</strong> {{ $recipe->employee->rne }}
            </td>
        </tr>
    </table>
</body>
</html>