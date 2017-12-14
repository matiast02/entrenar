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

    <form id="editar-ejercicio" class="form-horizontal col-md-6">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Modificar Ejercicio<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
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

                            <div id="nombre-field" class="form-group">
                                <label class="col-lg-3 control-label">Ejercicio:</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name ="nombre" value="{{$ejercicio->nombre}}">
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>


                            <div id="categoria_ejercicios-field" class="form-group">
                                <label for="categoria_ejercicios" class="col-lg-3 control-label">Categoria Ejercicio:</label>
                                <div class="col-lg-9">
                                    <select class="select" name="categoria_ejercicios_id" >
                                        @foreach($categoria_ejercicios as $categoria_ejercicio)
                                            @if($categoriaDeLosejercicios == $categoria_ejercicio->id)
                                                <option value="{{$categoria_ejercicio->id}}" selected="selected">{{$categoria_ejercicio->nombre}}</option>
                                            @else
                                                <option value="{{$categoria_ejercicio->id}}">{{$categoria_ejercicio->nombre}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>



                            <div class="form-group hidden">
                                <label class="col-lg-3 control-label">Fuerza?:</label>
                                <div class="col-lg-9">
                                    <label class="radio-inline radio-right">
                                        <div>
                                            <span @if($ejercicio->fuerza == 1) class="checked" @endif>
                                                <input type="radio" name="fuerza" value="1" class="styled"  @if($ejercicio->fuerza == 1) checked="checked" @endif>
                                            </span>
                                        </div>
                                        Si
                                    </label>

                                    <label class="radio-inline radio-right">
                                        <div >
                                            <span @if($ejercicio->fuerza == 0) class="checked" @endif>
                                                <input type="radio" name="fuerza" value="0" class="styled" @if($ejercicio->fuerza == 0)  checked="checked" @endif>
                                            </span>
                                        </div>
                                        No
                                    </label>
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


        //enviar formulario
        $("#editar-ejercicio").submit(function(e) {

            $.ajax({
                type: 'patch',
                url: "{{route('ejercicios.update',$ejercicio->id)}}",
                data:  $("#editar-ejercicio").serialize(),
                dataType: 'json',
                success: function(data){
                    swal("Bien!", "Los datos se guardaron correctamente.", "success");
                    //resetear estilos
                    $('.form-group').removeClass("has-error has-feedback");
                    $('#editar-ejercicio').find('.form-control-feedback').html('');
                    $('#editar-ejercicio').find('.help-block').html('');
                    $('#editar-ejercicio')[0].reset();

                    {{--window.location.replace("{{route('listar.ejercicios')}}");--}}

                    var delay = 1250;
                    setTimeout(function(){window.location.replace("{{route('listar.ejercicios')}}") }, delay);
                },
                error: function(data){
                    //resetear estilos
                    $('.form-group').removeClass("has-error has-feedback");
                    $('#editar-ejercicio').find('.form-control-feedback').html('');
                    $('#editar-ejercicio').find('.help-block').html('');

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