{{-- Titulo de la pagina --}}
@section('title', 'Control de protocolos')


{{-- Contenido principal --}}
@extends('admin.layouts.app')

@section('content') @component('admin.components.panel') @slot('title', 'Control Protocolos')
    @if(session()->get('sede'))

    <br>
    <br>
    
    <div class="col-md-12">
        @component('admin.components.datatable', ['id' => 'protocolos-table-ajax']) @slot('columns', [
        'id','Nombre' ,'Protocolo', 'Descripcion', 
        'Acciones' => ['style' => 'width:55px;']]) @endcomponent

    </div>
    @else
    Por favor seleccione una sede

    @endif
    @endcomponent
@endsection

{{-- Scripts necesarios para el formulario --}}
@push('scripts')
    <!-- Datatables -->
    <script src="{{asset('gentella/vendors/DataTables/datatables.min.js') }}"></script>
    <script src="{{asset('gentella/vendors/sweetalert/sweetalert2.all.min.js') }}"></script>
    <!-- PNotify -->
    <script src="{{ asset('gentella/vendors/pnotify/dist/pnotify.js') }}"></script>
    <script src="{{ asset('gentella/vendors/pnotify/dist/pnotify.buttons.js') }}"></script>
    <script src="{{ asset('gentella/vendors/pnotify/dist/pnotify.nonblock.js') }}"></script>

@endpush


{{-- Estilos necesarios para el formulario --}}
@push('styles')
    <!-- Datatables -->
    <link href="{{ asset('gentella/vendors/DataTables/datatables.min.css') }}" rel="stylesheet">
    <!-- PNotify -->
    <link href="{{ asset('gentella/vendors/pnotify/dist/pnotify.css') }}" rel="stylesheet">
    <link href="{{ asset('gentella/vendors/pnotify/dist/pnotify.buttons.css') }}" rel="stylesheet">
    <link href="{{ asset('gentella/vendors/pnotify/dist/pnotify.nonblock.css') }}" rel="stylesheet">

@endpush


{{-- Funciones necesarias por el formulario --}}
@push('functions')
    <script type="text/javascript">
        $(document).ready(function () {
            

            table = $('#protocolos-table-ajax').DataTable({
                processing: true,
                serverSide: false,
                stateSave: true,
                keys: true,
                dom: 'lBfrtip',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                "ajax": {
                    url : "{{ route('admin.protocolos.data') }}",
                    complete: function() { $('[data-toggle="tooltip"]').tooltip(); }
                },
                "columns": [
                    {data: 'id', name: 'id', "visible": false},
                    {data: 'nombre', name: 'Nombre', className: "all"},
                    {data: 'protocolo', name: 'Protocolo', className: "all"},
                    {data: 'descripcion', name: 'Descripcion', className: "min-phone-l"},
                    {
                        defaultContent:
                            '<a data-toggle="tooltip" title="Enviar protocolo" href="javascript:;" class="btn btn-simple btn-info btn-sm enviar"><i class="fas fa-bolt"></i></a>',
                        data: 'action',
                        name: 'action',
                        title: 'Acciones',
                        orderable: false,
                        searchable: false,
                        exportable: false,
                        printable: false,
                        className: 'text-right',
                        render: null,
                        responsivePriority: 2
                    }
                    
                ],
                language: {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
            });

            table.on('click', '.enviar', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var dataTable = table.row($tr).data();

                $.ajax({
                        url: "{{ route('admin.enviar_protocolo.post') }}",
                        type: 'POST',
                        data: {
                            '_token': $('meta[name="_token"]').attr('content'),
                            id_protocolo:dataTable.id
                        },
                        dataType: 'json',
                        success: function (response, NULL, jqXHR) {
                            new PNotify({
                                title: response.title,
                                text: response.msg,
                                type: 'success',
                                styling: 'bootstrap3'
                            });
                        },
                        error: function (data) {

                            var errores = data.responseJSON.errors;
                            var msg = '';
                            $.each(errores, function (name, val) {
                                msg += val + '<br>';
                            });
                            new PNotify({
                                title: "Error!",
                                text: msg,
                                type: 'error',
                                styling: 'bootstrap3'
                            });
                        }
                    });
               


            });

        });

    </script>

@endpush