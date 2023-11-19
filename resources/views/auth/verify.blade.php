@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <link rel='stylesheet' href='/border_rainbow/style.css'>
        <link rel='stylesheet' href='https://taniarascia.github.io/primitive/css/main.css'>
        <div class="c-subscribe-box u-align-center" style="height:400px; width:350px">
            <div class="rainbow"><span></span><span></span></div>
            <div class="c-subscribe-box__wrapper">
                <h3 class="c-subscribe-box__title">{{ __('Verify Your Email Address') }}</h3>
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @else
                <img src="/border_rainbow/img/email.png" class="rounded mx-auto d-block" alt="email" style="width: 100px; height:auto;">
                @endif
                <p class="c-subscribe-box__desc">
                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                </p>

                <form class="c-form c-form--accent c-subscribe-box__form" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                    <button type="submit" class="full-button">{{ __('click here to request another') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
