@extends('layouts.service')

@section('title', $seo->title)
@section('description', $seo->description)
@section('keywords', $seo->keywords)

@section('content')
    <main class="main">
        <div class="container container--aside">
            <article class="aside-page">

                {{-- @include('site.parts.breadcrumbs') --}}

                <form id="login-form" class="login-form" action={{ route('user.auth') }} method="post">
                    @csrf

                    <h1 class="page-h1">Вход</h1>

                    @if ($errors->any())
                        <div class="form-group form-errors">
                            <ul>
                                @foreach ($errors->all() as $message)
                                    <li>
                                        {{ $message }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group">
                        <label class="label" for="email">E-mail:</label>
                        <input type="text" id="email" class="input" name="email">
                        @error('email')
                            <div class="error-notify">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="label" for="password">Пароль:</label>
                        <input type="password" id="password" class="input" name="password">
                        @error('password')
                            <div class="error-notify">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- <div class="form-group field-loginform-rememberme">
                        <div class="checkbox">
                            <label>
                                <input type="hidden" name="LoginForm[rememberMe]" value="0"><input type="checkbox"
                                    id="loginform-rememberme" name="LoginForm[rememberMe]" value="1" checked="">
                                Запомнить
                            </label>
                            <p class="help-block help-block-error"></p>
                        </div>
                    </div> --}}

                    <div class="form-group">
                        <button type="submit" class="button">Вход</button>
                    </div>
                </form>
            </article>
        </div>
    </main>
@endsection
