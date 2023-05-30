@extends('layouts.app')

@section('styles')
 <link rel="stylesheet" href="{{asset('css/styles.css')}}">
@endsection

@section('content')
    <section class="my-5">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-end">
                    <a href="{{route('receta.index')}}" class="btn btn-outline-primary"><i class="fas fa-arrow-circle-left"></i> Volver</a>
                </div>
            </div>
            {{-- Titulo --}}
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 text-center">
                    <h1 class="h2 mb-5">Recetas que te gustan</h1>
                    <ul class="list-group">
                        @forelse ($recetas as $receta)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{$receta->titulo}} <a href="{{route('receta.show',['receta' => $receta->id])}}" class="btn btn-primary text-uppercase">Ver receta</a>
                        </li>
                        @empty
                        <p class="text-muted text-center">Las recetas que te gustan aparecerán aqui</p>
                        @endforelse
                    </ul>
                   
                </div>
            </div>
        </div>
    </section>
@endsection
