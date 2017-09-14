@extends('layouts.home')

@section('scripts_header')<meta name="_token" content="{{ csrf_token() }}"/>
<!-- Load Moment.js extension -->
<script type="text/javascript" src="{{URL::asset('js/plugins/ui/moment/moment.min.js')}}"></script>
<!-- Load plugin -->
<script type="text/javascript" src="{{URL::asset('js/plugins/pickers/daterangepicker.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/plugins/notifications/sweet_alert.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/plugins/visualization/echarts/echarts2.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/plugins/visualization/echarts/theme/limitless.js')}}"></script>


<script type="text/javascript" src="{{asset('js/plugins/forms/styling/uniform.min.js')}}"></script>



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

    <div class="panel panel-white">
        <div class="panel-heading">
            <h6 class="panel-title">Resultados<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4" id="datos-cliente" style="padding-left: 10px;">

            </div>
            <div class="col-md-4"></div>
        </div>
        <div class="row text-center">
            <div class=""><?php echo $perfil; ?></div>
            <div class="row">
                @for($i = 0; $i <= count($graficos)-1;$i++)
                    <canvas id="chart{{$i}}" class="text-center" width="600" height="400"></canvas>
                @endfor
            </div>
        </div>
        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4">
                <form id="form-pdf" action="{{route('pdfs.crear_pdf_deportista')}}" method="POST">
                    {{csrf_field()}}
                    <input type="hidden" name="cliente" id="cliente">
                    <input type="hidden" name="tipo" value="1">
                    <input type="hidden" name="img" id="img">
                    <input type="hidden" name="ejercicio" id="ejercicio">
                    <button type="submit" id="btn-form-pdf" class="btn btn-primary" style="display:none;margin-bottom: 30px;">Generar PDF<i class="icon-arrow-right14 position-right"></i></button>
                </form>
            </div>

        </div>
    </div>

    </div>


@endsection

@section('scripts')
    <script type="text/javascript">

        @for($i = 0; $i <= count($graficos)-1;$i++)
        var grafico{{$i}} = echarts.init(document.getElementById('chart{{$i}}'));

        var option{{$i}} = {
            title: {
                text: '{{$graficos[$i][0]}}'
            },
            tooltip: {
                data: ['{{implode(' ',$graficos[$i][3])}}']
            },
            legend: {
                data:['{{implode(' ',$graficos[$i][3])}}']
            },
            xAxis: {
                data: [@for($j=0; $j <= count($graficos[$i][2])-1;$j++) "{{$graficos[$i][2][$j]}}" @if($j < count($graficos[$i][2])-1),@endif  @endfor]
            },
            yAxis: {},
            series: [{
                name: '{{implode(' ',$graficos[$i][3])}}',
                type: 'bar',
                data: [@for($j=0; $j <= count($graficos[$i][1])-1;$j++) {{$graficos[$i][1][$j]}} @if($j < count($graficos[$i][1])-1) , @endif @endfor],
                itemStyle: {
                    normal: {
                        label: {
                            show: true,
                            textStyle: {
                                fontWeight: 500
                            }
                        }
                    }
                },
                markLine: {
                    data: [{type: 'average', name: 'Average'}]
                }
            }],
            itemStyle: {
                    normal: {
                        // shadow size
                        shadowBlur: 200,
                        // horizontal offset of shadow
                        shadowOffsetX: 0,
                        // vertical offset of shadow
                        shadowOffsetY: 0,
                        // shadow color
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                }
            };
        @endfor

        window.onload = function() {
            @for($i = 0; $i <= count($graficos)-1;$i++)
            grafico{{$i}}.setOption(option{{$i}});//grafica los datos de respuesta
            @endfor
        };

        //envia la imagen del grafico
        $( "#form-pdf" ).submit(function() {
            var image = new Image();
            image.id = "pic";
            image.src = canvas.toDataURL('image/png');
            $('#cliente').val($('#cliente_id').val());
            $('#img').val(image.src);
            $('#ejercicio').val($('#id_ejercicio').val());
            console.log(image.src);
        });


    </script>


@endsection