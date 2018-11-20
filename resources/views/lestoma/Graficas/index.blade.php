{{-- Titulo de la pagina --}} 
@section('title', 'Graficas') {{-- Contenido principal --}} 
@extends('admin.layouts.app') 
@section('content')
    @component('admin.components.panel') 
        @slot('title', 'Graficas.')

        @if(session()->get('id_sede'))

        <div class="row">
        <form action="{{ route('admin.graficas.data') }}" method="post" id="form_selecionar_fecha">
            @csrf
                <div class=" col-md-6 col-sm-6 col-xs-12">
                    {!! Form::label('fecha_inicio', 'Fecha Inicio', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!} 
                    {!! Form::text('fecha_inicio', old('fecha_inicio', isset($fechaInicio)?(string)$fechaInicio->format('d/m/Y'):''),
                    [ 'class' => 'form-control col-md-6 col-sm-6 col-xs-12', 'required' => 'required', 'id' => 'fecha_inicio' ] ) !!}
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::label('fecha_fin', 'Fecha Fin', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!} 
                   {!! Form::text('fecha_fin', old('fecha_fin', isset($fechaInicio)?(string)$fechaInicio->format('d/m/Y'):''),
                    [ 'class' => 'form-control col-md-6 col-sm-6 col-xs-12', 'required' => 'required', 'id' => 'fecha_fin' ] ) !!}
                </div>
                <div class=" col-md-6 col-sm-6 col-xs-12">
                    {!! Form::label('tipo', 'Tipo', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!} 
                    {!! Form::select('tipo', isset($tipos)?$tipos:[],
                    old('area'), ['class' => 'select2 form-control', 'placeholder' => 'Seleccione un tipo de variable', 'required' => '', 'id' => 'tipo'])
                    !!}
                </div>
            </form>
        </div>
        <br>
        <br>


        <div id="graficas" class="hidden">
        
            <div class="row">
                    <canvas id="datos" height="200"></canvas>
            </div>
        </div>
    @else
        Por favor seleccione una sede
    @endif
    @endcomponent
@endsection


{{-- Scripts necesarios para el formulario --}}
@push('scripts')
    <!-- Char js -->
    <script src="{{ asset('gentella/vendors/Chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/charts.js') }}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{asset('gentella/vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('gentella/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <!-- PNotify -->
    <script src="{{ asset('gentella/vendors/pnotify/dist/pnotify.js') }}"></script>
    <script src="{{ asset('gentella/vendors/pnotify/dist/pnotify.buttons.js') }}"></script>
    <script src="{{ asset('gentella/vendors/pnotify/dist/pnotify.nonblock.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('gentella/vendors/select2/dist/js/select2.full.min.js') }}"></script>
@endpush

{{-- Estilos necesarios para el formulario --}}
@push('styles')
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('gentella/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('gentella/vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet">
    <!-- PNotify -->
    <link href="{{ asset('gentella/vendors/pnotify/dist/pnotify.css') }}" rel="stylesheet">
    <link href="{{ asset('gentella/vendors/pnotify/dist/pnotify.buttons.css') }}" rel="stylesheet">
    <link href="{{ asset('gentella/vendors/pnotify/dist/pnotify.nonblock.css') }}" rel="stylesheet">
    <link href="{{ asset('gentella/vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet">
@endpush

{{-- Funciones necesarias por el formulario --}} @push('functions')
<script type="text/javascript">
    $(document).ready(function () {
        fecha('#fecha_inicio'); 
        fecha('#fecha_fin');
        $('#tipo').select2();
        var form = $('#form_selecionar_fecha');
        $("#fecha_inicio, #fecha_fin, #tipo").change(function () {
            let fechaInicio = new Date($('#fecha_inicio').val());
            let fechaFin = new Date($('#fecha_fin').val());
            let tipo = $('#tipo').val();
            
            console.log(fechaInicio);
            console.log(fechaFin);
            console.log(tipo);

            if(fechaInicio > fechaFin){
                new PNotify({
                        title: "Error!",
                        text: "La fecha de inicio tiene que ser menor que la fecha fin",
                        type: 'error',
                        styling: 'bootstrap3'
                });
            }
            else if($('#tipo').val() != ''){
                $.ajax({
                        url: form.attr('action'),
                        type: form.attr('method'),
                        data: form.serialize(),
                        dataType: 'json',
                        success: function (r) {
                            $('#graficas').removeClass('hidden');
                            if(chartData != null){
                                chartData.destroy();
                            }
                            var chartData = crearGrafica(
                                'datos',
                                'line', 
                                r.tipo,
                                r.fechas,
                                [r.tipo],
                                r.data 
                            );
                            
                        }
                            
                });
            }

        });

    });

    function crearGrafica(canvas = null, tipo, titulo = null,  etiquetas, etiquetasData, data = null) {
        var dynamicColorsArray = function (cantidad) {
            let colors =[];
            for (let i = 0; i < cantidad; i++) {
                var r = Math.floor(Math.random() * 255);
                var g = Math.floor(Math.random() * 255);
                var b = Math.floor(Math.random() * 255);
                colors.push("rgb(" + r + "," + g + "," + b + ")");
            }
            return colors

        };

        var dynamicColors = function () {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            return "rgb(" + r + "," + g + "," + b + ")";
        };

        var dataset = [];

        for (let i = 0; i < etiquetasData.length; i++){
            let aux = {};
            aux['label'] = etiquetasData[i];
            aux['data'] = data[i];
            if(tipo != 'line'){
                aux['backgroundColor'] = dynamicColorsArray(data[i].length);
            }
            else{    
                aux['borderColor'] = dynamicColors();
                aux['fill'] = false;
            }
            dataset.push(aux);
        }
        
    
        var jsonChart = {
            type: tipo,
            data: {
                labels: etiquetas,
                datasets: dataset,
            },
            options:{
                title:{
                    display:true,
                    text: titulo
                },
                animation: {
                    onComplete: function (animation) {
                        if(url_base64.length < limite)
                            url_base64.push(this.toBase64Image());
                    }
                },

                "scales": { 
                }

            },
        };
        if (tipo == 'bar' || tipo == 'horizontalBar'){
            jsonChart.options.scales = {
                "yAxes": [{
                    "ticks": {
                        "beginAtZero": true
                    }
                }],
                "xAxes": [{
                    "ticks": {
                        "beginAtZero": true
                    }
                }]
            };
        }

        var ctx = document.getElementById(canvas).getContext('2d');
        var myChart = new Chart(ctx, jsonChart);
        
        return myChart;
    }
</script>

@endpush