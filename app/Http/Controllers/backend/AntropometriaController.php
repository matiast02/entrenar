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
use App\Antropometria;

class AntropometriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function create(Request $request)
    {
        return view('admin.antropometria.crear-antropometria',['titulo'=>'Crear Antropometria']);
    }


    public function store(Request $request)
    {
        $cliente = $request->input('cliente');
        $fecha_antropometria = $request->input('fecha_antropometria');

        $peso_corporal = $request->input('peso_corporal');
        $talla = $request->input('talla');
        $porcentaje_adiposo = $request->input('porcentaje_adiposo');
        $porcentaje_muscular = $request->input('porcentaje_muscular');
        $indice_endo = $request->input('indice_endo');
        $indice_meso = $request->input('indice_meso');
        $indice_hecto = $request->input('indice_hecto');
        $clasificacion = $request->input('clasificacion');
        $ideal = $request->input('ideal');


        ///validamos los campos enviados
        $validator =  Validator::make($request->all(), [
            'cliente' => 'required|numeric',
            'fecha_antropometria' => 'required|date_format:d/m/Y',

            'peso_corporal' => 'required|numeric',
            'talla' => 'required|numeric',
            'porcentaje_adiposo' => 'required|numeric',
            'porcentaje_muscular' => 'required|numeric',
            'indice_endo' => 'required|numeric',
            'indice_meso' => 'required|numeric',
            'indice_hecto' => 'required|numeric',
            'clasificacion' => 'required|string',
            'ideal' => 'required|string',
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

            $fecha_antropometria = $date = str_replace('/', '-', $request->input('fecha_antropometria'));
            $fecha_antropometria =date("Y-m-d", strtotime($fecha_antropometria));

            //guardar los datos
            $antropometria = New Antropometria();
            $antropometria->cliente_id = $cliente;
            $antropometria->fecha_antropometria = $fecha_antropometria;
            $antropometria->peso_corporal = $peso_corporal;
            $antropometria->talla = $talla;
            $antropometria->porcentaje_adiposo = $porcentaje_adiposo;
            $antropometria->porcentaje_muscular = $porcentaje_muscular;
            $antropometria->indice_endo = $indice_endo;
            $antropometria->indice_meso = $indice_meso;
            $antropometria->indice_hecto = $indice_hecto;
            $antropometria->clasificacion = $clasificacion;
            $antropometria->ideal = $ideal;
            $antropometria->save();

            return response()->json([
                'success' => true,
                'message' => 'record updated'
            ], 200);
        }
    }


    public function edit($id)
    {
        //muestra el formulario con los datos del pago a modificar
        $antropometria =  Antropometria::findOrFail($id);
        $cliente = $antropometria->clientes;

        return view('admin.antropometria.editar-antropometria',['titulo'=>'Modificar Antropometria','antropometria' => $antropometria, 'cliente' => $cliente]);
    }


    public function update(Request $request, $id)
    {
        $antropometria = Antropometria::findOrFail($id);

        $cliente = $request->input('cliente');
        $fecha_antropometria = $request->input('fecha_antropometria');

        $peso_corporal = $request->input('peso_corporal');
        $talla = $request->input('talla');
        $porcentaje_adiposo = $request->input('porcentaje_adiposo');
        $porcentaje_muscular = $request->input('porcentaje_muscular');
        $indice_endo = $request->input('indice_endo');
        $indice_meso = $request->input('indice_meso');
        $indice_hecto = $request->input('indice_hecto');
        $clasificacion = $request->input('clasificacion');
        $ideal = $request->input('ideal');

        ///validamos los campos enviados
        $validator =  Validator::make($request->all(), [
            'cliente' => 'required|numeric',
            'fecha_antropometria' => 'required|date_format:d/m/Y',

            'peso_corporal' => 'required|numeric',
            'talla' => 'required|numeric',
            'porcentaje_adiposo' => 'required|numeric',
            'porcentaje_muscular' => 'required|numeric',
            'indice_endo' => 'required|numeric',
            'indice_meso' => 'required|numeric',
            'indice_hecto' => 'required|numeric',
            'clasificacion' => 'required',
            'ideal' => 'required',
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
            $fecha_antropometria = $date = str_replace('/', '-', $request->input('fecha_antropometria'));
            $request->merge(array('fecha_antropometria' => date("Y-m-d", strtotime($fecha_antropometria))));

            //guardar los datos

            $antropometria->cliente_id = $cliente;
            $antropometria->fecha_antropometria = $fecha_antropometria;
            $antropometria->peso_corporal = $peso_corporal;
            $antropometria->talla = $talla;
            $antropometria->porcentaje_adiposo = $porcentaje_adiposo;
            $antropometria->porcentaje_muscular = $porcentaje_muscular;
            $antropometria->indice_endo = $indice_endo;
            $antropometria->indice_meso = $indice_meso;
            $antropometria->indice_hecto = $indice_hecto;
            $antropometria->clasificacion = $clasificacion;
            $antropometria->ideal = $ideal;
            $antropometria->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'record updated'
        ], 200);

        }
    }


    public function destroy($id)
    {
        $antropometria = Antropometria::find($id);

        //Con el objeto $ejercicio llamo a la funcion delete que ya trae Laravel
        $antropometria->delete();
        //if el ejercicio está borrado
        if ($antropometria->trashed()){
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


    //listar todos los pagos
    public function listar()
    {
        $clientes = Cliente::all();

        return view('admin.antropometria.listar-antropometria',['titulo'=>'Listado de Antropometria', 'clientes'=>$clientes]);
    }


    //devuelve los datos al datatable que les solicito
    public function anyData(Request $request)
    {


        ///validamos los campos enviados
        $validator =  Validator::make($request->all(), [
            'cliente' => 'required|numeric',
            'rango_fechas' => 'required',
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

        $id = $request->input("cliente");
        $rango_fechas = $request->input('rango_fechas');
        $rango_fechas = explode('-',$request->input('rango_fechas'));
        $fecha_inicio = date('Y-m-d',strtotime(strtr($rango_fechas[0], '/', '-')));
        $fecha_fin = date('Y-m-d',strtotime(strtr($rango_fechas[1],'/','-')));

        
        $antropometrias = Cliente::findOrFail($id)->antropometrias()->whereBetween('fecha_antropometria', array($fecha_inicio, $fecha_fin))->get();

            return Datatables::of($antropometrias)

                ->editColumn('fecha_antropometria',function($antropometria){
                    return date('d-m-Y', strtotime($antropometria->fecha_antropometria));
                })

                ->addColumn('operaciones', '
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{ URL::route( \'antropometrias.editar\', array( $id )) }}"><i class="icon-pencil"></i> Editar</a></li>
                                    <li><a href="#" onclick="eliminar({{ $id  }})"><i class="icon-trash"></i> Eliminar</a></li>
                                </ul>
                            </li>
                        </ul>')
                ->removeColumn('id')
                ->make(true);

    }


}
