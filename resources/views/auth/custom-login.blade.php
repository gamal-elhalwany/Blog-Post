@extends('layouts.front.front-layout')
@section('title', 'NEWSROOM - SINGLE POST')
@section('content')

<!-- News With Sidebar Start -->
<div class="container-fluid py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <div class="account-login section">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                                <form class="card login-form" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="card-body">
                                        <div class="title">
                                            <h3>Login Now</h3>
                                            <p>You can login using your social media account or email address.</p>
                                        </div>
                                        <div class="social-login">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <a class="btn google-btn" href="{{ route('auth.socialite.redirect', 'google') }}">
                                                        <i class="lni lni-google"></i>
                                                        Google login
                                                    </a>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-12">
                                                    <a class="btn facebook-btn" href="{{ route('auth.socialite.redirect', 'facebook') }}">
                                                        <i class="lni lni-facebook-filled"></i> Facebook login
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="alt-option">
                                            <span>Or</span>
                                        </div>
                                        <!-- Email Address -->
                                        <div class="form-group input-group">
                                            <x-input-label for="email" :value="__('Email')" />
                                            <x-text-input id="email" class="form-control block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>

                                        <!-- Password -->
                                        <div class="form-group input-group">
                                            <x-input-label for="password" :value="__('Password')" />

                                            <x-text-input id="password" class="form-control block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />

                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>

                                        <div class="d-flex flex-wrap justify-content-between bottom-content">
                                            <!-- Remember Me -->
                                            <div class="form-check">
                                                <label for="remember_me" class="form-check-input-width-auto inline-flex items-center">
                                                    <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                                                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                                                </label>
                                            </div>
                                            @if (Route::has('password.request'))
                                            <a class="lost-pass underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                                                {{ __('Forgot your password?') }}
                                            </a>
                                            @endif
                                        </div>
                                        <div class="button">
                                            <button class="btn btn-primary" type="submit">{{ __('Log in') }}</button>
                                        </div>
                                        <p class="outer-link">Don't have an account? <a href="{{ route('register') }}">Register here </a>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- News With Sidebar End -->
<script>
    function toggleReply(replyId) {
        $('.reply-form-jr-' + replyId).slideToggle();
    }
</script>
@endsection