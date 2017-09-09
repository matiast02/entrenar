@extends('layouts.home')

@section('scripts_header')
    <!-- Load Moment.js extension -->
    <script type="text/javascript" src="{{URL::asset('js/plugins/ui/moment/moment.min.js')}}"></script>
    <!-- Load plugin -->
    <script type="text/javascript" src="{{URL::asset('js/plugins/pickers/daterangepicker.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/plugins/notifications/sweet_alert.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/pages/form_layouts.js')}}"></script>
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

    <form class="form-horizontal" id="editar-cliente" enctype="multipart/form-data">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Editar Cliente<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
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
                            <legend class="text-semibold"><i class="icon-reading position-left"></i> Datos Personales</legend>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Nombre y Apellido</label>
                                <div class="col-lg-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div id="name-field" class="form-group">
                                                {{csrf_field()}}
                                                {{ method_field('PATCH') }}
                                                <input type="text" name="nombre" placeholder="Nombres" class="form-control" value="{{$cliente->nombre}}">
                                                <div class="form-control-feedback"></div>
                                                <span class="help-block"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div id="apellido-field" class="form-group">
                                                <input type="text" name="apellido" placeholder="Apellidos" class="form-control" value="{{$cliente->apellido}}">
                                                <div class="form-control-feedback"></div>
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">Fecha de Nacimiento: </label>
                                <div class="col-lg-9">
                                    <div id="fecha_nacimiento-field" class="input-group">
                                        <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                        <input type="text" id="fecha_nacimiento"  name="fecha_nacimiento" class="form-control daterange-single" value="{{date("d/m/Y", strtotime($cliente->fecha_nacimiento))}}">
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>

                            <div id="dni-field" class="form-group">
                                <label class="col-lg-3 control-label">DNI:</label>
                                <div class="col-lg-9">
                                    <input type="text"  name="dni" class="form-control" value="{{$cliente->dni}}">
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div id="direccion-field" class="form-group">
                                <label class="col-lg-3 control-label">Direccion:</label>
                                <div class="col-lg-9">
                                    <input type="text"  name="direccion" class="form-control" value="{{$cliente->direccion}}">
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div id="celular-field" class="form-group">
                                <label class="col-lg-3 control-label">Celular:</label>
                                <div class="col-lg-9">
                                    <input type="tel"  name="celular" class="form-control" value="{{$cliente->celular}}">
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div id="categoria-field" class="form-group">
                                <label class="col-lg-3 control-label">Categoria:</label>
                                <div class="col-lg-9">
                                    <select class="select" name="categoria_id">
                                        @foreach($categorias as $categoria)
                                            @if($categoria_cliente == $categoria->id)
                                                <option value="{{$categoria->id}}" selected="selected">{{$categoria->nombre}}</option>
                                            @else
                                                <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{--<div id="categoria-field" class="form-group">--}}
                                {{--<label class="col-lg-3 control-label">Categoria</label>--}}
                                {{--<div class="col-lg-9">--}}
                                    {{--<label class="radio-inline radio-right">--}}
                                        {{--<input type="radio" name="categoria" value="juvenil" @if($cliente->categoria == 0 ) checked="checked" @endif>--}}
                                        {{--Juvenil--}}
                                        {{--<div class="form-control-feedback"></div>--}}
                                        {{--<span class="help-block"></span>--}}
                                    {{--</label>--}}
                                    {{--<label class="radio-inline radio-right">--}}
                                        {{--<input type="radio" name="categoria" value="mayor" @if($cliente->categoria == 1 ) checked="checked" @endif>--}}
                                        {{--Mayor--}}
                                        {{--<div class="form-control-feedback"></div>--}}
                                        {{--<span class="help-block"></span>--}}
                                    {{--</label>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                        </fieldset>
                    </div>


                    <div class="col-md-6">
                        <fieldset>
                            <legend class="text-semibold"><i class="icon-reading position-left"></i> Datos Personales</legend>

                            <div id="deporte-field" class="form-group">
                                <label class="col-lg-3 control-label">Deporte:</label>
                                <div class="col-lg-9">
                                    <select class="select" name="deporte_id">
                                        @foreach($deportes as $deporte)
                                            @if($deporte_cliente == $deporte->id)
                                                <option value="{{$deporte->id}}" selected="selected">{{$deporte->nombre}}</option>
                                            @else
                                                <option value="{{$deporte->id}}">{{$deporte->nombre}}</option>
                                            @endif

                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div id="institucion-field" class="form-group">
                                <label class="col-lg-3 control-label">Institucion:</label>
                                <div class="col-lg-9">
                                    <input type="text"  name="institucion" class="form-control" value="{{$cliente->institucion}}">
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div id="gym-field" class="form-group">
                                <label class="col-lg-3 control-label">Gimnasio:</label>
                                <div class="col-lg-9">
                                    <input type="text"  name="gym" class="form-control" value="{{$cliente->gym}}">
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div id="fecha_inicio_entrenamiento-field" class="form-group">
                                <label class="col-lg-3 control-label">Fecha de Inicio: </label>
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                        <input type="text" id="fecha_inicio_entrenamiento"  name="fecha_inicio_entrenamiento" class="form-control daterange-single" value="{{date("d/m/Y", strtotime($cliente->fecha_inicio_entrenamiento))}}">
                                    </div>
                                </div>
                            </div>


                            <div id="email-field" class="form-group">
                                <label class="col-lg-3 control-label">Email:</label>
                                <div class="col-lg-9">
                                    <input type="email" class="form-control" name ="email" value="{{$cliente->email}}" >
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            {{--<div id="password-field" class="form-group">--}}
                                {{--<label class="col-lg-3 control-label">Contraseña:</label>--}}
                                {{--<div class="col-lg-9">--}}
                                    {{--<input type="password" class="form-control" name="password" >--}}
                                    {{--<div class="form-control-feedback"></div>--}}
                                    {{--<span class="help-block"></span>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div id="password_confirmation-field" class="form-group">--}}
                                {{--<label class="col-lg-3 control-label">Confirme la Contraseña:</label>--}}
                                {{--<div class="col-lg-9">--}}
                                    {{--<input type="password" class="form-control" name="password_confirmation" >--}}
                                    {{--<div class="form-control-feedback"></div>--}}
                                    {{--<span class="help-block"></span>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            <div id="foto-field" class="form-group">
                                <label class="col-lg-3 control-label">Foto</label>
                                <div class="media no-margin-top">
                                    <div class="media-left">
                                        <a href="#"><img src="{{asset($cliente->foto)}}" style="width: 58px; height: 58px; border-radius: 2px;" alt=""></a>
                                    </div>

                                    <div class="media-body">
                                        <div class="uploader">
                                            <input type="file" id="foto" name="foto" class="file-styled">
                                        </div>
                                        <div class="form-control-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-lg-9">

                                </div>
                            </div>


                            <div id="estado-field" class="form-group hidden">
                                <label class="col-lg-3 control-label">Estado:</label>
                                <div class="col-lg-9">
                                    <input type="number" class="form-control" name ="estado" value="1">
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>


                        </fieldset>
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit" id="btn-enviar" class="btn btn-primary">Enviar <i class="icon-arrow-right14 position-right"></i></button>
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

        //date picker
        $('#fecha_nacimiento').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'DD/MM/YYYY'
            },
            applyClass: 'bg-slate-600',
            cancelClass: 'btn-default'
        });

        $('#fecha_inicio_entrenamiento').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'DD/MM/YYYY'
            },
            applyClass: 'bg-slate-600',
            cancelClass: 'btn-default'
        });


        //enviar formulario
        $("#editar-cliente").submit(function(e) {
            var fd = new FormData($(this)[0]);
            fd.append( 'file',  $("#foto")[0].files[0] );

            $.ajax({
                type: 'post',
                url: "{{route('update.clientes',$cliente->id)}}",
                dataType: 'json',
                data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false,       // The content type used when sending data to the server.
                cache: false,             // To unable request pages to be cached
                processData:false,
                success: function(data){
                    swal("Bien!", "Los datos se editaron correctamente.", "success");
                    //resetear estilos
                    $('.form-group').removeClass("has-error has-feedback");
                    $('#editar-cliente').find('.form-control-feedback').html('');
                    $('#editar-cliente').find('.help-block').html('');
                    $('#editar-cliente')[0].reset();

                    setTimeout(function(){window.location.replace("{{route('listar.clientes')}}") }, 1280);

                },
                error: function(data){
                    //resetear estilos
                    $('.form-group').removeClass("has-error has-feedback");
                    $('#editar-cliente').find('.form-control-feedback').html('');
                    $('#editar-cliente').find('.help-block').html('');
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
                    // console.log(errors);
                    // Render the errors with js ...
                }
            });

            e.preventDefault(); // avoid to execute the actual submit of the form.
        });

    </script>
@endsection

