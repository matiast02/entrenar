@extends('layouts.home')

@section('scripts_header')<meta name="_token" content="{{ csrf_token() }}"/>
<!-- Load Moment.js extension -->
<script type="text/javascript" src="{{URL::asset('js/plugins/ui/moment/moment.min.js')}}"></script>
<!-- Load plugin -->
<script type="text/javascript" src="{{URL::asset('js/plugins/pickers/daterangepicker.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/plugins/notifications/sweet_alert.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/plugins/forms/wizards/stepy.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/plugins/forms/wizards/steps.min.js')}}"></script>

@endsection

@section('usuario-nombre')
    {{ucfirst(session('nombre'))}}
@endsection

@section('titulo')
    Nuevo Test Incremental
@endsection

@section('ruta')

@endsection

@section('contenido')

    <form class="form-horizontal col-lg-4" id="buscar-cliente" method="POST" >
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Test Incremental<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
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
                            <legend class="text-semibold"><i class="icon-reading position-left"></i>Nuevo Test Incremental</legend>
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
                                <div class="text-center">
                                    <input type="button" id="btn-fuerza" class="btn btn-success" value="Fuerza">
                                    <input type="button" id="btn-no-fuerza" class="btn btn-warning" value="No fuerza">
                                </div>
                            </div>

                            <div id="ejercicio-field" class="form-group" style="display:none;">
                                <label class="col-lg-3 control-label">Ejercicio de Fuerza</label>
                                <div class="col-lg-9">
                                    <select class="select"  id="ejercicio_id" name="ejercicio"  disabled="true">
                                        <option value="#" selected="selected">Seleccione un ejercicio</option>
                                        @foreach($cat_ejer as $cat)
                                         <optgroup label="{{$cat->nombre}}">
                                            @foreach($ejercicios as $ejercicio)
                                                    @if($ejercicio->fuerza == 1)
                                                        @if($cat->id == $ejercicio->categoria_ejercicios_id)
                                         <option value="{{$ejercicio->id}}">{{$ejercicio->nombre}}</option>
                                                        @endif
                                                    @endif
                                            @endforeach
                                         </optgroup>
                                        @endforeach
                                    </select>
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div id="peso_corporal-field" class="form-group" style="display:none;">
                                <label class="col-lg-3 control-label">Peso Corporal kg</label>
                                <div class="col-lg-9">
                                    <input type="number" id="peso_corporal" name="peso_corporal" value="80" class="touchspin-empty form-control" style="display: block;">
                                    <input type="hidden" id="cantidad_series" name="cantidad_series" value="0" class="touchspin-empty form-control" style="display: block;">
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>

                            <div id="ejercicio-nf-field" class="form-group" style="display:none;">
                                <label class="col-lg-3 control-label">Ejercicio no fuerza</label>
                                <div class="col-lg-9">
                                    <select class="select"  id="ejercicio_nf_id" name="ejercicio" disabled="true">
                                        <option value="#" selected="selected">Seleccione un ejercicio</option>
                                    @foreach($cat_ejer as $cat)
                                         <optgroup label="{{$cat->nombre}}">
                                                @foreach($ejercicios as $ejercicio)
                                                        @if($ejercicio->fuerza == 0)
                                                            @if($cat->id == $ejercicio->categoria_ejercicios_id)
                                         <option value="{{$ejercicio->id}}">{{$ejercicio->nombre}}</option>
                                                            @endif
                                                        @endif
                                                @endforeach
                                         </optgroup>
                                        @endforeach
                                    </select>
                                    <div class="form-control-feedback"></div>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            {{--<div id="cantidad_series-field" class="form-group">--}}
                                {{--<label class="col-lg-3 control-label">Cantidad de Series</label>--}}
                                {{--<div class="col-lg-9">--}}
                                    {{----}}
                                    {{--<div class="form-control-feedback"></div>--}}
                                    {{--<span class="help-block"></span>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                        </fieldset>
                    </div>
                </div>

                <div class="text-right">
                    <button type="button" id="btn-enviar" onclick="steps()" class="btn btn-primary" style="display: none;"></button>
                    <button type="button" id="btn-removeStep" onclick="removeStep()" class="btn btn-danger" style="display: none;">-</button>
                </div>
            </div>
        </div>
    </form>


    <div class="panel panel-white col-lg-8" id="panel-series" style="display: none;">
        <div class="panel-heading">
            <h6 class="panel-title">Carga de Series<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                </ul>
            </div>
        </div>
        <form class="form-horizontal" method="POST" id="wizard">

        </form>
    </div>

    <div class="panel panel-white col-lg-4" id="panel-series-nf" style="display: none;">

    </div>



@endsection

@section('scripts')
    <script type="text/javascript">

        $('#btn-fuerza').click(function(){
            $('#ejercicio-field').show();
            $('#peso_corporal-field').show();
            $('#ejercicio-nf-field').hide();
            $('#panel-series-nf').hide();
            $('#btn-enviar').show();
            $('#ejercicio_id').prop('disabled',false);
            $('#ejercicio_nf_id').prop('disabled',false);
        });

        $('#btn-no-fuerza').click(function(){
            $('#ejercicio-nf-field').show();
            $('#ejercicio-field').hide();
            $('#peso_corporal-field').hide();
            $('#btn-enviar').hide();
            $('#btn-removeStep').hide();
            $('#panel-series').hide();
            $('#ejercicio_id').prop('disabled',true);
            $('#ejercicio_nf_id').prop('disabled',false);

        });


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        var numero = 0; //variable global para contar el numero de series

        $(function() {
            $('#panel-series').hide();
            $('#btn-enviar').html('<b>Series</b> <i class="icon-plus2 position-right"></i>');
        });

        var wizard = $("#wizard").steps({
            transitionEffect: "none",
            startIndex: 0,
            labels: {
                cancel: 'Cancelar',
                next: 'siguiente',
                previous: 'anterior',
                finish: 'Enviar'
            },
            onFinished: function (event, currentIndex) {
                event.preventDefault();
                event.stopImmediatePropagation();
                var datos = $('#wizard').serializeArray();
                datos.push({name:'peso_corporal',value: $('#peso_corporal').val()});
                datos.push({name:'cantidad_series',value: $('#cantidad_series').val()});
                datos.push({name:'cliente',value: $('#cliente_id').val()});
                datos.push({name:'ejercicio',value: $('#ejercicio_id').find(':selected')[0].value});
                $.ajax({
                    type: 'post',
                    url: "{{route('series.guardar')}}",
                    data:  datos,
                    dataType: 'json',
                    success: function(data){
                        swal("Bien!", "Los datos se guardaron correctamente.", "success");
                        //resetear estilos
                        $('.form-group').removeClass("has-error has-feedback");
                        $('#wizard').find('.form-control-feedback').html('');
                        $('#wizard').find('.help-block').html('');
                        $('#wizard')[0].reset();
                        $('#buscar-cliente').find('.form-control-feedback').html('');
                        $('#buscar-cliente').find('.help-block').html('');
                        $('#buscar-cliente')[0].reset();
                        $("#wizard").html("");
                        numero = 0;
//                        location.reload();
                    },
                    error: function(data){
                        //resetear estilos
                        $('.form-group').removeClass("has-error has-feedback");
                        $('#wizard').find('.form-control-feedback').html('');
                        $('#wizard').find('.help-block').html('');
                        $('#buscar-cliente').find('.form-control-feedback').html('');
                        $('#buscar-cliente').find('.help-block').html('');
                        //mostramos los errores
                        var errors = data.responseJSON;
                        swal("Oops...", "Algo salio mal!", "error");
                        $.each(errors, function(i,item){
                            if(i === 'message'){
                                $.each(item,function (k,v){
                                    k = k.replace(/\./g,"-");
                                    $('#'+k+'-field').addClass("has-error has-feedback");
                                    $('#'+k+'-field').find('.form-control-feedback').html('<i class="icon-cancel-circle2"></i>');
                                    $('#'+k+'-field').find('.help-block').html(v);
                                });
                            }
                        })
                        //console.log(errors);
                        // Render the errors with js ...
                    }
                });

            }

        });


        function steps(){
            $('#panel-series').show();
            add_step(numero);
            $('#cantidad_series').val(numero);
            console.log("serie agregada "+numero);
            numero++;
//            console.log("serie siguiente "+numero);

            //muestra u oculta el boton segun corresponda
            $('[id="btn-eliminar-serie"]').each(function( index ) {
                //si es laa ultima serie, muestro el boton eliminar
                if((numero-1 == index) && (numero-1 != 0)){
                    $( this ).show();
                }else{
                    //oculto el boton eliminar de las series anteriores
                    $( this ).hide();
                }
            });
        }


        function remove(index){

            //elimin la serie siguiente
            if (numero > 0){

                console.log("serie eliminada "+(index));
                wizard.steps('previous');//vuelve  a la serie anterior
                //elimina la serie con el index indicado (actual)
                console.log(wizard.steps('remove',(index)));
                //para evitar que numero vuelva a ser 0
                if(numero > 1){
                    numero = numero - 1;
                }
                $('#cantidad_series').val(numero);
                //muestra u oculta el boton segun corresponda
                $('[id="btn-eliminar-serie"]').each(function( index ) {
                    //si es laa ultima serie, muestro el boton eliminar
                    if((numero-1 == index) && (numero-1 != 0)){
                        $( this ).show();
                    }else{
                        //oculto el boton eliminar de las series anteriores
                        $( this ).hide();
                    }
                });

            }

        }

        function add_step(numero){
            // Add step
            wizard.steps("add", {
                title: "Serie "+numero,
                content: ' <div class="col-md-6"><fieldset>' +
                '<legend class="text-semibold"><i class="icon-reading position-left"></i>Serie '+numero+'</legend>'+
                '<div id="serie-'+numero+'-pes_ext-field" class="form-group">'+
                '<label class="col-lg-3 control-label">Peso Externo:</label>'+
                '<div class="col-lg-4">'+
                '<input type="number" id="peso_externo" name="serie['+numero+'][pes_ext]" value="" class="touchspin-empty form-control" style="display: block;">'+
                '<div class="form-control-feedback"></div>'+
                '<span class="help-block"></span>'+
                ' </div>'+
                '</div>'+
                '<div id="serie-'+numero+'-can_rep-field" class="form-group">'+
                '<label class="col-lg-3 control-label">Cantidad de Repeticiones:</label>'+
                '<div class="col-lg-4">'+
                '<input type="number" name="serie['+numero+'][can_rep]" value="" class="touchspin-empty form-control" style="display: block;">'+
                '<div class="form-control-feedback"></div>'+
                '<span class="help-block"></span>'+
                ' </div>'+
                '</div>'+
                '<div id="serie-'+numero+'-pot_imp-field" class="form-group">'+
                '<label class="col-lg-3 control-label">Potencia Impulsiva:</label>'+
                '<div class="col-lg-4">'+
                '<input type="number" name="serie['+numero+'][pot_imp]" value="" class="touchspin-empty form-control" style="display: block;">'+
                '<div class="form-control-feedback"></div>'+
                '<span class="help-block"></span>'+
                ' </div>'+
                '</div>'+
                '<div id="serie-'+numero+'-pse" class="form-group">'+
                '<label class="col-lg-3 control-label">PSE:</label>'+
                '<div class="col-lg-4">'+
                '<input type="number" name="serie['+numero+'][pse]" value="" class="touchspin-empty form-control" style="display: block;">'+
                '<div class="form-control-feedback"></div>'+
                '<span class="help-block"></span>'+
                ' </div>'+
                '</div>'+
                '</fieldset></div>'+
                '<div class="col-md-6"><fieldset>'+
                '<legend class="text-semibold"><i class="icon-reading position-left"></i> </legend>'+
                '<div id="serie-'+numero+'-masa" class="form-group">'+
                '<label class="col-lg-3 control-label">Masa:</label>'+
                '<div class="col-lg-4">'+
                '<input type="number" name="serie['+numero+'][masa]" value="" class="touchspin-empty form-control" style="display: block;">'+
                '<div class="form-control-feedback"></div>'+
                '<span class="help-block"></span>'+
                ' </div>'+
                '</div>'+
                '<div id="serie-'+numero+'-vel_imp-field" class="form-group">'+
                '<label class="col-lg-3 control-label">Velicidad Impulsiva:</label>'+
                '<div class="col-lg-4">'+
                '<input type="number" name="serie['+numero+'][vel_imp]" value="" class="touchspin-empty form-control" style="display: block;">'+
                '<div class="form-control-feedback"></div>'+
                '<span class="help-block"></span>'+
                ' </div>'+
                '</div>'+
                '<div id="serie-'+numero+'-fue_imp-field" class="form-group">'+
                '<label class="col-lg-3 control-label">Fuerza Impulsiva:</label>'+
                '<div class="col-lg-4">'+
                '<input type="number" name="serie['+numero+'][fue_imp]" value="" class="touchspin-empty form-control" style="display: block;">'+
                '<div class="form-control-feedback"></div>'+
                '<span class="help-block"></span>'+
                ' </div>'+
                '</div>'+
                '<input type="button" class="btn btn-warning" id="btn-eliminar-serie" name="boton-eliminar-'+numero+'" value="Eliminar Serie '+Number(numero)+'">'+
                '<fieldset></div>'+
                '<div id="boton-eliminar-'+numero+'"></div>'
            });

            //calcular la masa en base al peso externo y corporal
            $('body').on('change', 'input[name="serie['+numero+'][pes_ext]"]', function() {
                $('input[name="serie['+numero+'][masa]"]').val(Number($('input[name="serie['+numero+'][pes_ext]"]').val()) + Number($('#peso_corporal').val()));
            });

//            cantidad de pasos
//            var wizardLength = $("#wizard").find('h1').length;
//            console.log("numero "+numero+" cantidad de pasos "+(wizardLength-1));

            //para cuando quiere eliminar un paso
            $('input[name="boton-eliminar-'+numero).click( function (e) {
                e.preventDefault();
                remove(wizard.steps("getCurrentIndex"));
            });



        }

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

        $(".steps-basic").steps();


        var id_ejer_nf = 0;
        //carga el formulario correspondiente al ejercicio de no fuerza indicado
        $('#ejercicio_nf_id').change(function () {
            id_ejer_nf = $(this).find(':selected')[0].value;
            $.ajax({
                type: 'GET',
                url: '../evaluaciones/mostrar-formulario/'+id_ejer_nf,
                success: function (data) {
                    $('#panel-series-nf').show();
                    $('#panel-series-nf').html(data);
                }
            });

        });

        //envia los datos del ejercicio de no fuerza
        $(document).on('submit','#form-nf',function(e){
            e.preventDefault();
            var datos = $('#form-nf').serializeArray();
            datos.push({name:'cliente',value: $('#cliente_id').val()});
            datos.push({name:'ejercicio',value: id_ejer_nf});
            $.ajax({
                type: 'POST',
                url: '{{route("cargar-resultado-nf")}}',
                data: datos,
                success: function (data) {
                    swal("Bien!", "Los datos se guardaron correctamente.", "success");
                    $('.form-group').removeClass("has-error has-feedback");
                    $('#buscar-cliente').find('.form-control-feedback').html('');
                    $('#buscar-cliente').find('.help-block').html('');
                    $('#buscar-cliente')[0].reset();
                    $('#form-nf').find('.form-control-feedback').html('');
                    $('#form-nf').find('.help-block').html('');
                    location.reload();
                },
                error: function(data){;

                    $('#buscar-cliente').find('.form-control-feedback').html('');
                    $('#buscar-cliente').find('.help-block').html('');
                    //mostramos los errores
                    var errors = data.responseJSON;
                    swal("Oops...", "Algo salio mal!", "error");
                    $.each(errors, function(i,item){
                        if(i === 'message'){
                            $.each(item,function (k,v){
                                k = k.replace(/\./g,"-");
                                $('#'+k+'-field').addClass("has-error has-feedback");
                                $('#'+k+'-field').find('.form-control-feedback').html('<i class="icon-cancel-circle2"></i>');
                                $('#'+k+'-field').find('.help-block').html(v);
                            });
                        }
                    })
                }
            });
        });




    </script>


@endsection