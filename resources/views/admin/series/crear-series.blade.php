@extends('layouts.home')

@section('scripts_header')
    <!-- Load Moment.js extension -->
    <script type="text/javascript" src="{{URL::asset('js/plugins/ui/moment/moment.min.js')}}"></script>
    <!-- Load plugin -->
    <script type="text/javascript" src="{{URL::asset('js/plugins/pickers/daterangepicker.js')}}"></script>

    <script type="text/javascript" src="{{URL::asset('js/plugins/notifications/sweet_alert.min.js')}}"></script>
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

    <form id="crear-serie" class="form-horizontal col-md-6"  >
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Nuevo Test Incremental<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
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

                            <div id="cantidad_series-field" class="form-group">
                                <label class="col-lg-3 control-label">Cantidad de Series:</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name ="cantidad_series" >
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>


                            <div id="peso_corporal-field" class="form-group">
                                <label class="col-lg-3 control-label">Peso Corporal:</label>
                                <div class="col-lg-9">
                                    <input type="text"  name="peso_corporal" class="form-control">
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>


                            <div id="peso_externo-field" class="form-group">
                                <label class="col-lg-3 control-label">Peso Externo:</label>
                                <div class="col-lg-9">
                                    <input type="text"  name="peso_externo" class="form-control">
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>


                            <div id="potencia_impulsiva-field" class="form-group">
                                <label class="col-lg-3 control-label">Potencia Impulsiva:</label>
                                <div class="col-lg-9">
                                    <input type="text"  name="potencia_impulsiva" class="form-control">
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>


                            <div id="velocidad_impulsiva-field" class="form-group">
                                <label class="col-lg-3 control-label">Velocidad Impulsiva:</label>
                                <div class="col-lg-9">
                                    <input type="text"  name="velocidad_impulsiva" class="form-control">
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>


                            <div id="fuerza_impulsiva-field" class="form-group">
                                <label class="col-lg-3 control-label">Fuerza Impulsiva:</label>
                                <div class="col-lg-9">
                                    <input type="text"  name="fuerza_impulsiva" class="form-control">
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


        //enviar formulario
        $("#crear-serie").submit(function(e) {

            $.ajax({
                type: 'post',
                url: "{{route('series.guardar')}}",
                data:  $("#crear-serie").serialize(),
                dataType: 'json',
                success: function(data){
                    swal("Bien!", "Los datos se guardaron correctamente.", "success");
                    //resetear estilos
                    $('.form-group').removeClass("has-error has-feedback");
                    $('#crear-serie').find('.form-control-feedback').html('');
                    $('#crear-serie').find('.help-block').html('');
                    $('#crear-serie')[0].reset();
                },
                error: function(data){
                    //resetear estilos
                    $('.form-group').removeClass("has-error has-feedback");
                    $('#crear-serie').find('.form-control-feedback').html('');
                    $('#crear-serie').find('.help-block').html('');

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