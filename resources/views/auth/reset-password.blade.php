@extends('layouts.auth')

@section('auth-content')
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-brand">
                <img src="{{ asset('images/logo.png') }}" alt="Fábrica Empresarial" class="auth-logo">
                <h1 class="auth-title">Restablecer Contraseña</h1>
            </div>

            <form method="POST" action="{{ route('password.update') }}" class="auth-form">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Nueva Contraseña</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required>
                    @error('password')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirmar Contraseña</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" class="form-control"
                        required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Restablecer</button>
                </div>
            </form>
        </div>
    </div>
@endsection