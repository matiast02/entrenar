@extends('layouts.home')

@section('scripts_header')
    <!-- Load Moment.js extension -->
    <script type="text/javascript" src="{{URL::asset('js/plugins/ui/moment/moment.min.js')}}"></script>
    <!-- Load plugin -->
    <script type="text/javascript" src="{{URL::asset('js/plugins/pickers/daterangepicker.js')}}"></script>

    <script type="text/javascript" src="{{URL::asset('js/plugins/notifications/sweet_alert.min.js')}}"></script>

    <meta name="_token" content="{{ csrf_token() }}"/>
@endsection

@section('usuario-nombre')
    {{ucfirst(session('nombre'))}}

@endsection

@section('titulo')
    {{$titulo}}
@endsection

@section('ruta')

@endsection

@section('contenido')

    <form id="editar-indicador" class="form-horizontal col-md-6"  >
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Modificar Indicador<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                    </ul>
                </div>
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <fieldset>

                            {{ csrf_field() }}

                            <div id="cliente-field" class="form-group">
                                <label for="cliente" class="col-lg-3 control-label">Cliente:</label>
                                <div class="col-lg-9">
                                    <select class="select" id="id_cliente" name="cliente" >
                                        <option value="{{$cliente->id}}">{{ucfirst($cliente->nombre. " " .$cliente->apellido)}}</option>
                                    </select>
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">Fecha Indicador: </label>
                                <div class="col-lg-9">
                                    <div id="fecha_indicador-field" class="input-group">
                                        <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                        <input type="text" id="fecha_indicador"  name="fecha_indicador" class="form-control daterange-single" value="{{date('d/m/Y', strtotime($indicador->fecha_indicador))}}" >
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>

                            {{--<div class="form-group">--}}
                                {{--<label class="col-lg-3 control-label">Mes Indicador: </label>--}}
                                {{--<div class="col-lg-9">--}}
                                    {{--<div id="mes-field" class="input-group">--}}
                                        {{--<select id="mes" name="mes" class="form-control">--}}
