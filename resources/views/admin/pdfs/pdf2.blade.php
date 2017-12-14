<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Lista de Personas</title>

    <link href="{{ URL::asset('css/pdf2.css')}}" rel="stylesheet" type="text/css">

<body>

<div class="header">
    <h2>Lista de personas</h2>
</div>

<div class="footer">
    Page <span class="pagenum"></span>
</div>

<table class="table table-striped" border="1">
    <tbody>

    @foreach($data as $cliente)

        <tr>
            <td class="text-center">
                {{--<img style="height: 80px"  src="{{ asset($cliente->foto) }}" alt="pas de photo">--}}
                <img style="height: 80px"  src="{{ URL::asset('images/pajaro.jpg')}}" alt="Foto">
            </td>

            <td>
                <strong>Nombre y Apellido: {{ $cliente->nombre.' '.$cliente->apellido }}</strong><br>
                <strong>Direccion: {{ $cliente->direccion }}</strong><br>
                <strong>DNI: {{ $cliente->deporte->id }}</strong>
            </td>

            <td>
                <strong>Nacido el: {{ $cliente->fecha_nacimiento }}</strong><br>
                <strong>Gimnasio: {{ $cliente->gym }}</strong><br>
                <strong>Celular: {{ $cliente->celular }}</strong><br>
            </td>
            <br>
        </tr>

    @endforeach
    </tbody>
</table>

</body>
</html>
