<?php

namespace App\Http\Controllers\backend;

use function foo\func;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Cliente;
use App\Pago;
use App\Indicador;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Integer;
use Yajra\Datatables\Datatables;
use Validator;
use DB;

class ClientePagoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        //
    }


    public function listarDeudasPersonales($id)
    {
        return view('admin.clientespagos.lista-deudas-personales',['id'=>$id]);
    }


    public function create()
    {
       // $clientes = Cliente::all();
        $pagos = Pago::all();

        //obtenemos todas las categorias para cargar el combobox

        return view('admin.clientespagos.crear-clientespagos',['titulo'=>'Pago Mensual', 'pagos'=>$pagos]);
    }



    public function store(Request $request)
    {
        ///validamos los campos enviados
        //en el formulario los llamo con el name
        $validator =  Validator::make($request->all(), [
            'cliente' => 'required|numeric',
            'pago' => 'required|numeric',
            'fecha_pago' => 'required|date_format:d/m/Y',
            'mes_pago' => 'required|date_format:Y-m-d',
        ]);


        $cliente_id = $request->input('cliente');
        $pago_id = $request->input('pago');
        $fecha_pago = $request->input('fecha_pago');
        $mes_pago = $request->input('mes_pago');



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
            //si no falla la validacion, se carga el cliente en la BD e informamos


            //Obtengo el cliente que va a pagar
            $clientePago = Cliente::findOrFail($cliente_id);

            //cambiamos el formato de la fecha
            $fecha_pago = $date = str_replace('/', '-', $request->input('fecha_pago'));
            $fecha_pago =date("Y-m-d", strtotime($fecha_pago));

            //cambiamos el formato de la fecha
            $mes_pago = $date = str_replace('/', '-', $request->input('mes_pago'));
            $mes_pago =date("Y-m-d", strtotime($mes_pago));

            $clientePago->pagos()->attach($pago_id, array('fecha_pago'=>$fecha_pago, 'mes_pago'=>$mes_pago));


            return response()->json([
                'success' => true,
                'message' => 'record updated'
            ], 200);
        }
    }


    public function listarClientesPagos()
    {
        $clientes = Cliente::all();

        return view('admin.clientespagos.lista-deudores',['titulo'=>'Lista de Deudores','clientes'=>$clientes]);
    }


    //devuelve con los deudores
    public function anyData(Request $request)
    {

        $clientes = Cliente::all();
        $clientes_deudores = array();

        foreach ( $clientes as $cliente) {
                $meses_pagados = DB::table('clientes_pagos')
                    ->select('mes_pago')
                    ->where('cliente_id',$cliente->id)
                    ->get();
                $lista_meses_pagados = array();
                foreach ($meses_pagados as $mes){
                    //guardar en una coleccion las fechas (solo mes y año) de los meses pagados
                    array_push($lista_meses_pagados,date('m-Y',strtotime($mes->mes_pago)));
                }

                $deudas_por_cliente =  DB::table('clientes_pagos')
                    ->select('clientes.id as id')
                    ->join('clientes','clientes_pagos.cliente_id','=','clientes.id')
                    ->join('indicadores','clientes.id','=','indicadores.cliente_id')
                    ->join('pagos','clientes_pagos.pago_id','=','pagos.id')
                    ->whereNull('indicadores.deleted_at')
                    ->where('clientes.id',$cliente->id)
                    ->whereNotIn(DB::raw('DATE_FORMAT(indicadores.mes,"%m-%Y")'),collect($lista_meses_pagados))
                    ->groupBy(DB::raw('YEAR(indicadores.fecha_indicador), MONTH(indicadores.fecha_indicador)'))
                    ->get();


            //si el cliente tiene deudas se lo coloca en la lista de deudores
            if (count($deudas_por_cliente)>0){
                $id_cliente = $deudas_por_cliente[0]->id;
                array_push($clientes_deudores, $id_cliente);
            }

        }


        $pagos = DB::table('clientes_pagos')
            ->join('clientes','clientes_pagos.cliente_id','=','clientes.id')
            ->select('clientes.apellido',
                'clientes.nombre',
                'clientes_pagos.mes_pago',
                'clientes_pagos.fecha_pago',
                'clientes.id as cliente_id')
            ->whereIn('clientes.id',collect($clientes_deudores))
            ->groupBy('clientes_pagos.cliente_id')
            ->orderBy('clientes_pagos.mes_pago', 'desc');



        return Datatables::of($pagos)


            ->editColumn('mes_pago',function($pago){
                //para mostrar formato nombre_mes /año
                $mes = date('F',strtotime($pago->fecha_pago));
                if ($mes=="January") $mes="Enero";
                if ($mes=="February") $mes="Febrero";
                if ($mes=="March") $mes="Marzo";
                if ($mes=="April") $mes="Abril";
                if ($mes=="May") $mes="Mayo";
                if ($mes=="June") $mes="Junio";
                if ($mes=="July") $mes="Julio";
                if ($mes=="August") $mes="Agosto";
                if ($mes=="September") $mes="Septiembre";
                if ($mes=="October") $mes="Octubre";
                if ($mes=="November") $mes="Noviembre";
                if ($mes=="December") $mes="Diciembre";
                $anio = date('Y',strtotime($pago->fecha_pago));
                return '<span class="label label-primary">'.$mes.' / '.$anio.'</span>'; })

            ->addColumn('deuda',function($pago){
                //se muestra el datatable de deudores
                $meses_pagados = DB::table('clientes_pagos')
                    ->select('mes_pago')
                    ->where('cliente_id',$pago->cliente_id)
                    ->get();
                $lista_meses_pagados = array();
                foreach ($meses_pagados as $mes){
                    //guardar en una coleccion las fechas (solo mes y año) de los meses pagados
                    array_push($lista_meses_pagados,date('m-Y',strtotime($mes->mes_pago)));
                }
                //consulta la cantidad de deudas para cada cliente
                $deudas =  DB::table('clientes_pagos')
                    ->select('clientes.id as id')
                    ->join('clientes','clientes_pagos.cliente_id','=','clientes.id')
                    ->join('indicadores','clientes.id','=','indicadores.cliente_id')
                    ->join('pagos','clientes_pagos.pago_id','=','pagos.id')
                    ->whereNull('indicadores.deleted_at')
                    ->where('clientes.id',$pago->cliente_id)
                    ->whereNotIn(DB::raw('DATE_FORMAT(indicadores.mes,"%m-%Y")'),collect($lista_meses_pagados))
                    ->groupBy(DB::raw('YEAR(indicadores.fecha_indicador), MONTH(indicadores.fecha_indicador)'))
                    ->get();
                if (count($deudas) > 1){
                    return '<span class="label label-danger">'.count($deudas).' meses</span>';
                }elseif(count($deudas) <= 1){
                    return '<span class="label label-warning">'.count($deudas).' mes</span>';
                    }
                 })

            ->addColumn('operaciones', '
                    <ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="{{ URL::route( \'clientepago.listaDeudasPersonales\', array( $cliente_id )) }}"><i class="icon-search4"></i> Ver</a></li>
							</ul>
						</li>
					</ul>')
            ->removeColumn('id')
            ->make(true);
    }



    public function datatableDeudasPersonales($id){
        $data['id'] = $id;
        $cliente = Cliente::find($id);
        $cliente_id = $cliente->id;
        $meses_pagados = DB::table('clientes_pagos')
                            ->select('mes_pago')
                            ->where('cliente_id',$cliente->id)
                            ->get();
        $lista_meses_pagados = array();
        foreach ($meses_pagados as $mes){
            //guardar en una coleccion las fechas (solo mes y año) de los meses pagados
            array_push($lista_meses_pagados,date('m-Y',strtotime($mes->mes_pago)));
        }

        $deudas = DB::table('clientes_pagos')
            ->select('clientes.apellido','clientes.nombre','indicadores.fecha_indicador as mes_sin_pagar','pagos.costo_mensual as deuda','clientes.id as id')
            ->join('clientes','clientes_pagos.cliente_id','=','clientes.id')
            ->join('indicadores','clientes.id','=','indicadores.cliente_id')
            ->join('pagos','clientes_pagos.pago_id','=','pagos.id')
            ->whereNull('indicadores.deleted_at')
            ->where('clientes.id',$cliente->id)
            ->whereNotIn(DB::raw('DATE_FORMAT(indicadores.mes,"%m-%Y")'),collect($lista_meses_pagados))
            ->groupBy(DB::raw('YEAR(indicadores.fecha_indicador), MONTH(indicadores.fecha_indicador)'))
            ->orderBy('indicadores.fecha_indicador','DESC');

        return Datatables::of($deudas)

            ->editColumn('mes_sin_pagar',function($pago){
                //para mostrar formato nombre_mes /año
                $mes = date('F',strtotime($pago->mes_sin_pagar));
                if ($mes=="January") $mes="Enero";
                if ($mes=="February") $mes="Febrero";
                if ($mes=="March") $mes="Marzo";
                if ($mes=="April") $mes="Abril";
                if ($mes=="May") $mes="Mayo";
                if ($mes=="June") $mes="Junio";
                if ($mes=="July") $mes="Julio";
                if ($mes=="August") $mes="Agosto";
                if ($mes=="September") $mes="Septiembre";
                if ($mes=="October") $mes="Octubre";
                if ($mes=="November") $mes="Noviembre";
                if ($mes=="December") $mes="Diciembre";
                $anio = date('Y',strtotime($pago->mes_sin_pagar));
                return '<span class="label label-danger">'.$mes.' / '.$anio.'</span>'; })
            ->editColumn('deuda',function($pago){
                return '<span class="label label-primary">$'.$pago->deuda.'</span>';
            })

            ->addColumn('operaciones', '
                    <ul class="icons-list">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-menu9"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="{{ URL::route( \'clientepago.clientePagarDeuda\', array( $id , $mes_sin_pagar)) }}"><i class="icon-money"></i> Pagar</a></li>
							</ul>
						</li>
					</ul>')
            ->removeColumn('id')
            ->make(true);

    }


    //funcion que carga el cliente y el mes que adeuda para pagar
    public function clientePagarDeuda($id = null,$fecha_deuda = null){
        //<option value="1">Pablo Rivera</option>
        $cliente = Cliente::find($id);
        $fecha_deuda = date('Y-n', strtotime($fecha_deuda));
        $pagos = Pago::all();
        return view('admin.clientespagos.crear-clientespagos',['titulo'=>'Pago Mensual','cliente'=>$cliente,'pagos'=>$pagos,'fecha_deuda'=>$fecha_deuda]);
    }




}