<!--                                            --><?php
//                                            $mes=date("n");
//                                            $rango=11;
//                                            for ($i=$mes;$i<=$mes+$rango;$i++){
//                                                $mesano=date('Y-n', mktime(0, 0, 0, $i, 1, date("Y") ) );
//                                                $meses=date('F', mktime(0, 0, 0, $i, 1, date("Y") ) );
//                                                if ($meses=="January") $meses="Enero";
//                                                if ($meses=="February") $meses="Febrero";
//                                                if ($meses=="March") $meses="Marzo";
//                                                if ($meses=="April") $meses="Abril";
//                                                if ($meses=="May") $meses="Mayo";
//                                                if ($meses=="June") $meses="Junio";
//                                                if ($meses=="July") $meses="Julio";
//                                                if ($meses=="August") $meses="Agosto";
//                                                if ($meses=="September") $meses="Septiembre";
//                                                if ($meses=="October") $meses="Octubre";
//                                                if ($meses=="November") $meses="Noviembre";
//                                                if ($meses=="December") $meses="Diciembre";
//                                                $ano=date('Y', mktime(0, 0, 0, $i, 1, date("Y") ) );
//                                                echo "<option value='$mesano-01'>$meses / $ano</option>";
//                                            }
//                                            ?>
                                        {{--</select>--}}
                                        {{--<div class="form-control-feedback"></div>--}}
                                        {{--<span class="help-block"></span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            <div id="peso_inicial-field" class="form-group">
                                <label class="col-lg-3 control-label">Peso Inicial:</label>
                                <div class="col-lg-9">
                                    <input type="number" step="any" class="form-control" name ="peso_inicial" value="{{$indicador->peso_inicial}}">
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div id="peso_final-field" class="form-group">
                                <label class="col-lg-3 control-label">Peso Final:</label>
                                <div class="col-lg-9">
                                    <input type="number" step="any" class="form-control" name ="peso_final" value="{{$indicador->peso_final}}">
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>


                            {{--<div id="diferencia_peso_porcentual-field" class="form-group">--}}
                            {{--<label class="col-lg-3 control-label">Diferencia Peso:</label>--}}
                            {{--<div class="col-lg-9">--}}
                            {{--<input type="text" class="form-control" name ="diferencia_peso_porcentual" >--}}
                            {{--<div class="form-control-feedback"></div>--}}
                            {{--<span class="help-block"></span>--}}
                            {{--</div>--}}
                            {{--</div>--}}


                            <div id="hora_entrada-field" class="form-group">
                                <label class="col-lg-3 control-label">Hora Entrada:</label>
                                <div class="col-lg-9">
                                    <input type="text" name="hora_entrada" class="form-control" value="{{$indicador->hora_entrada}}">
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div id="hora_salida-field" class="form-group">
                                <label class="col-lg-3 control-label">Hora Salida:</label>
                                <div class="col-lg-9">
                                    <input type="text"  name="hora_salida" class="form-control" value="{{$indicador->hora_salida}}">
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div id="pse-field" class="form-group">
                                <label class="col-lg-3 control-label">PSE:</label>
                                <div class="col-lg-9">
                                    <input type="number"  name="pse" class="form-control" value="{{$indicador->pse}}">
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div id="sueno-field" class="form-group">
                                <label class="col-lg-3 control-label">Sueño:</label>
                                <div class="col-lg-9">
                                    <input type="number"  name="sueno" class="form-control" value="{{$indicador->sueno}}">
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div id="dolor-field" class="form-group">
                                <label class="col-lg-3 control-label">Dolor:</label>
                                <div class="col-lg-9">
                                    <input type="number"  name="dolor" class="form-control" value="{{$indicador->dolor}}">
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div id="deseo_entrenar-field" class="form-group">
                                <label class="col-lg-3 control-label">Deseo Entrenar:</label>
                                <div class="col-lg-9">
                                    <input type="number" name="deseo_entrenar" class="form-control" value="{{$indicador->deseo_entrenar}}">
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div id="desayuno-field" class="form-group">
                                <label class="col-lg-3 control-label">Desayuno:</label>
                                <div class="col-lg-9">
                                    <input type="number" name="desayuno" class="form-control" value="{{$indicador->desayuno}}">
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>


                            {{--<div id="sumatoria-field" class="form-group">--}}
                            {{--<label class="col-lg-3 control-label">Sumatoria:</label>--}}
                            {{--<div class="col-lg-9">--}}
                            {{--<input type="number"  name="sumatoria" class="form-control">--}}
                            {{--<div class="form-control-feedback"></div>--}}
                            {{--<span class="help-block"></span>--}}
                            {{--</div>--}}
                            {{--</div>--}}


                            <div id="pse_global_sesion-field" class="form-group">
                                <label class="col-lg-3 control-label">PSE Global:</label>
                                <div class="col-lg-9">
                                    <input type="number"  name="pse_global_sesion" class="form-control" value="{{$indicador->pse_global_sesion}}">
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>


                            {{--<div id="tiempo_entrenamiento-field" class="form-group">--}}
                            {{--<label class="col-lg-3 control-label">Tiempo Entrenamiento:</label>--}}
                            {{--<div class="col-lg-9">--}}
                            {{--<input type="text"  name="tiempo_entrenamiento" class="form-control">--}}
                            {{--<div class="form-control-feedback"></div>--}}
                            {{--<span class="help-block"></span>--}}
                            {{--</div>--}}
                            {{--</div>--}}

                            {{--<div id="carga_entrenamiento-field" class="form-group">--}}
                                {{--<label class="col-lg-3 control-label">Carga Entrenamiento:</label>--}}
                                {{--<div class="col-lg-9">--}}
                                    {{--<input type="number"  name="carga_entrenamiento" class="form-control" value="{{$indicador->carga_entrenamiento}}">--}}
                                    {{--<div class="form-control-feedback"></div>--}}
                                    {{--<span class="help-block"></span>--}}
                                {{--</div>--}}
                            {{--</div>--}}


                            <div class="text-right">
                                <button type="submit" class="btn btn-success">Enviar <i class="icon-arrow-right14 position-right"></i></button>
                            </div>

                        </fieldset>
                    </div>
                </div>

            </div>
        </div>
    </form>
@endsection



@section('scripts')
    <script type="text/javascript">

        $('select').select2({
            // options
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });


        //date picker
        $('#fecha_indicador').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'DD/MM/YYYY'
            },
            applyClass: 'bg-slate-600',
            cancelClass: 'btn-default'
        });


        //date picker
        $('#mes').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'DD/MM/YYYY'
            },
            applyClass: 'bg-slate-600',
            cancelClass: 'btn-default'
        });


        //buscar en formulario cliente
        $("#id_cliente").select2({
            minimumInputLength: 2,
            ajax: {
                url: '{{route('search.clientes')}}',
                dataType: 'json',
                type: "POST",
                quietMillis: 50,
                data: function (term) {
                    return {
                        term: term
                    };
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.text+' '+item.apellido,
                                id: item.id
                            }
                        })
                    };
                },
                formatResult: function (data, term) {
                    return data;
                },
                formatSelection: function (data) {
                    return data;
                }
            }
        });


        //enviar formulario
        $("#editar-indicador").submit(function(e) {

            $.ajax({
                type: 'patch',
                url: "{{route('indicadores.update',$indicador->id)}}",
                data:  $("#editar-indicador").serialize(),
                dataType: 'json',
                success: function(data){
                    swal("Bien!", "Los datos se guardaron correctamente.", "success");
                    //resetear estilos
                    $('.form-group').removeClass("has-error has-feedback");
                    $('#editar-indicador').find('.form-control-feedback').html('');
                    $('#editar-indicador').find('.help-block').html('');
                    $('#editar-indicador')[0].reset();

                    var delay = 1250;
                    setTimeout(function(){window.location.replace("{{route('listar.indicadores')}}") }, delay);
                },
                error: function(data){
                    //resetear estilos
                    $('.form-group').removeClass("has-error has-feedback");
                    $('#editar-indicador').find('.form-control-feedback').html('');
                    $('#editar-indicador').find('.help-block').html('');

                    //mostramos los errores
                    var errors = data.responseJSON;
                    swal("Oops...", "Algo salio mal!", "error");
                    $.each(errors, function(i,item){
                        if(i === 'message'){
                            $.each(item,function (k,v){
                                $('#'+k+'-field').addClass("has-error has-feedback");
                                $('#'+k+'-field').find('.form-control-feedback').html('<i class="icon-cancel-circle2"></i>');
                                $('#'+k+'-field').find('.help-block').html(v);
                            });
                        }
                    })

                }
            });

            e.preventDefault(); // avoid to execute the actual submit of the form.
        });


    </script>
@endsection