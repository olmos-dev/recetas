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
                    <h1 class="h2">Crear nueva receta</h1>
                </div>
            </div>
            <div class="row my-3">
                <div class="container">
                    <div class="col-12 d-flex justify-content-end">
                        <a href="{{route('receta.index')}}" class="btn btn-outline-primary"><i class="fas fa-arrow-circle-left"></i> Volver</a>
                    </div>
                </div>
            </div>
            {{-- crear nueva receta --}}
            <div class="row justify-content-center">
                <div class="col-md-8 col-12">
                    <form action="{{route('receta.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- Titulo --}}
                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input type="text" name="titulo" id="titulo" class="form-control @error('titulo') is-invalid @enderror" value="{{old('titulo')}}" placeholder="Título de la receta">
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
                                <option value="{{$categoria->id}}" {{ old('categoria') == $categoria->id ? 'selected' : '' }}>{{$categoria->nombre}}</option>
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
                            <input type="hidden" name="ingredientes" id="ingredientes" value="{{old('ingredientes')}}">
                            <trix-editor input="ingredientes" style="min-height: 300px"></trix-editor>
                            @error('ingredientes')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        {{-- Preparacion --}}
                        <div class="form-group">
                            <label for="preparacion">Preparación</label>
                            <input type="hidden" name="preparacion" id="preparacion" value="{{old('preparacion')}}">
                            <trix-editor style="min-height: 300px" input="preparacion"></trix-editor>
                            @error('preparacion')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        {{-- Imagen --}}
                        <div class="form-group">
                            <label for="imagen">Selecciona una imágen</label>
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