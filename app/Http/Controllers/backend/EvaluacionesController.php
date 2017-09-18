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
            case 4:
                //salto abalacob
                $formulario = '<div id="salto_abalacob-field" class="form-group">
                                    <label class="col-lg-3 control-label">Altura:</label>
                                    <div class="col-lg-5">
                                        <input type="numeric" class="form-control" name="salto_abalacob" id="salto_abalacob">
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                                 </div>';
                break;

            case 6:
                //salto cm
                $formulario = '<div id="salto_cmj-field" class="form-group">
                                    <label class="col-lg-3 control-label">Altura:</label>
                                    <div class="col-lg-5">
                                        <input type="numeric" class="form-control" name="salto_cmj" id="salto_cm">
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                                 </div>';
                break;

            case 7:
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

            case 8:
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

            case 9:
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

            case 10:
                //velocidad 10 mts
                $formulario = '<div id="velocidad_segundos-field" class="form-group">
                                    <label class="col-lg-3 control-label">Segundos:</label>
                                    <div class="col-lg-5">
                                       <input type="numeric" class="form-control" name="velocidad_segundos" id="velocidad_s">
                                        <div class="form-control-feedback"></div>
                                        <span class="help-block"></span>
                                    </div>
                               </div>'.
                    '<div id="velocidad_decimas-field" class="form-group">
                        <label class="col-lg-3 control-label">Decimas:</label>
                        <div class="col-lg-5">
                          <input type="numeric" class="form-control" name="velocidad_decimas" id="velocidad_d">
                            <div class="form-control-feedback"></div>
                            <span class="help-block"></span>
                        </div>
                    </div>'.
                    '<div id="velocidad_centesimas-field" class="form-group">
                        <label class="col-lg-3 control-label">Centesimas:</label>
                        <div class="col-lg-5">
                          <input type="numeric" class="form-control" name="velocidad_centesimas" id="velocidad_c">
                            <div class="form-control-feedback"></div>
                            <span class="help-block"></span>
                        </div>
                     </div>';
                break;

            case 11:
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

            case 3:
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

            case 12:
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
            case 4:
                //salto abalacob
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

            case 6:
                //salto cm
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

            case 7:
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

            case 8:
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

            case 9:
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

            case 10:
                //velocidad 10 mts
                $validator =  Validator::make($request->all(), [
                    'velocidad_segundos' => 'required|numeric',
                    'velocidad_decimas' => 'required|numeric',
                    'velocidad_centesimas' => 'required|numeric',
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
                    $evaluacion->velocidad_segundos = $request->input('velocidad_segundos');
                    $evaluacion->velocidad_decimas = $request->input('velocidad_decimas');
                    $evaluacion->velocidad_centesimas = $request->input('velocidad_centesimas');
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

            case 3:
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

            case 12:
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
        }
    }



    public function edit($id)
    {
        //muestra el formulario con los datos de las evaluaciones a modificar
        $evaluaciones =  Evaluaciones::findOrFail($id);

        return view('admin.evaluaciones.editar-evaluaciones',['titulo'=>'Modificar Evaluación','evaluaciones' => $evaluaciones]);
    }



    public function update(Request $request, $id)
    {
        $evaluaciones = Evaluaciones::findOrFail($id);

        //validamos los campos enviados
        $validator =  Validator::make($request->all(), [

            //QUe en la tabla ejercicios el nombre del ejercicio sea unico
            'maximo_peso' => 'required|numeric',
            'velocidad_segundos' => 'required',
            'salto_abalacob' => 'required',
            'salto_cmj' => 'required',
            'salto_sj' => 'required',
            'mejor_salto_continuo' => 'required',
            'peor_salto_continuo' => 'required',
            'cantidad_salto_continuo' => 'required',
            'resistencia_numero_fase' => 'required|numeric',
            'cantidad_repeticiones' => 'required|numeric'

        ]);

        //si falla la validacion, redireccionamos con los errores
        if ($validator->fails())
        {
            $errors = $validator->errors();
            $errors =  json_decode($errors);

            return response()->json([
                'success' => false,
                'message' => $errors
            ], 422);
        }
        //si no falla la validacion, se carga la serie en la BD
        $evaluaciones->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'record updated'
        ], 200);
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

            }

            else {

                $consulta = Cliente::findOrFail($id)->evaluaciones()->whereBetween('evaluaciones.created_at', array($fecha_inicio, $fecha_fin))->where('ejercicio_id',$ejercicio_id)
                    ->orderBY('created_at','DESC')->get();
                $eliminar = 'eliminarNF';
            }

            return Datatables::of($consulta)

            ->editColumn('created_at',function($evaluaciones){
                return "<i class='icon-calendar'></i> ".date('d-m-Y', strtotime($evaluaciones->created_at))."  <i class='icon-watch2'></i> ".date('H:i:s', strtotime($evaluaciones->created_at));
            })

                ->addColumn('operaciones', '
                    <ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="{{ URL::route( \'evaluaciones.editar\', array( $id )) }}"><i class="icon-pencil"></i> Editar</a></li>
								<li><a href="#" onclick="'.$eliminar.'({{ $id  }})"><i class="icon-trash"></i> Eliminar</a></li>
							</ul>
						</li>
					</ul>')

                ->removeColumn('id')
                ->make(true);
        }


    }

}
