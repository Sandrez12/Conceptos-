@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<section class="hero">
    <div class="wrap">
        <p class="eyebrow">Buenas prácticas de programación</p>
        <h1>Escribe código que <span>cambie sin romperse</span></h1>
        <p class="lead">SOLID, cohesión, acoplamiento e inyección de dependencias explicados con ejemplos “antes y después” en PHP y Laravel.</p>
        <div class="actions">
            <a class="btn primary" href="{{ route('solid') }}">Empezar con SOLID</a>
            <a class="btn" href="{{ route('bibliografia') }}">Ver bibliografía</a>
        </div>
    </div>
</section>

<section class="wrap topics" aria-label="Temas">
    @foreach ($temas as $clave => $tema)
        <a class="topic" href="{{ route($tema['ruta']) }}">
            <span class="topic-num">0{{ $loop->iteration }}</span>
            <h2>{{ $tema['etiqueta'] }}</h2>
            <p>{{ $tema['intro'] }}</p>
            <span class="topic-meta">{{ $tema['total'] }} {{ $tema['total'] === 1 ? 'tema' : 'temas' }} · Leer →</span>
        </a>
    @endforeach
</section>

<section class="wrap pillars" aria-label="Cómo está organizado">
    <div>
        <h3>Antes y después</h3>
        <p>Cada concepto muestra primero el problema en código real y luego la versión mejorada.</p>
    </div>
    <div>
        <h3>Señales de alerta</h3>
        <p>Aprende a reconocer cuándo un diseño está pidiendo ayuda, antes de que sea tarde.</p>
    </div>
    <div>
        <h3>Listo para Laravel</h3>
        <p>Los ejemplos usan el contenedor de servicios, eventos y repositorios de Laravel.</p>
    </div>
</section>
@endsection
