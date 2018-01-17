<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Cliente;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Validator;
use DB;
use App\Indicador;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;

class IndicadorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function create()
    {
        return view('admin.indicadores.crear-indicadores',['titulo'=>'Crear Indicador']);
    }



    public function store(Request $request)
    {
        $cliente = $request->input('cliente');
        $fecha_indicador = $request->input('fecha_indicador');

        $peso_inicial = $request->input('peso_inicial');
        $peso_final = $request->input('peso_final');

        $hora_entrada = $request->input('hora_entrada');
        $hora_salida = $request->input('hora_salida');

        $pse = $request->input('pse');
        $sueno = $request->input('sueno');
        $dolor = $request->input('dolor');
        $deseo_entrenar = $request->input('deseo_entrenar');
        $desayuno = $request->input('desayuno');

        $pse_global_sesion = $request->input('pse_global_sesion');

        //$carga_entrenamiento = $request->input('carga_entrenamiento');

        ///validamos los campos enviados
        $validator =  Validator::make($request->all(), [
            'cliente' => 'required|numeric',
            'fecha_indicador' => 'required|date_format:d/m/Y',
            'mes' => 'required|date_format:Y-m-d',

            $semana = 'semana' => 'numeric',

            'peso_inicial' => 'required|numeric',
            'peso_final' => 'required|numeric',

            $diferencia_peso_porcentual = 'diferencia_peso_porcentual' => 'float',

            'hora_entrada' => 'required',
            'hora_salida' => 'required',
            $tiempo_entrenamiento = 'tiempo_entrenamiento',

            'pse' => 'required|numeric|max:10|min:1',
            'sueno' => 'required|numeric|max:10|min:1',
            'dolor' => 'required|numeric|max:10|min:1',
            'deseo_entrenar' => 'required|numeric|max:10|min:1',
            'desayuno' => 'required|numeric|max:10|min:1',

            $sumatoria = 'sumatoria' => 'numeric',

            'pse_global_sesion' => 'required|numeric',
            $carga_entrenamiento = 'carga_entrenamiento' => 'numeric'
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
        } else{
            //si no falla la validacion, se carga el deporte en la BD e informamos

            $fecha_indicador = $date = str_replace('/', '-', $request->input('fecha_indicador'));
            $fecha_indicador =date("Y-m-d", strtotime($fecha_indicador));

                $mes = $date = str_replace('/', '-', $request->input('mes'));
                $mes =date("Y-m-d", strtotime($mes));

            //date("W",strtotime($fecha)), es una funcion que me guarda en la vble semana, la correspondiente semana de la fecha agregada, EN CASO QUE LA FECHA NO SE ENCUENTRE YA REGISTRADA.
            $semana =date("W",strtotime($fecha_indicador));

            $diferencia_peso = $peso_final - $peso_inicial;
            $diferencia_peso_porcentual = ((($diferencia_peso * 100) / $peso_inicial) * -1);

            $sumatoria = $pse + $sueno + $dolor + $deseo_entrenar + $desayuno;

            $tiempo_entrenamiento = (( strtotime($hora_salida) - strtotime($hora_entrada) ) / 60);

            $carga_entrenamiento = $pse_global_sesion * $tiempo_entrenamiento;

            //guardar los datos
            $indicador = New Indicador();
            //$indicador->create($request->all());
            $indicador->cliente_id = $cliente;
            $indicador->fecha_indicador = $fecha_indicador;
            $indicador->mes = $mes;
            $indicador->semana = $semana;
            $indicador->peso_inicial = $peso_inicial;
            $indicador->peso_final = $peso_final;
            $indicador->diferencia_peso_porcentual = $diferencia_peso_porcentual;
            $indicador->fecha_indicador = $fecha_indicador;
            $indicador->hora_entrada = $hora_entrada;
            $indicador->hora_salida = $hora_salida;
            $indicador->pse = $pse;
            $indicador->sueno = $sueno;
            $indicador->dolor = $dolor;
            $indicador->deseo_entrenar = $deseo_entrenar;
            $indicador->desayuno = $desayuno;
            $indicador->sumatoria = $sumatoria;
            $indicador->pse_global_sesion = $pse_global_sesion;
            $indicador->tiempo_entrenamiento = $tiempo_entrenamiento;
            $indicador->carga_entrenamiento = $carga_entrenamiento;
            $indicador->save();

            return response()->json([
                'success' => true,
                'message' => 'record updated'
            ], 200);
        }
    }


    public function listarIndicadores()
    {
        $clientes = Cliente::all();

        return view('admin.indicadores.listar-indicadores',['titulo'=>'Lista de Indicadores','clientes'=>$clientes]);
    }


    //devuelve los datos al datatable que les solicito
    public function anyData(Request $request)
    {
        $id = $request->input("cliente");

        $semana = $request->input("semana");

        ///validamos los campos enviados
        $validator =  Validator::make($request->all(), [
            'cliente' => 'required|numeric',
            'semana' => 'required|numeric',
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
        } else{

            //se muestra el datatable
            //$indicadores = Cliente::findOrFail($id)->indicadores()->get();

            $indicadores = Cliente::findOrFail($id)->indicadores()->where([['semana','=', $semana],['deleted_at','=',null]]);

            return Datatables::of($indicadores)
                //->editColumn('fecha_indicador','{{date_format(new DateTime($fecha_indicador),"d-m-Y")}}')
                ->editColumn('fecha_carga',function($indicador){
                    return date('d-m-Y', strtotime($indicador->fecha_indicador));
                })

                ->editColumn('pse',function($indicador){
                    if($indicador->pse >= 1 and $indicador->pse <= 4) {$color= "green";}
                    elseif($indicador->pse >= 5 and $indicador->pse <= 6) {$color = "#E1DE01";}
                    else{$color = "red";}

                    return '<span class="label" style="background-color:'.$color.';">'.$indicador->pse.'</span>';
                })

                ->editColumn('sueno',function($indicador){
                    if($indicador->sueno >= 1 and $indicador->sueno <= 5) {$color= "red";}
                    elseif($indicador->sueno >= 6 and $indicador->sueno <= 7) {$color = "#E1DE01";}
                    else{$color = "green";}

                    return '<span class="label" style="background-color:'.$color.';">'.$indicador->sueno.'</span>';
                })

                ->editColumn('dolor',function($indicador){
                    if($indicador->dolor >= 1 and $indicador->dolor <= 4) {$color= "green";}
                    elseif($indicador->dolor >= 5 and $indicador->dolor <= 6) {$color = "#E1DE01";}
                    else{$color = "red";}

                    return '<span class="label" style="background-color:'.$color.';">'.$indicador->dolor.'</span>';
                })

                ->editColumn('deseo_entrenar',function($indicador){
                    if($indicador->deseo_entrenar >= 1 and $indicador->deseo_entrenar <= 5) {$color= "red";}
                    elseif($indicador->deseo_entrenar >= 6 and $indicador->deseo_entrenar <= 8) {$color = "#E1DE01";}
                    else{$color = "green";}

                    return '<span class="label" style="background-color:'.$color.';">'.$indicador->deseo_entrenar.'</span>';
                })

                ->editColumn('desayuno',function($indicador){
                    if($indicador->desayuno >= 1 and $indicador->desayuno <= 4) {$color= "green";}
                    elseif($indicador->desayuno >= 5 and $indicador->desayuno <= 6) {$color = "#E1DE01";}
                    else{$color = "red";}

                    return '<span class="label" style="background-color:'.$color.';">'.$indicador->desayuno.'</span>';
                })

                ->editColumn('diferencia_peso_porcentual',function($indicador){
                    return round($indicador->diferencia_peso_porcentual,1);
                })

                ->addColumn('operaciones', '
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{ URL::route( \'indicadores.editar\', array( $id )) }}"><i class="icon-pencil"></i> Editar</a></li>
                                    <li><a href="#" onclick="eliminar({{ $id  }})"><i class="icon-trash"></i> Eliminar</a></li>
                                </ul>
                            </li>
                        </ul>')
                ->removeColumn('id')
                ->make(true);
        }
    }




    public function resultadosSemanales(Request $request) {

        $id = $request->input("cliente");
        $semana = $request->input("semana");


        ///validamos los campos enviados
        $validator =  Validator::make($request->all(), [
            'cliente' => 'required|numeric',
            'semana' => 'required|numeric',
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
        } else{

            $indicadores = Cliente::findOrFail($id)->indicadores()->where([['semana','=', $semana],['deleted_at','=',null]])->get();

            if (count($indicadores) >= 2){

                $cargaSemanal = 0;
                $ds = 0;
                $indiceDeMonotonia = 0;
                $impacto = 0;

                $cargaEntrenamiento = array();

                foreach ($indicadores as $indicador){
                    array_push($cargaEntrenamiento,$indicador->carga_entrenamiento);
                }

                $media = array_sum($cargaEntrenamiento)/count($cargaEntrenamiento);
                $cargaSemanal = $media / count($cargaEntrenamiento);


                $suma = 0;
                for ($i =0 ; $i <= count($cargaEntrenamiento) -1 ;$i++){
                    $suma = $suma + pow($cargaEntrenamiento[$i] - $media , 2);
                }

                $ds = sqrt(($suma / (count($cargaEntrenamiento) - 1)));

                $indiceDeMonotonia = $cargaSemanal / $ds;

                $impacto = $cargaSemanal * $indiceDeMonotonia;

                return '<div "table-responsive pre-scrollable">
                            <table class="table">
                            <thead>
                                <tr>
                                    <th>Carga Semanal</th>
                                    <th>DS</th>
                                    <th>Indice de Monotonia</th>
                                    <th>Impacto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>'.round($cargaSemanal,1).'</td>
                                    <td>'.round($ds,1).'</td>
                                    <td>'.round($indiceDeMonotonia,1).'</td>
                                    <td>'.round($impacto,1).'</td>
                                </tr>
                            </tbody>
                            </table>
                        </div>';
            }

            else {
                return '<h5> Se requiere más de un indicador para realizar los cálculos </h5>';
            }
        }
    }



    public function listarIndicadoresMensuales()
    {
        $clientes = Cliente::all();

        return view('admin.indicadores.listar-mes-indicadores',['titulo'=>'Lista de Indicadores Mensuales','clientes'=>$clientes]);
    }


    public function semanasDelMes($fecha){
        $mes = date('m',strtotime($fecha));
        $anio = date('Y',strtotime($fecha));
        $semana = array();
        $timestamp = mktime(0, 0, 0, $mes, 1, $anio);
        while(date('n', $timestamp) == $mes)
        {
            array_push($semana,date('W', $timestamp));
            $timestamp = strtotime("+1 week", $timestamp);
        }
        return $semana;
    }


    //devuelve los datos al datatable que les solicito
    public function anyDataMes(Request $request)
    {
        ///validamos los campos enviados
        $validator =  Validator::make($request->all(), [
            'cliente' => 'required|numeric',
            'mes' => 'required|date_format:Y-m-d',
        ]);

        $cliente = $request->input("cliente");

        $fecha = $date = str_replace('/', '-', $request->input('mes'));
        $fecha = date('Y/m/d',strtotime($fecha)); //la que obtenes del formulario

        $mes = date('m',strtotime($fecha));

        $resultado = static::semanasDelMes($fecha); //obtiene en un array los numeros de las semanas indicadas


        //si falla la validacion, redireccionamos con los errores
        if ($validator->fails())
        {
            $errors = $validator->errors();
            $errors =  json_decode($errors);

            return response()->json([
                'success' => false,
                'message' => $errors
            ], 422);
        } else{


        $indicadores = DB::table('indicadores')->where('cliente_id',$cliente)->where(DB::raw('date_format(fecha_indicador, \'%m\')'),$mes)->whereNull('deleted_at')->whereIn('semana', collect($resultado));

        //se muestra el datatable

        return Datatables::of($indicadores)
            //->editColumn('fecha_indicador','{{date_format(new DateTime($fecha_indicador),"d-m-Y")}}')
            ->editColumn('fecha_carga',function($indicador){
                return date('d-m-Y', strtotime($indicador->fecha_indicador));
            })

            ->editColumn('pse',function($indicador){
                if($indicador->pse >= 1 and $indicador->pse <= 4) {$color= "green";}
                elseif($indicador->pse >= 5 and $indicador->pse <= 6) {$color = "#E1DE01";}
                else{$color = "red";}

                return '<span class="label" style="background-color:'.$color.';">'.$indicador->pse.'</span>';
            })

            ->editColumn('sueno',function($indicador){
                if($indicador->sueno >= 1 and $indicador->sueno <= 5) {$color= "red";}
                elseif($indicador->sueno >= 6 and $indicador->sueno <= 7) {$color = "#E1DE01";}
                else{$color = "green";}

                return '<span class="label" style="background-color:'.$color.';">'.$indicador->sueno.'</span>';
            })

            ->editColumn('dolor',function($indicador){
                if($indicador->dolor >= 1 and $indicador->dolor <= 4) {$color= "green";}
                elseif($indicador->dolor >= 5 and $indicador->dolor <= 6) {$color = "#E1DE01";}
                else{$color = "red";}

                return '<span class="label" style="background-color:'.$color.';">'.$indicador->dolor.'</span>';
            })

            ->editColumn('deseo_entrenar',function($indicador){
                if($indicador->deseo_entrenar >= 1 and $indicador->deseo_entrenar <= 5) {$color= "red";}
                elseif($indicador->deseo_entrenar >= 6 and $indicador->deseo_entrenar <= 8) {$color = "#E1DE01";}
                else{$color = "green";}

                return '<span class="label" style="background-color:'.$color.';">'.$indicador->deseo_entrenar.'</span>';
            })

            ->editColumn('desayuno',function($indicador){
                if($indicador->desayuno >= 1 and $indicador->desayuno <= 4) {$color= "green";}
                elseif($indicador->desayuno >= 5 and $indicador->desayuno <= 6) {$color = "#E1DE01";}
                else{$color = "red";}

                return '<span class="label" style="background-color:'.$color.';">'.$indicador->desayuno.'</span>';
            })
            ->editColumn('diferencia_peso_porcentual',function($indicador){
                return round($indicador->diferencia_peso_porcentual,1);
            })

            ->addColumn('operaciones', '
                    <ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="{{ URL::route( \'indicadores.editar\', array( $id )) }}"><i class="icon-pencil"></i> Editar</a></li>
								<li><a href="#" onclick="eliminar({{ $id  }})"><i class="icon-trash"></i> Eliminar</a></li>
							</ul>
						</li>
					</ul>')
            ->removeColumn('id')
            ->make(true);
        }
    }



    public function resultadosMensuales(Request $request) {

        $cliente = $request->input("cliente");

        $fecha = $date = str_replace('/', '-', $request->input('mes'));
        $fecha = date('Y/m/d',strtotime($fecha)); //la que obtenes del formulario
        $mes = date('m',strtotime($fecha));

        //Obtengo todas las semanas de un mes
        $resultado = static::semanasDelMes($fecha); //obtiene en un array los numeros de las semanas indicadas


        ///validamos los campos enviados
        $validator =  Validator::make($request->all(), [
            'cliente' => 'required|numeric',
            'mes' => 'required|date_format:Y-m-d',
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
        } else{

            $semanas = DB::table('indicadores')->where('cliente_id',$cliente)->where(DB::raw('date_format(fecha_indicador, \'%m\')'),$mes)->whereNull('deleted_at')->whereIn('semana', collect($resultado))->get();

            $respuesta = '<div "table-responsive pre-scrollable">
                            <table class="table">
                            <thead>
                                <tr>
                                    
                                    <th>Carga Semanal</th>
                                    <th>DS</th>
                                    <th>Indice de Monotonia</th>
                                    <th>Impacto</th>
                                </tr>
                            </thead>
                            <tbody>';

            $cargaEntrenamiento = array();

            //segun la cantidad de semanas
            foreach ($semanas as $indicador){
                array_push($cargaEntrenamiento,$indicador->carga_entrenamiento);
            }

            $cargaSemanal = 0;
            $ds = 0;
            $indiceDeMonotonia = 0;
            $impacto = 0;

            if (count($cargaEntrenamiento) >= 2){
                $media = array_sum($cargaEntrenamiento) / count($cargaEntrenamiento);
                $cargaSemanal = $media / count($cargaEntrenamiento);


                $suma = 0;
                for ($i = 0; $i <= count($cargaEntrenamiento) - 1; $i++) {
                    $suma = $suma + pow($cargaEntrenamiento[$i] - $media, 2);
                }

                $ds = sqrt(($suma / (count($cargaEntrenamiento) - 1)));
                $indiceDeMonotonia = $cargaSemanal / $ds;
                $impacto = $cargaSemanal * $indiceDeMonotonia;

                $respuesta .= '<tr>
                                            <td>' . round($cargaSemanal,1) . '</td>
                                            <td>' . round($ds, 1) . '</td>
                                            <td>' . round($indiceDeMonotonia, 1) . '</td>
                                             <td>' . round($impacto, 1) . '</td>
                                         </tr>';
            }

            $respuesta .= ' </tbody></table></div>';
            return $respuesta;
//            else {
//                return '<h5> Se requiere más de un indicador para realizar los cálculos </h5>';
//            }
        }
    }



    public function edit($id)
    {
        //muestra el formulario con los datos del ejercicio a modificar
        $indicador =  Indicador::findOrFail($id);
        $cliente = $indicador->clientes;

        return view('admin.indicadores.editar-indicadores',['titulo'=>'Modificar Indicador','indicador' => $indicador, 'cliente' => $cliente]);
    }



    public function update(Request $request, $id)
    {
        $indicador = Indicador::findOrFail($id);

        $cliente = $request->input('cliente');
        $fecha_indicador = $request->input('fecha_indicador');
        $mes = $request->input('mes');
        $peso_inicial = $request->input('peso_inicial');
        $peso_final = $request->input('peso_final');
        $hora_entrada = $request->input('hora_entrada');
        $hora_salida = $request->input('hora_salida');
        $pse = $request->input('pse');
        $sueno = $request->input('sueno');
        $dolor = $request->input('dolor');
        $deseo_entrenar = $request->input('deseo_entrenar');
        $desayuno = $request->input('desayuno');
        $pse_global_sesion = $request->input('pse_global_sesion');
        //$carga_entrenamiento = $request->input('carga_entrenamiento');

        //validamos los campos enviados
        $validator =  Validator::make($request->all(), [
            'cliente' => 'required|numeric',
            'fecha_indicador' => 'required|date_format:d/m/Y',
            'mes' => 'required|date_format:Y-m-d',
            $semana = 'semana' => 'numeric',
            'peso_inicial' => 'required|numeric',
            'peso_final' => 'required|numeric',
            $diferencia_peso_porcentual = 'diferencia_peso_porcentual' => 'float',
            'hora_entrada' => 'required',
            'hora_salida' => 'required',
            $tiempo_entrenamiento = 'tiempo_entrenamiento',
            'pse' => 'required|numeric|max:10|min:1',
            'sueno' => 'required|numeric|max:10|min:1',
            'dolor' => 'required|numeric|max:10|min:1',
            'deseo_entrenar' => 'required|numeric|max:10|min:1',
            'desayuno' => 'required|numeric|max:10|min:1',
            $sumatoria = 'sumatoria' => 'numeric',
            'pse_global_sesion' => 'required|numeric',
            $carga_entrenamiento = 'carga_entrenamiento' => 'numeric'
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
        }else{

        //si no falla la validacion, se carga la categoria en la BD

            $fecha_indicador = $date = str_replace('/', '-', $request->input('fecha_indicador'));
            $request->merge(array('fecha_indicador' => date("Y-m-d", strtotime($fecha_indicador))));

        $mes = $date = str_replace('/', '-', $request->input('mes'));
        $mes =date("Y-m-d", strtotime($mes));

        //date("W",strtotime($fecha)), es una funcion que me guarda en la vble semana, la correspondiente semana de la fecha agregada, EN CASO QUE LA FECHA NO SE ENCUENTRE YA REGISTRADA.
        $semana =date("W",strtotime($fecha_indicador));

        $diferencia_peso = $peso_final - $peso_inicial;
        $diferencia_peso_porcentual = ((($diferencia_peso * 100) / $peso_inicial) * -1);

        $sumatoria = $pse + $sueno + $dolor + $deseo_entrenar + $desayuno;

        $tiempo_entrenamiento = (( strtotime($hora_salida) - strtotime($hora_entrada) ) / 60);

        $carga_entrenamiento = $pse_global_sesion * $tiempo_entrenamiento;

        //guardar los datos
        //$indicador = New Indicador();
        //$indicador->create($request->all());
        $indicador->cliente_id = $cliente;
        $indicador->fecha_indicador = $fecha_indicador;
        $indicador->mes = $mes;
        $indicador->semana = $semana;
        $indicador->peso_inicial = $peso_inicial;
        $indicador->peso_final = $peso_final;
        $indicador->diferencia_peso_porcentual = $diferencia_peso_porcentual;
        $indicador->fecha_indicador = $fecha_indicador;
        $indicador->hora_entrada = $hora_entrada;
        $indicador->hora_salida = $hora_salida;
        $indicador->pse = $pse;
        $indicador->sueno = $sueno;
        $indicador->dolor = $dolor;
        $indicador->deseo_entrenar = $deseo_entrenar;
        $indicador->desayuno = $desayuno;
        $indicador->sumatoria = $sumatoria;
        $indicador->pse_global_sesion = $pse_global_sesion;
        $indicador->tiempo_entrenamiento = $tiempo_entrenamiento;
        $indicador->carga_entrenamiento = $carga_entrenamiento;
        $indicador->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'record updated'
        ], 200);

        }
    }



    public function destroy($id)
    {
        $indicador = Indicador::find($id);


        $indicador->delete();

        //if el ejercicio está borrado
        if ($indicador->trashed()){
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





}
