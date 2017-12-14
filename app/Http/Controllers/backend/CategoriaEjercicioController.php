<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Ejercicio;
use App\Categoria_Ejercicio;
use App\Cliente;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Validator;
use DB;

class CategoriaEjercicioController extends Controller
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
        return view('admin.categoria_ejercicios.crear-categoria_ejercicios',['titulo'=>'Crear Categoria de Ejercicio']);
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
            //si no falla la validacion, se carga el ejercicio en la BD e informamos

            //guardar los datos
            $categoria_ejercicio = New Categoria_Ejercicio();
            $categoria_ejercicio->create($request->all());

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
        $categoria_ejercicio =  Categoria_Ejercicio::findOrFail($id);

        return view('admin.categoria_ejercicios.editar-categoria_ejercicios',['titulo'=>'Modificar Categoria de Ejercicios','categoria_ejercicio' => $categoria_ejercicio]);
    }



    public function update(Request $request, $id)
    {
        $categoria_ejercicio = Categoria_Ejercicio::findOrFail($id);

        //validamos los campos enviados
        $validator =  Validator::make($request->all(), [

            //QUe en la tabla ejercicios el nombre del ejercicio sea unico
            'nombre' => 'required|unique:categoria_ejercicios,nombre,'.$id.'|min:3|regex:/^[\pL\s\-]+$/u'
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
        $categoria_ejercicio->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'record updated'
        ], 200);
    }



    public function destroy($id)
    {
        $categoria_ejercicio = Categoria_Ejercicio::find($id);

        //Con el objeto $ejercicio llamo a la funcion delete que ya trae Laravel
        $categoria_ejercicio->delete();
        //if el ejercicio está borrado
        if ($categoria_ejercicio->trashed()){
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
        return view('admin.categoria_ejercicios.listar-categoria_ejercicios',['titulo'=>'Listado de Categoria de Ejercicios']);
    }


    //devuelve los datos al datatable que les solicito
    public function anyData()
    {
        return Datatables::of(Categoria_Ejercicio::query())
            ->addColumn('operaciones', '
                    <ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="{{ URL::route( \'categoria_ejercicios.editar\', array( $id )) }}"><i class="icon-pencil"></i> Editar</a></li>
								<li><a href="#" onclick="eliminar({{ $id  }})"><i class="icon-trash"></i> Eliminar</a></li>
							</ul>
						</li>
					</ul>')
            ->removeColumn('id')
            ->make(true);
    }


}


