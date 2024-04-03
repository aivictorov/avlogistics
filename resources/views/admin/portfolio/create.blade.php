@extends('admin.layouts.main')

@section('title', 'Добавить страницу портфолио')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <form action={{ route('admin.portfolio.store') }} method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Основные данные</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Название</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="h1">Заголовок</label>
                                    <input type="text" class="form-control" id="h1" name="h1">
                                </div>
                                <div class="form-group">
                                    <label>Категория</label>
                                    <select class="form-control">
                                        @foreach ($sections as $section)
                                            <option value={{ $section['id'] }}>{{ $section['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Текст</label>
                                    <textarea class="form-control" rows="3" name="text"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Основное изображение</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="image">Основное изображение</label>
                                    <div class="input-group">
                                        <input type="file" id="image" name="image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Галерея изображений</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="images">Галерея изображений</label>
                                    <div class="input-group">
                                        <input type="file" id="images" name="images" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">SEO</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="url">
                                </div>
                                <div class="form-group">
                                    <label for="meta_keywords">meta:Description</label>
                                    <textarea id="meta_description" class="form-control" rows="3" name="text"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="meta_keywords">meta:Keywords</label>
                                    <textarea id="meta_keywords" class="form-control" rows="3" name="text"></textarea>
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
                                            <label for="url">URL</label>
                                            <input type="text" class="form-control" id="url" name="url">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="sort_key">Ключ сортировки</label>
                                            <input type="text" class="form-control" id="sort_key" name="sort_key">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
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