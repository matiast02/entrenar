<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Cliente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Yajra\Datatables\Datatables;
use Validator;
use DB;
use App\Indicador;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Barryvdh\DomPDF\PDF;
use Anouar\Fpdf\Fpdf;
use Response;

class PdfController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }




    public function index()
    {
        return view("admin.pdfs.listado_reportes",['titulo'=>'Reporte de Clientes']);
    }



    public function crear_reporte($tipo) {

        $clientes=Cliente::all();

        $vistaurl="admin.pdfs.pdf2";

        return $this->crearPDF($clientes, $vistaurl, $tipo);

    }



    public function crear_reporte_porpais($tipo) {

        $clientes=Cliente::all();

        $vistaurl="admin.pdfs.reporte_por_pais";

        return $this->crearPDF($clientes, $vistaurl, $tipo);

    }



    public function crearPDF($clientes,$vistaurl,$tipo) {

        $data = $clientes;
        $date = date('d-m-Y');
        $view =  \View::make($vistaurl, compact('data', 'date'))->render();

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML(utf8_decode($view))->setPaper('A4', 'portrait')->setWarnings(false);

        if($tipo==1){return $pdf->stream('reportes');}
        if($tipo==2){return $pdf->download('reporte.pdf'); }
    }



    public function crear_pdf_deportista($tipo) {

        $clientes=Cliente::all();
        $vistaurl="admin.pdfs.reporte_por_pais";

        return $this->crearPDF($clientes, $vistaurl, $tipo);

    }





}
