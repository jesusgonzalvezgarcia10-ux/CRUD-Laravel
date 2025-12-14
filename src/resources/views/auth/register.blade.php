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
                    
                    <div style="text-align: center; margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #eee;">
                        ¿Ya tienes cuenta? 
                        <a href="{{ route('login') }}" style="color: #667eea; text-decoration: none; font-weight: bold;">
                            Inicia Sesión
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
