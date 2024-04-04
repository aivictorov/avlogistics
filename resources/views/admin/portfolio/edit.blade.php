@extends('admin.layouts.main')

@section('title', 'Редактировать страницу портфолио')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <form action={{ route('admin.portfolio.store') }} method="post" enctype="multipart/form-data">
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
                                        value="{{ $portfolio['name'] }}" />
                                </div>
                                <div class="form-group">
                                    <label for="h1">Заголовок</label>
                                    <x-input type="text" class="form-control" id="h1" name="h1"
                                        value="{{ $portfolio['h1'] }}" />
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
                                    <label for="image">Основное изображение</label>
                                    <div class="input-group">
                                        <input type="file" id="image" name="image">
                                    </div>
                                    @if ($image_path)
                                        <div class="d-block mt-3">
                                            <img src={{ $image_path }} />
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
                                    @if ($gallery)
                                        @foreach ($gallery as $image_path)
                                            <div class="d-inline-block mt-1">
                                                <img src={{ $image_path }} />
                                            </div>
                                        @endforeach
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
                                <h3 class="card-title">SEO</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <x-input type="text" class="form-control" id="title" name="url" value="{{ $seo['title'] }}" />
                                </div>
                                <div class="form-group">
                                    <label for="meta_keywords">meta:Description</label>
                                    <textarea id="meta_description" class="form-control" rows="3" name="text">{{ $seo['description'] }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="meta_keywords">meta:Keywords</label>
                                    <textarea id="meta_keywords" class="form-control" rows="3" name="text">{{ $seo['keywords'] }}</textarea>
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
                                class="btn btn-block btn-danger btn-lg">Удалить</a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <a href={{ url()->previous() }} type="button"
                                class="btn btn-block btn-outline-primary btn-lg">Назад</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
