@extends('layouts.articles')

@section('title', 'Crear Artículo')

@section('content')
    <a href="{{ route('articles.index') }}" class="back-link">← Volver al listado</a>

    <div class="card">
        <h1 class="card-title" style="margin-bottom: 1.5rem;">Crear Nuevo Artículo</h1>

        <form action="{{ route('articles.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="title" class="form-label">Título</label>
                <input type="text" name="title" id="title" class="form-control" 
                       value="{{ old('title') }}" required>
                @error('title')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="date" class="form-label">Fecha</label>
                <input type="date" name="date" id="date" class="form-control" 
                       value="{{ old('date', date('Y-m-d')) }}" required>
                @error('date')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="body" class="form-label">Contenido</label>
                <textarea name="body" id="body" class="form-control" required>{{ old('body') }}</textarea>
                @error('body')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="actions">
                <button type="submit" class="btn btn-primary">Crear Artículo</button>
                <a href="{{ route('articles.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
