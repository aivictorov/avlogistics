@extends('layouts.main')

@section('title', $seo->title)
@section('description', $seo->description)
@section('keywords', $seo->keywords)

@section('content')
    <section class="main-section main-section__container--page">
        <div class="main-section__container main-section__container--aside">
            <article class="aside-page">

                @include('site.parts.breadcrumbs')

                <h1 class="page-h1">Вход</h1>

                {{-- @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach --}}

                <x-errors />

                <form id="login-form" class="form-horizontal" action={{ route('user.auth') }} method="post">
                    @csrf
                    {{-- <input type="hidden" name="_csrf" value="M1pjSjJicGkFFRooRCg4W1YUVC1QG0UQezsHEHcNRiNFNlUYdAAnWg=="> --}}
                    <div class="form-group field-loginform-username required has-success">
                        <label class="col-lg-1 control-label" for="name">email</label>
                        <div class="col-lg-3">
                            <x-input type="text" id="email" class="form-control" name="email" />
                        </div>
                        <div class="col-lg-8">
                            <p class="help-block help-block-error"></p>
                        </div>
                    </div>

                    <div class="form-group field-loginform-password required has-success">
                        <label class="col-lg-1 control-label" for="password">Пароль</label>
                        <div class="col-lg-3">
                            <x-input type="password" id="password" class="form-control" name="password" />
                        </div>
                        <div class="col-lg-8">
                            <p class="help-block help-block-error"></p>
                        </div>
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
                        <div class="col-lg-offset-1 col-lg-11">
                            <button type="submit" class="btn btn-primary" name="login-button">Вход</button>
                        </div>
                    </div>
                </form>
            </article>
        </div>
    </section>
@endsection
