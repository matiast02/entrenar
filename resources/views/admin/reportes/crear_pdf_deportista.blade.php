


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Clientes</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <link href="{{ URL::asset('css/pdf.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('css/bootstrap2.min.css')}}" rel="stylesheet" type="text/css">



</head>

<body>

<div id="body">

    <div id="section_header">
    </div>

    <div id="content">

        <div class="page" style="font-size: 7pt">
            <table style="width: 100%;" class="header">
                <tr>
                    <td><h1 style="text-align: left">Reporte PDF</h1></td>
                    <td><h1 style="text-align: right">Fecha: <?=  $date; ?></h1></td>
                </tr>
            </table>

            <table style="width: 100%; font-size: 8pt; border-bottom: 1px solid black;">
                <tr>
                    <td>Profesor: <strong>Victor Cuellar</strong></td>
                    <td>Direccion: <strong>Urquiza.</strong></td>
                </tr>

                <tr>
                    <td>Telefono: <strong>4254568</strong></td>
                    <td>Email: <strong>victorcuellar@hotmail.com</strong></td>
                </tr>

            </table>

            <br>

            <table style="width: 100%; font-size: 8pt;">
                <tr>
                    <td colspan="2"> </td>
                </tr>
            </table>

            <div class="row perfil-cliente">
                <div class="foto-cliente">
                    <img src="{{asset($cliente->foto)}}" width="100" height="100" alt="foto-cliente">
                </div>
                <div class="datos-cliente-left">
                    <ul>
                        <li><b>{{$cliente->nombre.', '.$cliente->apellido}}</b></li>
                        <li><b>Edad:</b> {{$edad}} a&ntilde;os</li>
                        <li><b>DNI:</b> {{$cliente->dni}}</li>
                        <li><b>Email:</b> {{$cliente->email}}</li>
                        <li><b>Telefono:</b> {{$cliente->telefono}}</li>
                        <li><b>Domicilio:</b> {{$cliente->direccion}}</li>
                    </ul>
                </div>
                <div class="datos-cliente-right">
                    <ul>
                        <li><b>Deporte:</b> {{$cliente->deportes->nombre}}</li>
                        <li><b>Categoria:</b> {{$cliente->categorias->nombre}}</li>
                        <li><b>Institución:</b> {{$cliente->institucion}}</li>
                        <li><b>GYM:</b> {{$cliente->gym}}</li>
                        <li><b>Inicio:</b> {{date('d/m/Y',strtotime($cliente->fecha_inicio_entrenamiento))}}</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <h2 style="text-align: center;font-size: 1.5em;padding-top: 50px;">Ejercicio {{$nombre_ejercicio}}</h2>
                <div class="row">
                    <div class="col-md-4 grafico"><img src="{{$imagen}}" alt=""></div>

                </div>
            </div>

        </div>

    </div>
</div>

</body>
</html>





