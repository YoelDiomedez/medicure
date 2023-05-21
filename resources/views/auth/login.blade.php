@extends('layouts.auth')

@section('pagetitle', 'Iniciar Sesión')

@section('content')
<!-- BEGIN LOGIN FORM -->
<form method="POST" action="{{ route('login') }}">
    @csrf

    <h3 class="form-title font-dark">Iniciar Sesión</h3>

    <div class="form-group @error('email') has-error @enderror">
        <label class="control-label visible-ie8 visible-ie9">{{ __('E-mail') }}</label>
        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-mail" required autofocus>

        @error('email')
            <span class="help-block text-center bold"> {{ $message }} </span>
        @enderror   
    </div>
    
    <div class="form-group @error('password') has-error @enderror">
        <label class="control-label visible-ie8 visible-ie9">{{ __('Password') }}</label>
        <input id="password" type="password" class="form-control" name="password" placeholder="Contraseña" required>
        @error('password')
            <span class="help-block text-center bold"> {{ $message }} </span>
        @enderror
    </div>

    <div class="form-actions text-center">
        <button id="login-btn" type="submit" class="btn blue uppercase btn-block">Ingresar <i class="icon-login"></i></button>
    </div>
    <div class="create-account bg-dark">
        <p>
            <a href="{{ route('password.request') }}" id="forget-password" class="bg-font-dark">
                ¿Olvidate tu Contraseña?
            </a>
        </p>
    </div>
    
</form>
<!-- END LOGIN FORM -->
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#login-btn').click(function() {
        var t = $(this)
        t.button('loading'), setTimeout(function() {
            t.button('reset')
        }, 3e3)
    })
})
</script>
@endpush