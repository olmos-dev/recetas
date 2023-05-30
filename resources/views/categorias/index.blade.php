@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-12 col-md-10">
            <h1 class="h1 ultimas text-uppercase">Categoría - {{$nombre}}</h1>
        </div>
    </div>
    <div class="row">
        @foreach ($recetas as $receta)
            <div class="col-12 col-md-4">
                <div class="card">
                    <img src="{{asset('storage/'.$receta->imagen)}}" class="card-img-top" alt="">
                    <div class="card-body">
                        <h1 class="h3">{{$receta->titulo}}</h1>
                        <div class="d-flex justify-content-between">
                            @php
                                $fecha = $receta->created_at;
                            @endphp
                            <p class="text-primary font-weight-bold"><fecha-receta fecha="{{$fecha}}"></fecha-receta></p>
                            @if (count($receta->likes) != 0)
                                <p class="text-primary"><span class="text-black-50">{{count($receta->likes)}} </span><i class="fas fa-heart"></i></p>
                            @else
                                <p class="text-primary"><span class="text-muted">se el primero </span><i class="fas fa-heart"></i></p>
                            @endif
                        </div>
                        <p>{{Str::words(strip_tags($receta->preparacion),12)}}</p>
                        <a href="{{route('receta.show',['receta' => $receta->id])}}" class="btn btn-block btn-primary text-uppercase">Ver Receta</a>
                    </div>
                </div>
            </div>          
        @endforeach
    </div>
     {{-- Paginacion --}}
     <div class="row">
        <div class="col-12 d-flex justify-content-center mt-3">
            {{$recetas->links()}}
        </div>
    </div>
</div>
@endsection
