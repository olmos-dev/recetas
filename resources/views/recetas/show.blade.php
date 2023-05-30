@extends('layouts.app')

@section('content')
    <section class="my-5">
        <div class="container bg-white p-5 shadow">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    <h1 class="text-center display-4 text-muted">{{$receta->titulo}}</h1>
                </div>                
                <div class="col-12 col-md-8">
                    <img src="{{asset('storage/'.$receta->imagen)}}" alt="" class="img-fluid">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 mt-3">
                    <p class=""><span class="text-primary">Autor:</span> 
                        <a class="text-dark" href="{{route('perfil.show',['perfil' => $receta->user->id])}}"> {{$receta->user->name}}</a>
                    </p>
                    <p class=""><span class="text-primary">Categoría:</span>
                        <a class="text-dark" href="{{route('categoria.show',['categoria' => $receta->categoria->id])}}">{{$receta->categoria->nombre}}</a>
                    </p>
                    @php
                        use Carbon\Carborn;
                        $fecha = $receta->created_at;
                    @endphp
                    <p class=""><span class="text-primary">Fecha publicación:</span><fecha-receta fecha="{{$fecha}}"></fecha-receta></p>
                    <h1 class="text-primary">Ingredientes</h1>
                    <div class="text-justify">
                        {!! $receta->ingredientes !!}
                    </div>
                    <h1 class="text-primary mt-1">Preparación</h1>
                    <div class="text-justify">
                        {!! $receta->preparacion !!}
                    </div>
                </div>
            </div>
            {{-- Like --}}
            <div class="row">
                <div class="col-12 d-flex justify-content-center text-center">
                    <like-button receta-id="{{$receta->id}}" like="{{$like}}" contar-likes="{{$contarLikes}}"></like-button>
                </div>
            </div>
        </div>
    </section>
@endsection