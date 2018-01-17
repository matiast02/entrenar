<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Cliente;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Yajra\Datatables\Datatables;
use Validator;
use App\Deporte;

class DeporteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        //
    }



    public function create()
    {
        return view('admin.deportes.crear-deportes',['titulo'=>'Crear Deporte']);
    }



    public function store(Request $request)
    {
        ///validamos los campos enviados
        $validator =  Validator::make($request->all(), [
            'nombre' => 'required|min:3|regex:/^[\pL\s\-]+$/u',
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
            $deporte = New Deporte();
            $deporte->create($request->all());

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
        //muestra el formulario con los datos del ejercicio a modificar
        $deporte =  Deporte::findOrFail($id);


        return view('admin.deportes.editar-deportes',['titulo'=>'Modificar Deporte','deporte' => $deporte]);
    }



    public function update(Request $request, $id)
    {
        $deporte = Deporte::findOrFail($id);

        //validamos los campos enviados
        $validator =  Validator::make($request->all(), [

            //QUe en la tabla ejercicios el nombre del ejercicio sea unico
            'nombre' => 'required|unique:ejercicios,nombre,'.$id.'|min:3|regex:/^[\pL\s\-]+$/u'
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
        $deporte->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'record updated'
        ], 200);
    }



    public function destroy($id)
    {
        $deporte = Deporte::find($id);

        //Con el objeto $deporte llamo a la funcion delete que ya trae Laravel
        $deporte->delete();

        //if el ejercicio está borrado
        if ($deporte->trashed()){
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

    //listar todos los ejercicios
    public function listar()
    {
        return view('admin.deportes.listar-deportes',['titulo'=>'Listado de Deportes']);
    }


    //devuelve los datos al datatable que les solicito
    public function anyData()
    {
        return Datatables::of(Deporte::query())
            ->addColumn('operaciones', '
                    <ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="{{ URL::route( \'deportes.editar\', array( $id )) }}"><i class="icon-pencil"></i> Editar</a></li>
								<li><a href="#" onclick="eliminar({{ $id  }})"><i class="icon-trash"></i> Eliminar</a></li>
							</ul>
						</li>
					</ul>')
            ->removeColumn('id')
            ->make(true);
    }



}
