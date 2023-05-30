@extends('layouts.app')

@section('scripts')
    
@endsection

@section('content')
    <section class="my-5">
        <div class="container">
            {{-- Perfil --}}
            <div class="row justify-content-center">
                <div class="col-12 col-md-4">
                    @if ($perfil->foto)
                    <img src="{{asset('storage/'.$perfil->foto)}}" alt="" class="rounded-circle img-fluid">
                    @endif
                </div>
                <div class="col-12 col-md-6">
                    <h1 class="text-primary text-center my-3 my-md-0">{{$perfil->user->name}}</h1>
                    <a href="{{$perfil->user->url}}" class="text-capitalize text-primary my-3 my-md-0"><i class="fas fa-globe"></i> Visitar sitio web</a>
                    <div class="my-3 my-md-3">
                        {!! $perfil->biografia !!}
                    </div>
                   
                </div>
            </div>
            {{-- Recetas de ese perfil --}}
            <h1 class="h2 text-primary my-3 text-center text-md-left">Recetas de {{$perfil->user->name}}</h1> 
            <div class="row">
                    @forelse ($recetas as $receta)
                    <div class="col-12 col-md-4 my-3 my-md-0">
                        <div class="card">
                            <img src="{{asset('storage/'.$receta->imagen)}}" alt="">
                            <div class="card-body">
                                <h1 class="h4 text-center mb-3">{{$receta->titulo}}</h1>
                                <a href="{{route('receta.show',['receta' => $receta->id])}}" class="btn btn-primary btn-block text-uppercase">Ver receta</a>
                            </div>
                        </div>  
                    </div>                      
                    @empty
                        <div class="col-12 mt-5">
                            <p class="h5 text-muted text-center">Ninguna receta aún</p>
                        </div>
                    @endforelse
                </div>
                <div class="col-12 mt-5 d-flex justify-content-center">
                    {{$recetas->links()}}
                </div>
            </div>
            
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{asset('trix/trix.js')}}"></script>
@endsection