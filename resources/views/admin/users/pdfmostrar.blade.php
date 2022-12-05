<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

{{--    <link href="{{public_path('css/app.css')}}" rel="stylesheet" type="text/css">--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    <style>
        /* margenes de la pagina */
        /* espacios reservados donde incluir la cabecera y pie */
        @page {
            margin: 200px 25px 80px 25px;
        }

        * {
            font-family: Arial, Helvetica, sans-serif;
            color: #353535;
        }

        header {
            position: fixed;
            top: -160px;
            left: 0px;
            right: 0px;
            height: 120px;
            /* border: 1px solid tomato; */
        }

        .header-table {
            width: 100%;
            height: 120px;
            font-size: 14px;
            line-height: 120%;
            border: none;
            padding: 0;
        }

        .logo-container {
            padding: 0;
            border: none;
            box-sizing: border-box;
        }

        .logo-wrapper {
            padding: 0;
            width: 100%;
            height: inherit;
            text-align: center;
        }

        .border {
            border: 1px solid #495057;
            border-collapse: collapse;
        }

        .title {
            background-color: #adb5bd;
            color: #212529;
            font-weight: 700;
        }

        .subtitle {
            background-color: #e9ecef;
            color: #212529;
            font-weight: 700;
        }

        .enphasis {
            font-weight: 700;
        }

        .enphasis,
        .data {
            font-size: 12px;
        }

        footer {
            position: fixed;
            bottom: -40px;
            left: 0px;
            right: 0px;
            height: 30px;
            border: 1px solid #e9ecef;
            text-align: center;
            vertical-align: middle;
            font-weight: 700;
            font-size: 12px;
            text-align: left;
        }

        footer p {
            font-size: 10px;
            margin-left: 25px;
            letter-spacing: .2px;
            color: #495057;
        }

        .data-table {
            width: 100%;
        }

        .data-table-head {
            font-size: 10px;
        }

        .data-table__row-head {
            font-size: 10px;
            letter-spacing: .3px;
            text-transform: uppercase;
            padding: 3px 5px;
            text-align: left;
            background-color: #adb5bd;
        }

        .data-table-body {
            font-size: 12px;
        }

        .data-table tr:nth-child(even) {
            background-color: #e9ecef;
        }

        .data-table__row-data {
            padding: 3px 5px;
            letter-spacing: .2px;
        }
    </style>
</head>
<body>
{{--<h1 class="text-center">Lista de Usuarios registrados</h1>--}}

<header>
    <table class="header-table border">
        <tr class="header-row border">
            <td rowspan="6" class="header-cell border logo-container" style="width: 120px;">
                <div class="logo-wrapper">
                    <img src= "{{public_path('img/Logo-ER.png')}}" style="width: 100px; height: 100px">
{{--                             "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fi0.wp.com%2Fwww.groovytakeon.com%2Fwp-content%2Fuploads%2F2016%2F04%2FHERE.jpg%3Fssl%3D1&f=1&nofb=1&ipt=f187506094c2146a1a7526e707b2a30e07f1c7f7407709446333acbd5179f769&ipo=images"--}}
                </div>
            </td>
            <td colspan="3" class="header-cell border title">Easy-Rent</td>
        </tr>
{{--        <tr class="header-row border">--}}
{{--            <td colspan="3" class="header-cell border subtitle" style="color: red">Secretaria de Bienestar Estudiantil - FCEQyN - UNaM.--}}
{{--            </td>--}}
{{--        </tr>--}}
        <tr class="header-row border">
            <td colspan="3" class="header-cell border subtitle">Titulo del reporte:
                <span class="enphasis">Listado de Usuarios</span>
            </td>
        </tr>
        <tr class="header-row border">
            <td class="header-cell border enphasis">Fecha de emision:
                <span class="data">{{date('d/m/Y')}}</span>
            </td>
            <td colspan="2" class="header-cell border enphasis">Hora de emision:
                <span class="data">{{date('H:i')}}</span>
            </td>
        </tr>
        <tr class="header-row border">
            <td class="header-cell border enphasis">Emitido por:
                <span class="data">{{Auth::user()->name}}</span>
            </td>
            <td colspan="2" class="header-cell border data">
{{--                <span style="font-weight: 700;">Nombre:</span>,--}}
                    <span style="font-weight: 700;">Correo:<span class="data">{{Auth::user()->email}}</span></span><br>
                    <span style="font-weight: 700;">Rol:<span class="data">{{Auth::user()->roles->pluck('name')->implode(', ')}}</span></span>
            </td>
        </tr>

        <tr class="header-row border">
            <td class="header-cell border enphasis">filtros de
                <span class="data">####</span>
            </td>
            <td colspan="2" class="header-cell border data">
                <span style="font-weight: 700;">filtrado por columna:
                    <span class="data">####</span>
                </span>
                <span style="text-transform: uppercase;"></span>
{{--                @if (array_key_exists('valor', $validated))--}}
{{--                    <span style="font-weight: 700;">con valor de busqueda:</span>--}}
{{--                    <span style="font-style:italic;">"{{ $validated['valor'] }}"</span>--}}
{{--                @endif--}}
                <span style="font-weight: 700;">ordenado de forma:
                    <span class="data">####</span>
                </span>
                <span style="text-transform: uppercase;"></span>
            </td>
        </tr>
    </table>
</header>
&nbsp;
<footer>
    <p>Easy-Rent - Copyright &copy; <?php echo date("Y");?></p>
</footer>

{{--<table class="table table-striped text-center">--}}
{{--    <thead class="thead-dark">--}}
{{--    <tr>--}}
{{--        <th>Id</th>--}}
{{--        <th>Name</th>--}}
{{--        <th>Email</th>--}}
{{--        <th></th>--}}
{{--    </tr>--}}
{{--    </thead>--}}
{{--    <tbody>--}}
{{--    @foreach ($users as $user)--}}
{{--        <tr>--}}
{{--            <td>{{ $user->id }}</td>--}}
{{--            <td>{{ $user->name }}</td>--}}
{{--            <td>{{ $user->email }}</td>--}}
{{--        </tr>--}}
{{--    @endforeach--}}
{{--    </tbody>--}}
{{--</table>--}}

<table class="data-table border">
    <thead class="data-table-head border">
    <tr class="data-table__row border">
        <th class="data-table__row-head border">Nombre</th>
        <th class="data-table__row-head border">email</th>
{{--        <th class="data-table__row-head border">email verificado</th>--}}
        <th class="data-table__row-head border">rol</th>
        <th class="data-table__row-head border">fecha de creacion</th>
    </tr>
    </thead>
    <tbody class="data-table-body">
    @foreach ($users as $user)
        <tr class="data-table__row border">
            <td class="data-table__row-data border">{{ $user->name }}</td>
            <td class="data-table__row-data border">{{ $user->email }}</td>
{{--            @if ($user->email_verified_at !== NULL)--}}
{{--                <td class="data-table__row-data border">{{ $user->email_verified_at }}</td>--}}
{{--            @else--}}
{{--                <td class="data-table__row-data border">no verificado</td>--}}
{{--            @endif--}}
            <td class="data-table__row-data border">{{ $user->roles->pluck('name')->implode(', ')}}</td>
            <td class="data-table__row-data border">{{ $user->created_at->format('d-m-Y')}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<script type="text/php">

        if (isset($pdf)) {
            //Shows number center-bottom of A4 page with $x,$y values
            $x = 490;  //X-axis i.e. vertical position
            $y = 795; //Y-axis horizontal position
            $text = "Pagina {PAGE_NUM} de {PAGE_COUNT}";  //format of display message
            $font =  $fontMetrics->get_font("helvetica", "bold");
            $size = 9;
            $color = array(0.2, 0.094, 0.0);
            $word_space = 0.0;  //  default
            $char_space = 0.0;  //  default
            $angle = 0.0;   //  default
            $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
        }

    </script>
</body>
</html>

