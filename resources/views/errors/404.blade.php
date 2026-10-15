@extends('layouts.app')

@section('title', 'Página no encontrada')

@section('content')
<section class="hero">
    <div class="wrap">
        <p class="eyebrow">Error 404</p>
        <h1>Esta página <span>no existe</span></h1>
        <p class="lead">Puede que el enlace esté mal escrito o que el contenido se haya movido.</p>
        <div class="actions"><a class="btn primary" href="{{ route('home') }}">Volver al inicio</a></div>
    </div>
</section>
@endsection
