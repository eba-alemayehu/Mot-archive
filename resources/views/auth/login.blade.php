@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin-top: 4em">
        <div class="col-md-4" >
            <div class="card">
                <h3>{{ __('Login') }}</h3>
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="from-group">
                        <label for="worker_id" class="form-label">{{ __("Worker ID") }}</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" name='worker_id' requird value="{{ old('email') }}"/>
                       
                        @error('worker_id')
                            <span class="invalid-feedback" style="display: block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" required name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" style="dispaly:block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
