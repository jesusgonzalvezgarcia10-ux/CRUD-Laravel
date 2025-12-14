@extends('layouts.articles')

@section('title', 'Mis Artículos')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Mis Artículos</h1>
        <a href="{{ route('articles.create') }}" class="btn btn-primary">+ Nuevo Artículo</a>
    </div>

    @if($articles->isEmpty())
        <div class="card">
            <div class="empty-state">
                <h3>No tienes artículos todavía</h3>
                <p>¡Crea tu primer artículo ahora!</p>
                <a href="{{ route('articles.create') }}" class="btn btn-primary" style="margin-top: 1rem;">
                    Crear Artículo
                </a>
            </div>
        </div>
    @else
        @foreach($articles as $article)
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        <a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a>
                    </h2>
                    <span class="card-meta">
                        {{ $article->date->format('d/m/Y') }}
                    </span>
                </div>
                <div class="card-body">
                    <p>{{ Str::limit($article->body, 200) }}</p>
                </div>
                <div class="actions" style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #eee;">
                    <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('articles.destroy', $article->id) }}" method="POST" 
                          onsubmit="return confirm('¿Estás seguro de que deseas eliminar este artículo?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </div>
            </div>
        @endforeach
    @endif
@endsection
