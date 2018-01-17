{{--extends -> Hereda, es como el include--}}
@extends('layouts.home')


{{--@section -> Inserta--}}
@section('scripts_header')
    <script type="text/javascript" src="{{ URL::asset('js/plugins/tables/datatables/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/plugins/tables/datatables/extensions/responsive.min.js')}}"></script>
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
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Lista de Series<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            <table id="series-table" class="table datatable-responsive-row-control dataTable no-footer dtr-column"  role="grid">
                <thead>
                <tr>
                    <th>Cant. Series</th>
                    <th>Peso Corporal</th>
                    <th>Peso Externo</th>
                    <th>Potencia Imp.</th>
                    <th>Velocidad Imp.</th>
                    <th>Fuerza Imp.</th>
                    <th>Masa</th>
                    <th>Potencia Imp.</th>
                    <th>Potencia Rel.</th>
                    <th>Operaciones</th>
                </tr>
                </thead>
            </table>
        </div>

    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        window.onload = function datos() {

            // Basic initialization
            $('#series-table').DataTable({
                autoWidth: false,
                responsive: true,
                dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
                language: {
                    search: '<span>Filtrar:</span> _INPUT_',
                    lengthMenu: '<span>Mostrar:</span> _MENU_',
                    paginate: { 'primera': 'Primera', 'ultima': 'Ultima', 'siguiente': '→', 'previa': '←' }
                },
                drawCallback: function () {
                    $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
                },
                preDrawCallback: function() {
                    $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
                },
                processing: true,
                serverSide: true,//evita que la columna con botones sea un parametro en la consulta sql
                "aoColumnDefs": [{ 'bSortable': false,"bSearchable": false, 'aTargets': [ 6 ] }],
                ajax: '{!! route('series.datatable') !!}',
                columns: [
                    {data: 'cantidad_series', name: 'cantidad_series'},
                    {data: 'peso_corporal', name: 'peso_corporal'},
                    {data: 'peso_externo', name: 'peso_externo'},
                    {data: 'potencia_impulsiva', name: 'potencia_impulsiva'},
                    {data: 'velocidad_impulsiva', name: 'velocidad_impulsiva'},
                    {data: 'fuerza_impulsiva', name: 'fuerza_impulsiva'},
                    {data: 'masa', name: 'masa'},
                    {data: 'potencia_relativa', name: 'potencia_relativa'},
                    //{data: 'created_at', name: 'created_at'},
                    //{data: 'updated_at', name: 'updated_at'},
                    //{data: 'deleted_at', name: 'deleted_at'},
                    {data: 'operaciones', name: 'operaciones'}
                ]
            });
        }


        function eliminar(id){
            swal({
                title: "Esta seguro que desea eliminar?",
                text: "Esta a punto de borrar una serie!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Si, eliminar!",
                closeOnConfirm: false,
                html: false
            }, function() {
                $.ajax({
                    type: 'delete',
                    url: 'eliminar/'+id,
                    data : {"_token": "{{ csrf_token() }}"},
                    dataType: 'json',
                    success: function(data){
                        swal(
                                "Eliminado!",
                                "La serie fue eliminada correctamente.",
                                "success"
                        );
                        $('#series-table').DataTable().ajax.reload();
                    },
                    error: function(data) {

                        var errors = data.responseJSON;
                        swal("Oops...", "Algo salío mal!", "error");
                    }

                });

            });
        }
    </script>
@endsection