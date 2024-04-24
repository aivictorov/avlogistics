@extends('admin.layouts.main')

@section('title', 'Редактировать тему')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <form action={{ route('admin.faq.update', ['id' => $faq['id']]) }} method="post" enctype="multipart/form-data">
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
                                    <label for="name">Название</label>
                                    <x-input type="text" class="form-control" id="name" name="name"
                                        value="{{ $faq['name'] }}" />
                                </div>
                                <div class="form-group">
                                    <label for="h1">Заголовок</label>
                                    <x-input type="text" class="form-control" id="h1" name="h1"
                                        value="{{ $faq['h1'] }}" />
                                </div>
                                <div class="form-group">
                                    <label>Анонс</label>
                                    <trix-editor input="announce"></trix-editor>
                                    <x-input id="announce" type="hidden" name="announce"
                                        value="{!! $faq['announce'] !!}" />
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
                                <span class="card-tools badge badge-danger">Сохранение без перезагрузки</span>
                            </div>
                            <div class="card-body">
                                <div class="questions row">
                                    @foreach ($questions as $question)
                                        <div class="question col-md-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="question_name">Название</label>
                                                        <input type="text" class="form-control" data-name="name"
                                                            name="questions[{{ $question['id'] }}][name]"
                                                            value="{{ $question['name'] }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="questions[{{ $question['id'] }}][answer]">Ответ</label>
                                                        <textarea id="questions[{{ $question['id'] }}][answer]" data-name="answer" class="form-control mini-editor"
                                                            rows="3" name="questions[{{ $question['id'] }}][answer]">{!! $question['answer'] !!}</textarea>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label for="sort">Ключ сортировки</label>
                                                                <input type="text" class="form-control"
                                                                    id="questions[{{ $question['id'] }}][sort]"
                                                                    name="questions[{{ $question['id'] }}][sort]"
                                                                    value="{{ $question['sort'] }}" data-name="sort">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5 d-flex align-items-end">
                                                            <div class="form-group w-100">
                                                                <button type="button" class="btn btn-block btn-primary"
                                                                    data-action="saveQuestion"
                                                                    data-id="{{ $question['id'] }}"
                                                                    data-faq="{{ $faq['id'] }}">
                                                                    Сохранить
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2 d-flex align-items-end">
                                                            <div class="form-group w-100">
                                                                <button type="button"
                                                                    class="btn btn-block btn-outline-danger"
                                                                    data-action="removeQuestion"
                                                                    data-id="{{ $question['id'] }}">
                                                                    Удалить
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-block btn-outline-primary"
                                                data-action="addNewQuestion" data-faq="{{ $faq['id'] }}">
                                                Добавить вопрос
                                            </button>
                                        </div>
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
                                    <x-input id="title" class="form-control" type="text" name="title"
                                        value="{{ $seo['title'] }}" />
                                </div>
                                <div class="form-group">
                                    <label for="description">meta:Description</label>
                                    <textarea id="description" class="form-control" name="description" rows="3">{{ $seo['description'] }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="keywords">meta:Keywords</label>
                                    <textarea id="keywords" class="form-control" name="keywords" rows="3">{{ $seo['keywords'] }}</textarea>
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
                                            <input type="text" class="form-control" id="url" name="url"
                                                value="{{ $faq['url'] }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="sort_key">Ключ сортировки</label>
                                            <input type="text" class="form-control" id="sort_key" name="sort_key"
                                                value="{{ $faq['sort_key'] }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="status">Статус</label>
                                            <select class="form-control" id="status" name="status">
                                                <option value="1" {{ $faq['status'] == 1 ? 'selected' : '' }}>
                                                    Включено</option>
                                                <option value="0" {{ $faq['status'] == 0 ? 'selected' : '' }}>
                                                    Отключено</option>
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
                    <div class="col-md-3">
                        <div class="form-group">
                            <a href={{ route('admin.faq.destroy', ['id' => $faq['id']]) }}
                                class="btn btn-block btn-danger btn-lg">Удалить</a>
                        </div>
                    </div>
                    <div class="col-md-3">
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
