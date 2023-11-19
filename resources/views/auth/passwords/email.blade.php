@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <link rel='stylesheet' href='/border_rainbow/style.css'>
        <link rel='stylesheet' href='https://taniarascia.github.io/primitive/css/main.css'>
        <div class="c-subscribe-box u-align-center" style="height:350px; width:350px">
            <div class="rainbow"><span></span><span></span></div>
            <div class="c-subscribe-box__wrapper">
                <h3 class="c-subscribe-box__title">{{ __('Reset Password') }}</h3>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @else
                <img src="/border_rainbow/img/email.png" class="rounded mx-auto d-block" alt="email" style="width: 100px; height:auto;">
                @endif

                <form class="c-form c-form--accent c-subscribe-box__form" method="POST" action="{{ route('password.email') }}">
                @csrf

                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Masukan Email" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror


                    {{-- <label for="email" class="form-label">{{ __('Email Address') }}</label>
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> --}}

                    <button type="submit" class="full-button">{{ __('Send Password Reset Link') }}</button>
                </form>


            </div>
        </div>
    </div>
</div>

@endsection




