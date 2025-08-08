@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<div class="text-center mb-5">
    <h1 class="fw-bold">Conceptos de Buenas Prácticas</h1>
    <p class="text-white-50">Aprende SOLID, cohesión, acoplamiento e inyección de dependencias con ejemplos en Laravel</p>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="glass-card h-100 d-flex flex-column">
            <h4>Principios SOLID</h4>
            <p class="flex-grow-1">Los cinco principios clave para un código limpio y mantenible.</p>
            <a href="{{ route('solid') }}" class="btn btn-light mt-auto">Ver más</a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="glass-card h-100 d-flex flex-column">
            <h4>Cohesión y Acoplamiento</h4>
            <p class="flex-grow-1">Mejora la organización interna y reduce dependencias.</p>
            <a href="{{ route('cohesion') }}" class="btn btn-light mt-auto">Ver más</a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="glass-card h-100 d-flex flex-column">
            <h4>Inyección de Dependencias</h4>
            <p class="flex-grow-1">Diseña código flexible, escalable y fácil de testear.</p>
            <a href="{{ route('inyeccion') }}" class="btn btn-light mt-auto">Ver más</a>
        </div>
    </div>
</div>

<div class="text-center mt-5">
    <a href="{{ route('bibliografia') }}" class="btn btn-outline-light btn-lg">Ver Bibliografía</a>
</div>
@endsection
