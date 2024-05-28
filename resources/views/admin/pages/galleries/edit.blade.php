<?php use App\Models\Image; ?>

@extends('admin.layouts.main')

@section('title', 'Редактировать галерею')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <x-errors />
            <x-notice />

            <form action={{ route('admin.galleries.update', ['id' => $gallery['id']]) }} method="post"
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
                                <div class="row">
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label for="id">ID</label>
                                            <x-input type="text" class="form-control" id="id" name="id"
                                                value="{{ $gallery['id'] }}" disabled />
                                        </div>
                                    </div>
                                    <div class="col-md-11">
                                        <div class="form-group">
                                            <label for="name">Название</label>
                                            <x-input type="text" class="form-control" id="name" name="name"
                                                value="{{ $gallery['name'] }}" />
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
                                <h3 class="card-title">Изображения</h3>
                                <x-ajaxBadge />
                            </div>

                            <div class="card-body">
                                <div class="questions row">
                                    @if (isset($items) && count($items) > 0)
                                        @foreach ($items as $item)
                                            <div class="question col-md-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div
                                                                    class="portfolio-gallery-image mr-2 mt-1 mb-1 d-block position-relative">
                                                                    <img src={{ Image::path($item['image'], '1_4') }} />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="form-group">
                                                                    <label for="text">Текст</label>
                                                                    <x-textarea class="form-control" id="text"
                                                                        name="text">
                                                                        {{ $item['text'] }}
                                                                    </x-textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <div class="form-group">
                                                                    <label for="sort">Ключ сортировки</label>
                                                                    <x-input type="text" class="form-control"
                                                                        id="sort" name="sort"
                                                                        value="{{ $item['sort'] }}" data-name="sort" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5 d-flex align-items-end">
                                                                <div class="form-group w-100">
                                                                    <button type="button"
                                                                        class="btn btn-block btn-primary">
                                                                        Сохранить
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 d-flex align-items-end">
                                                                <div class="form-group w-100">
                                                                    <button type="button" class="btn btn-block btn-danger">
                                                                        Удалить
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-block btn-outline-primary">
                                                Добавить изображение
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
                                <h3 class="card-title">Настройки</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="url">URL</label>
                                            <input type="text" class="form-control" id="url" name="url"
                                                value="{{ $gallery['url'] }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="sort_key">Ключ сортировки</label>
                                            <input type="text" class="form-control" id="sort_key" name="sort_key"
                                                value="{{ $gallery['sort_key'] }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="status">Статус</label>
                                            <select class="form-control" id="status" name="status">
                                                <option value="1" {{ $gallery['status'] == 1 ? 'selected' : '' }}>
                                                    Включено</option>
                                                <option value="0" {{ $gallery['status'] == 0 ? 'selected' : '' }}>
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
                        {{-- <div class="form-group">
                            <a href={{ route('admin.faq.destroy', ['id' => $faq['id']]) }}
                                class="btn btn-block btn-danger btn-lg">Удалить</a>
                        </div> --}}
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
