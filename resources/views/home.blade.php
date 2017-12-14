@extends('layouts.home')

@section('usuario-nombre')
    {{ucfirst(session('nombre'))}}
@endsection

@section('titulo')
    {{$titulo}}
@endsection

@section('ruta')

@endsection

@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Panel de Control</div>

                    <div class="panel-body">
                        Usted se encuentra logueado!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

