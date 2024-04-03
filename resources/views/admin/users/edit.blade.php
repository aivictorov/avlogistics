@extends('admin.layouts.main')

@section('title', 'Редактировать пользователя')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <form action={{ route('admin.users.store') }} method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Основные данные</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Имя пользователя</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>          
                                <div class="form-group">
                                    <label for="name">Электронная почта</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="h1">Пароль</label>
                                    <input type="text" class="form-control" id="h1" name="h1">
                                </div>
                                <div class="form-group">
                                    <label for="h1">Подтверждение пароля</label>
                                    <input type="text" class="form-control" id="h1" name="h1">
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
                                            <select class="form-control">
                                                <option>Администратор</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Статус</label>
                                            <select class="form-control">
                                                <option>Включено</option>
                                                <option>Выключено</option>
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
                            <button type="submit" class="btn btn-block btn-primary btn-lg">Создать</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-outline-primary btn-lg">Назад</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection