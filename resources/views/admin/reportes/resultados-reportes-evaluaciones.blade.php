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
        <div class="row text-center" id="reporte">
            <div class="" id="perfil"><?php echo $perfil; ?></div>
            <div class="row">
                @for($i = 0; $i <= count($graficos)-1;$i++)
                    <canvas id="chart{{$i}}" class="text-center" width="800" height="400"></canvas>
                @endfor
            </div>
            <div class="row" style="margin:2%;">
                <button id="btn-imprimir" style="display:none;" class="btn btn-primary" onclick="print('perfil')">Imprimir</button>
            </div>
        </div>
        <div class="row" style="display:none;">
            <div id="logo" style="float:left;margin:5%;"><img src="{{asset('images/logo.jpeg')}}" style="width: 70px; height: 70px;"></div>
            <div class="col-md-8"></div>
            <div class="col-md-4">
                <form id="form-pdf" action="{{route('pdfs.crear_pdf_deportista')}}" method="POST">
                    {{csrf_field()}}
                    <input type="hidden" name="cliente" id="cliente">
                    <input type="hidden" name="tipo" value="1">
                    <input type="hidden" name="img" id="img">
                    <input type="hidden" name="ejercicio" id="ejercicio">
                    <button type="submit" id="btn-form-pdf" class="btn btn-primary" style="margin-bottom: 30px;">Generar PDF<i class="icon-arrow-right14 position-right"></i></button>
                </form>
            </div>
        </div>
        {{--Div oculto donde se cargan las imagenes de los graficos--}}
        <div class="row" style="display:none;" id="imprimir"></div>
    </div>

    </div>


@endsection

@section('scripts')
    <script type="text/javascript">
        //$graficos[$i][0] nombre ejercicio
        //$graficos[$i][1] datos
        //$graficos[$i][2] fechas
        //$graficos[$i][3] nombre de los campos
        @for($i = 0; $i <= count($graficos)-1;$i++)
        var grafico{{$i}} = echarts.init(document.getElementById('chart{{$i}}'));

        var option{{$i}} = {
            title: {
                text: '{{$graficos[$i][0]}}'
            },
            grid: {
                show: 'true',
                width: 'auto',
                containLabel:'true'
            },
            calculable : true,
            tooltip: {
                data: [@for($j=0; $j<= count($graficos[$i][3])-1;$j++) '{{$graficos[$i][3][$j]}}' @if($j < count($graficos[$i][3])-1) , @endif  @endfor]
            },
            legend: {
                {{--data:['{{implode(' ',$graficos[$i][3])}}']--}}
                data: [@for($j=0; $j<= count($graficos[$i][3])-1;$j++) '{{$graficos[$i][3][$j]}}' @if($j < count($graficos[$i][3])-1) , @endif  @endfor]
            },
            xAxis: {
                data: [@for($j=0; $j <= count($graficos[$i][2])-1;$j++) "{{$graficos[$i][2][$j]}}" @if($j < count($graficos[$i][2])-1),@endif  @endfor],
                type : 'category',
                axisTick: {
                    alignWithLabel: true
                }
            },
            yAxis: {},
            series: [
                //recorre los array de valores para cada campo solicitado
                @for($j=0; $j <= count($graficos[$i][1])-1;$j++)
                {
                name: '{{$graficos[$i][3][$j]}}',
                type: 'bar',
                data: [
                          @foreach($graficos[$i][1][$j] as $indice=>$valor)
                          {{$valor}} @if($indice < count($graficos[$i][1][$j])-1) ,@endif
                          @endforeach],
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
                barMaxWidth: 30,
                markLine: {
                    data: [{type: 'average', name: 'Average'}]
                }
            },@endfor],
            itemStyle: {
                emphasis: {
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
            //espera 2 segundos para generar y cargar las imagenes en el div oculto
            setTimeout(function(){
                @for($i = 0; $i <= count($graficos)-1;$i++)
                var canvas{{$i}} = document.getElementById('chart{{$i}}');
                var image{{$i}} = new Image();
                image{{$i}}.id = "pic{{$i}}";
                image{{$i}}.src = canvas{{$i}}.toDataURL('image/png');
                $('#imprimir').append('<img src="'+image{{$i}}.src+'" width="500" height="200" style="margin-left:20%;margin-top:5%;"/>');
                @endfor
                //una vez que se crean todas las imagenes
                $('#btn-imprimir').show();
            },2000);
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

        $(document).ready(function(){

        });

        function print(divId) {$


            var perfil = document.getElementById(divId).innerHTML;
            var logo = document.getElementById('logo').innerHTML;
            var mywindow = window.open('', 'Print', 'height=1400,width=1600');

            mywindow.document.write('<html><head><title>Reporte de {{$cliente->apellido.', '.$cliente->nombre}}</title></head>');
            mywindow.document.write('<body>');
            mywindow.document.write('<div id="cabcera" style="display:inline-block;">');
            mywindow.document.write('<div id="logo" style="float:left;"><img src="{{asset('images/logo.jpeg')}}" style="width: 120px; height: 120px;"></div>');
                mywindow.document.write('<div id="perfil-cliente" style="float:left;margin-left:200px;">');
                    mywindow.document.write('<div id="foto-perfil" style="float:left"><img src="{{asset($cliente->foto)}}" style="width: 70px; height: 70px;"></div>');
                    mywindow.document.write('<div id="datos-cliente" style="display:inline-block;margin-left:5px;margin-top:-10px;font-size: 0.7em;"><ul style="padding-left:0px;list-style:none;">');


                    mywindow.document.write('<li><a style="text-decoration:none"><b>Edad:</b> {{   }}</a></li>');

                    mywindow.document.write('<li><a style="text-decoration:none"><b>DNI:</b> {{$cliente->dni}}</a></li>');
                    mywindow.document.write('<li><a><b>Fecha Nac.:</b> {{date('d/m/Y',strtotime($cliente->fecha_nacimiento))}}</a></li>');
                    mywindow.document.write('<li><a style="text-decoration:none"><b>Deporte:</b> {{$cliente->deportes->nombre}}</a></li>');
                    mywindow.document.write('<li><a style="text-decoration:none"><b>Categoria:</b> {{$cliente->categorias->nombre}}</a></li>');
                    mywindow.document.write('<li><a><b>Inicio:</b> {{date('d/m/Y',strtotime($cliente->fecha_inicio_entrenamiento))}}</a></li>');
                    mywindow.document.write('</ul></div>');
                mywindow.document.write('</div>');
            mywindow.document.write('</div>');
            mywindow.document.write($('#imprimir').html());
            mywindow.document.write('</body></html>');
            mywindow.document.close();
            mywindow.focus()
            mywindow.print();
            mywindow.close();
            return true;
        }

    </script>


@endsection