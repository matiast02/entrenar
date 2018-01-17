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
use App\Pago;

class PagoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index()
    {

    }



    public function create(Request $request)
    {
        return view('admin.pagos.crear-pagos',['titulo'=>'Crear Pagos']);
    }



    public function store(Request $request)
    {
        ///validamos los campos enviados
        $validator =  Validator::make($request->all(), [
            'dias_semana' => 'required|numeric',
            'grupo' => 'required|numeric',
            'costo_mensual' => 'required|numeric',
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

            //guardar los datos
            $pago = New Pago();
            $pago->create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'record updated'
            ], 200);
        }
    }



    public function show($id)
    {
        //
    }



    public function edit($id)
    {
        //muestra el formulario con los datos del pago a modificar
        $pago =  Pago::findOrFail($id);

        return view('admin.pagos.editar-pagos',['titulo'=>'Modificar Pago','pago' => $pago]);
    }



    public function update(Request $request, $id)
    {
        $pago = Pago::findOrFail($id);

        //validamos los campos enviados
        $validator =  Validator::make($request->all(), [

            //QUe en la tabla ejercicios el nombre del ejercicio sea unico
            //'nombre' => 'required|unique:ejercicios,nombre,'.$id.'|min:3|regex:/^[\pL\s\-]+$/u'
            'dias_semana' => 'required|numeric',
            'grupo' => 'required|numeric',
            'costo_mensual' => 'required|numeric',
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
        //si no falla la validacion, se carga la categoria en la BD
        $pago->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'record updated'
        ], 200);
    }



    public function destroy($id)
    {
        $pago = Pago::find($id);

        //Con el objeto $ejercicio llamo a la funcion delete que ya trae Laravel
        $pago->delete();
        //if el ejercicio está borrado
        if ($pago->trashed()){
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
        return view('admin.pagos.listar-pagos',['titulo'=>'Listado de Grupos con su costo mensual']);
    }


    //devuelve los datos al datatable que les solicito
    public function anyData()
    {
        return Datatables::of(Pago::query())
            ->addColumn('operaciones', '
                    <ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="{{ URL::route( \'pagos.editar\', array( $id )) }}"><i class="icon-pencil"></i> Editar</a></li>
								<li><a href="#" onclick="eliminar({{ $id  }})"><i class="icon-trash"></i> Eliminar</a></li>
							</ul>
						</li>
					</ul>')
            ->removeColumn('id')
            ->make(true);
    }

}