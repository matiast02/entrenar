<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Reporte de Clientes</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <link href="{{ URL::asset('css/pdf.css')}}" rel="stylesheet" type="text/css">

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

            {{--<table style="width: 100%; border-top: 1px solid black; border-bottom: 1px solid black; font-size: 8pt;">--}}

                {{--<tr>--}}
                    {{--<td>Model: <strong>Franklin</strong></td>--}}
                    {{--<td>Elevation: <strong>B</strong></td>--}}
                    {{--<td>Size: <strong>1160 Cu. Ft.</strong></td>--}}
                    {{--<td>Style: <strong>Reciprocating</strong></td>--}}
                {{--</tr>--}}

            {{--</table>--}}

            <table class="change_order_items">

                <tr><td colspan="6"><h2>Datos Personales:</h2></td></tr>

                <tbody>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>DNI</th>
                    <th colspan="2">Email</th>
                    <th>Fecha_Nac</th>
                </tr>

                <tr class="even_row">
                    <td style="text-align: center">Pablo</td>
                    <td>Rivera</td>
                    <td style="text-align: center">33753907</td>
                    <td style="text-align: right; border-right-style: none;">pablorivera_89@hotmail.com</td>
                    <td class="change_order_unit_col" style="border-left-style: none;"></td>
                    <td class="change_order_total_col">21/01/1989</td>
                </tr>

                <tr>
                    <th>Celular</th>
                    <th>Categoria</th>
                    <th>Deporte</th>
                    <th colspan="2">Direccion</th>
                    <th>Institucion</th>
                </tr>


                <tr class="odd_row">
                    <td style="text-align: center">155124345</td>
                    <td>Juvenil</td>
                    <td style="text-align: center">Futbol</td>
                    <td style="text-align: right; border-right-style: none;">Urquiza 2300</td>
                    <td class="change_order_unit_col" style="border-left-style: none;"></td>
                    <td class="change_order_total_col">Vicky</td>
                </tr>

                <tr>
                    <th>Gimnasio</th>
                    <th>Fecha_Inicio</th>
                    <th>Estado</th>
                    <th colspan="2">Foto</th>
                    <th></th>

                </tr>

                <tr class="even_row">
                    <td style="text-align: center">Vicky</td>
                    <td>01/06/2017</td>
                    <td style="text-align: center">Activo</td>
                    <td style="text-align: right; border-right-style: none;">Foto</td>
                    <td class="change_order_unit_col" style="border-left-style: none;"></td>
                    <td class="change_order_total_col"></td>
                </tr>

                </tbody>


                {{--<tr>--}}
                    {{--<td colspan="3" style="text-align: right;">(Tax is not included; it will be collected on closing.)</td>--}}
                    {{--<td colspan="2" style="text-align: right;"><strong>GRAND TOTAL:</strong></td>--}}
                    {{--<td class="change_order_total_col"><strong>$7560.00</strong></td>--}}
                {{--</tr>--}}
            </table>

            <table class="change_order_items">
                <tr><td colspan="6"><h2>Ejercicio: Pecho</h2></td></tr>
            </table>


            <table class="sa_signature_box" style="border-top: 1px solid black; padding-top: 2em; margin-top: 2em;">

                <h1>ACA VAN LOS GRAFICOS ENTRE UN RANGO DE FECHAS</h1>
                {{--<tr>--}}
                    {{--<td>WITNESS:</td><td class="written_field" style="padding-left: 2.5in">&nbsp;</td>--}}
                    {{--<td style="padding-left: 1em">PURCHASER:</td><td class="written_field" style="padding-left: 2.5in; text-align: right;">X</td>--}}
                {{--</tr>--}}
                {{--<tr>--}}
                    {{--<td colspan="3" style="padding-top: 0em">&nbsp;</td>--}}
                    {{--<td style="text-align: center; padding-top: 0em;">Mr. Leland Palmer</td>--}}
                {{--</tr>--}}

                {{--<tr><td colspan="4" style="white-space: normal">--}}
                        {{--This change order shall have no force or effect until approved and signed--}}
                        {{--by an authorizing signing officer of the supplier.  Any change or special--}}
                        {{--request not noted on this document is not contractual.--}}
                    {{--</td>--}}
                {{--</tr>--}}

                {{--<tr>--}}
                    {{--<td colspan="2">ACCEPTED THIS--}}
                        {{--<span class="written_field" style="padding-left: 4em">&nbsp;</span>--}}
                        {{--DAY OF <span class="written_field" style="padding-left: 8em;">&nbsp;</span>,--}}
                        {{--20<span class="written_field" style="padding-left: 4em">&nbsp;</span>.--}}
                    {{--</td>--}}

                    {{--<td colspan="2" style="padding-left: 1em;">TWIN PEAKS SUPPLY LTD.<br/><br/>--}}
                        {{--PER:--}}
                        {{--<span class="written_field" style="padding-left: 2.5in">&nbsp;</span>--}}
                    {{--</td>--}}
                {{--</tr>--}}
            </table>

        </div>

    </div>
</div>

</body>
</html>


