@extends('layouts.app')

@section('title', 'Inyección de Dependencias')

@section('content')
<h1 class="mb-4">Inyección de Dependencias</h1>
@foreach($inyeccion_dependencias as $tema)
    <div class="glass-card mb-4">
        <h3>{{ $tema['titulo'] }}</h3>
        <p style="white-space: pre-line;">{{ $tema['descripcion'] }}</p>
        @if(!empty($tema['codigo']))
            <pre><code class="language-php">{{ $tema['codigo'] }}</code></pre>
        @endif
    </div>
@endforeach
@endsection
