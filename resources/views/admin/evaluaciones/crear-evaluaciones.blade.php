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

    <form id="crear-evaluaciones" class="form-horizontal col-md-6"  >
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Nueva Evaluacion<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
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

                            <div id="maximo_peso-field" class="form-group">
                                <label class="col-lg-3 control-label">Máximo Peso:</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name ="maximo_peso" >
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>


                            <div id="velocidad_segundos-field" class="form-group">
                                <label class="col-lg-3 control-label">Velocidad en Segundos:</label>
                                <div class="col-lg-9">
                                    <input type="text"  name="velocidad_segundos" class="form-control">
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>


                            <div id="salto_abalacob-field" class="form-group">
                                <label class="col-lg-3 control-label">Salta Abalacob:</label>
                                <div class="col-lg-9">
                                    <input type="text"  name="salto_abalacob" class="form-control">
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>


                            <div id="salto_cmj-field" class="form-group">
                                <label class="col-lg-3 control-label">Salto CMJ:</label>
                                <div class="col-lg-9">
                                    <input type="text"  name="salto_cmj" class="form-control">
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>


                            <div id="salto_sj-field" class="form-group">
                                <label class="col-lg-3 control-label">Salto SJ:</label>
                                <div class="col-lg-9">
                                    <input type="text"  name="salto_sj" class="form-control">
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>


                            <div id="mejor_salto_continuo-field" class="form-group">
                                <label class="col-lg-3 control-label">Mejor Salto Continuo:</label>
                                <div class="col-lg-9">
                                    <input type="text"  name="mejor_salto_continuo" class="form-control">
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>


                            <div id="peor_salto_continuo-field" class="form-group">
                                <label class="col-lg-3 control-label">Peor Salto Continuo:</label>
                                <div class="col-lg-9">
                                    <input type="text"  name="peor_salto_continuo" class="form-control">
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>


                            <div id="cantidad_salto_continuo-field" class="form-group">
                                <label class="col-lg-3 control-label">Cantidad Saltos Continuo:</label>
                                <div class="col-lg-9">
                                    <input type="text"  name="cantidad_salto_continuo" class="form-control">
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>


                            <div id="resistencia_numero_fase-field" class="form-group">
                                <label class="col-lg-3 control-label">Resistencia Número Fase:</label>
                                <div class="col-lg-9">
                                    <input type="text"  name="resistencia_numero_fase" class="form-control">
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
        $("#crear-evaluaciones").submit(function(e) {

            $.ajax({
                type: 'post',
                url: "{{route('evaluaciones.guardar')}}",
                data:  $("#crear-evaluaciones").serialize(),
                dataType: 'json',
                success: function(data){
                    swal("Bien!", "Los datos se guardaron correctamente.", "success");
                    //resetear estilos
                    $('.form-group').removeClass("has-error has-feedback");
                    $('#crear-evaluaciones').find('.form-control-feedback').html('');
                    $('#crear-evaluaciones').find('.help-block').html('');
                    $('#crear-evaluaciones')[0].reset();
                },
                error: function(data){
                    //resetear estilos
                    $('.form-group').removeClass("has-error has-feedback");
                    $('#crear-evaluaciones').find('.form-control-feedback').html('');
                    $('#crear-evaluaciones').find('.help-block').html('');

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