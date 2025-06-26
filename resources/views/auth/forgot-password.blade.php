@extends('layouts.auth')

@section('auth-content')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-brand">
            <img src="{{ asset('images/logo.png') }}" alt="Fábrica Empresarial" class="auth-logo">
            <h1 class="auth-title">Recuperar Contraseña</h1>
        </div>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="auth-form">
            @csrf

            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input id="email" type="email" name="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}" required autofocus>
                @error('email')
                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Enviar enlace de recuperación</button>
            </div>
        </form>

        <div class="auth-footer">
            <a href="{{ route('login') }}">Volver al inicio de sesión</a>
        </div>
    </div>
</div>
@endsection
