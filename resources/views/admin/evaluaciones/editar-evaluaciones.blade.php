@extends('layouts.home')

@section('scripts_header')<meta name="_token" content="{{ csrf_token() }}"/>
<!-- Load Moment.js extension -->
<script type="text/javascript" src="{{URL::asset('js/plugins/ui/moment/moment.min.js')}}"></script>
<!-- Load plugin -->
<script type="text/javascript" src="{{URL::asset('js/plugins/pickers/daterangepicker.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('js/plugins/tables/datatables/datatables.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/plugins/tables/datatables/extensions/responsive.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/plugins/notifications/sweet_alert.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/plugins/visualization/echarts/echarts2.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/plugins/visualization/echarts/theme/limitless.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/plugins/notifications/jgrowl.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/plugins/forms/styling/uniform.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/plugins/forms/wizards/stepy.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/plugins/forms/wizards/steps.min.js')}}"></script>

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

    <form class="form-horizontal col-md-12" id="editar-evaluaciones" method="POST">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Modificar Evaluaciones<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                    </ul>
                </div>
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-8">
                       {!! $formulario !!}
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" id="btn-enviar" class="btn btn-primary">Aceptar <i class="icon-arrow-right14 position-right"></i></button>
                </div>
            </div>
        </div>
    </form>
@endsection


@section('scripts')
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });


        $('select').select2({});

    </script>




    <script type="text/javascript">

        $('#editar-evaluaciones').on('submit',function (e) {
            e.preventDefault();
            $.ajax({
                type: 'patch',
                url: "{{route('evaluaciones.update',$evaluacion->id)}}",
                data: $("#editar-evaluaciones").serialize(),
                dataType: 'json',
                success: function (data) {
                    $('#resultados').html(data);
                    //resetear estilos
                    swal("Bien!", "Los datos se guardaron correctamente.", "success");

                    $('.form-group').removeClass("has-error has-feedback");
                    $('#editar-evaluaciones').find('.form-control-feedback').html('');
                    $('#editar-evaluaciones').find('.help-block').html('');

                    var delay = 1280;
                    setTimeout(function(){window.location.replace("{{route('listar.evaluaciones')}}") }, delay);

                },
                error: function (data) {
                    //resetear estilos
                    $('.form-group').removeClass("has-error has-feedback");
                    $('#editar-evaluaciones').find('.form-control-feedback').html('');
                    $('#editar-evaluaciones').find('.help-block').html('');

                    //mostramos los errores
                    var errors = data.responseJSON;
                    swal("Oops...", "Algo salio mal!", "error");
                    $.each(errors, function (i, item) {
                        if (i === 'message') {
                            $.each(item, function (k, v) {
                                $('#' + k + '-field').addClass("has-error has-feedback");
                                $('#' + k + '-field').find('.form-control-feedback').html('<i class="icon-cancel-circle2"></i>');
                                $('#' + k + '-field').find('.help-block').html(v);
                            });
                        }
                    })

                }
            });
        });

    </script>



@endsection