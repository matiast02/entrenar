@extends('layouts.home')

@section('scripts_header')
  <!-- Load Moment.js extension -->
  <script type="text/javascript" src="{{URL::asset('js/plugins/ui/moment/moment.min.js')}}"></script>
  <!-- Load plugin -->
  <script type="text/javascript" src="{{URL::asset('js/plugins/pickers/daterangepicker.js')}}"></script>

  <script type="text/javascript" src="{{URL::asset('js/plugins/notifications/sweet_alert.min.js')}}"></script>
@endsection

@section('usuario-nombre')
  {{ucfirst(session('nombre'))}}
@endsection

@section('titulo')
  {{$titulo}}
@endsection

@section('ruta')

@endsection

@section('contenido')

  <div class="row">
            <div class="col-xs-12">
              <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title">REPORTES DEL SISTEMA</h3>
                  <div class="box-tools">
                    <div class="input-group" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search">
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                  </div>
                </div><!-- /.box-header -->

                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>reporte</th>
                        <th>ver</th>
                        <th>descargar</th>
                      </tr>
                    </thead>

                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>Reporte de Clientes</td>
                        <td><a href="crear_reporte_porpais/1" target="_blank" ><button class="btn btn-block btn-primary btn-xs">Ver</button></a></td>
                        <td><a href="crear_reporte_porpais/2" target="_blank" ><button class="btn btn-block btn-success btn-xs">Descargar</button></a></td>
                        <td><a href="crear_reporte/1" target="_blank" ><button class="btn btn-block btn-success btn-xs">PDF Prueba</button></a></td>
                        {{--<td><a href="prueba_pdf/1" target="_blank" ><button class="btn btn-block btn-success btn-xs">FPDF</button></a></td>--}}
                      </tr>
                    </tbody>
                  </table>

                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
  </div>

@endsection