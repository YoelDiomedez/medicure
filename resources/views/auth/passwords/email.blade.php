@extends('layouts.auth')

@section('pagetitle', 'Recuperar Contraseña')

@section('content')
<!-- BEGIN FORGOT PASSWORD FORM -->
<form method="POST" action="{{ route('password.email') }}">
    @csrf
    
    <h3 class="form-title font-dark">{{ __('¿Olvidate tu Contraseña?') }}</h3>

    @if (session('status'))
        <div class="alert alert-success text-center" role="alert">
            <button class="close" data-close="alert"></button>
            <span role="alert">
                <strong>{{ session('status') }}</strong>
            </span>
        </div>
    @endif

    <div class="form-group @error('email') has-error @enderror">
        <label class="control-label visible-ie8 visible-ie9">{{ __('E-Mail') }}</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="E-Mail" required>
        @error('email')
            <span class="help-block text-center bold"> {{ $message }} </span>
        @enderror 
    </div>

    <div class="form-actions">  
        <button id="recovery-btn" type="submit" class="btn blue uppercase btn-block">
            Recuperar <i class="icon-key"></i>
        </button>
    </div>
</form>
<!-- END FORGOT PASSWORD FORM -->
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#recovery-btn').click(function() {
        var t = $(this)
        t.button('loading'), setTimeout(function() {
            t.button('reset')
        }, 2e3)
    })
})
</script>
@endpush