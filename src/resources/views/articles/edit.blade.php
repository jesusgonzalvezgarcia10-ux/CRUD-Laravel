@extends('layouts.articles')

@section('title', 'Editar Artículo')

@section('content')
    <a href="{{ route('articles.index') }}" class="back-link">← Volver al listado</a>

    <div class="card">
        <h1 class="card-title" style="margin-bottom: 1.5rem;">Editar Artículo</h1>

        <form action="{{ route('articles.update', $article->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title" class="form-label">Título</label>
                <input type="text" name="title" id="title" class="form-control" 
                       value="{{ old('title', $article->title) }}" required>
                @error('title')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="date" class="form-label">Fecha</label>
                <input type="date" name="date" id="date" class="form-control" 
                       value="{{ old('date', $article->date->format('Y-m-d')) }}" required>
                @error('date')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="body" class="form-label">Contenido</label>
                <textarea name="body" id="body" class="form-control" required>{{ old('body', $article->body) }}</textarea>
                @error('body')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="actions">
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <a href="{{ route('articles.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
