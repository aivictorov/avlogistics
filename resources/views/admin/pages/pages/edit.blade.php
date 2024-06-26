<?php use App\Models\Image; ?>

@extends('admin.layouts.main')

@section('title', 'Редактировать страницу')

@section('content')
    <section class="content">
        <div class="container">
            <x-errors />
            <x-notice />

            <form action={{ route('admin.pages.update', ['id' => $page['id']]) }} method="post"
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
                                    <label for="name">Название</label>
                                    <x-input type="text" class="form-control" id="name" name="name"
                                        value="{{ $page['name'] }}" />
                                </div>
                                <div class="form-group">
                                    <label for="h1">Заголовок</label>
                                    <x-input type="text" class="form-control" id="h1" name="h1"
                                        value="{{ $page['h1'] }}" />
                                </div>
                                <div class="form-group">
                                    <label>Категория (страница родитель)</label>
                                    <select class="form-control" name="parent_id">
                                        <option value="0" {{ $page['parent_id'] == 0 ? 'selected' : '' }}>Без родителя
                                        </option>
                                        @foreach ($pages as $parent)
                                            <option value="{{ $parent['id'] }}"
                                                {{ $page['parent_id'] == $parent['id'] ? 'selected' : '' }}>
                                                {{ $parent['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="text">Текст</label>
                                    <x-textarea id="text" class="editor form-control"
                                        name="text">{{ $page['text'] }}</x-textarea>
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
                                <x-ajaxBadge />
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="avatar">Основное изображение</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="avatar"
                                                        name="avatar">
                                                    <div class="custom-file-label" data-browse="Выберите файл">
                                                        Файл не выбран
                                                    </div>
                                                </div>
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-primary"
                                                        data-action="updateAvatar" data-id="{{ $page['id'] }}"
                                                        data-type="page">
                                                        Загрузить
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group d-flex">
                                            <div class="avatar position-relative">
                                                @if ($avatar)
                                                    <img src={{ Image::path($avatar) }} data-function="destroy" />
                                                @endif
                                            </div>
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
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="url">URL</label>
                                            <x-input type="text" class="form-control" id="url" name="url"
                                                value="{{ $page['url'] }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="menu_sort">Ключ сортировки</label>
                                            <x-input type="text" class="form-control" id="menu_sort" name="menu_sort"
                                                value="{{ $page['menu_sort'] }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="menu_show">Отображение в меню</label>
                                            @if ($page['system_page'] != 0)
                                                <select class="form-control" id="menu_show" name="menu_show" disabled>
                                                    <option value="1"
                                                        {{ $page['menu_show'] == 1 ? 'selected' : '' }}>
                                                        Включено</option>
                                                    <option value="0"
                                                        {{ $page['menu_show'] == 0 ? 'selected' : '' }}>
                                                        Отключено</option>
                                                </select>
                                            @else
                                                <select class="form-control" id="menu_show" name="menu_show">
                                                    <option value="1"
                                                        {{ $page['menu_show'] == 1 ? 'selected' : '' }}>
                                                        Включено</option>
                                                    <option value="0"
                                                        {{ $page['menu_show'] == 0 ? 'selected' : '' }}>
                                                        Отключено</option>
                                                </select>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="status">Статус</label>
                                            @if ($page['system_page'] != 0)
                                                <select class="form-control" id="status" name="status" disabled>
                                                    <option value="1" {{ $page['status'] == 1 ? 'selected' : '' }}>
                                                        Включено</option>
                                                    <option value="0" {{ $page['status'] == 0 ? 'selected' : '' }}>
                                                        Отключено</option>
                                                </select>
                                            @else
                                                <select class="form-control" id="status" name="status">
                                                    <option value="1" {{ $page['status'] == 1 ? 'selected' : '' }}>
                                                        Включено</option>
                                                    <option value="0" {{ $page['status'] == 0 ? 'selected' : '' }}>
                                                        Отключено</option>
                                                </select>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="system_page">Системная страница</label>
                                            <select class="form-control" id="system_page" name="system_page" disabled>
                                                <option value="1" {{ $page['system_page'] == 1 ? 'selected' : '' }}>
                                                    Включено</option>
                                                <option value="0" {{ $page['system_page'] == 0 ? 'selected' : '' }}>
                                                    Выключено</option>
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
                            <a href={{ route('admin.pages.destroy', ['id' => $page['id']]) }}
                                class="btn btn-block btn-danger btn-lg" onclick="return check()">
                                Удалить
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <a href={{ route('admin.pages.index') }} type="button"
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
