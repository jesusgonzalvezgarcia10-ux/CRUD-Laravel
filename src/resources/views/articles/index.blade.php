@extends('layouts.articles')

@section('title', 'Todos los Artículos')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Todos los Artículos</h1>
    </div>

    @if($articles->isEmpty())
        <div class="card">
            <div class="empty-state">
                <h3>No hay artículos disponibles</h3>
                <p>Aún no se han publicado artículos.</p>
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
