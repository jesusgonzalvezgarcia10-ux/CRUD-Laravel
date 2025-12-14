@extends('layouts.articles')

@section('title', $article->title)

@section('content')
    <a href="{{ route('articles.index') }}" class="back-link">← Volver al listado</a>

    <div class="card">
        <div class="card-header">
            <h1 class="card-title">{{ $article->title }}</h1>
            <span class="card-meta">
                {{ $article->date->format('d/m/Y') }}
                @if($article->user)
                    | Por {{ $article->user->name }}
                @endif
            </span>
        </div>
        <div class="card-body">
            <div class="article-content">{{ $article->body }}</div>
        </div>
        @auth
            @if(Auth::id() === $article->user_id)
                <div class="actions" style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid #eee;">
                    <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('articles.destroy', $article->id) }}" method="POST" 
                          onsubmit="return confirm('¿Estás seguro de que deseas eliminar este artículo?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            @endif
        @endauth
    </div>
@endsection
