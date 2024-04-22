@extends('admin.layouts.main')

@section('title', 'Редактировать пользователя')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <form action={{ route('admin.users.update', ['id' => $user['id']]) }} method="post"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Основные данные</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <x-errors />
                                </div>
                                <div class="form-group">
                                    <label for="name">Имя пользователя</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $user['name'] }}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Электронная почта</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        value="{{ $user['email'] }}">
                                </div>
                                <div class="form-group">
                                    <label for="current_password">Текущий пароль</label>
                                    <input id="current_password" class="form-control" type="password"
                                        name="current_password">
                                </div>
                                <div class="form-group">
                                    <label for="password">Новый пароль</label>
                                    <input id="password" class="form-control" type="password" name="password">
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Подтверждение пароля</label>
                                    <input id="password_confirmation" class="form-control" type="password"
                                        name="password_confirmation">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Настройки</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Роль</label>
                                            <select class="form-control" disabled>
                                                <option>Администратор</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Статус</label>
                                            <select class="form-control" name="status">
                                                <option value="1" selected>Включено</option>
                                                <option value="0">Выключено</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-primary btn-lg">Сохранить</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <a href={{ route('admin.users.index') }} type="button"
                                class="btn btn-block btn-outline-primary btn-lg">
                                Назад
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
