{{--extends -> Hereda, es como el include--}}
@extends('layouts.home')


{{--@section -> Inserta--}}
@section('scripts_header')
    <script type="text/javascript" src="{{URL::asset('js/plugins/ui/moment/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/plugins/pickers/daterangepicker.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/plugins/tables/datatables/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/plugins/tables/datatables/extensions/responsive.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/plugins/notifications/sweet_alert.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/plugins/forms/wizards/stepy.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/plugins/forms/wizards/steps.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/plugins/visualization/echarts/echarts2.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/plugins/visualization/echarts/theme/limitless.js')}}"></script>

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

    <form id="buscar-cliente" class="form-horizontal col-md-6"  >
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
                                <div class="col-lg-8">
                                    <select class="form-control" id="cliente" name="cliente" >

                                    </select>
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>


                            <div id="rango-fechas-field" class="form-group">
                                <label for="rango-fechas" class="col-lg-3 control-label">Fechas</label>
                                <div class="col-lg-8">
                                    <input type="text" id="rango_fechas" name="rango_fechas" class="form-control daterange-ranges" value="01/04/2016 - 31/01/2017">
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
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


    <form id="seleccionarCliente" class="form-horizontal col-md-12" >
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Listado de Antropometria<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>

            <div class="panel-body">
                <table class="table datatable-responsive-row-control dataTable no-footer dtr-column" id="antropometria-table" role="grid">
                    <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Peso Corporal</th>
                        <th>Talla</th>
                        <th>% Adiposo</th>
                        <th>% Musculas</th>
                        <th>Índice Endo</th>
                        <th>Índice Meso</th>
                        <th>Índice Hecto</th>
                        <th>Clasificación</th>
                        <th>Ideal</th>
                        <th>Operaciones</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </form>
@endsection

@section('scripts')

    <script type="text/javascript">
        $('select').select2({});

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
    </script>


    <script type="text/javascript">
         function datos() {

             table = $('#antropometria-table').DataTable();

             table.destroy();

            // Basic initialization
             table =  $('#antropometria-table').DataTable({
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
                "aoColumnDefs": [{ 'bSortable': false,"bSearchable": false, 'aTargets': [ 9 ] }],
                 ajax: {
                     "url":'{!! route('antropometrias.datatable') !!}',
                     "data":{"cliente" :$('#cliente option:selected').val(),'rango_fechas': $('#rango_fechas').val()},
                     error: function(data){
                         //resetear estilos
                         $('.form-group').removeClass("has-error has-feedback");
                         $('#buscar-cliente').find('.form-control-feedback').html('');
                         $('#buscar-cliente').find('.help-block').html('');

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

                     }},

                columns: [
                    {data: 'fecha_antropometria', name: 'fecha_antropometria'},
                    {data: 'peso_corporal', name: 'peso_corporal'},
                    {data: 'talla', name: 'talla'},
                    {data: 'porcentaje_adiposo', name: 'porcentaje_adiposo'},
                    {data: 'porcentaje_muscular', name: 'porcentaje_muscular'},
                    {data: 'indice_endo', name: 'indice_endo'},
                    {data: 'indice_meso', name: 'indice_meso'},
                    {data: 'indice_hecto', name: 'indice_hecto'},
                    {data: 'clasificacion', name: 'clasificacion'},
                    {data: 'ideal', name: 'ideal'},
                    {data: 'operaciones', name: 'operaciones'}
                ]
            });
        }


        function eliminar(id){
            swal({
                title: "Esta seguro que desea eliminar?",
                text: "Esta a punto de borrar todos los registros de la antropometria!",
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
                                "Antropometria eliminada correctamente.",
                                "success"
                        );
                        $('#antropometria-table').DataTable().ajax.reload();
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