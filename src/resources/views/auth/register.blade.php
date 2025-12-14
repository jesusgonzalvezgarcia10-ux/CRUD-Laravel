@extends('layouts.articles')

@section('title', 'Registrarse')

@section('content')
    <div class="auth-container">
        <div class="card" style="max-width: 400px; margin: 0 auto;">
            <h1 class="card-title" style="text-align: center; margin-bottom: 1.5rem;">Crear Cuenta</h1>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" name="name" id="name" class="form-control" 
                           value="{{ old('name') }}" required autofocus autocomplete="name">
                    @error('name')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" 
                           value="{{ old('email') }}" required autocomplete="username">
                    @error('email')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" name="password" id="password" class="form-control" 
                           required autocomplete="new-password">
                    @error('password')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" 
                           class="form-control" required autocomplete="new-password">
                    @error('password_confirmation')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="actions" style="flex-direction: column; gap: 1rem;">
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Registrarse</button>
                </div>
            </form>

            <!-- Separador -->
            <div style="display: flex; align-items: center; margin: 1.5rem 0; gap: 1rem;">
                <div style="flex: 1; height: 1px; background: #ddd;"></div>
                <span style="color: #888; font-size: 0.875rem;">o continúa con</span>
                <div style="flex: 1; height: 1px; background: #ddd;"></div>
            </div>

            <!-- Botón de Google -->
            <a href="{{ route('auth.google') }}" class="btn-google" style="display: flex; align-items: center; justify-content: center; gap: 0.75rem; width: 100%; padding: 0.75rem 1rem; border: 1px solid #ddd; border-radius: 5px; background: white; text-decoration: none; color: #333; font-weight: 500; transition: all 0.3s;">
                <svg width="20" height="20" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                </svg>
                Registrarse con Google
            </a>

            <div style="text-align: center; margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid #eee;">
                ¿Ya tienes cuenta? 
                <a href="{{ route('login') }}" style="color: #667eea; text-decoration: none; font-weight: bold;">
                    Inicia Sesión
                </a>
            </div>
        </div>
    </div>

    <style>
        .btn-google:hover {
            background: #f8f8f8 !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
    </style>
@endsection
