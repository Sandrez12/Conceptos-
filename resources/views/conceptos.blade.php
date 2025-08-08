@extends('layouts.app')

@section('title', $titulo)

@section('content')
<div class="container py-4">
    <h1 class="mb-4">{{ $titulo }}</h1>
    @foreach($items as $item)
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h3 class="card-title">{{ $item['titulo'] }}</h3>
                <p class="card-text">{{ $item['descripcion'] }}</p>
                @if(!empty($item['codigo']))
                    <pre><code class="language-php">{{ $item['codigo'] }}</code></pre>
                @endif
            </div>
        </div>
    @endforeach
    <a href="{{ route('home') }}" class="btn btn-secondary mt-3">Volver al inicio</a>
</div>
@endsection
