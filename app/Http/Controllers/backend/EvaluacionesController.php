<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Evaluaciones;
use App\Cliente;
use App\Ejercicio;
use App\Serie;
use App\User;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Validator;
use DB;

class EvaluacionesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }



    public function create()
    {
        return view('admin.evaluaciones.crear-evaluaciones',['titulo'=>'Nueva Evaluación']);
    }


    //listar todas las series
    public function listar()
    {
        $ejercicios = Ejercicio::all();
        return view('admin.evaluaciones.listar-evaluaciones',['titulo'=>'Resultado de Evaluaciones', 'ejercicios' => $ejercicios]);
    }



    public function mostrarForm($id_ejercicio_nf)
    {
        //muestra el formulario correspondiente al ejercicio en indicadores
        $ejercicio = Ejercicio::find($id_ejercicio_nf);
        $formulario = '';

        switch ($id_ejercicio_nf){

            //Salto Abalakov - Saltos
            case 1:
                //salto abalakov
                $formulario = '<div id="salto_abalacob-field" class="form-group">
                                    <label class="col-lg-3 control-label">Altura:</label>
                                    <div class="col-lg-5">
                                        <input type="numeric" class="form-control" name="salto_abalacob" id="salto_abalacob">
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                                 </div>';
                break;

            //Salto Cmj - Saltos
            case 2:
                //salto cmj
                $formulario = '<div id="salto_cmj-field" class="form-group">
                                    <label class="col-lg-3 control-label">Altura:</label>
                                    <div class="col-lg-5">
                                        <input type="numeric" class="form-control" name="salto_cmj" id="salto_cm">
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                                 </div>';
                break;

            //Salto Sj - Saltos
            case 3:
                //salto sj
                $formulario = '<div id="salto_sj-field" class="form-group">
                <label class="col-lg-3 control-label">Altura:</label>
                <div class="col-lg-5">
                    <input type="numeric" class="form-control" name="salto_sj" id="salto_sj">
                    <div class="form-control-feedback"></div>
                    <span class="help-block"></span>
                </div>
             </div>';
                break;

            //Salto Continuo - Saltos
            case 4:
                //salto continuo
                $formulario = '<div id="mejor_salto_continuo-field" class="form-group">
                    <label class="col-lg-3 control-label">Mejor salto:</label>
                        <div class="col-lg-5">
                           <input type="numeric" class="form-control" name="mejor_salto_continuo" id="salto_continuo_ms">
                            <div class="form-control-feedback"></div>
                            <span class="help-block"></span>
                        </div>
                    </div>'.
                    '<div id="peor_salto_continuo-field" class="form-group">
                    <label class="col-lg-3 control-label">Peor salto:</label>
                        <div class="col-lg-5">
                           <input type="numeric" class="form-control" name="peor_salto_continuo" id="salto_continuo_ps">
                            <div class="form-control-feedback"></div>
                            <span class="help-block"></span>
                        </div>
                    </div>'.
                    '<div id="cantidad_salto_continuo-field" class="form-group">
                        <label class="col-lg-3 control-label">Cantidad de saltos:</label>
                        <div class="col-lg-5">
                           <input type="numeric" class="form-control" name="cantidad_salto_continuo" id="salto_continuo_cs">
                            <div class="form-control-feedback"></div>
                            <span class="help-block"></span>
                        </div>
                    </div>';
                break;

            //Peso Muerto - Fuerza Tren Inferior
            case 5:
                //peso muerto
                $formulario = '<div id="maximo_peso-field" class="form-group">
                                    <label class="col-lg-3 control-label">Maximo Peso:</label>
                                    <div class="col-lg-5">
                                       <input type="numeric" class="form-control" name="maximo_peso" id="peso_muerto">
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                                </div>';
                break;

            //Velocidad 10 mts - Velocidad
            case 6:
                //velocidad 10 mts
                $formulario = '<div id="velocidad_segundos-field" class="form-group">
                                    <label class="col-lg-3 control-label">Segundos:</label>
                                    <div class="col-lg-5">
                                       <input type="numeric" class="form-control" name="velocidad_segundos_10" id="velocidad_s">
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                               </div>'.
                    '<div id="velocidad_decimas-field" class="form-group">
                        <label class="col-lg-3 control-label">Decimas:</label>
                        <div class="col-lg-5">
                          <input type="numeric" class="form-control" name="velocidad_decimas_10" id="velocidad_d">
                            <div class="form-control-feedback"></div>
                            <span class="help-block"></span>
                        </div>
                    </div>'.
                    '<div id="velocidad_centesimas-field" class="form-group">
                        <label class="col-lg-3 control-label">Centesimas:</label>
                        <div class="col-lg-5">
                          <input type="numeric" class="form-control" name="velocidad_centesimas_10" id="velocidad_c">
                            <div class="form-control-feedback"></div>
                            <span class="help-block"></span>
                        </div>
                     </div>';
                break;

            //Remo - Fuerza Tren Superior
            case 7:
                //remo
                $formulario = '<div id="maximo_peso-field" class="form-group">
                                    <label class="col-lg-3 control-label">Maximo Peso:</label>
                                    <div class="col-lg-5">
                                       <input type="numeric" class="form-control" name="maximo_peso" id="remo">
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                                </div>';
                break;

            //Yoyo Test - Resistencia
            case 8:
                //yoyo test
                $formulario = '<div id="resistencia_numero_fase-field" class="form-group">
                                    <label class="col-lg-3 control-label">Fase Final:</label>
                                    <div class="col-lg-5">
                                       <input type="numeric" class="form-control" name="resistencia_numero_fase" id="yoyo_test">
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                               </div>';
                break;

            //Sentadilla Bulgara - Fuerza Tren Inferior
            case 9:
                //sentadilla bulgara
                $formulario = '<div id="cantidad_repeticiones-field" class="form-group">
                                    <label class="col-lg-3 control-label">Cantidad de Repeticiones:</label>
                                    <div class="col-lg-5">
                                      <input type="numeric" class="form-control" name="cantidad_repeticiones" id="sb_cantidad_repeticiones">
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                                </div>'.
                                '<div id="maximo_peso-field" class="form-group">
                                    <label class="col-lg-3 control-label">Maximo Peso:</label>
                                    <div class="col-lg-5">
                                      <input type="numeric" class="form-control" name="maximo_peso" id="sb_maximo_peso">
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                                 </div>';
                break;

            //Peso Muerto 1 Pierna - Fuerza Tren Inferior
            case 10:

                //Peso Muerto 1 pierna
                $formulario = '<div id="maximo_peso-field" class="form-group">
                                    <label class="col-md-3 control-label">Máximo Peso:</label>
                                    <div class="col-md-5">
                                       <input type="numeric" class="form-control" name="maximo_peso" id="peso_muerto">
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                                </div>';
                break;

            //Agilidad 5-10-5 - Velocidad
            case 11:
                //Agilidad (velocidad) 5 - 10 - 5
                $formulario =   '<div class="col-md-3"><div id="velocidad_segundos-field" class="form-group">
                                    <label class="col-lg-4 control-label">Seg:</label>
                                    <div class="col-lg-7">
                                       <input type="numeric" class="form-control" name="velocidad_segundos_5" id="velocidad_agilidad">
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                                 </div>
                                 <div id="velocidad_decimas-field" class="form-group">
                                    <label class="col-lg-4 control-label">Dec:</label>
                                    <div class="col-lg-7">
                                      <input type="numeric" class="form-control" name="velocidad_decimas_5" id="velocidad_agilidad">
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                 <div id="velocidad_centesimas-field" class="form-group">
                                    <label class="col-lg-4 control-label">Cen:</label>
                                    <div class="col-lg-7">
                                      <input type="numeric" class="form-control" name="velocidad_centesimas_5" id="velocidad_agilidad">
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                                 </div>
                                 
                                 </div>
                                 
                                 <div class="col-md-3"><div id="velocidad_segundos-field" class="form-group">
                                    <label class="col-lg-4 control-label">Seg:</label>
                                    <div class="col-lg-7">
                                       <input type="numeric" class="form-control" name="velocidad_segundos_10" id="velocidad_aguilidad">
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                               </div>
                                 <div id="velocidad_decimas-field" class="form-group">
                                    <label class="col-lg-4 control-label">Dec:</label>
                                    <div class="col-lg-7">
                                      <input type="numeric" class="form-control" name="velocidad_decimas_10" id="velocidad_agilidad">
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                 <div id="velocidad_centesimas-field" class="form-group">
                                    <label class="col-lg-4 control-label">Cen:</label>
                                    <div class="col-lg-7">
                                      <input type="numeric" class="form-control" name="velocidad_centesimas_10" id="velocidad_agilidad">
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                                 </div>
                                 
                                 </div>
                                 
                                 <div class="col-md-6"><div id="velocidad_segundos-field" class="form-group">
                                    <label class="col-lg-4 control-label">Sum:</label>
                                    <div class="col-lg-6">
                                       <input type="numeric" class="form-control" name="velocidad_sumatoria" id="velocidad_sumatoria">
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                               </div>                                                     
                                 
                                 </div>';
                break;
        }

        //devuelve el formulario correspondiente
        return '<div class="panel-heading">
                    <h6 class="panel-title">'.$ejercicio->nombre.'<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                <form class="form-horizontal col-lg-8" method="POST" id="form-nf">
                     '.$formulario.'
                     <input type="submit" class="btn btn-success col-lg-offset-10" value="Cargar">
                </form>
            </div>';
    }



    public function cargarResultadosNF(Request $request){

        $evaluacion = new Evaluaciones();

        switch ($request->input('ejercicio')){
            case 1:
                //salto abalakov
                $validator =  Validator::make($request->all(), [
                    'salto_abalacob' => 'required|numeric',
                    'cliente' => 'required|numeric',
                    'ejercicio' => 'required|numeric'
                ]);
                if ($validator->fails())
                {
                    //Crea un array con los errores
                    $errors = $validator->errors();
                    $errors =  json_decode($errors);

                    return response()->json([
                        'success' => false,
                        'message' => $errors
                    ], 422);

                }else{

                    $evaluacion->salto_abalacob = $request->input('salto_abalacob');
                    $evaluacion->save();
                    //se inserta en la tabla pivot
                    $evaluacion->clientes()->attach([$evaluacion->id => ['cliente_id'=>$request->input('cliente'),'ejercicio_id'=>$request->input('ejercicio')]]);
                    return response()->json([
                        'success' => true,
                        'message' => 'Resultados cargados'
                    ], 200);
                }
                break;

            case 2:
                //salto cmj
                $validator =  Validator::make($request->all(), [
                    'salto_cmj' => 'required|numeric',
                    'cliente' => 'required|numeric',
                    'ejercicio' => 'required|numeric'
                ]);
                if ($validator->fails())
                {
                    //Crea un array con los errores
                    $errors = $validator->errors();
                    $errors =  json_decode($errors);

                    return response()->json([
                        'success' => false,
                        'message' => $errors
                    ], 422);

                }else{
                    $evaluacion->salto_cmj = $request->input('salto_cmj');
                    $evaluacion->save();
                    //se inserta en la tabla pivot
                    $evaluacion->clientes()->attach([$evaluacion->id => ['cliente_id'=>$request->input('cliente'),'ejercicio_id'=>$request->input('ejercicio')]]);
                    return response()->json([
                        'success' => true,
                        'message' => 'Resultados cargados'
                    ], 200);
                }
                break;

            case 3:
                //salto sj
                $validator =  Validator::make($request->all(), [
                    'salto_sj' => 'required|numeric',
                    'cliente' => 'required|numeric',
                    'ejercicio' => 'required|numeric'
                ]);
                if ($validator->fails())
                {
                    //Crea un array con los errores
                    $errors = $validator->errors();
                    $errors =  json_decode($errors);

                    return response()->json([
                        'success' => false,
                        'message' => $errors
                    ], 422);

                }else{
                    $evaluacion->salto_sj = $request->input('salto_sj');
                    $evaluacion->save();
                    //se inserta en la tabla pivot
                    $evaluacion->clientes()->attach([$evaluacion->id => ['cliente_id'=>$request->input('cliente'),'ejercicio_id'=>$request->input('ejercicio')]]);
                    return response()->json([
                        'success' => true,
                        'message' => 'Resultados cargados'
                    ], 200);
                }
                break;

            case 4:
                //salto continuo
                $validator =  Validator::make($request->all(), [
                    'mejor_salto_continuo' => 'required|numeric',
                    'peor_salto_continuo' => 'required|numeric',
                    'cantidad_salto_continuo' => 'required|numeric',
                    'cliente' => 'required|numeric',
                    'ejercicio' => 'required|numeric'
                ]);
                if ($validator->fails())
                {
                    //Crea un array con los errores
                    $errors = $validator->errors();
                    $errors =  json_decode($errors);

                    return response()->json([
                        'success' => false,
                        'message' => $errors
                    ], 422);

                }else{
                    $evaluacion->mejor_salto_continuo = $request->input('mejor_salto_continuo');
                    $evaluacion->peor_salto_continuo = $request->input('peor_salto_continuo');
                    $evaluacion->cantidad_salto_continuo = $request->input('cantidad_salto_continuo');
                    $evaluacion->save();
                    //se inserta en la tabla pivot
                    $evaluacion->clientes()->attach([$evaluacion->id => ['cliente_id'=>$request->input('cliente'),'ejercicio_id'=>$request->input('ejercicio')]]);
                    return response()->json([
                        'success' => true,
                        'message' => 'Resultados cargados'
                    ], 200);
                }
                break;

            case 5:
                //peso muerto
                $validator =  Validator::make($request->all(), [
                    'maximo_peso' => 'required|numeric',
                    'cliente' => 'required|numeric',
                    'ejercicio' => 'required|numeric'
                ]);
                if ($validator->fails())
                {
                    //Crea un array con los errores
                    $errors = $validator->errors();
                    $errors =  json_decode($errors);

                    return response()->json([
                        'success' => false,
                        'message' => $errors
                    ], 422);

                }else{
                    $evaluacion->maximo_peso = $request->input('maximo_peso');
                    $evaluacion->save();
                    //se inserta en la tabla pivot
                    $evaluacion->clientes()->attach([$evaluacion->id => ['cliente_id'=>$request->input('cliente'),'ejercicio_id'=>$request->input('ejercicio')]]);
                    return response()->json([
                        'success' => true,
                        'message' => 'Resultados cargados'
                    ], 200);
                }
                break;

            case 6:
                //velocidad 10 mts
                $validator =  Validator::make($request->all(), [
                    'velocidad_segundos_10' => 'required|numeric',
                    'velocidad_decimas_10' => 'required|numeric',
                    'velocidad_centesimas_10' => 'required|numeric',
                    'cliente' => 'required|numeric',
                    'ejercicio' => 'required|numeric'
                ]);
                if ($validator->fails())
                {
                    //Crea un array con los errores
                    $errors = $validator->errors();
                    $errors =  json_decode($errors);

                    return response()->json([
                        'success' => false,
                        'message' => $errors
                    ], 422);

                }else{
                    $evaluacion->velocidad_segundos = $request->input('velocidad_segundos_10');
                    $evaluacion->velocidad_decimas = $request->input('velocidad_decimas_10');
                    $evaluacion->velocidad_centesimas = $request->input('velocidad_centesimas_10');
                    $evaluacion->save();
                    //se inserta en la tabla pivot
                    $evaluacion->clientes()->attach([$evaluacion->id => ['cliente_id'=>$request->input('cliente'),'ejercicio_id'=>$request->input('ejercicio')]]);
                    return response()->json([
                        'success' => true,
                        'message' => 'Resultados cargados'
                    ], 200);
                }
                break;

            case 7:
                //remo
                $validator =  Validator::make($request->all(), [
                    'maximo_peso' => 'required|numeric',
                    'cliente' => 'required|numeric',
                    'ejercicio' => 'required|numeric'
                ]);
                if ($validator->fails())
                {
                    //Crea un array con los errores
                    $errors = $validator->errors();
                    $errors =  json_decode($errors);

                    return response()->json([
                        'success' => false,
                        'message' => $errors
                    ], 422);

                }else{
                    $evaluacion->maximo_peso = $request->input('maximo_peso');
                    $evaluacion->save();
                    //se inserta en la tabla pivot
                    $evaluacion->clientes()->attach([$evaluacion->id => ['cliente_id'=>$request->input('cliente'),'ejercicio_id'=>$request->input('ejercicio')]]);
                    return response()->json([
                        'success' => true,
                        'message' => 'Resultados cargados'
                    ], 200);
                }
                break;

            case 8:
                //yoyo test
                $validator =  Validator::make($request->all(), [
                    'resistencia_numero_fase' => 'required|numeric',
                    'cliente' => 'required|numeric',
                    'ejercicio' => 'required|numeric'
                ]);
                if ($validator->fails())
                {
                    //Crea un array con los errores
                    $errors = $validator->errors();
                    $errors =  json_decode($errors);

                    return response()->json([
                        'success' => false,
                        'message' => $errors
                    ], 422);

                }else{
                    $evaluacion->resistencia_numero_fase = $request->input('resistencia_numero_fase');
                    $evaluacion->save();
                    //se inserta en la tabla pivot
                    $evaluacion->clientes()->attach([$evaluacion->id => ['cliente_id'=>$request->input('cliente'),'ejercicio_id'=>$request->input('ejercicio')]]);
                    return response()->json([
                        'success' => true,
                        'message' => 'Resultados cargados'
                    ], 200);
                }
                break;

            case 9:
                //sentadilla bulgara
                $validator =  Validator::make($request->all(), [
                    'maximo_peso' => 'required|numeric',
                    'cantidad_repeticiones' => 'required|numeric',
                    'cliente' => 'required|numeric',
                    'ejercicio' => 'required|numeric'
                ]);
                if ($validator->fails())
                {
                    //Crea un array con los errores
                    $errors = $validator->errors();
                    $errors =  json_decode($errors);

                    return response()->json([
                        'success' => false,
                        'message' => $errors
                    ], 422);

                }else{
                    $evaluacion->maximo_peso = $request->input('maximo_peso');
                    $evaluacion->cantidad_repeticiones = $request->input('cantidad_repeticiones');
                    $evaluacion->save();
                    //se inserta en la tabla pivot
                    $evaluacion->clientes()->attach([$evaluacion->id => ['cliente_id'=>$request->input('cliente'),'ejercicio_id'=>$request->input('ejercicio')]]);
                    return response()->json([
                        'success' => true,
                        'message' => 'Resultados cargados'
                    ], 200);
                }
                break;

            case 10:
                //peso muerto 1 Pierna
                $validator =  Validator::make($request->all(), [
                    'maximo_peso' => 'required|numeric',
                    'cliente' => 'required|numeric',
                    'ejercicio' => 'required|numeric'
                ]);
                if ($validator->fails())
                {
                    //Crea un array con los errores
                    $errors = $validator->errors();
                    $errors =  json_decode($errors);

                    return response()->json([
                        'success' => false,
                        'message' => $errors
                    ], 422);

                }else{
                    $evaluacion->maximo_peso = $request->input('maximo_peso');
                    $evaluacion->save();
                    //se inserta en la tabla pivot
                    $evaluacion->clientes()->attach([$evaluacion->id => ['cliente_id'=>$request->input('cliente'),'ejercicio_id'=>$request->input('ejercicio')]]);
                    return response()->json([
                        'success' => true,
                        'message' => 'Resultados cargados'
                    ], 200);
                }
                break;

            case 11:
                //Agilidad (velocidad) 5 - 10 - 5
                $validator =  Validator::make($request->all(), [
                    'velocidad_segundos_5' => 'required|numeric',
                    'velocidad_decimas_5' => 'required|numeric',
                    'velocidad_centesimas_5' => 'required|numeric',
                    'velocidad_segundos_10' => 'required|numeric',
                    'velocidad_decimas_10' => 'required|numeric',
                    'velocidad_centesimas_10' => 'required|numeric',
                    'velocidad_sumatoria' => 'required',
                    'cliente' => 'required|numeric',
                    'ejercicio' => 'required|numeric'
                ]);
                if ($validator->fails())
                {
                    //Crea un array con los errores
                    $errors = $validator->errors();
                    $errors =  json_decode($errors);

                    return response()->json([
                        'success' => false,
                        'message' => $errors
                    ], 422);

                }else{
                    $evaluacion->velocidad_segundos_5 = $request->input('velocidad_segundos_5');
                    $evaluacion->velocidad_decimas_5 = $request->input('velocidad_decimas_5');
                    $evaluacion->velocidad_centesimas_5 = $request->input('velocidad_centesimas_5');
                    $evaluacion->velocidad_segundos_10 = $request->input('velocidad_segundos_10');
                    $evaluacion->velocidad_decimas_10 = $request->input('velocidad_decimas_10');
                    $evaluacion->velocidad_centesimas_10 = $request->input('velocidad_centesimas_10');
                    $evaluacion->velocidad_sumatoria = $request->input('velocidad_sumatoria');
                    $evaluacion->save();
                    //se inserta en la tabla pivot
                    $evaluacion->clientes()->attach([$evaluacion->id => ['cliente_id'=>$request->input('cliente'),'ejercicio_id'=>$request->input('ejercicio')]]);
                    return response()->json([
                        'success' => true,
                        'message' => 'Resultados cargados'
                    ], 200);
                }
                break;
        }
    }



    public function edit($evaluacion_id)
    {
        //muestra el formulario con los datos de las evaluaciones a modificar
        $evaluacion = Evaluaciones::findOrFail($evaluacion_id);
        //muestra el formulario correspondiente al ejercicio de no fuerza
        $formulario = '';
        $pivot = DB::table('ejercicios')->select('*')->join('clientes_evaluaciones','ejercicio_id','=','ejercicios.id')->where('clientes_evaluaciones.evaluaciones_id',$evaluacion->id)->get();
        $ejercicio = Ejercicio::find($pivot[0]->ejercicio_id);

        switch ($ejercicio->id){

            case 1:
                //salto abalakov
                $formulario = '<div id="salto_abalacob-field" class="form-group">
                                    <label class="col-lg-3 control-label">Altura:</label>
                                    <div class="col-lg-5">
                                        <input type="numeric" class="form-control" name="salto_abalacob" id="salto_abalacob" value='.$evaluacion->salto_abalacob.'>
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                                 </div>';
                break;

            case 2:
                //salto cmj
                $formulario = '<div id="salto_cmj-field" class="form-group">
                                    <label class="col-lg-3 control-label">Altura:</label>
                                    <div class="col-lg-5">
                                        <input type="numeric" class="form-control" name="salto_cmj" id="salto_cm" value='.$evaluacion->salto_cmj.'>
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                                 </div>';
                break;

            case 3:
                //salto sj
                $formulario = '<div id="salto_sj-field" class="form-group">
                <label class="col-lg-3 control-label">Altura:</label>
                <div class="col-lg-5">
                    <input type="numeric" class="form-control" name="salto_sj" id="salto_sj" value='.$evaluacion->salto_sj.'>
                    <div class="form-control-feedback"></div>
                    <span class="help-block"></span>
                </div>
             </div>';
                break;

            case 4:
                //salto continuo
                $formulario = '<div id="mejor_salto_continuo-field" class="form-group">
                    <label class="col-lg-3 control-label">Mejor salto:</label>
                        <div class="col-lg-5">
                           <input type="numeric" class="form-control" name="mejor_salto_continuo" id="salto_continuo_ms" value='.$evaluacion->mejor_salto_continuo.'>
                            <div class="form-control-feedback"></div>
                            <span class="help-block"></span>
                        </div>
                    </div>'.
                    '<div id="peor_salto_continuo-field" class="form-group">
                    <label class="col-lg-3 control-label">Peor salto:</label>
                        <div class="col-lg-5">
                           <input type="numeric" class="form-control" name="peor_salto_continuo" id="salto_continuo_ps" value='.$evaluacion->peor_salto_continuo.'>
                            <div class="form-control-feedback"></div>
                            <span class="help-block"></span>
                        </div>
                    </div>'.
                    '<div id="cantidad_salto_continuo-field" class="form-group">
                        <label class="col-lg-3 control-label">Cantidad de saltos:</label>
                        <div class="col-lg-5">
                           <input type="numeric" class="form-control" name="cantidad_salto_continuo" id="salto_continuo_cs" value='.$evaluacion->cantidad_salto_continuo.'>
                            <div class="form-control-feedback"></div>
                            <span class="help-block"></span>
                        </div>
                    </div>';
                break;

            case 5:
                //peso muerto
                $formulario = '<div id="maximo_peso-field" class="form-group">
                                    <label class="col-lg-3 control-label">Maximo Peso:</label>
                                    <div class="col-lg-5">
                                       <input type="numeric" class="form-control" name="maximo_peso" id="peso_muerto" value='.$evaluacion->maximo_peso.'>
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                                </div>';
                break;

            case 6:
                //velocidad 10 mts
                $formulario = '<div id="velocidad_segundos-field" class="form-group">
                                    <label class="col-lg-3 control-label">Segundos:</label>
                                    <div class="col-lg-5">
                                       <input type="numeric" class="form-control" name="velocidad_segundos_10" id="velocidad_s" value='.$evaluacion->velocidad_segundos_10.'>
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                               </div>'.
                    '<div id="velocidad_decimas-field" class="form-group">
                        <label class="col-lg-3 control-label">Decimas:</label>
                        <div class="col-lg-5">
                          <input type="numeric" class="form-control" name="velocidad_decimas_10" id="velocidad_d" value='.$evaluacion->velocidad_decimas_10.'>
                            <div class="form-control-feedback"></div>
                            <span class="help-block"></span>
                        </div>
                    </div>'.
                    '<div id="velocidad_centesimas-field" class="form-group">
                        <label class="col-lg-3 control-label">Centesimas:</label>
                        <div class="col-lg-5">
                          <input type="numeric" class="form-control" name="velocidad_centesimas_10" id="velocidad_c" value='.$evaluacion->velocidad_centesimas_10.'>
                            <div class="form-control-feedback"></div>
                            <span class="help-block"></span>
                        </div>
                     </div>';
                break;

            case 7:
                //remo
                $formulario = '<div id="maximo_peso-field" class="form-group">
                                    <label class="col-lg-3 control-label">Maximo Peso:</label>
                                    <div class="col-lg-5">
                                       <input type="numeric" class="form-control" name="maximo_peso" id="remo" value='.$evaluacion->maximo_peso.'>
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                                </div>';
                break;

            case 8:
                //yoyo test
                $formulario = '<div id="resistencia_numero_fase-field" class="form-group">
                                    <label class="col-lg-3 control-label">Fase Final:</label>
                                    <div class="col-lg-5">
                                       <input type="numeric" class="form-control" name="resistencia_numero_fase" id="yoyo_test" value='.$evaluacion->resistencia_numero_fase.'>
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                               </div>';
                break;

            case 9:
                //sentadilla bulgara
                $formulario = '<div id="cantidad_repeticiones-field" class="form-group">
                                    <label class="col-lg-3 control-label">Cantidad de Repeticiones:</label>
                                    <div class="col-lg-5">
                                      <input type="numeric" class="form-control" name="cantidad_repeticiones" id="sb_cantidad_repeticiones" value='.$evaluacion->cantidad_repeticiones.'>
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                                </div>'.
                    '<div id="maximo_peso-field" class="form-group">
                                    <label class="col-lg-3 control-label">Maximo Peso:</label>
                                    <div class="col-lg-5">
                                      <input type="numeric" class="form-control" name="maximo_peso" id="sb_maximo_peso" value='.$evaluacion->maximo_peso.'>
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                                 </div>';
                break;

            case 10:
                //peso muerto 1 Pierna
                $formulario = '<div id="maximo_peso-field" class="form-group">
                                    <label class="col-lg-3 control-label">Maximo Peso:</label>
                                    <div class="col-lg-5">
                                       <input type="numeric" class="form-control" name="maximo_peso" id="peso_muerto" value='.$evaluacion->maximo_peso.'>
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                                </div>';
                break;

            case 11:
                //Agilidad (velocidad) 5 - 10 - 5
                $formulario =   '<div class="col-md-4"><div id="velocidad_segundos-field" class="form-group">
                                    <label class="col-lg-3 control-label">Segundos:</label>
                                    <div class="col-lg-5">
                                       <input type="numeric" class="form-control" name="velocidad_segundos_5" id="velocidad_s" value='.$evaluacion->velocidad_segundos_5.'>
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                               </div>
                                 <div id="velocidad_decimas-field" class="form-group">
                                    <label class="col-lg-3 control-label">Decimas:</label>
                                    <div class="col-lg-5">
                                      <input type="numeric" class="form-control" name="velocidad_decimas_5" id="velocidad_d" value='.$evaluacion->velocidad_decimas_5.'>
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                 <div id="velocidad_centesimas-field" class="form-group">
                                    <label class="col-lg-3 control-label">Centesimas:</label>
                                    <div class="col-lg-5">
                                      <input type="numeric" class="form-control" name="velocidad_centesimas_5" id="velocidad_c" value='.$evaluacion->velocidad_centesimas_5.'>
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                                 </div>
                                 
                                 </div>
                                 
                                 <div class="col-md-4"><div id="velocidad_segundos-field" class="form-group">
                                    <label class="col-lg-3 control-label">Segundos:</label>
                                    <div class="col-lg-5">
                                       <input type="numeric" class="form-control" name="velocidad_segundos_10" id="velocidad_s" value='.$evaluacion->velocidad_segundos_10.'>
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                               </div>
                                 <div id="velocidad_decimas-field" class="form-group">
                                    <label class="col-lg-3 control-label">Decimas:</label>
                                    <div class="col-lg-5">
                                      <input type="numeric" class="form-control" name="velocidad_decimas_10" id="velocidad_d" value='.$evaluacion->velocidad_decimas_10.'>
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                 <div id="velocidad_centesimas-field" class="form-group">
                                    <label class="col-lg-3 control-label">Centesimas:</label>
                                    <div class="col-lg-5">
                                      <input type="numeric" class="form-control" name="velocidad_centesimas_10" id="velocidad_c" value='.$evaluacion->velocidad_centesimas_10.'>
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                                 </div>
                                 
                                 </div>
                                 
                                 <div class="col-md-4"><div id="velocidad_segundos-field" class="form-group">
                                    <label class="col-lg-3 control-label">Segundos:</label>
                                    <div class="col-lg-5">
                                       <input type="numeric" class="form-control" name="velocidad_sumatoria" id="velocidad_s" value='.$evaluacion->velocidad_sumatoria.'>
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                               </div>                                                     
                                 
                                 </div>';
                break;

        }

        //devuelve el formulario correspondiente
        $html =  '<div class="panel-heading">
                    <h6 class="panel-title">Nombre ejercicio<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                <form class="form-horizontal col-lg-8" method="POST" id="form-nf">
                     '.$formulario.'
                     <input type="submit" class="btn btn-success col-lg-offset-10" value="Cargar">
                </form>
            </div>';

        return view('admin.evaluaciones.editar-evaluaciones',['titulo'=>'Modificar Evaluación','evaluacion'=>$evaluacion,'formulario'=>$formulario]);
    }



    public function update(Request $request, $evaluaciones_id)
    {

        $evaluacion = Evaluaciones::findOrFail($evaluaciones_id);

        $pivot = DB::table('ejercicios')->select('*')->join('clientes_evaluaciones','ejercicio_id','=','ejercicios.id')->where('clientes_evaluaciones.evaluaciones_id',$evaluacion->id)->get();

        $ejercicio = Ejercicio::find($pivot[0]->ejercicio_id);


        switch ($ejercicio->id) {

            case 1:
                //salto abalakov

                $salto_abalacob = $request->input('salto_abalacob');


                //validamos los campos enviados
                $validator = Validator::make($request->all(), [
                    'salto_abalacob' => 'required|numeric',
                ]);


                //si falla la validacion, redireccionamos con los errores
                if ($validator->fails()) {
                    $errors = $validator->errors();
                    $errors = json_decode($errors);

                    return response()->json([
                        'success' => false,
                        'message' => $errors
                    ], 422);

                } else {

                    $evaluacion->salto_abalacob = $salto_abalacob;
                    $evaluacion->update();


                    return response()->json([
                        'success' => true,
                        'message' => 'record updated'
                    ], 200);
                }

                break;

            case 2:
                //salto cmj
                $salto_cmj = $request->input('salto_cmj');


                //validamos los campos enviados
                $validator = Validator::make($request->all(), [
                    'salto_cmj' => 'required|numeric',
                ]);


                //si falla la validacion, redireccionamos con los errores
                if ($validator->fails()) {
                    $errors = $validator->errors();
                    $errors = json_decode($errors);

                    return response()->json([
                        'success' => false,
                        'message' => $errors
                    ], 422);

                } else {

                    $evaluacion->salto_cmj = $salto_cmj;
                    $evaluacion->update();


                    return response()->json([
                        'success' => true,
                        'message' => 'record updated'
                    ], 200);
                }

                break;

            case 3:
                //salto sj
                $salto_sj = $request->input('salto_sj');


                //validamos los campos enviados
                $validator = Validator::make($request->all(), [
                    'salto_sj' => 'required|numeric',
                ]);


                //si falla la validacion, redireccionamos con los errores
                if ($validator->fails()) {
                    $errors = $validator->errors();
                    $errors = json_decode($errors);

                    return response()->json([
                        'success' => false,
                        'message' => $errors
                    ], 422);

                } else {

                    $evaluacion->salto_sj = $salto_sj;
                    $evaluacion->update();


                    return response()->json([
                        'success' => true,
                        'message' => 'record updated'
                    ], 200);
                }

                break;

            case 4:
                //salto continuo
                $mejor_salto_continuo = $request->input('mejor_salto_continuo');
                $peor_salto_continuo = $request->input('peor_salto_continuo');
                $cantidad_salto_continuo = $request->input('cantidad_salto_continuo');


                //validamos los campos enviados
                $validator = Validator::make($request->all(), [
                    'mejor_salto_continuo' => 'required|numeric',
                    'peor_salto_continuo' => 'required|numeric',
                    'cantidad_salto_continuo' => 'required|numeric',
                ]);


                //si falla la validacion, redireccionamos con los errores
                if ($validator->fails()) {
                    $errors = $validator->errors();
                    $errors = json_decode($errors);

                    return response()->json([
                        'success' => false,
                        'message' => $errors
                    ], 422);

                } else {

                    $evaluacion->mejor_salto_continuo = $mejor_salto_continuo;
                    $evaluacion->peor_salto_continuo = $peor_salto_continuo;
                    $evaluacion->cantidad_salto_continuo = $cantidad_salto_continuo;
                    $evaluacion->update();


                    return response()->json([
                        'success' => true,
                        'message' => 'record updated'
                    ], 200);
                }

                break;

            case 5:
                //peso muerto
                $maximo_peso = $request->input('maximo_peso');


                //validamos los campos enviados
                $validator = Validator::make($request->all(), [
                    'maximo_peso' => 'required|numeric',
                ]);


                //si falla la validacion, redireccionamos con los errores
                if ($validator->fails()) {
                    $errors = $validator->errors();
                    $errors = json_decode($errors);

                    return response()->json([
                        'success' => false,
                        'message' => $errors
                    ], 422);

                } else {

                    $evaluacion->maximo_peso = $maximo_peso;
                    $evaluacion->update();


                    return response()->json([
                        'success' => true,
                        'message' => 'record updated'
                    ], 200);
                }

                break;

            case 6:
                //velocidad 10 mts
                $velocidad_segundos = $request->input('velocidad_segundos_10');
                $velocidad_decimas = $request->input('velocidad_decimas_10');
                $velocidad_centesimas = $request->input('velocidad_centesimas_10');


                //validamos los campos enviados
                $validator = Validator::make($request->all(), [
                    'velocidad_segundos_10' => 'required|numeric',
                    'velocidad_decimas_10' => 'required|numeric',
                    'velocidad_centesimas_10' => 'required|numeric',
                ]);


                //si falla la validacion, redireccionamos con los errores
                if ($validator->fails()) {
                    $errors = $validator->errors();
                    $errors = json_decode($errors);

                    return response()->json([
                        'success' => false,
                        'message' => $errors
                    ], 422);

                } else {

                    $evaluacion->velocidad_segundos_10 = $velocidad_segundos;
                    $evaluacion->velocidad_decimas_10 = $velocidad_decimas;
                    $evaluacion->velocidad_centesimas_10 = $velocidad_centesimas;
                    $evaluacion->update();


                    return response()->json([
                        'success' => true,
                        'message' => 'record updated'
                    ], 200);
                }

                break;

            case 7:
                //remo
                $maximo_peso = $request->input('maximo_peso');


                //validamos los campos enviados
                $validator = Validator::make($request->all(), [
                    'maximo_peso' => 'required|numeric',
                ]);


                //si falla la validacion, redireccionamos con los errores
                if ($validator->fails()) {
                    $errors = $validator->errors();
                    $errors = json_decode($errors);

                    return response()->json([
                        'success' => false,
                        'message' => $errors
                    ], 422);

                } else {

                    $evaluacion->maximo_peso = $maximo_peso;
                    $evaluacion->update();


                    return response()->json([
                        'success' => true,
                        'message' => 'record updated'
                    ], 200);
                }

                break;

            case 8:
                //yoyo test
                $resistencia_numero_fase = $request->input('resistencia_numero_fase');


                //validamos los campos enviados
                $validator = Validator::make($request->all(), [
                    'resistencia_numero_fase' => 'required|numeric',
                ]);


                //si falla la validacion, redireccionamos con los errores
                if ($validator->fails()) {
                    $errors = $validator->errors();
                    $errors = json_decode($errors);

                    return response()->json([
                        'success' => false,
                        'message' => $errors
                    ], 422);

                } else {

                    $evaluacion->resistencia_numero_fase = $resistencia_numero_fase;
                    $evaluacion->update();


                    return response()->json([
                        'success' => true,
                        'message' => 'record updated'
                    ], 200);
                }

                break;

            case 9:
                //sentadilla bulgara
                $cantidad_repeticiones = $request->input('cantidad_repeticiones');
                $maximo_peso = $request->input('maximo_peso');


                //validamos los campos enviados
                $validator = Validator::make($request->all(), [
                    'cantidad_repeticiones' => 'required|numeric',
                    'maximo_peso' => 'required|numeric',
                ]);


                //si falla la validacion, redireccionamos con los errores
                if ($validator->fails()) {
                    $errors = $validator->errors();
                    $errors = json_decode($errors);

                    return response()->json([
                        'success' => false,
                        'message' => $errors
                    ], 422);

                } else {

                    $evaluacion->cantidad_repeticiones = $cantidad_repeticiones;
                    $evaluacion->maximo_peso = $maximo_peso;
                    $evaluacion->update();


                    return response()->json([
                        'success' => true,
                        'message' => 'record updated'
                    ], 200);
                }

                break;

            case 10:
                //peso muerto 1 Pierna
                $maximo_peso = $request->input('maximo_peso');


                //validamos los campos enviados
                $validator = Validator::make($request->all(), [
                    'maximo_peso' => 'required|numeric',
                ]);


                //si falla la validacion, redireccionamos con los errores
                if ($validator->fails()) {
                    $errors = $validator->errors();
                    $errors = json_decode($errors);

                    return response()->json([
                        'success' => false,
                        'message' => $errors
                    ], 422);

                } else {

                    $evaluacion->maximo_peso = $maximo_peso;
                    $evaluacion->update();


                    return response()->json([
                        'success' => true,
                        'message' => 'record updated'
                    ], 200);
                }

                break;

            case 11:
                //Agilidad (velocidad) 5 - 10 - 5
                $velocidad_segundos_5 = $request->input('velocidad_segundos_5');
                $velocidad_decimas_5 = $request->input('velocidad_decimas_5');
                $velocidad_centesimas_5 = $request->input('velocidad_centesimas_5');

                $velocidad_segundos_10 = $request->input('velocidad_segundos_10');
                $velocidad_decimas_10 = $request->input('velocidad_decimas_10');
                $velocidad_centesimas_10 = $request->input('velocidad_centesimas_10');

                $velocidad_sumatoria = $request->input('velocidad_sumatoria');


                //validamos los campos enviados
                $validator = Validator::make($request->all(), [
                    'velocidad_segundos_5' => 'required|numeric',
                    'velocidad_decimas_5' => 'required|numeric',
                    'velocidad_centesimas_5' => 'required|numeric',

                    'velocidad_segundos_10' => 'required|numeric',
                    'velocidad_decimas_10' => 'required|numeric',
                    'velocidad_centesimas_10' => 'required|numeric',

                    'velocidad_sumatoria' => 'required',
                ]);


                //si falla la validacion, redireccionamos con los errores
                if ($validator->fails()) {
                    $errors = $validator->errors();
                    $errors = json_decode($errors);

                    return response()->json([
                        'success' => false,
                        'message' => $errors
                    ], 422);

                } else {

                    $evaluacion->velocidad_segundos_5 = $velocidad_segundos_5;
                    $evaluacion->velocidad_decimas_5 = $velocidad_decimas_5;
                    $evaluacion->velocidad_centesimas_5 = $velocidad_centesimas_5;

                    $evaluacion->velocidad_segundos_10 = $velocidad_segundos_10;
                    $evaluacion->velocidad_decimas_10 = $velocidad_decimas_10;
                    $evaluacion->velocidad_centesimas_10 = $velocidad_centesimas_10;

                    $evaluacion->velocidad_sumatoria = $velocidad_sumatoria;

                    $evaluacion->update();


                    return response()->json([
                        'success' => true,
                        'message' => 'record updated'
                    ], 200);
                }

                break;

        }
    }



    public function destroy($serie_id)
    {
        //Obtengo el ejercicio de Fuerza que se está editando. Ej: Pecho, Sentadilla, etc.
        $serie = Serie::find($serie_id);

        $cliente = $serie->clientes()->first();


        $series = Serie::where('created_at',$serie->created_at)->get();
        $ids  = array();

        foreach ($series as $serie){
            array_push($ids,$serie->id);
        }

        //Borro la relacion de la tabla intermedia
        $cliente->series()->detach($ids);
        foreach ($series as $serie){
            $serie->delete();
        }

        //if el ejercicio está borrado
        if ($serie->trashed()){
            return response()->json([
                'success' => true,
                'message' => 'Eliminado'
            ], 200);
        }else{
            //si hay error al eliminar
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar.'
            ], 422);
        }
    }



    public function destroyNoFuerza($evaluacion_id)
    {
        //Obtengo el ejercicio de No Fuerza que se está editando. Ej: Remo, peso_muerto, etc.
        $evaluacion = Evaluaciones::find($evaluacion_id);

        //Borro la relacion de la tabla intermedia
        $evaluacion->clientes()->detach();

        $evaluacion->delete();
        //if el ejercicio está borrado
        if ($evaluacion->trashed()){
            return response()->json([
                'success' => true,
                'message' => 'Eliminado'
            ], 200);
        }else{
            //si hay error al eliminar
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar.'
            ], 422);
        }
    }



    //lista los ejercicios para ser eliminados o editados dependiendo si es de fuerza o no
    public function anyData(Request $request)
    {
        //validamos los campos enviados
        $validator =  Validator::make($request->all(), [
            'cliente' => 'required|numeric',
            'ejercicios' => 'required|numeric',
            'rango_fechas' => 'required',
        ]);

        $consulta = "";
        $id = $request->input("cliente");

        $ejercicio_id = $request->input('ejercicios');
        $ejercicio = Ejercicio::findOrFail($ejercicio_id);

        $rango_fechas = $request->input('rango_fechas');
        $rango_fechas = explode('-',$request->input('rango_fechas'));
        $fecha_inicio = date('Y-m-d',strtotime(strtr($rango_fechas[0], '/', '-')));
        $fecha_fin = date('Y-m-d',strtotime(strtr($rango_fechas[1],'/','-')));

        //si falla la validacion, redireccionamos con los errores
        if ($validator->fails())
        {
            $errors = $validator->errors();
            $errors =  json_decode($errors);

            return response()->json([
                'success' => false,
                'message' => $errors
            ], 422);
        }else{
            //ejercicios.fuerza = 0 es NO fuerza y 1 Fuerza
            if ($ejercicio['fuerza'] == 1) {

                $consulta = Cliente::findOrFail($id)->series()->whereBetween('series.created_at', array($fecha_inicio, $fecha_fin))->where('ejercicio_id',$ejercicio_id)
                    ->groupBy('created_at')->orderBY('created_at','DESC')->get();
                $eliminar = 'eliminar';
                $link_editar = '';

            }

            else {

                $consulta = Cliente::findOrFail($id)->evaluaciones()->whereBetween('evaluaciones.created_at', array($fecha_inicio, $fecha_fin))->where('ejercicio_id',$ejercicio_id)
                    ->orderBY('created_at','DESC')->get();
                $eliminar = 'eliminarNF';
                $link_editar = '<li><a href="{{ URL::route( \'evaluaciones.editar\', array( $id )) }}"><i class="icon-pencil"></i> Editar</a></li>';
            }

            return Datatables::of($consulta)

            ->editColumn('created_at',function($evaluaciones){
                return "<i class='icon-calendar'></i> ".date('d-m-Y', strtotime($evaluaciones->created_at))."  <i class='icon-watch2'></i> ".date('H:i:s', strtotime($evaluaciones->created_at));
            })

            ->editColumn('peso_corporal',function($evaluacion){
                if (is_null($evaluacion->peso_corporal)){
                    return "-";
                }else{
                    return $evaluacion->peso_corporal;
                }
            })

            ->editColumn('peso_externo',function($evaluacion){
                 if (is_null($evaluacion->peso_externo)){
                        return "-";
                    }else{
                     return $evaluacion->peso_externo;
                 }
            })

            ->editColumn('masa',function($evaluacion){
                    if (is_null($evaluacion->masa)){
                        return "-";
                    }else{
                        return $evaluacion->masa;
                    }
            })

                ->addColumn('operaciones', '
                    <ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								'.$link_editar.'
								<li><a href="#" onclick="'.$eliminar.'({{ $id  }})"><i class="icon-trash"></i> Eliminar</a></li>
							</ul>
						</li>
					</ul>')

                ->removeColumn('id')
                ->make(true);
        }


    }



    public  function vistaResultados(){

        $ejercicios = Ejercicio::all();

        return view('admin.evaluaciones.vista-resultados',['titulo'=>'Consulta de Resultados','ejercicios'=> $ejercicios]);
    }



    public function listarResultados(Request $request)
    {

        //validamos los campos enviados
        $validator = Validator::make($request->all(), [
            'cliente' => 'required|numeric',
            'ejercicios' => 'required|numeric',
            'rango_fechas' => 'required',
        ]);

        $consulta = "";
        $id = $request->input("cliente");

        $ejercicio_id = $request->input('ejercicios');


        //si falla la validacion, redireccionamos con los errores
        if ($validator->fails()) {
            $errors = $validator->errors();
            $errors = json_decode($errors);

            return response()->json([
                'success' => false,
                'message' => $errors
            ], 422);
        } else {

            $ejercicio = Ejercicio::findOrFail($ejercicio_id);

            $rango_fechas = $request->input('rango_fechas');
            $rango_fechas = explode('-', $request->input('rango_fechas'));
            $fecha_inicio = date('Y-m-d', strtotime(strtr($rango_fechas[0], '/', '-')));
            $fecha_fin = date('Y-m-d', strtotime(strtr($rango_fechas[1], '/', '-')));

            $tabla= '<table class="table bg-slate-600">';
            //ejercicios.fuerza = 0 es NO fuerza y 1 Fuerza
            if ($ejercicio['fuerza'] == 1) {

                $series = Cliente::findOrFail($id)->series()->whereBetween('series.created_at', array($fecha_inicio, $fecha_fin))->where('ejercicio_id', $ejercicio_id)
                   ->orderBY('created_at', 'DESC')->get();

                $tabla .= '<thead>
                             <tr>
                                 <th>Cant Series</th>
                                 <th>Peso Corp</th>
                                 <th>Peso Ext</th>
                                 <th>Masa</th>
                                 <th>Pot Impulsiva</th>
                                 <th>Pot Relativa</th>
                                 <th>Vel Impulsiva</th>
                                 <th>Fuerza Impulsiva</th>
                                 <th>Mejor Serie</th>
                                 <th>RM</th>
                                 <th>Fecha</th>
                                 <th>pse</th>
                                 <th>rm %</th>
                                 <th>Mejor Serie</th>
                                 <th>Ultima Serie</th>
                             </tr>
                            </thead>
                            <tbody>';

                //se argma la tabla
                foreach ($series as $serie){
                    $tabla .= '<tr>
                                 <td>'.$serie->cantidad_series.'</td>
                                 <td>'.$serie->peso_corporal.'</td>
                                 <td>'.$serie->peso_externo.'</td>
                                 <td>'.$serie->masa.'</td>
                                 <td>'.$serie->potencia_impulsiva.'</td>
                                 <td>'.$serie->potencia_relativa.'</td>
                                 <td>'.$serie->velocidad_impulsiva.'</td>
                                 <td>'.$serie->fuerza_impulsiva.'</td>
                                 <td>'.$serie->mejor_serie.'</td>
                                 <td>'.$serie->rm.'</td>
                                 <td>'.date('d-m-Y H:m:s',strtotime($serie->created_at)).'</td>
                                 <td>'.$serie->pse.'</td>
                                 <td>'.round($serie->rm_porcentual,2).'</td>';
                    if($serie->mejor_serie_boolean == 1){
                        $tabla .= '<td><span class="label label-success">SI</span></td>';
                    }else {
                        $tabla .= '<td><span class="label label-danger">NO</span></td>';
                    }

                    if($serie->ultima_serie == 1){
                       $tabla .= '<td><span class="label label-success">SI</span></td>';
                    }else {
                       $tabla .= '<td><span class="label label-danger">NO</span></td>';
                    }

                }

                $tabla .= '</tbody>
                     <table>';

            } else {

                //si no es de fuerza se tiene que conttrolar el id para ver que campos corresponde mostrar
                $evaluaciones = Cliente::findOrFail($id)->evaluaciones()->whereBetween('evaluaciones.created_at', array($fecha_inicio, $fecha_fin))->where('ejercicio_id', $ejercicio_id)
                    ->orderBY('created_at', 'DESC')->get();
                $tabla = '<div class="col-md-4"><table class="table bg-slate-600"><thead>';
                $titulos_tabla = '';
                $filas = '';
                //segun el id del ejercio se muestran los datos en la tabla

                foreach ($evaluaciones as $evaluacion) {

                    switch ($request->input('ejercicios')) {

                        case 1:
                            //salto abalacob
                            $titulos_tabla = '<tr>
                                                  <th>Altura</th>
                                                  <th>Fecha</th>
                                              </tr>
                                              </thead>
                                              <tbody>';
                            $filas .= '<tr>
                                          <td>'.$evaluacion->salto_abalacob.'</td>
                                          <td>'.date('d-m-Y H:m:s',strtotime($evaluacion->updated_at)).'</td>
                                       </tr>';
                            break;

                        case 2:
                            //salto cmj
                            $titulos_tabla = '<tr>
                                                  <th>Altura</th>
                                                  <th>Fecha</th>
                                              </tr>
                                              </thead>
                                              <tbody>';
                            $filas .= '<tr>
                                          <td>'.$evaluacion->salto_cmj.'</td>
                                          <td>'.date('d-m-Y H:m:s',strtotime($evaluacion->updated_at)).'</td>
                                       </tr>';

                            break;

                        case 3:
                            //salto sj
                            $titulos_tabla = '<tr>
                                                  <th>Altura</th>
                                                  <th>Fecha</th>
                                              </tr>
                                              </thead>
                                              <tbody>';
                            $filas .= '<tr>
                                          <td>'.$evaluacion->salto_sj.'</td>
                                          <td>'.date('d-m-Y H:m:s',strtotime($evaluacion->updated_at)).'</td>
                                       </tr>';

                            break;

                        case 4:
                            //salto continuo
                            $titulos_tabla = '<tr>
                                                  <th>Mejor Salto</th>
                                                  <th>Peor Salto</th>
                                                  <th>Cantidad Saltos</th>
                                                  <th>Fecha</th>
                                              </tr>
                                              </thead>
                                              <tbody>';
                            $filas .= '<tr>
                                          <td>'.$evaluacion->mejor_salto_continuo.'</td>
                                          <td>'.$evaluacion->peor_salto_continuo.'</td>
                                          <td>'.$evaluacion->cantidad_salto_continuo.'</td>
                                          <td>'.date('d-m-Y H:m:s',strtotime($evaluacion->updated_at)).'</td>
                                       </tr>';

                            break;

                        case 5:
                            //peso muerto
                            $titulos_tabla = '<tr>
                                                  <th>Maximo Peso</th>
                                                  <th>Fecha</th>
                                              </tr>
                                              </thead>
                                              <tbody>';
                            $filas .= '<tr>
                                          <td>'.$evaluacion->maximo_peso.'</td>
                                          <td>'.date('d-m-Y H:m:s',strtotime($evaluacion->updated_at)).'</td>
                                       </tr>';

                            break;

                        case 6:
                            //velocidad 10 mts
                            $titulos_tabla = '<tr>
                                                  <th>Segundos</th>
                                                  <th>Decimas</th>
                                                  <th>Centesimas</th>
                                                  <th>Fecha</th>
                                              </tr>
                                              </thead>
                                              <tbody>';
                            $filas .= '<tr>
                                          <td>'.$evaluacion->velocidad_segundos_10.'</td>
                                          <td>'.$evaluacion->velocidad_decimas_10.'</td>
                                          <td>'.$evaluacion->velocidad_centesimas_10.'</td>
                                          <td>'.date('d-m-Y H:m:s',strtotime($evaluacion->updated_at)).'</td> 
                                       </tr>';

                            break;

                        case 7:
                            //remo
                            $titulos_tabla = '<tr>
                                                  <th>Maximo Peso</th>
                                                  <th>Fecha</th>
                                              </tr>
                                              </thead>
                                              <tbody>';
                            $filas .= '<tr>
                                          <td>'.$evaluacion->maximo_peso.'</td>
                                          <td>'.date('d-m-Y H:m:s',strtotime($evaluacion->updated_at)).'</td> 
                                       </tr>';

                            break;

                        case 8:
                            //yoyo test
                            $titulos_tabla = '<tr>
                                                  <th>Fase Final</th>
                                                  <th>Fecha</th>
                                              </tr>
                                              </thead>
                                              <tbody>';
                            $filas .= '<tr>
                                          <td>'.$evaluacion->fase_final.'</td>
                                          <td>'.date('d-m-Y H:m:s',strtotime($evaluacion->updated_at)).'</td> 
                                       </tr>';

                            break;

                        case 9:
                            //sentadilla bulgara
                            $titulos_tabla = '<tr>
                                                  <th>Cantidad de Repeticiones</th>
                                                  <th>Maximo Peso</th>
                                                  <th>Fecha</th>
                                              </tr>
                                              </thead>
                                              <tbody>';
                            $filas .= '<tr>
                                          <td>'.$evaluacion->cantidad_repeticiones.'</td>
                                          <td>'.$evaluacion->maximo_peso.'</td>
                                          <td>'.date('d-m-Y H:m:s',strtotime($evaluacion->updated_at)).'</td> 
                                       </tr>';

                            break;

                        case 10:
                            //peso muerto 1 Pierna
                            $titulos_tabla = '<tr>
                                                  <th>Maximo Peso</th>
                                                  <th>Fecha</th>
                                              </tr>
                                              </thead>
                                              <tbody>';
                            $filas .= '<tr>
                                          <td>'.$evaluacion->maximo_peso.'</td>
                                          <td>'.date('d-m-Y H:m:s',strtotime($evaluacion->updated_at)).'</td>
                                       </tr>';

                            break;

                        case 11:
                            //Agilidad (velocidad) 5 - 10 - 5
                            $titulos_tabla = '<tr>
                                                  <th>Segundos 5</th>
                                                  <th>Decimas 5</th>
                                                  <th>Centesimas 5</th>
                                                  <th>Segundos 10</th>
                                                  <th>Decimas 10</th>
                                                  <th>Centesimas 10</th>
                                                  <th>Sumatoria</th>
                                                  <th>Fecha</th>
                                              </tr>
                                              </thead>
                                              <tbody>';
                            $filas .= '<tr>
                                          <td>'.$evaluacion->velocidad_segundos_5.'</td>
                                          <td>'.$evaluacion->velocidad_decimas_5.'</td>
                                          <td>'.$evaluacion->velocidad_centesimas_5.'</td>
                                          <td>'.$evaluacion->velocidad_segundos_10.'</td>
                                          <td>'.$evaluacion->velocidad_decimas_10.'</td>
                                          <td>'.$evaluacion->velocidad_centesimas_10.'</td>
                                          <td>'.$evaluacion->velocidad_sumatoria.'</td>
                                          <td>'.date('d-m-Y H:m:s',strtotime($evaluacion->updated_at)).'</td> 
                                       </tr>';

                            break;
                    }
                }

                $tabla .= $titulos_tabla . $filas .'</tbody></table></div>';

            }


            return $tabla;


        }
    }


}
