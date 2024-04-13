<?php use App\Models\Image; ?>

@extends('admin.layouts.main')

@section('title', 'Редактировать страницу портфолио')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <form action={{ route('admin.portfolio.update', ['id' => $portfolio['id']]) }} method="post"
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
                                    <x-notice />
                                </div>

                                <div class="form-group">
                                    <label for="name">Название</label>
                                    <x-input type="text" class="form-control" id="name" name="name"
                                        value="{{ $portfolio['name'] }}" />
                                </div>
                                <div class="form-group">
                                    <label for="h1">Заголовок</label>
                                    <x-input type="text" class="form-control" id="h1" name="h1"
                                        value="{{ $portfolio['h1'] }}" />
                                </div>
                                <div class="form-group">
                                    <label>Категория</label>
                                    <select class="form-control" name="portfolio_section_id">
                                        @foreach ($sections as $section)
                                            <option value={{ $section['id'] }}>{{ $section['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Текст</label>
                                    <trix-editor input="text"></trix-editor>
                                    <input id="text" value="{{ $portfolio['text'] }}" type="hidden" name="text">
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
                                    <label for="avatar">Основное изображение</label>
                                    <div class="input-group">
                                        <input type="file" id="avatar" name="avatar">
                                    </div>
                                    @if ($avatar)
                                        <div class="d-block mt-3 portfolio-gallery__item">
                                            <img src={{ Image::path($avatar) }} />
                                            <button class="position-absolute border-1" type="button" data-action="image"
                                                data-id="{{ $avatar->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    @endif
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

                                <div class="form-group">
                                    @if ($images)
                                        <div class="portfolio-gallery row">
                                            @foreach ($images as $key => $image)
                                                <div class="portfolio-gallery__item mb-3 mr-2 position-relative"
                                                    style="max-width: 152px">

                                                    <button class="position-absolute border-1" type="button"
                                                        data-action="image" data-id="{{ $image->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>

                                                    <img src={{ Image::path($image, 'small') }} width="152px" />

                                                    <div class="small mt-1">
                                                        <label>
                                                            <span class="mr-1">Порядок:</span>
                                                            <input type="text" class="w-25"
                                                                value="{{ $image->sort }}"
                                                                name="edit_images[{{ $image->id }}][sort]">
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div class="portfolio-gallery row">

                                        <div class="portfolio-gallery__item"
                                            style="background-color: blue; width: 150px; height: 100px">1
                                            <div
                                                style="background-color: gray; width: 100px; height: 75px; pointer-events: none;">
                                            </div>
                                        </div>
                                        <div class="portfolio-gallery__item"
                                            style="background-color: green; width: 150px; height: 100px">2
                                            <img src="/storage/upload/portfolio_image/6/1286/sizes/small_p1220997.jpg"
                                                alt="" width="80px" height="auto">
                                        </div>
                                        <div class="portfolio-gallery__item"
                                            style="background-color: red; width: 150px; height: 100px">3
                                        </div>

                                        <div class="w-100">
                                            <button class="mt-2" type="button">Sort</button>
                                            <button class="mt-2 sort-save-button" type="button">Save</button>
                                            <button class="mt-2" type="button">Cancel</button>
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
                            <x-input type="text" class="form-control" id="title" name="title"
                                value="{{ $seo['title'] }}" />
                        </div>
                        <div class="form-group">
                            <label for="description">meta:Description</label>
                            <textarea id="description" class="form-control" rows="3" name="description">{{ $seo['description'] }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="keywords">meta:Keywords</label>
                            <textarea id="keywords" class="form-control" rows="3" name="keywords">{{ $seo['keywords'] }}</textarea>
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
                                    <x-input type="text" class="form-control" id="url" name="url"
                                        value="{{ $portfolio['url'] }}" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sort_key">Ключ сортировки</label>
                                    <x-input type="text" class="form-control" id="sort_key" name="sort_key"
                                        value="{{ $portfolio['sort_key'] }}" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Статус</label>
                                    <select class="form-control" name="status">
                                        <option value="1" {{ $portfolio['status'] == 1 ? 'selected' : '' }}>
                                            Включено</option>
                                        <option value="0" {{ $portfolio['status'] == 0 ? 'selected' : '' }}>
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
                    <a href={{ route('admin.portfolio.destroy', ['id' => $portfolio['id']]) }}
                        class="btn btn-block btn-danger btn-lg">
                        Удалить
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <a href={{ url()->previous() }} type="button" class="btn btn-block btn-outline-primary btn-lg">
                        Назад
                    </a>
                </div>
            </div>
        </div>
        </form>
        </div>
    </section>
@endsection
