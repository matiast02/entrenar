<?php

namespace App\Http\Controllers\backend;

use App\Deporte;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Serie;
use App\Cliente;
use App\Ejercicio;
use Illuminate\Support\Facades\Auth;
use Validator;
use Carbon\Carbon;
use Image;
use Illuminate\Support\Facades\Redirect;

class ReporteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index()
    {
        $ejercicios = Ejercicio::all();

        return view('admin.reportes.index',['titulo'=>'Reporte por Deportista','ejercicios'=>$ejercicios]);
    }



    public function reportePorEjercicio(Request $request){
        $validator =  Validator::make($request->all(), [
            'cliente' => 'required|numeric',
            'ejercicio' => 'required|numeric',
            'rango-fechas' => 'required',
        ]);

        if ($validator->fails()){
            $errors = $validator->errors();
            $errors =  json_decode($errors);

            return response()->json([
                'success' => false,
                'message' => $errors
            ], 422);

        }else{
            $cliente = Cliente::findOrFail($request->input('cliente'));

            $rango_fechas = explode('-',$request->input('rango-fechas'));
            $fecha_inicio = date('Y-m-d',strtotime(strtr($rango_fechas[0], '/', '-')));
            $fecha_fin = date('Y-m-d',strtotime(strtr($rango_fechas[1],'/','-')));

            $rm = array();
            $fecha = array();
            $ejercicio = Ejercicio::find($request->input('ejercicio'));
            if ($fecha_inicio == $fecha_fin){
                $series_por_cliente = $cliente->series()->whereDate('series.created_at','=',$fecha_inicio)->get();
            }else{
                //se almacenan en array los datos para pasarlos a formato json
                $series_por_cliente = $cliente->series()->whereBetween('series.created_at', array($fecha_inicio, $fecha_fin))->get();
            }


            foreach ($series_por_cliente as $serie){ //filtrar por fechas en series()
                if ($serie->pivot->ejercicio_id == $request->input('ejercicio')){
                    array_push($rm,$serie->rm);
                    array_push($fecha, $serie->created_at->format('d-m-Y'));
                }

            }
            //se envia la foto junto con nombre y apellido del cliente
            $html = ' <div class="media" style="padding-top:10px;padding-bottom: 30px;">
                    <div class="media-left">
                        <a href="#" data-popup="lightbox">
                            <img src="'.asset($cliente->foto).'" style="width: 70px; height: 70px;" class="img-circle" alt="'.$cliente->foto.'">
                        </a>
                    </div>

                    <div class="media-body">
                        <h6 class="media-heading"><b>'.$cliente->apellido.', '.$cliente->nombre.'</b></h6>
                        <h6 class="media-body"><b>Edad:</b> '.$this->calculaedad($cliente->fecha_nacimiento).'</h6>
                    </div>
                </div>';

            //si no existen datos se informa que no hay datos registrados para ese ejercicio
            if (count($rm) < 1){
                return response()->json([
                    'success' => false,
                    'message' => 'No se encontraron datos para esa solicitud'
                ], 422);
            }else{
                return response()->json([
                    'success' => true,
                    'rm' => $rm,
                    'fecha'=>$fecha,
                    'ejercicio' => $ejercicio->nombre,
                    'html' => $html
                ], 200);
            }
        }



    }




    public function crear_pdf_deportista(Request $request) {
        $cliente = $request->input('cliente');
        $tipo = $request->input('tipo');
        $img = $request->input('img');
        $ejercicio = $request->input('ejercicio');

        $grafico = public_path()."/reportes/image.png";
        $img = Image::make($img)->save($grafico);

        $ejercicio = Ejercicio::findOrFail($ejercicio);
        $deportes = Deporte::all();
        $clientes= Cliente::findOrFail($cliente);
        $vistaurl="admin.reportes.crear_pdf_deportista";

        return $this->crearPDF($clientes, $vistaurl, 1, $ejercicio,$grafico);

    }




    public function crearPDF($clientes,$vistaurl,$tipo ,$ejercicio, $img) {

        $cliente = $clientes;
        $date = date('d/m/Y');
        $fecha_nac = $cliente->fecha_nacimiento;
        $edad = $this->calculaedad($fecha_nac);
        $imagen = $img;
        $nombre_ejercicio = $ejercicio->nombre;
        $view =  \View::make($vistaurl, compact('cliente', 'date', 'edad','imagen','nombre_ejercicio'))->render();

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML(utf8_decode($view))->setPaper('A4', 'portrait')->setWarnings(false);

        if($tipo==1){return $pdf->stream('reportes');}
        if($tipo==2){return $pdf->download('reporte.pdf'); }
    }



    function calculaedad($fecha_nacimiento){
        list($ano,$mes,$dia) = explode("-",$fecha_nacimiento);
        $ano_diferencia  = date("Y") - $ano;
        $mes_diferencia = date("m") - $mes;
        $dia_diferencia   = date("d") - $dia;
        if ($dia_diferencia < 0 || $mes_diferencia < 0)
            $ano_diferencia;
        return $ano_diferencia;
    }



    public function vistaReporteEvaluaciones(){
        $ejercicios = Ejercicio::all();
        $titulo = 'Reporte de Evaluaciones por Deportista';
        return view('admin.reportes.reporte-evaluaciones',compact('titulo','ejercicios'));
    }



    public function generarReporteEvaluaciones(Request $request){
        $validator =  Validator::make($request->all(), [
            'cliente' => 'required|numeric',
            'ejercicios' => 'required',
            'ejercicios.*' => 'numeric',
            'campos.*' => 'required',
            'rango-fechas' => 'required',
        ]);

        if ($validator->fails()){
            $errors = $validator->errors();
            $errors =  json_decode($errors);

            return Redirect::back()->withErrors($errors);

        }else{

            $cliente = Cliente::findOrFail($request->input('cliente'));
            $rango_fechas = explode('-',$request->input('rango-fechas'));
            $fecha_inicio = date('Y-m-d',strtotime(strtr($rango_fechas[0], '/', '-')));
            $fecha_fin = date('Y-m-d',strtotime(strtr($rango_fechas[1],'/','-')));

            $graficos = array();

            foreach ($request->input('ejercicios') as $ejercicio_id){
                $ejercicio = Ejercicio::find($ejercicio_id);
                //si es de fuerza
                if ($ejercicio->fuerza == 1){
                    $rm = array();
                    $fecha = array();
                    if ($fecha_inicio == $fecha_fin){
                        $series_por_cliente = $cliente->series()->whereDate('series.created_at','=',$fecha_inicio)->where('series.mejor_serie_boolean','=',true)->get();
                    }else{
                        //se almacenan en array los datos para pasarlos a formato json
                        $series_por_cliente = $cliente->series()->whereBetween('series.created_at', array($fecha_inicio, $fecha_fin))->where('series.mejor_serie_boolean','=',true)->get();
                    }
                    //defino el array campo para mostrar en grafico el nombde de cada campo solicitado
                    $campos = array();

                    //por cada campo solicitado (fuerza_imp,velo_imp,etc)
                    foreach ($request->input('campos') as $campo ){
                        array_push($campos,$campo);
                        $valores = array();//alamacena los valores del campo solicitado
                        foreach ($series_por_cliente as $serie){ //filtrar por fechas en series()
                            if ($serie->pivot->ejercicio_id == $ejercicio_id){
                                array_push($valores,$serie->$campo);//construye el array de valores del campo seleccionado
                                //para evitar que esten repetidas las fechas se controlan
                                if (!in_array($serie->created_at->format('d-m-Y'),$fecha)){
                                    array_push($fecha, $serie->created_at->format('d-m-Y'));//guarada en el array fechas las fechas del ejercicio
                                }
                            }
                        }
                        array_push($rm,$valores);//almacena el array de valores de cada campo en el array de rm
                    }


                    if(count($rm) > 0 ){
                        array_push($graficos,array($ejercicio->nombre,$rm,$fecha,$campos));
                    }

//                    return var_dump($graficos[0][1]);

                }else{
                    //sino es de fuerza entonces consulto en la tabla evaluaciones
                    $rm = array();
                    $fecha = array();
                    $campo = array();
                    if ($fecha_inicio == $fecha_fin){
                        $evaluaciones_por_cliente = $cliente->evaluaciones()->whereDate('evaluaciones.created_at','=',$fecha_inicio)->get();
                    }else{
                        //se almacenan en array los datos para pasarlos a formato json
                        $evaluaciones_por_cliente = $cliente->evaluaciones()->whereBetween('evaluaciones.created_at', array($fecha_inicio, $fecha_fin))->get();
                    }
                    $valores = array();//alamacena los valores del campo solicitado
                    foreach ($evaluaciones_por_cliente as $evaluacion){ //filtrar por fechas en series()

                        if ($evaluacion->pivot->ejercicio_id == $ejercicio_id){

                            //segun el id del ejercicio, corresponden los campos a graficar en las barras
                            switch ($ejercicio_id){
                                case 1:
                                    //salto abalakov
                                    array_push($valores,$evaluacion->salto_abalacob);
                                    array_push($campo,'Altura');
                                    break;

                                case 2:
                                    //salto CMJ
                                    array_push($valores,$evaluacion->salto_cmj);
                                    array_push($campo,'Altura');
                                    break;

                                case 3:
                                    //salto SJ
                                    array_push($valores,$evaluacion->salto_sj);
                                    array_push($campo,'Altura');
                                    break;

                                case 4:
                                    //salto continuo
                                    array_push($valores,$evaluacion->mejor_salto_continuo);
                                    array_push($campo,'Mejor Salto');
                                    break;

                                case 5:
                                    //peso muerto
                                    array_push($valores,$evaluacion->maximo_peso);
                                    array_push($campo,'Maximo peso');
                                    break;

                                case 6:
                                    //velocidad 10 mts
                                    array_push($valores,$evaluacion->velocidad_segundos);
                                    array_push($campo,'Segundos');
                                    break;

                                case 7:
                                    //remo
                                    array_push($valores,$evaluacion->maximo_peso);
                                    array_push($campo,'Maximo peso');
                                    break;

                                case 8:
                                    //yoyo test
                                    array_push($valores,$evaluacion->resistencia_numero_fase);
                                    array_push($campo,'Numero de Fase');
                                    break;

                                case 9:
                                    //sentadilla bulgara
                                    array_push($valores,$evaluacion->maximo_peso);
                                    array_push($campo,"Maximo peso");
                                    break;

                                case 10:
                                    //peso muerto 1 Pierna
                                    array_push($valores,$evaluacion->maximo_peso);
                                    array_push($campo,'Maximo peso');
                                    break;

                            }
                            //datos de lsa fechas de cada registro, para evitar que esten repetidos
                            if (!in_array($evaluacion->created_at->format('d-m-Y'),$fecha)){
                                array_push($fecha, $evaluacion->created_at->format('d-m-Y'));
                            }
                        }
                    }
                    array_push($rm,$valores);//almacena el array de valores de cada campo en el array de rm

                    if(count($rm) > 0){
                        array_push($graficos,array($ejercicio->nombre,$rm,$fecha,$campo));
                    }



                }
//                return var_dump($graficos);
            }




            //se envia la foto junto con nombre y apellido del cliente
            $perfil = ' <div class="media" style="padding-top:10px;padding-bottom: 30px;">
                    <div class="media-center">
                        <a href="#" data-popup="lightbox">
                            <img src="'.asset($cliente->foto).'" style="width: 70px; height: 70px;" class="img-circle" alt="'.$cliente->foto.'">
                        </a>
                    </div>

                    <div class="media-body">
                        <h6 class="media-heading"><b>'.$cliente->apellido.', '.$cliente->nombre.'</b></h6>
                        <h6 class="media-body"><b>Edad:</b> '.$this->calculaedad($cliente->fecha_nacimiento).' años</h6>
                    </div>
                </div>';

            //si no existen datos se informa que no hay datos registrados para ese ejercicio
            if (count($graficos) < 1){

                return Redirect::back()->withErrors(['No se encontraron datos para esa solicitud']);

            }else{
                $edad = $this->calculaedad($cliente->fecha_nacimiento);
                $titulo = 'Resultado Evaluaciones';
                return view('admin.reportes.resultados-reportes-evaluaciones',compact('titulo','graficos','perfil','cliente','edad'));

            }
        }



    }

}
