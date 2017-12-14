@extends('layouts.home')


@section('scripts_header')
    <script type="text/javascript" src="{{ URL::asset('js/plugins/tables/datatables/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/plugins/tables/datatables/extensions/responsive.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/plugins/notifications/sweet_alert.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/plugins/forms/wizards/stepy.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/plugins/forms/wizards/steps.min.js')}}"></script>

    <script type="text/javascript" src="{{URL::asset('js/plugins/ui/moment/moment.min.js')}}"></script>
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

    <form id="buscar-cliente" class="form-horizontal col-md-4"  >
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Seleccionar Cliente<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
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
                                <div class="col-lg-6">
                                    <select class="select form-control" id="cliente" name="cliente">
                                    </select>
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>


                            <div id="semana-field" class="form-group" >
                                <label for="semana" class="col-lg-3 control-label">Semana:</label>
                                <div class="col-lg-3">
                                    <input class="form-control" type="number" name="semana" id="semana">
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div class="form-group" id="semanitas-mes">
                                <label class="col-lg-3 control-label">Consultar semana</label>
                                <div class="col-lg-6">
                                    <div id="" class="input-group">
                                        <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                        <input type="text" id="semana-mes" name="semana-mes" class="form-control daterange-single">
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>


                            <div class="text-right">
                                <button type="button" id="btn-enviar" onclick="datos()" class="btn btn-primary">Buscar <i class="icon-arrow-right14 position-right"></i></button>
                            </div>

                        </fieldset>
                    </div>
                </div>

            </div>
        </div>
    </form>



    <div id="seleccionarCliente" class=" col-md-12" >

        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Indicadores de los Clientes<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>

            <div class="panel-body">
                <table class="table datatable-responsive-row-control dataTable no-footer dtr-column" id="indicadoresClientes-table" role="grid">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Pse</th>
                            <th>Sueño</th>
                            <th>Dolor</th>
                            <th>Deseo Entrenar</th>
                            <th>Desayuno</th>
                            <th>Sumatoria</th>
                            <th>Peso Inicial</th>
                            <th>Peso Final</th>
                            <th>Dif. Peso %</th>
                            <th>Hora Entrada</th>
                            <th>Hora Salida</th>
                            <th>Tiempo</th>
                            <th>Pse Global</th>
                            <th>Carga</th>
                            <th>Operaciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>


        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">Resultados<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                    </ul>
                </div>
            </div>

            <div id="resultados" class="panel-body">
            </div>
        </div>


    </div>




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

        $('#semana-mes').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {

                format: 'DD/MM/YYYY'
            },
            showWeekNumbers: true,
            applyClass: 'bg-slate-600',
            cancelClass: 'btn-default'
        });


    </script>


    <script type="text/javascript">
        function datos() {

            // Basic initialization
            table = $('#indicadoresClientes-table').DataTable();

            table.destroy();

            table = $('#indicadoresClientes-table').DataTable({
                autoWidth: false,
                responsive: true,
                paging: false,
                retrieve: true,
                dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
                language: {
                    search: '<span>Filtrar:</span> _INPUT_',
                    lengthMenu: '<span>Mostrar:</span> _MENU_',
                    paginate: { 'primera': 'Primera', 'ultima': 'Ultima', 'siguiente': '→', 'previa': '←' }
                },
                drawCallback: function () {
                    $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
                },
                preDrawCallback: function() {
                    $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
                },
                processing: true,
                serverSide: true,//evita que la columna con botones sea un parametro en la consulta sql
                "aoColumnDefs": [{ 'bSortable': false,"bSearchable": false, 'aTargets': [ 15 ] }],
                ajax: {
                    "url": '{!! route('indicadores.datatable') !!}', "data": {
                        "cliente": $('#cliente option:selected').val(), "semana": $('#semana').val(),
                        success: function (data) {

                        }

                    },
                    error: function (data) {
                        //resetear estilos
                        $('.form-group').removeClass("has-error has-feedback");
                        $('#wizard').find('.form-control-feedback').html('');
                        $('#wizard').find('.help-block').html('');
                        $('#buscar-cliente').find('.form-control-feedback').html('');
                        $('#buscar-cliente').find('.help-block').html('');
                        //mostramos los errores
                        var errors = data.responseJSON;
                        swal("Oops...", "Algo salio mal!", "error");
                        $.each(errors, function (i, item) {
                            if (i === 'message') {
                                $.each(item, function (k, v) {
                                    k = k.replace(/\./g, "-");
                                    $('#' + k + '-field').addClass("has-error has-feedback");
                                    $('#' + k + '-field').find('.form-control-feedback').html('<i class="icon-cancel-circle2"></i>');
                                    $('#' + k + '-field').find('.help-block').html(v);
                                });
                            }
                        })
                        //console.log(errors);
                        // Render the errors with js ...
                    }
                },
                    columns: [
                        {data: 'fecha_indicador', name: 'fecha_indicador'},
                        {data: 'pse', name: 'pse'},
                        {data: 'sueno', name: 'sueno'},
                        {data: 'dolor', name: 'dolor'},
                        {data: 'deseo_entrenar', name: 'deseo_entrenar'},
                        {data: 'desayuno', name: 'desayuno'},
                        {data: 'sumatoria', name: 'sumatoria'},
                        {data: 'peso_inicial', name: 'peso_inicial'},
                        {data: 'peso_final', name: 'peso_final'},
                        {data: 'diferencia_peso_porcentual', name: 'diferencia_peso_porcentual'},
                        {data: 'hora_entrada', name: 'hora_entrada'},
                        {data: 'hora_salida', name: 'hora_salida'},
                        {data: 'tiempo_entrenamiento', name: 'tiempo_entrenamiento'},
                        {data: 'pse_global_sesion', name: 'pse_global_sesion'},
                        {data: 'carga_entrenamiento', name: 'carga_entrenamiento'},
                        {data: 'operaciones', name: 'operaciones'}
                    ]
            });
            $.ajax({"url":'{!! route('indicadores.resultados-semanales') !!}',
                "data":{"cliente" :$('#cliente option:selected').val(),
                    "semana" :$('#semana').val() },

                success:function(data){
                    $('#resultados').html(data);
                },

                error: function (data) {
                    //resetear estilos
                    $('.form-group').removeClass("has-error has-feedback");
                    $('#wizard').find('.form-control-feedback').html('');
                    $('#wizard').find('.help-block').html('');
                    $('#buscar-cliente').find('.form-control-feedback').html('');
                    $('#buscar-cliente').find('.help-block').html('');

                    //mostramos los errores
                    var errors = data.responseJSON;
                    swal("Oops...", "Algo salio mal!", "error");
                    $.each(errors, function (i, item) {
                        if (i === 'message') {
                            $.each(item, function (k, v) {
                                k = k.replace(/\./g, "-");
                                $('#' + k + '-field').addClass("has-error has-feedback");
                                $('#' + k + '-field').find('.form-control-feedback').html('<i class="icon-cancel-circle2"></i>');
                                $('#' + k + '-field').find('.help-block').html(v);
                            });
                        }
                    })
                }
            });

        }



        function eliminar(id){
            swal({
                title: "Esta seguro que desea eliminar?",
                text: "Esta a punto de borrar el indicador de un cliente!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Si, eliminar!",
                closeOnConfirm: false,
                html: false
            }, function() {
                $.ajax({
                    type: 'delete',
                    url: 'eliminar/'+id,
                    data : {"_token": "{{ csrf_token() }}"},
                    dataType: 'json',
                    success: function(data){
                        swal(
                                "Eliminado!",
                                "El indicador del cliente fue eliminado correctamente.",
                                "success"
                        );
                        $('#indicadoresClientes-table').DataTable().ajax.reload();
                    },
                    error: function(data) {

                        var errors = data.responseJSON;
                        swal("Oops...", "Algo salío mal!", "error");
                    }

                });

            });
        }
    </script>


    <script>
        //buscar en formulario cliente
        $("#cliente").select2({
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
    </script>

@endsection
