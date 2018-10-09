{{-- Titulo de la pagina --}}
@section('title', 'Datos Historicos')


{{-- Contenido principal --}}
@extends('admin.layouts.app')

@section('content') @component('admin.components.panel') @slot('title', 'Datos históricos')

    <br>
    <br>
    <div class="col-md-12">
        @component('admin.components.datatable', ['id' => 'datos_historicos-table-ajax']) @slot('columns', [
        'id','Fecha' ,'Temperatura ambiente', 'Temperatura agua', 'PH', 'Humedad']) @endcomponent

    </div>
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

            table = $('#datos_historicos-table-ajax').DataTable({
                processing: true,
                serverSide: false,
                stateSave: true,
                keys: true,
                dom: 'lBfrtip',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                "ajax": "{{ route('admin.datos_historicos.data') }}",
                "columns": [
                    {data: 'id', name: 'id', "visible": false},
                    {data: 'created_at', name: 'Fecha', className: "all"},
                    {data: 'temperatura_ambiente', name: 'Temperatura ambiente', className: "all"},
                    {data: 'temperatura_agua', name: 'Temperatura agua', className: "min-phone-l"},
                    {data: 'ph', name: 'Ph', className: "min-phone-l"},
                    {data: 'humedad', name: 'Humedad', className: "min-phone-l"}
                    
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

        });

    </script>

@endpush