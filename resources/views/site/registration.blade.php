@extends('layouts.main')

@section('content')
    <section class="main-section main-section__container--page">
        <div class="main-section__container main-section__container--aside">
            <article class="aside-page">

                @include('site.parts.breadcrumbs')

                <h1 class="page-h1">Registration</h1>

                <form id="login-form" class="form-horizontal" action={{ route('register') }} method="post">
                    @csrf
                    <div class="form-group field-loginform-username required has-success">
                        <label class="col-lg-1 control-label" for="email">Имя</label>
                        <div class="col-lg-3">
                            <input type="text" id="name" class="form-control" name="name">
                            @error('name')
                                <div>Error message</div>
                            @enderror
                        </div>
                        <label class="col-lg-1 control-label" for="email">Email</label>
                        <div class="col-lg-3">
                            <input type="text" id="email" class="form-control" name="email">
                            @error('email')
                                <div>Error message</div>
                            @enderror
                        </div>
                        <div class="col-lg-8">
                            <p class="help-block help-block-error"></p>
                        </div>
                    </div>
                    <div class="form-group field-loginform-password required has-success">
                        <label class="col-lg-1 control-label" for="password">Пароль</label>
                        <div class="col-lg-3">
                            <input type="password" id="password" class="form-control"name="password">
                        </div>
                        <div class="col-lg-8">
                            @error('password')
                                <p class="help-block help-block-error">Error message</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-1 col-lg-11">
                            <button type="submit" class="btn btn-primary" name="login-button">Register</button>
                        </div>
                    </div>
                </form>
            </article>
        </div>
    </section>
@endsection
