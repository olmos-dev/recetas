@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{asset('trix/trix.css')}}">
@endsection

@section('content')
    <section class="my-5">
        <div class="container">
            {{-- Titulo --}}
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="h2">Editar perfil</h1>
                </div>
            </div>
            {{-- Volver --}}
            <div class="row my-3">
                <div class="container">
                    <div class="col-12 d-flex justify-content-end">
                        <a href="{{route('receta.index')}}" class="btn btn-outline-primary"><i class="fas fa-arrow-circle-left"></i> Volver</a>
                    </div>
                </div>
            </div>
            {{-- Formulario para editar --}}
             <div class="row justify-content-center">
                <div class="col-md-8 col-12">
                    <form action="{{route('perfil.update',['perfil' => $perfil->id])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        {{-- Nombre --}}
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{old('nombre',$perfil->user->name)}}" placeholder="Nombre">
                            @error('nombre')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        {{-- Sitio web --}}
                        <div class="form-group">
                            <label for="web">Sitio Web</label>
                            <input type="text" name="web" id="web" class="form-control @error('web') is-invalid @enderror" value="{{old('web', $perfil->user->url)}}" placeholder="Sitio web">
                            @error('web')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        {{-- Biografía --}}
                        <div class="form-group">
                            <label for="biografia">Biografía</label>
                            <input type="hidden" name="biografia" id="biografia" value="{{old('biografia',$perfil->biografia)}}">
                            <trix-editor input="biografia" class="form-control @error('biografia') is-invalid @enderror" style="min-height: 300px"></trix-editor>
                            @error('biografia')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        {{-- Foto actual --}}
                        @if ($perfil->foto)
                            <div class="form-group">
                                <p>Foto Actual</p>
                                <img src="{{asset('storage/'.$perfil->foto)}}" alt="" class="img-fluid w-25">
                            </div>
                        @endif
                        {{-- Foto --}}
                        <div class="form-group">
                            <label for="foto">Selecciona una Foto</label>
                            <input type="file" name="foto" id="foto" class="form-control  @error('foto') is-invalid @enderror" accept="image/*">
                            @error('foto')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary text-white" value="Agregar Receta">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{asset('trix/trix.js')}}"></script>
@endsection