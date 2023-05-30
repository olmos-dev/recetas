@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{asset('trix/trix.css')}}">
<link rel="stylesheet" href="{{asset('select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('select2/css/select2-bootstrap4.min.css')}}">
@endsection

@section('content')
    <section class="my-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="h2">Editar la receta</h1>
                </div>
            </div>
            <div class="row my-3">
                <div class="container">
                    <div class="col-12 d-flex justify-content-end">
                        <a href="{{route('receta.index')}}" class="btn btn-outline-primary"><i class="fas fa-arrow-circle-left"></i> Volver</a>
                    </div>
                </div>
            </div>
            {{-- editar receta --}}
            <div class="row justify-content-center">
                <div class="col-md-8 col-12">
                    <form action="{{route('receta.update',['receta' => $receta->id])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        {{-- Titulo --}}
                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input type="text" name="titulo" id="titulo" class="form-control @error('titulo') is-invalid @enderror" value="{{old('titulo',$receta->titulo)}}" placeholder="Título de la receta">
                            @error('titulo')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        {{-- Cateria--}}
                        <div class="form-group">
                            <label for="categoria">Categoria</label>
                            <select name="categoria" id="categoria" class="form-control select2bs4 @error('categoria') is-invalid @enderror">
                                <option value="" disabled selected>-seleccionar-</option>
                                @foreach ($categorias as $categoria)
                                <option value="{{$categoria->id}}" {{$receta->categoria_id == $categoria->id ? 'selected' : ''}}>{{$categoria->nombre}}</option>
                                @endforeach
                            </select>
                            @error('categoria')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        {{-- Ingredientes --}}
                        <div class="form-group">
                            <label for="ingredientes">Ingredientes</label>
                            <input type="hidden" name="ingredientes" id="ingredientes" value="{{old('ingredientes',$receta->ingredientes)}}">
                            <trix-editor input="ingredientes" class="form-control @error('ingredientes') is-invalid @enderror" style="min-height: 300px"></trix-editor>
                            @error('ingredientes')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        {{-- Preparacion --}}
                        <div class="form-group">
                            <label for="preparacion">Preparación</label>
                            <input type="hidden" name="preparacion" id="preparacion" value="{{old('preparacion',$receta->preparacion)}}">
                            <trix-editor style="min-height: 300px" class="form-control @error('preparacion') is-invalid @enderror" input="preparacion"></trix-editor>
                            @error('preparacion')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        {{-- Imagen Actual --}}
                        <div class="form-group">
                            <p>Imagén Actual</p>
                            <img src="{{asset('storage/'.$receta->imagen)}}" alt="" class="img-fluid w-25">
                        </div>
                        {{--Cambiar Imagen --}}
                        <div class="form-group">
                            <label for="imagen">Cambiar imagen</label>
                            <input type="file" name="imagen" id="imagen" class="form-control  @error('imagen') is-invalid @enderror" accept="image/*">
                            @error('imagen')
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
<script src="{{asset('select2/js/select2.full.min.js')}}"></script>
<script>
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
</script>
@endsection