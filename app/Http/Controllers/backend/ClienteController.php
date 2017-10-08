<?php

namespace App\Http\Controllers\backend;

use App\Categoria;
use App\Categoria_Ejercicio;
use App\Deporte;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Indicador;
use App\Cliente;
//use App\Role;
use App\Ejercicio;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Symfony\Component\HttpKernel\Client;
use Yajra\Datatables\Datatables;
use Validator;
use DB;
use Image;



class ClienteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }



    public function create()
    {
        $deportes = Deporte::all();
        $categorias = Categoria::all();
        return view('admin.clientes.crear-clientes',['titulo'=>'Crear Cliente', 'deportes' => $deportes, 'categorias' => $categorias]);
    }



    public function store(Request $request)
    {
        $nombre = $request->input('nombre');
        $apellido = $request->input('apellido');
        $fecha_nacimiento = $request->input('fecha_nacimiento');
        $dni = $request->input('dni');
        $direccion = $request->input('direccion');
        $celular = $request->input('celular');
        $email = $request->input('email');


        //$date = Carbon::createFromDate(1970,19,12)->age; // 43

        $deporte_id = $request->input('deporte_id');
        $categoria_id = $request->input('categoria_id');
        $institucion = $request->input('institucion');
        $gym = $request->input('gym');
        $fecha_inicio_entrenamiento = $request->input('fecha_inicio_entrenamiento');
        //$foto = $request->input('foto');
        //$test_control_id = $request->input('test_control_id');
        $estado = $request->input('estado');

        //validamos los campos enviados
        $validator =  Validator::make($request->all(), [
            'nombre' => 'required|min:3|regex:/^[\pL\s\-]+$/u',
            'apellido' => 'required|min:3|regex:/^[\pL\s\-]+$/u',
            'fecha_nacimiento' => 'required|date_format:d/m/Y',
            'dni' => 'required|min:7|max:8|unique:clientes,dni',
            'direccion' => 'required|min:4',
            'celular' => 'required|min:9',
            'email' => 'required|email|unique:clientes',

            'deporte_id' => 'required|numeric',
            'categoria_id' => 'required',
            'institucion' => 'required|min:3',
            'gym' => 'required',
            'fecha_inicio_entrenamiento' => 'required|date_format:d/m/Y',

//            'password' =>'required|min:8|confirmed',
//            'password_confirmation' =>'required|min:8',
            'foto' => 'mimes:jpeg,gif,png,jpg|dimensions:max_height=1000,max_width=1000',
            //'test_control_id' => 'required|numeric',
            'estado' => 'required|numeric',
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
            //si no falla la validacion, se carga el usuario en la BD e informamos
            $cliente =  New Cliente;
            //cambiamos el formato de la fecha

            $fecha_nacimiento = $date = str_replace('/', '-', $request->input('fecha_nacimiento'));
            $fecha_nacimiento =date("Y-m-d", strtotime($fecha_nacimiento));

            $fecha_inicio_entrenamiento = $date = str_replace('/', '-', $request->input('fecha_inicio_entrenamiento'));
            $fecha_inicio_entrenamiento =date("Y-m-d", strtotime($fecha_inicio_entrenamiento));

//            //hashear password
//            $password = bcrypt($request->input('password'));
//            $request->merge(array('password' => $password));

            //guardar los datos
//            $cliente = New Cliente();
//            $cliente->estado = 1;
//            $cliente->create($request->all());

            $cliente->nombre = $nombre;
            $cliente->apellido = $apellido;
            $cliente->fecha_nacimiento = $fecha_nacimiento;
            $cliente->dni = $dni;
            $cliente->direccion = $direccion;
            $cliente->celular = $celular;
            $cliente->email = $email;
            $cliente->deporte_id = $deporte_id;
            $cliente->categoria_id = $categoria_id;
            $cliente->institucion = $institucion;
            $cliente->gym = $gym;
            $cliente->fecha_inicio_entrenamiento = $fecha_inicio_entrenamiento;
            //$cliente->foto = $foto;
            //$cliente->test_control_id = $test_control_id;
            $cliente->estado = $estado;
            $cliente->save();

            if($request->file('foto')) {
                //cambiar la imagen
                $rutaDeCarpeta = 'images/perfiles/'; // ruta de la carpeta donde guardar la imagen
                $extension = $request->file('foto')->getClientOriginalExtension(); // extencion de la imagen
                $nombreArchivo = $rutaDeCarpeta . $cliente->id . '.' . $extension; // renameing image
                //$request->file('ImagePrincipal')->move($rutaDeCarpeta, $nombreArchivo); // moviendo la imagen a la carpeta
                Image::make($request->file('foto')->getRealPath())->resize(500,500)->save($nombreArchivo);
                $cliente->foto = $nombreArchivo;
                $cliente->save();

            }else{
                //imagen standar
                $cliente->foto = 'images/perfiles/default.jpg';
                $cliente->save();
            }


//            //obtenemos el  ultimo usuario insertado para asignarle el rol deportista
//            $rol = Role::where('name', '=', 'deportista')->first();
//            $usuario->attachRole($rol,$usuario->id);
//            //definir rol deportista por defecto

            return response()->json([
                'success' => true,
                'message' => 'record updated'
            ], 200);
        }

    }



    //listar todos los clientes
    public function listar(){
        return view('admin.clientes.listar-clientes',['titulo'=>'Gestion de Clientes']);
    }



    //devuelve los datos al datatable que les solicito, en este caso lista de clientes
    public function anyData()
    {
        return Datatables::of(Cliente::query())

            ->editColumn('deporte_id',function($data){
                $deportes = Deporte::find($data['deporte_id']);
                return $deportes['nombre'];
            })

            ->editColumn('categoria_id',function($data){
                $categorias = Deporte::find($data['categoria_id']);
                return $categorias['nombre'];
            })

            ->addColumn('foto', function($data){
                return '<div class="media-left media-middle">
							<a href="#">
								<img src="'.asset($data->foto).'" class="img-circle" alt="'.$data->foto.'">
							</a>
						</div>';
            })
            ->editColumn('fecha_nacimiento', function($data){
                return date('d-m-Y',strtotime($data->fecha_nacimiento));
            })
            ->editColumn('fecha_inicio_entrenamiento',function($data){
                return date('d-m-Y',strtotime($data->fecha_inicio_entrenamiento));
            })
            ->addColumn('operaciones', '
                    <ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="{{ URL::route( \'editar.clientes\', array( $id )) }}"><i class="icon-pencil"></i> Editar</a></li>
								<li><a href="#" onclick="eliminar({{ $id  }})"><i class="icon-trash"></i> Eliminar</a></li>
							</ul>
						</li>
					</ul>')
            ->removeColumn('id')
            ->make(true);
    }



    public function buscar(){
        $ejercicios = Ejercicio::all();
        $cat_ejer = Categoria_Ejercicio::all();
        return   view('admin.clientes.buscar',['titulo'=>'Buscar Clientes','ejercicios'=>$ejercicios,'cat_ejer'=>$cat_ejer]);
    }



    public function search(Request $keyword)
    {

        $clientes =  \DB::table('clientes')
            ->select(['nombre AS text','id AS id','apellido AS apellido'])
            ->where("apellido", "LIKE", "%{$keyword->input('term.term')}%")
            ->get();
        $searchClientes = Cliente::where("nombre", "LIKE", "%{$keyword->input('term.term')}%")->get();
        return response()->json(
            $clientes
            , 200);
    }



    public function edit($id)
    {
        //muestra el formulario con los datos del pago a modificar
        $cliente =  Cliente::findOrFail($id);

        $deporte_cliente = $cliente->deportes->id;
        $categoria_cliente = $cliente->categorias->id;

        $deportes = Deporte::all();
        $categorias = Categoria::all();

        return view('admin.clientes.editar-clientes',['titulo'=>'Modificar Cliente', 'cliente' => $cliente, 'deportes' => $deportes, 'deporte_cliente' => $deporte_cliente, 'categorias' => $categorias, 'categoria_cliente' => $categoria_cliente]);
    }



    public function update(Request $request, $id)
    {

        $cliente = Cliente::findOrFail($id);

        $nombre = $request->input('nombre');
        $apellido = $request->input('apellido');
        $fecha_nacimiento = $request->input('fecha_nacimiento');
        $dni = $request->input('dni');
        $direccion = $request->input('direccion');
        $celular = $request->input('celular');
        $email = $request->input('email');

        //$date = Carbon::createFromDate(1970,19,12)->age; // 43

        $deporte_id = $request->input('deporte_id');
        $categoria_id = $request->input('categoria_id');
        $institucion = $request->input('institucion');
        $gym = $request->input('gym');
        $fecha_inicio_entrenamiento = $request->input('fecha_inicio_entrenamiento');
        $foto = $request->input('foto');
        //$test_control_id = $request->input('test_control_id');
        $estado = $request->input('estado');


        $validator =  Validator::make($request->all(), [
            'nombre' => 'required|min:3|regex:/^[\pL\s\-]+$/u',
            'apellido' => 'required|min:3|regex:/^[\pL\s\-]+$/u',
            'fecha_nacimiento' => 'required|date_format:d/m/Y',
            'dni' => 'required|min:7|max:8|unique:clientes,dni,'.$cliente->id,
            'direccion' => 'required|min:4',
            'celular' => 'required|min:9',
            'email' => 'required|email',

            'deporte_id' => 'required|numeric',
            'categoria_id' => 'required|numeric',
            'institucion' => 'required|min:3',
            'gym' => 'required',
            'fecha_inicio_entrenamiento' => 'required|date_format:d/m/Y',

//            'password' =>'required|min:8|confirmed',
//            'password_confirmation' =>'required|min:8',
            'foto' => 'mimes:jpeg,gif,png,jpg|dimensions:max_height=1000,max_width=1000',
            //'test_control_id' => 'required|numeric',
            'estado' => 'required|numeric',
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
            //si no falla la validacion, se carga el usuario en la BD e informamos


            //cambiamos el formato de la fecha

            $fecha_nacimiento = $date = str_replace('/', '-', $request->input('fecha_nacimiento'));
            $fecha_nacimiento =date("Y-m-d", strtotime($fecha_nacimiento));

            $fecha_inicio_entrenamiento = $date = str_replace('/', '-', $request->input('fecha_inicio_entrenamiento'));
            $fecha_inicio_entrenamiento =date("Y-m-d", strtotime($fecha_inicio_entrenamiento));

//            //hashear password
//            $password = bcrypt($request->input('password'));
//            $request->merge(array('password' => $password));


            $cliente->nombre = $nombre;
            $cliente->apellido = $apellido;
            $cliente->fecha_nacimiento = $fecha_nacimiento;
            $cliente->dni = $dni;
            $cliente->direccion = $direccion;
            $cliente->celular = $celular;
            $cliente->email = $email;
            $cliente->deporte_id = $deporte_id;
            $cliente->categoria_id = $categoria_id;
            $cliente->institucion = $institucion;
            $cliente->gym = $gym;
            $cliente->fecha_inicio_entrenamiento = $fecha_inicio_entrenamiento;
            //$cliente->test_control_id = $test_control_id;
            $cliente->estado = $estado;


            if($request->file('foto')) {


                //eliminar la imagen anterior si no es la imagen por defecto
                if ($cliente->foto !== 'images/perfiles/default.jpg'){
                    \File::delete($cliente->foto);
                }

                //cambiar la imagen
                $rutaDeCarpeta = 'images/perfiles/'; // ruta de la carpeta donde guardar la imagen
                $extension = $request->file('foto')->getClientOriginalExtension(); // extencion de la imagen
                $nombreArchivo = $rutaDeCarpeta . $cliente->id . '.' . $extension; // renameing image
                //$request->file('foto')->move($rutaDeCarpeta, $nombreArchivo); // moviendo la imagen a la carpeta
                Image::make($request->file('foto')->getRealPath())->resize(500,500)->save($nombreArchivo);
                $cliente->foto = $nombreArchivo;
                $cliente->save();

            }

            $cliente->update();

//            //obtenemos el  ultimo usuario insertado para asignarle el rol deportista
//            $rol = Role::where('name', '=', 'deportista')->first();
//            $usuario->attachRole($rol,$usuario->id);
//            //definir rol deportista por defecto

            return response()->json([
                'success' => true,
                'message' => 'record updated'
            ], 200);
        }

    }



    public function destroy($id)
    {
        $cliente = Cliente::find($id);

        //Con el objeto $ejercicio llamo a la funcion delete que ya trae Laravel
        $cliente->delete();
        //if el ejercicio está borrado
        if ($cliente->trashed()){
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



    public function verAsistencias(){
        return view('admin.clientes.asistencia',['titulo'=>'Asistencias del cliente']);
    }



    public function asistencias($id){
        $indicadores = Indicador::select('fecha_indicador')->where('cliente_id',$id)->groupBy('fecha_indicador')->orderBy('fecha_indicador','DESC')->get();
        $asistencias = array();
        foreach ($indicadores as $indicador) {
            array_push($asistencias,['title'=>'asistencia','start'=>$indicador->fecha_indicador]);
        }
        json_encode($asistencias);
        return $asistencias;
    }



    public function verEliminados(){
        return view('admin.clientes.clientes-eliminados',['titulo'=>'Clientes eliminados']);
    }



    public function listaEliminados(){

        $clientes = Cliente::onlyTrashed()->get();

        return Datatables::of($clientes)

            ->editColumn('deporte_id',function($data){
                $deportes = Deporte::find($data['deporte_id']);
                return $deportes['nombre'];
            })

            ->editColumn('categoria_id',function($data){
                $categorias = Deporte::find($data['categoria_id']);
                return $categorias['nombre'];
            })

            ->addColumn('foto', function($data){
                return '<div class="media-left media-middle">
							<a href="#">
								<img src="'.asset($data->foto).'" class="img-circle" alt="'.$data->foto.'">
							</a>
						</div>';
            })
            ->editColumn('fecha_nacimiento', function($data){
                return date('d-m-Y',strtotime($data->fecha_nacimiento));
            })
            ->editColumn('fecha_inicio_entrenamiento',function($data){
                return date('d-m-Y',strtotime($data->fecha_inicio_entrenamiento));
            })
            ->addColumn('operaciones', '
                    <ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="#" onclick="restaurar({{ $id }})"><i class="icon-rotate-cw2"></i> Restaurar</a></li>
							</ul>
						</li>
					</ul>')
            ->removeColumn('id')
            ->make(true);
    }


    //restaurar cliente eliminado
    public function restaurar($id){
        $cliente = Cliente::withTrashed()->find($id)->restore();

        if ($cliente == true){
            return response()->json([
                'success' => true,
                'message' => 'Restaurado'
            ], 200);
        }else{
            //si hay error al restaurar
            return response()->json([
                'success' => false,
                'message' => 'Error al restaurar.'
            ], 422);
        }

    }

}
