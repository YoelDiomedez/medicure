@extends('layouts.auth')

@section('pagetitle', 'Restablecer Contraseña')

@section('content')
<!-- BEGIN RESET PASSWORD FORM -->
<form method="POST" action="{{ route('password.update') }}">
   @csrf

   <input type="hidden" name="token" value="{{ $token }}">

   <h3 class="form-title font-dark">{{ __('Restablecer Contraseña') }}</h3>

   <div class="form-group @error('email') has-error @enderror">
       <label class="control-label visible-ie8 visible-ie9">{{ __('E-Mail') }}</label>
       <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" placeholder="E-Mail" required>
       @error('email')
            <span class="help-block text-center bold"> {{ $message }} </span>
        @enderror 
   </div>

   <div class="form-group @error('password') has-error @enderror">
       <label class="control-label visible-ie8 visible-ie9">{{ __('Nueva Contraseña') }}</label>
       <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Nueva Contraseña" required>
       @error('password')
            <span class="help-block text-center bold"> {{ $message }} </span>
        @enderror
   </div>

   <div class="form-group">
       <label class="control-label visible-ie8 visible-ie9">{{ __('Confirmar Contraseña') }}</label>
       <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar Contraseña" required>
   </div>

   <div class="form-actions">
       <button id="reset-btn" type="submit" id="register-submit-btn" class="btn blue uppercase btn-block">
           {{ __('Restablecer') }} <i class="icon-lock"></i>
       </button>
   </div>
</form>
<!-- END RESET PASSWORD FORM -->
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#reset-btn').click(function() {
        var t = $(this)
        t.button('loading'), setTimeout(function() {
            t.button('reset')
        }, 4e3)
    })
})
</script>
@endpush