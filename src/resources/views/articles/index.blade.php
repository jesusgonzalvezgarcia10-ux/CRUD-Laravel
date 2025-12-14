@extends('layouts.articles')

@section('title', 'Todos los Artículos')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Todos los Artículos</h1>
    </div>

    <!-- Buscador -->
    <div class="card" style="margin-bottom: 1.5rem;">
        <form action="{{ route('articles.index') }}" method="GET" style="display: flex; gap: 0.5rem;">
            <input type="text" name="search" class="form-control" 
                   placeholder="Buscar artículos..." 
                   value="{{ request('search') }}"
                   style="flex: 1;">
            <button type="submit" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: middle;">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.3-4.3"></path>
                </svg>
                Buscar
            </button>
            @if(request('search'))
                <a href="{{ route('articles.index') }}" class="btn btn-secondary">Limpiar</a>
            @endif
        </form>
    </div>

    @if(request('search'))
        <p style="margin-bottom: 1rem; color: #666;">
            Resultados para: <strong>"{{ request('search') }}"</strong> 
            ({{ $articles->count() }} {{ $articles->count() == 1 ? 'artículo' : 'artículos' }})
        </p>
    @endif

    @if($articles->isEmpty())
        <div class="card">
            <div class="empty-state">
                @if(request('search'))
                    <h3>No se encontraron artículos</h3>
                    <p>No hay resultados para "{{ request('search') }}"</p>
                    <a href="{{ route('articles.index') }}" class="btn btn-primary" style="margin-top: 1rem;">Ver todos los artículos</a>
                @else
                    <h3>No hay artículos disponibles</h3>
                    <p>Aún no se han publicado artículos.</p>
                @endif
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
            </div>
        @endforeach
    @endif
@endsection
