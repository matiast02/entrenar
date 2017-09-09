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


//    public function prueba_internet(){
//        if ( isset($pdf) ) {
//
//            $font = Font_Metrics::get_font("verdana");
//            // If verdana isn't available, we'll use sans-serif.
//            if (!isset($font)) { Font_Metrics::get_font("sans-serif"); }
//            $size = 6;
//            $color = array(0,0,0);
//            $text_height = Font_Metrics::get_font_height($font, $size);
//
//            $foot = $pdf->open_object();
//
//            $w = $pdf->get_width();
//            $h = $pdf->get_height();
//
//            // Draw a line along the bottom
//            $y = $h - 2 * $text_height - 24;
//            $pdf->line(16, $y, $w - 16, $y, $color, 1);
//
//            $y += $text_height;
//
//            $text = "Job: 132-003";
//            $pdf->text(16, $y, $text, $font, $size, $color);
//
//            $pdf->close_object();
//            $pdf->add_object($foot, "all");
//
//            global $initials;
//            $initials = $pdf->open_object();
//
//            // Add an initals box
//            $text = "Initials:";
//            $width = Font_Metrics::get_text_width($text, $font, $size);
//            $pdf->text($w - 16 - $width - 38, $y, $text, $font, $size, $color);
//            $pdf->rectangle($w - 16 - 36, $y - 2, 36, $text_height + 4, array(0.5,0.5,0.5), 0.5);
//
//
//            $pdf->close_object();
//            $pdf->add_object($initials);
//
//            // Mark the document as a duplicate
//            $pdf->text(110, $h - 240, "DUPLICATE", Font_Metrics::get_font("verdana", "bold"),
//                110, array(0.85, 0.85, 0.85), 0, 0, -52);
//
//            $text = "Page {PAGE_NUM} of {PAGE_COUNT}";
//
//            // Center the text
//            $width = Font_Metrics::get_text_width("Page 1 of 2", $font, $size);
//            $pdf->page_text($w / 2 - $width / 2, $y, $text, $font, $size, $color);
//
//        }
//    }


    public function index()
    {
        return view("admin.pdfs.listado_reportes",['titulo'=>'Reporte de Clientes']);
    }


//    public function prueba_fpdf($tipo)
//    {
//        $fpdf = new Fpdf();
//        $fpdf->AddPage();
//        $fpdf->SetFont('Arial','B',16);
//        $fpdf->Cell(40,10,'Hello World!');
//
//
//        $headers = ['Content-Type' => 'application/pdf'];
//
//        if($tipo==1){return Response::make($fpdf->Output(), 200, $headers);}
//    }

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
