@extends('layouts.home')

@section('scripts_header')
    <!-- Load Moment.js extension -->
    <script type="text/javascript" src="{{URL::asset('js/plugins/ui/moment/moment.min.js')}}"></script>
    <!-- Load plugin -->
    <script type="text/javascript" src="{{URL::asset('js/plugins/pickers/daterangepicker.js')}}"></script>

    <script type="text/javascript" src="{{URL::asset('js/plugins/notifications/sweet_alert.min.js')}}"></script>

    <script type="text/javascript" src="{{URL::asset('js/plugins/forms/wizards/stepy.min.js')}}"></script>

    <script type="text/javascript" src="{{URL::asset('js/plugins/forms/wizards/steps.min.js')}}"></script>

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


    <form id="crear-clientePago" class="form-horizontal col-md-6"  >
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Nuevo Pago Mensual<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
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

                            <legend class="text-semibold"><i class="icon-reading position-left"></i>Mensualidad</legend>

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">


                            <div id="cliente-field" class="form-group">
                                <label for="cliente" class="col-lg-3 control-label">Cliente:</label>
                                <div class="col-lg-6">
                                    @if(isset($cliente))
                                        <select class="select" id="cliente_id" name="cliente">
                                            <option value="{{$cliente->id}}">{{$cliente->nombre." ".$cliente->apellido}}</option>
                                        </select>
                                    @else
                                        <select class="select" id="cliente_id" name="cliente">
                                        </select>
                                    @endif

                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>


                            <div id="pago-field" class="form-group">
                                <label for="pago" class="col-lg-3 control-label">Mensualidad:</label>
                                <div class="col-lg-6">
                                    <select class="form-control" id="pago" name="pago">
                                        @foreach($pagos as $pago)
                                            <option value="{{$pago->id}}">{{ucfirst('Dias: '.$pago->dias_semana. '  -  ' . ' Grupo: ' .$pago->grupo. '  -  ' . ' Monto: $' .$pago->costo_mensual)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="form-group ">
                                <label class="col-lg-3 control-label">Fecha de Pago:</label>
                                <div class="col-lg-4">
                                    <div id="fecha_pago-field" class="input-group">
                                        <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                        <input type="text"  placeholder="Presionar aquí" class="form-control datepicker" id="fecha_pago" name ="fecha_pago" >
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="col-lg-3 control-label">Mes a Pagar:</label>
                                <div class="col-lg-5">
                                    <div id="mes_pago-field" class="input-group">
                                        <select id="mes_pago" name="mes_pago" class="form-control">
                                            <?php
                                                // date("n") - 2 (muestra los dos anteriores al actual)
                                            $mes=date("n");
                                            $rango=11;
                                            //si se indico la fecha de deuda se la muestra y no se la puede cambiar
                                            if (isset($fecha_deuda)){
                                                $mes = date('F',strtotime($fecha_deuda));
                                                if ($mes=="January") $mes="Enero";
                                                if ($mes=="February") $mes="Febrero";
                                                if ($mes=="March") $mes="Marzo";
                                                if ($mes=="April") $mes="Abril";
                                                if ($mes=="May") $mes="Mayo";
                                                if ($mes=="June") $mes="Junio";
                                                if ($mes=="July") $mes="Julio";
                                                if ($mes=="August") $mes="Agosto";
                                                if ($mes=="September") $mes="Septiembre";
                                                if ($mes=="October") $mes="Octubre";
                                                if ($mes=="November") $mes="Noviembre";
                                                if ($mes=="December") $mes="Diciembre";
                                                $anio = date('Y',strtotime($fecha_deuda));

                                                echo "<option value='".date('Y-n',strtotime($fecha_deuda))."-01' readonly='readonly'>".$mes." / ".$anio."</option>";
                                            }else{
                                                for ($i=$mes;$i<=$mes+$rango;$i++){
                                                    $mesano=date('Y-n', mktime(0, 0, 0, $i, 1, date("Y") ) );
                                                    $meses=date('F', mktime(0, 0, 0, $i, 1, date("Y") ) );
                                                    if ($meses=="January") $meses="Enero";
                                                    if ($meses=="February") $meses="Febrero";
                                                    if ($meses=="March") $meses="Marzo";
                                                    if ($meses=="April") $meses="Abril";
                                                    if ($meses=="May") $meses="Mayo";
                                                    if ($meses=="June") $meses="Junio";
                                                    if ($meses=="July") $meses="Julio";
                                                    if ($meses=="August") $meses="Agosto";
                                                    if ($meses=="September") $meses="Septiembre";
                                                    if ($meses=="October") $meses="Octubre";
                                                    if ($meses=="November") $meses="Noviembre";
                                                    if ($meses=="December") $meses="Diciembre";
                                                    $ano=date('Y', mktime(0, 0, 0, $i, 1, date("Y") ) );
                                                    echo "<option value='$mesano-01'>$meses / $ano</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                        {{--<input type="text"  placeholder="Presionar aquí" class="form-control datepicker" id="mes_pago" name ="mes_pago" @if(isset($fecha_deuda)) value="{{'01/'.$fecha_deuda}}" readonly="readonly" @endif>--}}
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>



                            <div class="text-right">
                                <button type="submit" class="btn btn-success">Guardar <i class="icon-arrow-right14 position-right"></i></button>
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

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });


        $('select').select2();



        //Esto permite que en blade la fecha aparezca dia/mes/año
        //date picker
        $('#fecha_pago').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'DD/MM/YYYY'
            },
            applyClass: 'bg-slate-600',
            cancelClass: 'btn-default'
        });

        @if(!isset($cliente))//si no se esta intentando pagar una deuda, se muestra el metodo para buscar clientes (para evitar pagar una deuda de otro cliente o se cambie la fecha de eduda)
        $('#mes_pago').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'DD/MM/YYYY'
            },
            applyClass: 'bg-slate-600',
            cancelClass: 'btn-default'
        });


        //buscar en formulario cliente
        $("#cliente_id").select2({
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
        @endif

        //CREAR NUEVO CANJE
        //enviar formulario
        $("#crear-clientePago").submit(function(e) {

            $.ajax({
                type: 'post',
                url: "{{route('clientepago.guardarClientePago')}}",
                data:  $("#crear-clientePago").serialize(),
                dataType: 'json',
                success: function(data){
                    swal("Bien!", "Los datos se guardaron correctamente.", "success");

                    //resetear estilos
                    $('.form-group').removeClass("has-error has-feedback");
                    $('#crear-clientePago').find('.form-control-feedback').html('');
                    $('#crear-clientePago').find('.help-block').html('');
                    $('#crear-clientePago')[0].reset();

                    var delay = 1220;
                    setTimeout(function(){window.location.replace("{{route('clientepago.crearClientePago')}}") }, delay);
                },

                error: function(data){
                    //resetear estilos
                    $('.form-group').removeClass("has-error has-feedback");
                    $('#crear-clientePago').find('.form-control-feedback').html('');
                    $('#crear-clientePago').find('.help-block').html('');

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