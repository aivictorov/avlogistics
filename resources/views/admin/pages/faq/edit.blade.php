@extends('admin.layouts.main')

@section('title', 'Редактировать тему')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <x-errors />
            <x-notice />

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
                                    <label for="announce">Анонс</label>
                                    <x-textarea class="form-control" id="announce"
                                        name="announce">{!! $faq['announce'] !!}</x-textarea>
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
                                <x-ajaxBadge />
                            </div>
                            <div class="card-body">
                                <div class="questions row">
                                    @foreach ($questions as $question)
                                        <div class="question col-md-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="questions[{{ $question['id'] }}][name]">Название</label>
                                                        <x-input type="text" class="form-control" data-name="name"
                                                            id="questions[{{ $question['id'] }}][name]"
                                                            name="questions[{{ $question['id'] }}][name]"
                                                            value="{{ $question['name'] }}" />
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <label
                                                                for="questions[{{ $question['id'] }}][answer]">Ответ</label>
                                                            <x-textarea class="form-control" rows="3"
                                                                data-name="answer"
                                                                id="questions[{{ $question['id'] }}][answer]"
                                                                name="questions[{{ $question['id'] }}][answer]">{!! $question['answer'] !!}</x-textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="questions[{{ $question['id'] }}][sort]">Ключ
                                                                    сортировки</label>
                                                                <x-input type="text" class="form-control"
                                                                    id="questions[{{ $question['id'] }}][sort]"
                                                                    name="questions[{{ $question['id'] }}][sort]"
                                                                    value="{{ $question['sort'] }}" data-name="sort" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 d-flex align-items-end">
                                                            <div class="form-group w-100">
                                                                <button type="button" class="btn btn-block btn-primary"
                                                                    data-action="saveQuestion"
                                                                    data-id="{{ $question['id'] }}"
                                                                    data-faq="{{ $faq['id'] }}">
                                                                    Сохранить
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 d-flex align-items-end">
                                                            <div class="form-group w-100">
                                                                <button type="button" class="btn btn-block btn-danger"
                                                                    data-action="removeQuestion"
                                                                    data-id="{{ $question['id'] }}"
                                                                    onclick="return check()">
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
                                    <x-textarea id="description" class="form-control" name="description"
                                        rows="3">{{ $seo['description'] }}</x-textarea>
                                </div>
                                <div class="form-group">
                                    <label for="keywords">meta:Keywords</label>
                                    <x-textarea id="keywords" class="form-control" name="keywords"
                                        rows="3">{{ $seo['keywords'] }}</x-textarea>
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
                                class="btn btn-block btn-danger btn-lg" onclick="return check()">
                                Удалить
                            </a>
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
