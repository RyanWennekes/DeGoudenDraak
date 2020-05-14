@extends('default')

@section('content')
    login
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label for="email">Emailadres</label>

        <input id="email"
               type="email"
               class="@error('email') col-12 is-invalid @enderror"
               name="email"
               value="{{ old('email') }}"
               required>

        @error('email')
        <div class="v-alert error">{{ $message }}</div>
        @enderror

        <label for="password">{{ __('Password') }}</label>
        <input id="password"
               type="password"
               class="form-control @error('password') is-invalid @enderror"
               name="password"
               required
               autocomplete="current-password">

        @error('password')
        <div class="v-alert error">{{ $message }}</div>
        @enderror

        <div class="form-check">
            <input class="form-check-input"
                   type="checkbox"
                   name="remember"
                   id="remember" {{ old('remember') ? 'checked' : '' }}>

            <label class="form-check-label" for="remember">
                {{ __('Remember Me') }}
            </label>
        </div>

        @if (Route::has('password.request'))
            <a class="text-primary" href="{{ route('password.request') }}">
                Wachtwoord vergeten?
            </a> <br/>
        @endif

        <button type="submit" class="v-btn v-btn--contained theme--light v-size--default primary float-right my-4">
            {{ __('Login') }}
        </button>
    </form>
@endsection
