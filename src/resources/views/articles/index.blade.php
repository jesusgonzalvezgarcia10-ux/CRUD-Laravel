@extends('layouts.app')

@section('title', 'Listado de Artículos')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Artículos</h1>
        @auth
            <a href="{{ route('articles.create') }}" class="btn btn-primary">+ Nuevo Artículo</a>
        @endauth
    </div>

    @if($articles->isEmpty())
        <div class="card">
            <div class="empty-state">
                <h3>No hay artículos disponibles</h3>
                <p>Sé el primero en crear un artículo.</p>
                @auth
                    <a href="{{ route('articles.create') }}" class="btn btn-primary" style="margin-top: 1rem;">
                        Crear Artículo
                    </a>
                @endauth
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
                        @if($article->user)
                            | Por {{ $article->user->name }}
                        @endif
                    </span>
                </div>
                <div class="card-body">
                    <p>{{ Str::limit($article->body, 200) }}</p>
                </div>
                @auth
                    @if(Auth::id() === $article->user_id)
                        <div class="actions" style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #eee;">
                            <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('articles.destroy', $article->id) }}" method="POST" 
                                  onsubmit="return confirm('¿Estás seguro de que deseas eliminar este artículo?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>
        @endforeach
    @endif
@endsection
