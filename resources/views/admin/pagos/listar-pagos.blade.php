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
    <div class="panel panel-flat col-lg-10">
        <div class="panel-heading">
            <h5 class="panel-title">Lista de Grupos y Pagos<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            <table class="table datatable-responsive-row-control dataTable no-footer dtr-column" id="pagos-table" role="grid">
                <thead>
                <tr>
                    <th>Días Semanales</th>
                    <th>Grupos</th>
                    <th>Costo Mensual</th>
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
            $('#pagos-table').DataTable({
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
                "aoColumnDefs": [{ 'bSortable': false,"bSearchable": false, 'aTargets': [ 3 ] }],
                ajax: '{!! route('pagos.datatable') !!}',
                columns: [
                    {data: 'dias_semana', name: 'dias_semana'},
                    {data: 'grupo', name: 'grupo'},
                    {data: 'costo_mensual', name: 'costo_mensual'},
                    {data: 'operaciones', name: 'operaciones'}
                ]
            });
        }


        function eliminar(id){
            swal({
                title: "Esta seguro que desea eliminar?",
                text: "Esta a punto de borrar un grupo con su pago mensual!",
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
                                "El grupo y pago mensual fue eliminado correctamente.",
                                "success"
                        );
                        $('#pagos-table').DataTable().ajax.reload();
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