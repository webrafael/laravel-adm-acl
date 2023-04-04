@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="text-center mb-5 offset-md-2">{{ __('Área de Login') }}</h3>
            <form method="POST" action="{{ route('auth.login') }}">
                @csrf

                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-mail') }}</label>

                    <div class="col-md-6">
                        <input
                            id="email"
                            type="text"
                            class="form-control @error('email') is-invalid @enderror @error('username') is-invalid @enderror"
                            name="email"
                            value="{{ old('email') }}"
                            autocomplete="email"
                            placeholder="E-mail ou username"
                            autofocus
                            required>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Senha') }}</label>

                    <div class="col-md-6">
                        <input
                            id="password"
                            type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            name="password"
                            autocomplete="current-password"
                            placeholder="***"
                            required>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Salvar login.') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-lg w-100 btn-dark">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link text-secondary" href="{{ route('password.request') }}">
                                {{ __('Esqueceu a senha?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
