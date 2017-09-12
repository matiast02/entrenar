@extends('layouts.home')


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
            <h5 class="panel-title">Deudores<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            <table class="table datatable-responsive-row-control dataTable no-footer dtr-column" id="clientepago-table" role="grid">
                <thead>
                <tr>
                    <th>Apellido</th>
                    <th>Nombre</th>
                    <th>Ultimo Mes Pagado</th>
                    <th>Deuda</th>
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
            $('#clientepago-table').DataTable({
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
                "aoColumnDefs": [{ 'bSortable': false,"bSearchable": false, 'aTargets': [ 0,1,2,3,4 ] }],
                ajax: '{!! route('clientepago.datatable') !!}',
                columns: [
                    {data: 'apellido', name: 'apellido'},
                    {data: 'nombre', name: 'nombre'},
                    {data: 'mes_pago', name: 'mes_pago'},
                    {data: 'deuda', name: 'deuda'},
                    {data: 'operaciones', name: 'operaciones'}
                ]
            });
        }

        function eliminar(id){
            swal({
                title: "Esta seguro que desea eliminar?",
                text: "Esta a punto de borrar un cliente!",
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
                                "El cliente fue eliminado correctamente.",
                                "success"
                        );
                        $('#clientepago-table').DataTable().ajax.reload();
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