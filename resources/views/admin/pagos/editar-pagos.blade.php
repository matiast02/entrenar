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

    <form id="editar-pago" class="form-horizontal col-md-6"  >
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Modificar Pago<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
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

                            <div id="dias_semana-field" class="form-group">
                                <label class="col-lg-3 control-label">Cantidad de Días:</label>
                                <div class="col-lg-9">
                                    <select class="select" name="dias_semana" id="dias_semana">
                                        <option value="{{$pago->dias_semana}}" selected>{{ucfirst($pago->dias_semana)}}</option>
                                        <option value="1" disabled>Seleccionar Cantidad de Días.</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>



                            <div id="grupo-field" class="form-group">
                                <label class="col-lg-3 control-label">Grupo:</label>
                                <div class="col-lg-9">
                                    {{--<input type="text" class="form-control" name ="grupo" >--}}
                                    <select class="select" name="grupo">
                                        <option value="{{$pago->grupo}}" selected>{{ucfirst($pago->grupo)}}</option>
                                        <option value="0" disabled>Seleccionar Grupo de Trabajo.</option>
                                        <option value="1">1</option>
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="15">15</option>
                                    </select>
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>


                            <div id="costo_mensual-field" class="form-group">
                                <label class="col-lg-3 control-label">Costo Mensual:</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name ="costo_mensual" value="{{$pago->costo_mensual}}">
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
        $("#editar-pago").submit(function(e) {

            $.ajax({
                type: 'patch',
                url: "{{route('pagos.update',$pago->id)}}",
                data:  $("#editar-pago").serialize(),
                dataType: 'json',
                success: function(data){
                    swal("Bien!", "Los datos se guardaron correctamente.", "success");
                    //resetear estilos
                    $('.form-group').removeClass("has-error has-feedback");
                    $('#editar-pago').find('.form-control-feedback').html('');
                    $('#editar-pago').find('.help-block').html('');
                    $('#editar-pago')[0].reset();

                    var delay = 1250;
                    setTimeout(function(){window.location.replace("{{route('listar.pagos')}}") }, delay);
                },

                error: function(data){
                    //resetear estilos
                    $('.form-group').removeClass("has-error has-feedback");
                    $('#editar-pago').find('.form-control-feedback').html('');
                    $('#editar-pago').find('.help-block').html('');

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