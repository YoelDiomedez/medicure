<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'Laravel') }} | Informes Laboratoriales</title>
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
                        {{ config('app.owner', 'Yoel Diomedez Apps') }} <br>
                        "{{ config('app.name', 'Laravel') }}"
                    </span>
                </td>
            </tr>
        </table>
    </header>
    
    <h2>Informe Laboratorial y Otros</h2>

    <table class="logo">
        <tr>
            <td>
                <strong>Fecha:</strong>
                {{ Carbon\Carbon::parse($lab->updated_at)->format('d/m/Y') }}  
            </td>
            <td style="text-align: center;">
                <strong>Servicio:</strong> 
                {{ $lab->service->concept }}   
            </td>
            <td style="text-align: right;">
                <strong>Costo:</strong> 
                S/ {{ $lab->amount }}  
            </td>
        </tr>
    </table>
    <table class="logo">
            <tr>
                <td>
                    <strong>Paciente:</strong>
                    {{ $lab->patient->document_type }}:
                    {{ $lab->patient->document_numb }} -
                    {{ $lab->patient->names }}
                    {{ $lab->patient->surnames }} 
                </td>
                <td style="text-align: right;">
                    <strong>Especialista:</strong>
                    {{ $lab->user->patient->names }} 
                    {{ $lab->user->patient->surnames }} 
                </td>
            </tr>
    </table>

    <h4>Informe</h4>

    <p style="text-align: justify;">{{ $lab->report }}</p>

    <table class="logo footer" >
        <tr>
            <td class="font-8">
                ____________________________ <br>
                {{ $lab->user->patient->names }} 
                {{ $lab->user->patient->surnames }} <br>

                {{ $lab->user->specialty }} <br>

                <strong>CMP:</strong> {{ $lab->user->cmp }} -
                <strong>RNE:</strong> {{ $lab->user->rne }}
            </td>
        </tr>
    </table>
</body>
</html>