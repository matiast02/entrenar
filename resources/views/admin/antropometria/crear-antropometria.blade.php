@extends('layouts.home')

@section('scripts_header')
    <!-- Load Moment.js extension -->
    <script type="text/javascript" src="{{URL::asset('js/plugins/ui/moment/moment.min.js')}}"></script>
    <!-- Load plugin -->
    <script type="text/javascript" src="{{URL::asset('js/plugins/pickers/daterangepicker.js')}}"></script>

    <script type="text/javascript" src="{{URL::asset('js/plugins/notifications/sweet_alert.min.js')}}"></script>

    <script type="text/javascript" src="{{URL::asset('js/plugins/pickers/anytime.min.js')}}"></script>

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

    <form id="crear-antropometria" class="form-horizontal col-md-6"  >
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Nueva Antropometria<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
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
                                    <select class="select" id="cliente_id" name="cliente">
                                    </select>
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-lg-3 control-label">Fecha Antropometria: </label>
                                <div class="col-lg-9">
                                    <div id="fecha_antropometria-field" class="input-group">
                                        <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                        <input type="text" id="fecha_antropometria"  name="fecha_antropometria" class="form-control daterange-single">
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>

                            <div id="peso_corporal-field" class="form-group">
                                <label class="col-lg-3 control-label">Peso Corporal:</label>
                                <div class="col-lg-9">
                                    <input type="number" step="any" class="form-control" name="peso_corporal" >
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>


                            <div id="talla-field" class="form-group">
                                <label class="col-lg-3 control-label">Talla:</label>
                                <div class="col-lg-9">
                                    <input type="number" step="any" class="form-control" name="talla" >
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>


                            <div id="porcentaje_adiposo-field" class="form-group">
                                <label class="col-lg-3 control-label">Porcentaje Adiposo:</label>
                                <div class="col-lg-9">
                                    <input type="number" step="any" class="form-control" name="porcentaje_adiposo" >
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>


                            <div id="porcentaje_muscular-field" class="form-group">
                                <label class="col-lg-3 control-label">Porcentaje Muscular:</label>
                                <div class="col-lg-9">
                                    <input type="number" step="any" class="form-control" name="porcentaje_muscular" >
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>


                            <div id="indice_endo-field" class="form-group">
                                <label class="col-lg-3 control-label">Índice Endo:</label>
                                <div class="col-lg-9">
                                    <input type="number" step="any" class="form-control" name="indice_endo" >
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>


                            <div id="indice_meso-field" class="form-group">
                                <label class="col-lg-3 control-label">Índice Meso:</label>
                                <div class="col-lg-9">
                                    <input type="number" step="any" class="form-control" name="indice_meso" >
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div id="indice_hecto-field" class="form-group">
                                <label class="col-lg-3 control-label">Índice Ecto:</label>
                                <div class="col-lg-9">
                                    <input type="text" step="any" class="form-control" name="indice_hecto" >
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>


                            <div id="clasificacion-field" class="form-group">
                                <label class="col-lg-3 control-label">Clasificación:</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="clasificacion" >
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>


                            <div id="ideal-field" class="form-group">
                                <label class="col-lg-3 control-label">Ideal:</label>
                                <div class="col-lg-9">
                                    <input type="text" step="any" class="form-control" name="ideal" >
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>


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
        $('#fecha_antropometria').daterangepicker({
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


        //enviar formulario
        $("#crear-antropometria").submit(function(e) {

            $.ajax({
                type: 'post',
                url: "{{route('antropometrias.guardar')}}",
                data:  $("#crear-antropometria").serialize(),
                dataType: 'json',
                success: function(data){
                    swal("Bien!", "Los datos se guardaron correctamente.", "success");
                    //resetear estilos
                    $('.form-group').removeClass("has-error has-feedback");
                    $('#crear-antropometria').find('.form-control-feedback').html('');
                    $('#crear-antropometria').find('.help-block').html('');
                    $('#crear-antropometria')[0].reset();

                    var delay = 1250;
                    setTimeout(function(){window.location.replace("{{route('crear.antropometrias')}}") }, delay);

                },

                error: function(data){
                    //resetear estilos
                    $('.form-group').removeClass("has-error has-feedback");
                    $('#crear-antropometria').find('.form-control-feedback').html('');
                    $('#crear-antropometria').find('.help-block').html('');

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