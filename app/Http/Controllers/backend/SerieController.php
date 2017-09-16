<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Serie;
use App\Cliente;
use App\User;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Validator;
use DB;

class SerieController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function create()
    {
        return view('admin.series.crear-series',['titulo'=>'Nueva Serie']);
    }



    public function store(Request $request)
    {
//        $cantidad_series = $request->input('cantidad_series');
//        $cantidad_series = $request->input('peso_corporal');

        ///validamos los campos enviados
        $validator =  Validator::make($request->all(), [
            'cantidad_series' => 'required|numeric',
            'peso_corporal' => 'required|numeric',
            'serie.*.can_rep' => 'required|numeric',
            'serie.*.pes_ext' => 'required|numeric',
            'serie.*.pot_imp' => 'required|numeric',
            'serie.*.vel_imp' => 'required|numeric',
            'serie.*.fue_imp' => 'required|numeric',
            'cliente' => 'required|numeric',
            'ejercicio' => 'required|numeric'
        ]);

        //si falla la validacion, redireccionamos con los errores
        if ($validator->fails())
        {
            //Crea un array con los errores
            $errors = $validator->errors();
            $errors =  json_decode($errors);

            return response()->json([
                'success' => false,
                'message' => $errors
            ], 422);

        } else{
            //si no falla la validacion, se carga la serie en la BD e informamos

            //guardar los datos
            $rm = 0;
            $aux = 0;
            $pot_imp = 0;
            $num_mejor_serie = 0;
            $cantidad_series  = $request->input('cantidad_series');




                //se guarda la  mejor serie (rm calculado) y la ultima serie
                for ($i = 0; $i<= $cantidad_series -1; $i++){
                    //si tiene una sola repeticion el rm=peso maximo
                    if ($request->input('serie'.$i.'can_rep') == 1){
                        $aux = $request->input('serie'.$i.'pes_ext');
                    }else{
                        $aux = 1 + (0.033 * intval($request->input('serie.'.$i.'.can_rep')) * intval($request->input('serie.'.$i.'.pes_ext')));
                    }

                    if ($aux > $rm){
                        $rm = $aux;
                    }

                    //guardo el nº de la mejor serie en base a la potencia impulsiva
                    if (intval($request->input('serie.'.$i.'.pot_imp')) > $pot_imp){
                        $pot_imp = $request->input('serie.'.$i.'.pot_imp');
                        $num_mejor_serie = $i;
                    }
                }


                //mejor serie, la que tiene la mejor potencia impulsiva
                    $serie = New Serie;
                    $serie->cantidad_series = $cantidad_series+1;//como cantidad de series inicia en 0 se aumenta 1 a cantidad de series y a mejor serie
                    $serie->peso_corporal = $request->input('peso_corporal');
                    $serie->peso_externo = $request->input('serie.'.$num_mejor_serie.'.pes_ext');
                    $serie->masa = $serie->peso_corporal + $serie->peso_externo;
                    $serie->potencia_impulsiva = $request->input('serie.'.$num_mejor_serie.'.pot_imp');
                    $serie->potencia_relativa = $serie->potencia_impulsiva / $serie->peso_corporal;
                    $serie->velocidad_impulsiva = $request->input('serie.'.$num_mejor_serie.'.vel_imp');
                    $serie->fuerza_impulsiva = $request->input('serie.'.$num_mejor_serie.'.fue_imp');
                    $serie->cantidad_repeticiones = $request->input('serie.'.$num_mejor_serie.'.can_rep');
                    $serie->mejor_serie =  $num_mejor_serie+1;//como cantidad de series inicia en 0 se aumenta 1 a cantidad de series y a mejor serie
                    $serie->mejor_serie_boolean = true;
                    $serie->ultima_serie = false;
                    if($serie->cantidad_repeticiones == 1){
                        $serie->rm = $serie->peso_externo;
                    }else{
                        $serie->rm = $rm;
                    }

                    $serie->pse = $request->input('serie.'.$num_mejor_serie.'.pse');
                    $serie->rm_pse_porcentual = (4.99 * $serie->pse ) + 43.093 ;
                    $serie->rm_porcentual = (($serie->peso_externo + $serie->peso_corpoal)*100) / $serie->rm;
                    $serie->save();

                    //almaceno el valor del peso optimo para calcular %rm de la ultima serie
                    $peso_optimo = $serie->peso_externo;

                    //realizar attach cliente_serie
                    $cliente = Cliente::findOrFail($request->input('cliente'));
                    $cliente->series()->attach($serie->id,array('cliente_id'=>$cliente->id,'ejercicio_id'=>($request->input('ejercicio'))));

                //ultima serie
                    $serie = New Serie;
                    $serie->cantidad_series = $cantidad_series+1;
                    $serie->peso_corporal = $request->input('peso_corporal');
                    $serie->peso_externo = $request->input('serie.'.$cantidad_series.'.pes_ext');
                    $serie->masa = $serie->peso_corporal + $serie->peso_externo;
                    $serie->potencia_impulsiva = $request->input('serie.'.$cantidad_series.'.pot_imp');
                    $serie->potencia_relativa = $serie->potencia_impulsiva / $serie->peso_corporal;
                    $serie->velocidad_impulsiva = $request->input('serie.'.$cantidad_series.'.vel_imp');
                    $serie->fuerza_impulsiva = $request->input('serie.'.$cantidad_series.'.fue_imp');
                    $serie->cantidad_repeticiones = $request->input('serie.'.$cantidad_series.'.can_rep');
                    $serie->mejor_serie =  $num_mejor_serie+1;
                    //$serie->mejor_serie_boolean = false;
                    $serie->ultima_serie = true;

                    if($serie->cantidad_repeticiones == 1){
                        $serie->rm = $serie->peso_externo;
                    }else{
                        //se calcula el rm de la ultima serie
                        $rm_ultima = 1 + (0.033 * intval($request->input('serie.'.$cantidad_series.'.can_rep')) * intval($request->input('serie.'.$cantidad_series.'.pes_ext')));
                        $serie->rm = $rm_ultima;
                    }

                    $serie->pse = $request->input('serie.'.$cantidad_series.'.pse');
                    $serie->rm_pse_porcentual = (4.99 * $serie->pse ) + 43.093 ;
                    $serie->rm_porcentual = (($peso_optimo + $serie->peso_corpoal)*100) / $serie->rm;
                    $serie->save();

                    //realizar attach cliente_serie
                    $cliente = Cliente::findOrFail($request->input('cliente'));
                    $cliente->series()->attach($serie->id,array('cliente_id'=>$cliente->id,'ejercicio_id'=>($request->input('ejercicio'))));

               // return 'rm mejor serie: '.$rm.' ultima serie: '.$rm_ultima.' cantidad de series: '.$cantidad_series;


            return response()->json([
                'success' => true,
                'message' => $num_mejor_serie
            ], 200);
        }
    }



    public function edit($id)
    {
        //muestra el formulario con los datos de la serie a modificar
        $serie =  Serie::findOrFail($id);

        return view('admin.series.editar-series',['titulo'=>'Modificar Serie','serie' => $serie]);
    }



    public function update(Request $request, $id)
    {
        $serie = Serie::findOrFail($id);

        //validamos los campos enviados
        $validator =  Validator::make($request->all(), [

            //QUe en la tabla ejercicios el nombre del ejercicio sea unico
            'cantidad_series' => 'required|numeric',
            'peso_corporal' => 'required|numeric',
            'peso_externo' => 'required|numeric',
            'potencia_impulsiva' => 'required|numeric',
            'velocidad_impulsiva' => 'required|numeric',
            'fuerza_impulsiva' => 'required|numeric',

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
        $serie->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'record updated'
        ], 200);

    }



    public function destroy($id)
    {
        //
    }


    //listar todas las series
    public function listar()
    {
        return view('admin.series.listar-series',['titulo'=>'Lista de Series']);
    }



    //devuelve los datos al datatable que les solicito
    public function anyData()
    {
        return Datatables::of(Serie::query())
            ->addColumn('masa',function($data){
                $peso_corporal = $data['peso_corporal'];
                $peso_externo = $data['peso_externo'];
                $masa = $peso_corporal + $peso_externo;
                return $masa;})
            ->addColumn('potencia_relativa',function($data){
                $potencia_impulsiva = $data['potencia_impulsiva'];
                $peso_corporal = $data['peso_corporal'];
                $potencia_relativa = $potencia_impulsiva / $peso_corporal;
                return $potencia_relativa;
            })
            ->addColumn('operaciones', '
                    <ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="{{ URL::route( \'series.editar\', array( $id )) }}"><i class="icon-pencil"></i> Editar</a></li>
								<li><a href="#" onclick="eliminar({{ $id  }})"><i class="icon-trash"></i> Eliminar</a></li>
							</ul>
						</li>
					</ul>')
            ->removeColumn('id')
            ->make(true);
    }


}