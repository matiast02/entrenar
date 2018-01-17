@extends('layouts.home')

@section('scripts_header')<meta name="_token" content="{{ csrf_token() }}"/>
<!-- Load Moment.js extension -->
<script type="text/javascript" src="{{URL::asset('js/plugins/ui/moment/moment.min.js')}}"></script>
<!-- Load plugin -->
<script type="text/javascript" src="{{URL::asset('js/plugins/pickers/daterangepicker.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/plugins/notifications/sweet_alert.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/plugins/visualization/echarts/echarts2.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/plugins/visualization/echarts/theme/limitless.js')}}"></script>



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

    <form class="form-horizontal" id="buscar-cliente" method="POST" >
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Buscar Cliente<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                    </ul>
                </div>
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <fieldset>
                            <legend class="text-semibold"><i class="icon-reading position-left"></i>Resultados</legend>
                            <div id="cliente-field" class="form-group">
                                <label class="col-lg-3 control-label">Cliente:</label>
                                <div class="col-lg-9">
                                    <select class="select"  id="cliente_id" name="cliente">
                                    </select>
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div id="ejercicio-field" class="form-group">
                                <label class="col-lg-3 control-label">Ejercicio</label>
                                <div class="col-lg-9">
                                    <select class="select"  id="id_ejercicio" name="ejercicio">
                                        @foreach($ejercicios as $ejercicio)
                                            <option value="{{$ejercicio->id}}">{{$ejercicio->nombre}}</option>
                                        @endforeach
                                    </select>
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div id="rango-fechas" class="form-group">
                                <label for="rango-fechas" class="col-lg-3 control-label">Fechas</label>
                                <div class="col-lg-9">
                                    <input type="text" name="rango-fechas" class="form-control daterange-ranges" value="01/04/2016 - 31/01/2017">
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="text-right">
                    <button type="button" id="btn-enviar" onclick="reporte()" class="btn btn-primary">Generar <i class="icon-arrow-right14 position-right"></i></button>
                </div>
            </div>
        </div>
    </form>

    <div class="panel panel-white">
        <div class="panel-heading">
            <h6 class="panel-title">Resultado<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4" id="datos-cliente" style="padding-left: 10px;">

            </div>
            <div class="col-md-4"></div>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <canvas id="chart" class="text-center" width="500" height="400"></canvas>
            </div>
            <div class="col-md-2"></div>
        </div>
        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4">
                <form id="form-pdf" action="{{route('pdfs.crear_pdf_deportista')}}" method="POST">
                    {{csrf_field()}}
                    <input type="hidden" name="cliente" id="cliente">
                    <input type="hidden" name="tipo" value="1">
                    <input type="hidden" name="img" id="img">
                    <input type="hidden" name="ejercicio" id="ejercicio">
                    <button type="submit" id="btn-form-pdf" class="btn btn-primary" style="display:none;margin-bottom: 30px;">Generar PDF<i class="icon-arrow-right14 position-right"></i></button>
                </form>
            </div>

        </div>


        </div>
    </div>


@endsection

@section('scripts')
    <script type="text/javascript">


        var grafico = echarts.init(document.getElementById('chart'));


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $('select').select2({
            // options
        });

        //buscar usuario
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

        function reporte(){
            $.ajax({
                type: 'post',
                url: "{{route('reporte-por-deportista.reportes')}}",
                data:  $("#buscar-cliente").serialize(),
                dataType: 'json',
                success: function(data){
                    swal("Bien!", "Los datos son correctos.", "success");
                    var option = {
                        title: {
                            text: 'Niveles de RM - '+ data['ejercicio']
                        },
                        tooltip: {
                            data: ['RM']
                        },
                        legend: {
                            data:['RM']
                        },
                        xAxis: {
                            data: data['fecha']
                        },
                        yAxis: {},
                        series: [{
                            name: 'RM',
                            type: 'bar',
                            data: data['rm'],
                            itemStyle: {
                                normal: {
                                    label: {
                                        show: true,
                                        textStyle: {
                                            fontWeight: 500
                                        }
                                    }
                                }
                            },
                            markLine: {
                                data: [{type: 'average', name: 'Average'}]
                            }
                        }],
                        itemStyle: {
                            normal: {
                                // shadow size
                                shadowBlur: 200,
                                // horizontal offset of shadow
                                shadowOffsetX: 0,
                                // vertical offset of shadow
                                shadowOffsetY: 0,
                                // shadow color
                                shadowColor: 'rgba(0, 0, 0, 0.5)'
                            }
                        }
                    };
                    //---------------------
                    canvas = document.getElementById('chart');


                    //var resul = chart(data['rm'],data['fecha']);
                    $('#datos-cliente').html(data['html']);
                    grafico.setOption(option);//grafica los datos de respuesta
                    //muestro el boton para enviar el formulario
                    $('#btn-form-pdf').show();
                },

                error: function(data){

                    //mostramos los errores
                    var errors = data.responseJSON;
                    var mensaje = errors.message;
                    swal("Oops...", mensaje, "error");
                    $.each(errors, function(i,item){
                        if(i === 'message'){
                            $.each(item,function (k,v){
                                $('#'+k+'-field').addClass("has-error has-feedback");
                                $('#'+k+'-field').find('.form-control-feedback').html('<i class="icon-cancel-circle2"></i>');
                                $('#'+k+'-field').find('.help-block').html(v);
                            });
                        }
                    })

                    //console.log(mensaje);
                    // Render the errors with js ...
                }
            });
        }
        //envia la imagen del grafico
        $( "#form-pdf" ).submit(function() {
            var image = new Image();
            image.id = "pic";
            image.src = canvas.toDataURL('image/png');
            $('#cliente').val($('#cliente_id').val());
            $('#img').val(image.src);
            $('#ejercicio').val($('#id_ejercicio').val());
            console.log(image.src);
        });

        $('.daterange-ranges').daterangepicker(
            {
                startDate: moment().subtract('days', 29),
                endDate: moment(),
                showDropdowns: true,
                autoUpdateInput: true,
                locale: {
                    format: 'DD/MM/YYYY',
                    applyLabel: 'Aplicar',
                    cancelLabel: 'Limpiar',
                    fromLabel: 'Desde',
                    toLabel: 'Hasta',
                    customRangeLabel: 'Seleccionar rango',
                    daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre',
                        'Diciembre'],
                    firstDay: 1
                },
                minDate: moment().subtract(2, 'years'),
                maxDate: '2050-11-10',
                ranges: {
                    'Hoy': [moment(), moment()],
                    'Ayer': [moment().subtract('days', 1), moment().subtract('days', 1)],
                    'Ultimos 7 dias': [moment().subtract('days', 6), moment()],
                    'Ultimos 30 dias': [moment().subtract('days', 29), moment()],
                    'Este mes': [moment().startOf('month'), moment().endOf('month')],
                    'Ultimo mes': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                },
                opens: 'left',
                applyClass: 'btn-small bg-slate-600',
                cancelClass: 'btn-small btn-default'
            },
            function(start, end) {
                $('.daterange-ranges span').html(start.format('MMM D, YYYY') + ' &nbsp; - &nbsp; ' + end.format('MMM D, YYYY'));
            }
        );


    </script>


@endsection