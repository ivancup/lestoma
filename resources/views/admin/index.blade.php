{{-- Titulo de la pagina --}}
@section('title', 'Home')
{{-- Contenido principal --}}
@extends('admin.layouts.app')

@section('content')
    @component('admin.components.panel')
        @slot('title', 'Bienvenido a Lestoma.')
        <h3>SERFAC (Semillero de robótica de Facatativá)</h3>
        <h4>Director: Ingeniero Jaime Andrade</h4>
        <h4>Semilleristas:</h4>
        <h4>Alejandro Vargas</h4>
        <h4>Lizeth Quintero</h4>
        <h4>Alejandro Méndez</h4>
        <h4>Andrés Gaitán</h4>
        <h4>Iván Urquijo</h4>
        
    @endcomponent
@endsection

@can('SUPERADMINISTRADOR')

    {{-- Scripts necesarios para el formulario --}} 
    @push('scripts')
    
    @endpush 

    {{-- Estilos necesarios para el formulario --}} 

    @push('styles')
    
    @endpush 
    
    {{-- Funciones necesarias por el formulario --}} 
    @push('functions')
    
    @endpush
@endcan