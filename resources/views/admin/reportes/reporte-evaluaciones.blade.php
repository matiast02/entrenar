@extends('layouts.home')

@section('scripts_header')<meta name="_token" content="{{ csrf_token() }}"/>
<!-- Load Moment.js extension -->
<script type="text/javascript" src="{{URL::asset('js/plugins/ui/moment/moment.min.js')}}"></script>
<!-- Load plugin -->
<script type="text/javascript" src="{{URL::asset('js/plugins/pickers/daterangepicker.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/plugins/notifications/sweet_alert.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/plugins/visualization/echarts/echarts2.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/plugins/visualization/echarts/theme/limitless.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/plugins/notifications/jgrowl.min.js')}}"></script>


<script type="text/javascript" src="{{asset('js/plugins/forms/styling/uniform.min.js')}}"></script>



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

    <form class="form-horizontal" id="buscar-cliente" method="POST" action="generar-reporte-evaluaciones">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Nuevo Reporte<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                    </ul>
                </div>
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-8">
                        <fieldset>
                            <legend class="text-semibold"><i class="icon-reading position-left"></i>Buscar</legend>
                            <div id="cliente-field" class="form-group">
                                <label class="col-lg-3 control-label">Cliente:</label>
                                <div class="col-lg-9">
                                    {{csrf_field()}}
                                    <select class="select"  id="cliente_id" name="cliente">
                                    </select>
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div id="ejercicio-field" class="form-group">
                                <label class="col-lg-3 control-label">Ejercicios</label>
                                <div class="col-lg-9">
                                    @foreach($ejercicios as $ejercicio)
                                    <div class="col-lg-4">
                                        <div class="checkbox">
                                            <label for="{{$ejercicio->nombre}}">

                                                    <input type="checkbox" name="ejercicios[]" class="styled" value="{{$ejercicio->id}}">

                                                {{$ejercicio->nombre}}
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <div id="campos-field" class="form-group">
                                <label class="col-lg-3 control-label">Datos Potencia</label>
                                <div class="col-lg-9">
                                        <div class="col-lg-4">
                                            <div class="checkbox">
                                                <label for="rm">
                                                    <input type="checkbox" name="campos[]" class="styled" value="rm" checked>
                                                    rm
                                                </label>
                                            </div>
                                        </div>
                                    <div class="col-lg-4">
                                        <div class="checkbox">
                                            <label for="peso_corporal">
                                                <input type="checkbox" name="campos[]" class="styled" value="peso_corporal">
                                                peso_corporal
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="checkbox">
                                            <label for="peso_externo">
                                                <input type="checkbox" name="campos[]" class="styled" value="peso_externo">
                                                peso_externo
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="checkbox">
                                            <label for="masa">
                                                <input type="checkbox" name="campos[]" class="styled" value="masa">
                                                masa
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="checkbox">
                                            <label for="potencia_impulsiva">
                                                <input type="checkbox" name="campos[]" class="styled" value="potencia_impulsiva">
                                                potencia_impulsiva
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="checkbox">
                                            <label for="potencia_relativa">
                                                <input type="checkbox" name="campos[]" class="styled" value="potencia_relativa">
                                                potencia_relativa
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="checkbox">
                                            <label for="velocidad_impulsiva">
                                                <input type="checkbox" name="campos[]" class="styled" value="velocidad_impulsiva">
                                                velocidad_impulsiva
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="checkbox">
                                            <label for="fuerza_impulsiva">
                                                <input type="checkbox" name="campos[]" class="styled" value="fuerza_impulsiva">
                                                fuerza_impulsiva
                                            </label>
                                        </div>
                                    </div>
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
                    <button type="submit" id="btn-enviar" onclick="reporte()" class="btn btn-primary">Generar <i class="icon-arrow-right14 position-right"></i></button>
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

        $('select').select2({});

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
     {{-- Si no se encuentran resultados, se muestra una alerta--}}
        @if($errors->any())
        swal("Oops...", "{{$errors->first()}}", "error");
        @endif

    </script>


@endsection