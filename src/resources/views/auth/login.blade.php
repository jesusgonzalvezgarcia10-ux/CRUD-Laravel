@extends('layouts.articles')

@section('title', 'Iniciar Sesión')

@section('content')
    <div class="auth-container">
        <div class="card" style="max-width: 400px; margin: 0 auto;">
            <h1 class="card-title" style="text-align: center; margin-bottom: 1.5rem;">Iniciar Sesión</h1>

            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" 
                           value="{{ old('email') }}" required autofocus autocomplete="username">
                    @error('email')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" name="password" id="password" class="form-control" 
                           required autocomplete="current-password">
                    @error('password')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                        <input type="checkbox" name="remember" id="remember_me">
                        <span>Recordarme</span>
                    </label>
                </div>

                <div class="actions" style="flex-direction: column; gap: 1rem;">
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Iniciar Sesión</button>
                    
                    <div style="text-align: center; margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #eee;">
                        ¿No tienes cuenta? 
                        <a href="{{ route('register') }}" style="color: #667eea; text-decoration: none; font-weight: bold;">
                            Regístrate
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
