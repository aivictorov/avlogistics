@extends('admin.layouts.main')

@section('title', 'Новая тема')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <form action={{ route('admin.faq.store') }} method="post" enctype="multipart/form-data">
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
                                    <label for="name">Название</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="h1">Заголовок</label>
                                    <input type="text" class="form-control" id="h1" name="h1">
                                </div>
                                <div class="form-group">
                                    <label>Анонс</label>
                                    <trix-editor input="announce"></trix-editor>
                                    <x-input id="announce" type="hidden" name="announce" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Вопросы</h3>
                            </div>
                            <div class="card-body">
                                <div class="row" id="questions">
                                    Добавление вопросов станет возможным после сохранения темы.
                                    {{-- <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="question_name">Название</label>
                                                    <input type="text" class="form-control" id="question_name"
                                                        name="questions[0][name]">
                                                </div>
                                                <div class="form-group">
                                                    <label for="questions[0][answer]">Ответ</label>
                                                    <textarea id="questions[0][answer]" class="form-control" rows="3" name="questions[0][answer]"></textarea>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label for="sort">Ключ сортировки</label>
                                                            <input type="text" class="form-control"
                                                                id="questions[0][sort]" name="questions[0][sort]">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 d-flex align-items-end">
                                                        <div class="form-group w-100">
                                                            <button type="button" class="btn btn-block btn-outline-danger">
                                                                Удалить
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                                {{-- <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button type="button" id="questions_btn"
                                                class="btn btn-block btn-outline-primary">
                                                Добавить вопрос
                                            </button>
                                        </div>
                                    </div>
                                </div> --}}
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
                                    <x-input id="title" class="form-control" type="text" name="title" />
                                </div>
                                <div class="form-group">
                                    <label for="description">meta:Description</label>
                                    <x-textarea id="description" class="form-control" rows="3" name="description" />
                                </div>
                                <div class="form-group">
                                    <label for="keywords">meta:Keywords</label>
                                    <x-textarea id="keywords" class="form-control" rows="3" name="keywords" />
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
                            <button type="submit" class="btn btn-block btn-primary btn-lg">Создать</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <a href={{ route('admin.faq.index') }} type="button"
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
