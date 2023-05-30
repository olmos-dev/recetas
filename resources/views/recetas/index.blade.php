@extends('layouts.app')

@section('styles')
 <link rel="stylesheet" href="{{asset('css/styles.css')}}">
@endsection

@section('content')
    <section class="my-5">
        <div class="container">
            {{-- Titulo --}}
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="h2">Administra tus recetas</h1>
                </div>
            </div>
            {{-- Boton --}}
            <div class="row my-3">
                <div class="container">
                    <div class="col-12 col-md-8 d-flex justify-content-start" style="overflow: auto">
                        <a href="{{route('receta.create')}}" class="btn btn-outline-primary mr-1 text-uppercase"><i class="fas fa-plus"></i> Crear nueva receta</a>
                        <a href="{{route('perfil.edit',['perfil' => Auth::user()->id])}}" class="btn btn-outline-success mr-1 text-uppercase"><i class="fas fa-edit"></i> Editar Perfil</a>
                        <a href="{{route('perfil.show',['perfil' => Auth::user()->id])}}" class="btn btn-outline-info mr-1 text-uppercase"><i class="fas fa-user-circle"></i> Ver Perfil</a>
                        <a href="{{route('likes.index')}}" class="btn btn-outline-dark text-uppercase"><i class="far fa-list-alt"></i> Recetas que te gustan</a>
                    </div>
                </div>
            </div>
          
            {{-- Tabla de recetas --}}
            <div class="row">
                <div class="container">
                    <div class="col-12">
                       <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="fondo bg-primary text-white">
                                    <tr>
                                        <th>Titulo</th>
                                        <th>Categoría</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recetas as $receta)
                                    <tr>
                                        <td>{{$receta->titulo}}</td>
                                        <td>{{$receta->categoria->nombre}}</td>
                                        <th>
                                            <a href="{{route('receta.show',['receta' => $receta->id])}}" class="btn btn-dark btn-block mr-1">Ver</a>
                                            <a href="{{route('receta.edit',['receta' => $receta->id])}}" class="btn btn-success btn-block mr-1">Editar</a>
                                            <eliminar-receta receta-id={{$receta->id}}></eliminar-receta>  
                                        </th>            
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                       </div>
                    </div>
                </div>
            </div>
            {{-- Paginacion --}}
            <div class="row">
                <div class="col-12 d-flex justify-content-center mt-3">
                    {{$recetas->links()}}
                </div>
            </div>
            
        </div>
    </section>
@endsection
