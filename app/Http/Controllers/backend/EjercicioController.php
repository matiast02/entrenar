<?php

namespace App\Http\Controllers\backend;

use App\Categoria_Ejercicio;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Ejercicio;
use App\User;
use App\Cliente;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Validator;

class EjercicioController extends Controller
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
        $categoria_ejercicios = Categoria_Ejercicio::all();
        return view('admin.ejercicios.crear-ejercicios',['titulo'=>'Crear Ejercicio', 'categoria_ejercicios'=>$categoria_ejercicios]);
    }



    public function store(Request $request)
    {
        ///validamos los campos enviados
        //en el formulario los llamo con el name
        $validator =  Validator::make($request->all(), [
            'nombre' => 'required|min:3',
            'categoria_ejercicios_id' => 'required|numeric',
            'fuerza' => 'required|boolean',
        ]);

        $nombre = $request->input('nombre');
        $categoria_ejercicios_id = $request->input('categoria_ejercicios_id');
        $fuerza = $request->input('fuerza');

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
            //si no falla la validacion, se carga la categoria del ejercicio en la BD e informamos

            //guardar los datos
            $ejercicio = New Ejercicio();
            $ejercicio->nombre = $nombre;
            $ejercicio->categoria_ejercicios_id = $categoria_ejercicios_id;
            $ejercicio->fuerza = $fuerza;
            $ejercicio->save();


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
        $ejercicio =  Ejercicio::findOrFail($id);

        $categoriaDeLosejercicios = $ejercicio->categoria_ejercicios_id;

        $categoria_ejercicios = Categoria_Ejercicio::all();


        return view('admin.ejercicios.editar-ejercicios',['titulo'=>'Modificar Ejercicio','ejercicio' => $ejercicio, 'categoriaDeLosejercicios'=>$categoriaDeLosejercicios, 'categoria_ejercicios'=>$categoria_ejercicios]);
    }



    public function update(Request $request, $id)
    {
        $ejercicio = Ejercicio::findOrFail($id);

        $nombre = $request->input('nombre');
        $categoria_ejercicios_id = $request->input('categoria_ejercicios_id');
        $fuerza = $request->input('fuerza');

        //validamos los campos enviados
        $validator =  Validator::make($request->all(), [
            //QUe en la tabla ejercicios el nombre del ejercicio sea unico
            'nombre' => 'required|min:3',
            'categoria_ejercicios_id' => 'required|numeric',
            'fuerza' => 'required|boolean',
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
            //si no falla la validacion, se carga la categoria en la BD
            //guardar los datos
            $ejercicio->nombre = $nombre;
            $ejercicio->categoria_ejercicios_id = $categoria_ejercicios_id;
            $ejercicio->fuerza = $fuerza;
            $ejercicio->update();


            return response()->json([
                'success' => true,
                'message' => 'record updated'
            ], 200);

        }
    }



    public function destroy($id)
    {
        $ejercicio = Ejercicio::find($id);

        //Con el objeto $ejercicio llamo a la funcion delete que ya trae Laravel
        $ejercicio->delete();
        //if el ejercicio está borrado
        if ($ejercicio->trashed()){
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
    public function listar(){

        $categoria_ejercicios = Categoria_Ejercicio::all();

        return view('admin.ejercicios.listar-ejercicios',['titulo'=>'Listado de Ejercicios', 'categoria_ejercicios' => $categoria_ejercicios]);

    }


    //devuelve los datos al datatable que les solicito
    public function anyData()
    {
        return Datatables::of(Ejercicio::query())

            ->editColumn('categoria_ejercicios_id',function($data){
                $categoria_ejercicios = Categoria_Ejercicio::find($data['categoria_ejercicios_id']);
                return $categoria_ejercicios['nombre'];
            })

            ->editColumn('fuerza',function($data){
                if($data['fuerza'] == 1){
                    return "<span class='label label-success'>Si</span>";
                }else{
                    return "<span class='label label-warning'>No</span>";
                }
            })

            ->addColumn('operaciones',function ($data){
                if ($data['fuerza']==1){
                    return '
                    <ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="'.route( "ejercicios.editar", $data['id']).'"><i class="icon-pencil"></i> Editar</a></li>
								<li><a href="#" onclick="eliminar('.$data['id'].')"><i class="icon-trash"></i> Eliminar</a></li>
							</ul>
						</li>
					</ul>';
                 }
                })

            ->removeColumn('id')
            ->make(true);
    }


}


//{{ URL::route( 'ejercicios.editar', array( $id )) }}