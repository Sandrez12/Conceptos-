@extends('layouts.app')

@section('title', 'Principios SOLID')

@section('content')
<h1 class="mb-4">Principios SOLID</h1>
@foreach($solid as $principio)
    <div class="glass-card mb-4">
        <h3>{{ $principio['titulo'] }}</h3>
        <p>{{ $principio['descripcion'] }}</p>
        @if(!empty($principio['codigo']))
            <pre><code class="language-php">{{ $principio['codigo'] }}</code></pre>
        @endif
    </div>
@endforeach
@endsection
