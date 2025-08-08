@extends('layouts.app')

@section('title', 'Cohesión y Acoplamiento')

@section('content')
<h1 class="mb-4">Cohesión y Acoplamiento</h1>
@foreach($cohesion_acoplamiento as $tema)
    <div class="glass-card mb-4">
        <h3>{{ $tema['titulo'] }}</h3>
        <p style="white-space: pre-line;">{{ $tema['descripcion'] }}</p>
        @if(!empty($tema['codigo']))
            <pre><code class="language-php">{{ $tema['codigo'] }}</code></pre>
        @endif
    </div>
@endforeach
@endsection
