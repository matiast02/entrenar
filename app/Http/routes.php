<?php


Route::auth();
use App\User;

Route::group(['middleware'=>'auth'],function (){

    Route::get('/', ['as'=>'home','uses'=>'HomeController@index']);

//    //rutas para control de usuarios
//    Route::get('/usuarios/listar-usuarios', ['as'=>'listar.usuarios','uses'=>'UserController@listar']);
//    Route::get('/usuarios/datatable',['as'=>'usuarios.datatable','uses'=>'UserController@anyData']);
//    Route::get('/usuarios/crear-usuarios', ['as'=>'crear.usuarios','uses'=>'UserController@create']);
//    Route::post('/usuarios/guardar-usuarios', ['as'=>'guardar.usuarios','uses'=>'UserController@store']);
//    Route::get('/usuarios/editar/{id}',['as'=>'editar.usuarios','uses'=>'UserController@edit']);
//    Route::patch('/usuarios/update/{id}',['as'=>'update.usuarios','uses'=>'UserController@update']);
//    Route::delete('/usuarios/eliminar/{id}',['as'=>'eliminar.usuarios','uses'=>'UserController@destroy']);
//    Route::post('/usuarios/buscar-usuario', ['as'=>'search.usuarios','uses'=>'UserController@search']);
//    Route::get('/usuarios/buscar', ['as'=>'buscar.usuarios','uses'=>'UserController@buscar']);


    //rutas para control de clientes
    Route::get('/clientes/listar-clientes', ['as'=>'listar.clientes','uses'=>'backend\ClienteController@listar']);
    Route::get('/clientes/datatable',['as'=>'clientes.datatable','uses'=>'backend\ClienteController@anyData']);
    Route::get('/clientes/crear-clientes', ['as'=>'crear.clientes','uses'=>'backend\ClienteController@create']);
    Route::post('/clientes/guardar-clientes', ['as'=>'guardar.clientes','uses'=>'backend\ClienteController@store']);
    Route::get('/clientes/editar/{id}',['as'=>'editar.clientes','uses'=>'backend\ClienteController@edit']);
    Route::patch('/clientes/update/{id}',['as'=>'update.clientes','uses'=>'backend\ClienteController@update']);
    Route::delete('/clientes/eliminar/{id}',['as'=>'eliminar.clientes','uses'=>'backend\ClienteController@destroy']);
    Route::post('/clientes/buscar-cliente', ['as'=>'search.clientes','uses'=>'backend\ClienteController@search']);
    Route::get('/clientes/buscar', ['as'=>'buscar.clientes','uses'=>'backend\ClienteController@buscar']);
    //clientes eliminados
    Route::get('/clientes/eliminados',['as'=>'eliminados.clientes','uses'=>'backend\ClienteController@verEliminados']);
    Route::get('/clientes/eliminados/datatable',['as'=>'clientes.eliminados.datatable','uses'=>'backend\ClienteController@listaEliminados']);
    Route::post('/clientes/eliminados/restaurar/{id}',['as'=>'restaurar.cliente','uses'=>'backend\ClienteController@restaurar']);
    //rutas para control de asistencia clientes
    Route::get('clientes/asistencias',['as'=>'ver.asistencias','uses'=>'backend\ClienteController@verAsistencias']);
    Route::get('clientes/asistencias/{id}',['as'=>'asistencias','uses'=>'backend\ClienteController@asistencias']);


    //rutas para control de pagos por clientes
    Route::get('/clientepago/crear-cliente-pago/{id?}/{deuda?}', ['as'=>'clientepago.crearClientePago','uses'=>'backend\ClientePagoController@create']);
    Route::get('/clientepago/cliente-pagar-deuda/{id?}/{fecha_deuda?}', ['as'=>'clientepago.clientePagarDeuda','uses'=>'backend\ClientePagoController@clientePagarDeuda']);
    Route::post('/clientepago/guardar-cliente-pago', ['as'=>'clientepago.guardarClientePago','uses'=>'backend\ClientePagoController@store']);
    Route::get('/clientepago/listar-clientes-pagos', ['as'=>'clientepago.listaClientePago','uses'=>'backend\ClientePagoController@listarClientesPagos']);
    Route::get('/clientepago/datatable',['as'=>'clientepago.datatable','uses'=>'backend\ClientePagoController@anyData']);
    Route::get('/clientepago/editar/{id}',['as'=>'clientepago.editar','uses'=>'backend\ClientePagoController@edit']);
    Route::patch('/clientepago/update/{id}',['as'=>'clientepago.update','uses'=>'backend\ClientePagoController@update']);
    Route::get('/clientepago/lista-deudas-personales/{id}',['as'=>'clientepago.listaDeudasPersonales','uses'=>'backend\ClientePagoController@listarDeudasPersonales']);
    Route::get('/clientepago/datatableDeudasPersonales/{id}',['as'=>'clientepago.datatableDeudasPersonales','uses'=>'backend\ClientePagoController@datatableDeudasPersonales']);


    //rutas para control de Categoria de ejercicios
    Route::get('/categoria_ejercicios/listar-categoria_ejercicios', ['as'=>'listar.categoria_ejercicios','uses'=>'backend\CategoriaEjercicioController@listar']);
    Route::get('/categoria_ejercicios/datatable',['as'=>'categoria_ejercicios.datatable','uses'=>'backend\CategoriaEjercicioController@anyData']);
    Route::get('/categoria_ejercicios/crear-categoria_ejercicios', ['as'=>'crear.categoria_ejercicios','uses'=>'backend\CategoriaEjercicioController@create']);
    Route::post('/categoria_ejercicios/guardar-categoria_ejercicios', ['as'=>'categoria_ejercicios.guardar','uses'=>'backend\CategoriaEjercicioController@store']);
    Route::get('/categoria_ejercicios/editar/{id}',['as'=>'categoria_ejercicios.editar','uses'=>'backend\CategoriaEjercicioController@edit']);
    Route::patch('/categoria_ejercicios/update/{id}',['as'=>'categoria_ejercicios.update','uses'=>'backend\CategoriaEjercicioController@update']);
    Route::delete('/categoria_ejercicios/eliminar/{id}',['as'=>'eliminar.categoria_ejercicios','uses'=>'backend\CategoriaEjercicioController@destroy']);



    //rutas para control de ejercicios
    Route::get('/ejercicios/listar-ejercicios', ['as'=>'listar.ejercicios','uses'=>'backend\EjercicioController@listar']);
    Route::get('/ejercicios/datatable',['as'=>'ejercicios.datatable','uses'=>'backend\EjercicioController@anyData']);
    Route::get('/ejercicios/crear-ejercicios', ['as'=>'crear.ejercicios','uses'=>'backend\EjercicioController@create']);
    Route::post('/ejercicios/guardar-ejercicios', ['as'=>'ejercicios.guardar','uses'=>'backend\EjercicioController@store']);
    Route::get('/ejercicios/editar/{id}',['as'=>'ejercicios.editar','uses'=>'backend\EjercicioController@edit']);
    Route::patch('/ejercicios/update/{id}',['as'=>'ejercicios.update','uses'=>'backend\EjercicioController@update']);
    Route::delete('/ejercicios/eliminar/{id}',['as'=>'eliminar.ejercicios','uses'=>'backend\EjercicioController@destroy']);


    //rutas para control de ejercicios
    Route::get('/antropometrias/listar-antropometrias', ['as'=>'listar.antropometrias','uses'=>'backend\AntropometriaController@listar']);
    Route::get('/antropometrias/datatable',['as'=>'antropometrias.datatable','uses'=>'backend\AntropometriaController@anyData']);
    Route::get('/antropometrias/crear-antropometrias', ['as'=>'crear.antropometrias','uses'=>'backend\AntropometriaController@create']);
    Route::post('/antropometrias/guardar-antropometrias', ['as'=>'antropometrias.guardar','uses'=>'backend\AntropometriaController@store']);
    Route::get('/antropometrias/editar/{id}',['as'=>'antropometrias.editar','uses'=>'backend\AntropometriaController@edit']);
    Route::patch('/antropometrias/update/{id}',['as'=>'antropometrias.update','uses'=>'backend\AntropometriaController@update']);
    Route::delete('/antropometrias/eliminar/{id}',['as'=>'eliminar.antropometrias','uses'=>'backend\AntropometriaController@destroy']);


    //rutas para control de seriers
    Route::get('/series/listar-series', ['as'=>'listar.series','uses'=>'backend\SerieController@listar']);
    Route::get('/series/datatable',['as'=>'series.datatable','uses'=>'backend\SerieController@anyData']);
    Route::get('/series/crear-series', ['as'=>'crear.series','uses'=>'backend\SerieController@create']);
    Route::post('/series/guardar-series', ['as'=>'series.guardar','uses'=>'backend\SerieController@store']);
    Route::get('/series/editar/{id}',['as'=>'series.editar','uses'=>'backend\SerieController@edit']);
    Route::patch('/series/update/{id}',['as'=>'series.update','uses'=>'backend\SerieController@update']);
    Route::delete('/series/eliminar/{id}',['as'=>'series.ejercicios','uses'=>'backend\SerieController@destroy']);


    //rutas para control de seriers
    Route::get('/evaluaciones/listar-evaluaciones', ['as'=>'listar.evaluaciones','uses'=>'backend\EvaluacionesController@listar']);
    Route::get('/evaluaciones/datatable',['as'=>'evaluaciones.datatable','uses'=>'backend\EvaluacionesController@anyData']);
    Route::get('/evaluaciones/crear-evaluaciones', ['as'=>'crear.evaluaciones','uses'=>'backend\EvaluacionesController@create']);
    Route::post('/evaluaciones/guardar-evaluaciones', ['as'=>'evaluaciones.guardar','uses'=>'backend\EvaluacionesController@store']);
    Route::get('/evaluaciones/editar/{id}',['as'=>'evaluaciones.editar','uses'=>'backend\EvaluacionesController@edit']);
    Route::patch('/evaluaciones/update/{id}',['as'=>'evaluaciones.update','uses'=>'backend\EvaluacionesController@update']);
    Route::delete('/evaluaciones/eliminar/{id}',['as'=>'evaluaciones.ejercicios','uses'=>'backend\EvaluacionesController@destroy']);
    Route::delete('/evaluaciones/eliminar/nf/{id}',['as'=>'evaluaciones.ejerciciosNoFuerza','uses'=>'backend\EvaluacionesController@destroyNoFuerza']);
    Route::get('/evaluaciones/mostrar-formulario/{id_ejercicio_nf}',['as'=>'mostrar-form-nf','uses'=>'backend\EvaluacionesController@mostrarForm']);
    Route::post('/evaluaciones/cargar-resultados',['as'=>'cargar-resultado-nf','uses'=>'backend\EvaluacionesController@cargarResultadosNF']);
    Route::get('/evaluaciones/resultados',['as'=>'vista.resultados','uses' => 'backend\EvaluacionesController@vistaResultados']);
    Route::post('/evaluaciones/listar-resultados',['as'=>'listar.resultados','uses' => 'backend\EvaluacionesController@listarResultados']);


    //rutas para control de deportes
    Route::get('/deportes/listar-deportes', ['as'=>'listar.deportes','uses'=>'backend\DeporteController@listar']);
    Route::get('/deportes/datatable',['as'=>'deportes.datatable','uses'=>'backend\DeporteController@anyData']);
    Route::get('/deportes/crear-deportes', ['as'=>'crear.deportes','uses'=>'backend\DeporteController@create']);
    Route::post('/deportes/guardar-deportes', ['as'=>'deportes.guardar','uses'=>'backend\DeporteController@store']);
    Route::get('/deportes/editar/{id}',['as'=>'deportes.editar','uses'=>'backend\DeporteController@edit']);
    Route::patch('/deportes/update/{id}',['as'=>'deportes.update','uses'=>'backend\DeporteController@update']);
    Route::delete('/deportes/eliminar/{id}',['as'=>'eliminar.deportes','uses'=>'backend\DeporteController@destroy']);


    //rutas para control de categorias
    Route::get('/categorias/listar-categorias', ['as'=>'listar.categorias','uses'=>'backend\CategoriaController@listar']);
    Route::get('/categorias/datatable',['as'=>'categorias.datatable','uses'=>'backend\CategoriaController@anyData']);
    Route::get('/categorias/crear-categorias', ['as'=>'crear.categorias','uses'=>'backend\CategoriaController@create']);
    Route::post('/categorias/guardar-categorias', ['as'=>'categorias.guardar','uses'=>'backend\CategoriaController@store']);
    Route::get('/categorias/editar/{id}',['as'=>'categorias.editar','uses'=>'backend\CategoriaController@edit']);
    Route::patch('/categorias/update/{id}',['as'=>'categorias.update','uses'=>'backend\CategoriaController@update']);
    Route::delete('/categorias/eliminar/{id}',['as'=>'eliminar.categorias','uses'=>'backend\CategoriaController@destroy']);

    //rutas para control de pagos
    Route::get('/pagos/listar-pagos', ['as'=>'listar.pagos','uses'=>'backend\PagoController@listar']);
    Route::get('/pagos/datatable',['as'=>'pagos.datatable','uses'=>'backend\PagoController@anyData']);
    Route::get('/pagos/crear-pagos', ['as'=>'crear.pagos','uses'=>'backend\PagoController@create']);
    Route::post('/pagos/guardar-pagos', ['as'=>'pagos.guardar','uses'=>'backend\PagoController@store']);
    Route::get('/pagos/editar/{id}',['as'=>'pagos.editar','uses'=>'backend\PagoController@edit']);
    Route::patch('/pagos/update/{id}',['as'=>'pagos.update','uses'=>'backend\PagoController@update']);
    Route::delete('/pagos/eliminar/{id}',['as'=>'eliminar.pagos','uses'=>'backend\PagoController@destroy']);


    //rutas para control de indicadores
    Route::get('/indicadores/listar-indicadores', ['as'=>'listar.indicadores','uses'=>'backend\IndicadorController@listarIndicadores']);
    Route::get('/indicadores/listar-mes-indicadores', ['as'=>'listar-mes.indicadores','uses'=>'backend\IndicadorController@listarIndicadoresMensuales']);
    Route::get('/indicadores/datatable',['as'=>'indicadores.datatable','uses'=>'backend\IndicadorController@anyData']);
    Route::get('/indicadores-mes/datatable',['as'=>'indicadores-mes.datatable','uses'=>'backend\IndicadorController@anyDataMes']);

    Route::get('/indicadores/resultados-semanales',['as'=>'indicadores.resultados-semanales','uses'=>'backend\IndicadorController@resultadosSemanales']);
    Route::get('/indicadores/resultados-mensuales',['as'=>'indicadores.resultados-mensuales','uses'=>'backend\IndicadorController@resultadosMensuales']);

    Route::get('/indicadores/crear-indicadores', ['as'=>'crear.indicadores','uses'=>'backend\IndicadorController@create']);
    Route::post('/indicadores/guardar-indicadores', ['as'=>'indicadores.guardar','uses'=>'backend\IndicadorController@store']);
    Route::get('/indicadores/editar/{id}',['as'=>'indicadores.editar','uses'=>'backend\IndicadorController@edit']);
    Route::patch('/indicadores/update/{id}',['as'=>'indicadores.update','uses'=>'backend\IndicadorController@update']);
    Route::delete('/indicadores/eliminar/{id}',['as'=>'eliminar.indicadores','uses'=>'backend\IndicadorController@destroy']);
    Route::post('/indicadores/buscar-cliente', ['as'=>'indicadores.search','uses'=>'IndicadorProductoController@search']);
    Route::get('/indicadores/buscar', ['as'=>'indicadores.buscar','uses'=>'IndicadorController@buscar']);


    //rutas para el control de reportes
    Route::get('/reportes/reporte-por-deportista', ['as'=>'deportista.reportes','uses'=>'backend\ReporteController@index']);
    Route::post('/reportes/reporte-por-deportista', ['as'=>'reporte-por-deportista.reportes','uses'=>'backend\ReporteController@reportePorEjercicio']);

    Route::get('/reportes/crear_pdf_deportista/{tipo}/{cliente}', ['as'=>'reporte.crear_pdf_deportista','uses'=>'backend\ReporteController@crear_pdf_deportista']);
    Route::get('/reportes/reporte-evaluaciones',['as'=>'reporte-evaluaciones','uses'=>'backend\ReporteController@vistaReporteEvaluaciones']);
    Route::post('/reportes/generar-reporte-evaluaciones',['as'=>'generar-reporte-evaluaciones','uses'=>'backend\ReporteController@generarReporteEvaluaciones']);


    //rutas para pdf
    Route::get('/pdfs/reportes', ['as'=>'pdfs.reportes','uses'=>'backend\PdfController@index']);
    Route::get('/pdfs/crear_reporte_porpais/{tipo}', ['as'=>'pdfs.crear_reporte_porpais','uses'=>'backend\PdfController@crear_reporte_porpais']);
    Route::post('/pdfs/crear_pdf_deportista', ['as'=>'pdfs.crear_pdf_deportista','uses'=>'backend\ReporteController@crear_pdf_deportista']);



    Route::get('/pdfs/crear_reporte/{tipo}', ['as'=>'pdfs.crear_reporte','uses'=>'backend\PdfController@crear_reporte']);


});

//Route::get('/home', 'HomeController@index');




Route::group(['middleware' => 'web'], function () {
    Route::get('/prueba', function(){
//        $date = str_replace('/', '-', '25/03/2016');
//        return date("Y-m-d", strtotime($date));
        $user = User::find(3);
        return $user->series()->get();
    });


});