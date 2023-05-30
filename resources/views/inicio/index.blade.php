@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{asset('owlcarrusel/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
@endsection

@section('content')
<header class="hero">
    <div class="container-fluid fondo-oscuro-transparente">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
               <div class="col-12 col-md-4">
                   <h1 class="text-white h3">Encuentra una receta para tu próxima comida</h1>
                   <form action="{{route('receta.search')}}">
                       <input type="search" name="buscar" id="buscar" class="form-control" placeholder="Buscar receta" onfocus="true">
                   </form>
               </div>
            </div>
        </div>
    </div>

</header>
<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-12 col-md-10">
            <h1 class="h1 ultimas text-uppercase">Últimas recetas</h1>
        </div>
    </div>
    {{-- Mostrar las ultimas 10 recetas--}}
    <div class="owl-carousel owl-theme">
        @foreach ($nuevas as $nueva)
     
            <div class="card">
                <img src="{{asset('storage/'.$nueva->imagen)}}" alt="" class="card-img-top">
            <div class="card-body">
                <h1 class="card-title h3">{{Str::title($nueva->titulo)}}</h1>
                <p>{{Str::words(strip_tags($nueva->preparacion),20)}}</p>
                <a href="{{route('receta.show',['receta' => $nueva->id])}}" class="btn btn-primary btn-block text-uppercase">Ver receta</a>
            </div>
            </div>
        
        @endforeach
    </div>
    {{-- Mostrar recetas por las categorías --}}
    @foreach ($recetas as $key => $grupo )
    <div class="row justify-content-center my-5">
        <div class="col-12 col-md-10">
            <h1 class="h2 ultimas text-uppercase mb-5">{{str_replace('-',' ',$key)}}</h1>
                    <div class="row">
                    @foreach ($grupo as $recetas)
                        @foreach ($recetas as $receta)
                        
                            <div class="col-12 col-md-4 mb-5 my-md-0">
                                <div class="card shadow">
                                    <img src="{{asset('storage/'.$receta->imagen)}}" alt="" class="img-top">
                                    <div class="card-body">
                                        <h1 class="h3 card-title">{{$receta->titulo}}</h1>
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
                    @endforeach
                    </div>
                
            
        </div>
    </div>
    @endforeach
</div>
@endsection
@section('scripts')
<script src="{{asset('owlcarrusel/owl.carousel.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('.owl-carousel').owlCarousel({
            margin:10,
            loop:true,
            autoplay:true,
            autoplayHoverPause:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:2
                },
                1000:{
                    items:3
                }
            }
        });
    });
</script>
@endsection
