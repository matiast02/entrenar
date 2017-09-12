@extends('layouts.home')

@section('scripts_header')
<meta name="_token" content="{{ csrf_token() }}"/>
<!-- Load Moment.js extension -->
<script type="text/javascript" src="{{URL::asset('js/plugins/ui/moment/moment.min.js')}}"></script>
<!-- Load plugin -->
<script type="text/javascript" src="{{URL::asset('js/plugins/pickers/daterangepicker.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/plugins/notifications/sweet_alert.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/plugins/forms/wizards/stepy.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/plugins/forms/wizards/steps.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/plugins/ui/fullcalendar/fullcalendar.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/plugins/ui/fullcalendar/lang/es.js')}}"></script>

@endsection

@section('usuario-nombre')
    {{ucfirst(session('nombre'))}}
@endsection

@section('titulo')
    Asistencias
@endsection

@section('ruta')

@endsection

@section('contenido')

    <form class="form-horizontal col-lg-4" id="ver-asistencias" method="GET" >
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Asistencias<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
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
                            <legend class="text-semibold"><i class="icon-reading position-left"></i>Ver Asistencias</legend>
                            <div id="cliente-field" class="form-group">
                                <label class="col-lg-3 control-label">Cliente:</label>
                                <div class="col-lg-9">
                                    <select class="select" id="cliente_id" name="cliente">
                                    </select>
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="text-right">
                                    <input type="submit" id="ver" class="btn btn-primary" value="Ver">
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <div class="panel panel-white col-lg-8" id="calendario" style="display:none ;">
        <div class="panel-heading">
            <h6 class="panel-title">Calendario de asistencias<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                </ul>
            </div>
        </div>
        <div class="panel-body">
            <div class="fullcalendar-basic"></div>
        </div>

    </div>

    </div>



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


        $('#ver-asistencias').on('submit',function (e){
            e.preventDefault();
            $('#calendario').show();
            $('.fullcalendar-basic').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek'
                },
                defaultDate: moment().format("YYYY MM DD"),//fecha actual
                editable: false,
                locale: 'es',
                eventColor: '#4CAF50',
                events: {
                    url: 'asistencias/'+$('#cliente_id').val(),
                    type: 'GET'
                }
            });
        });








    </script>


@endsection