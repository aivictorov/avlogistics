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
                                <div class="form-group">
                                    <label for="name">Название</label>
                                    <x-input type="text" class="form-control" id="name" name="name"
                                        value="{{ $gallery['name'] }}" />
                                </div>

                                @foreach ($items as $item)
                                    <div class="form-group">
                                        <label for="text">Текст</label>
                                        <x-textarea class="form-control" id="text" name="text">
                                            {{ $item['text'] }}
                                        </x-textarea>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Основное изображение</h3>
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
                                                        data-action="updateAvatar" data-id="{{ $portfolio['id'] }}"
                                                        data-type="portfolio">
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
                </div> --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Галерея изображений</h3>
                                <x-ajaxBadge />
                            </div>
                            <div class="card-body">
                                <div id="portfolio-gallery" class="d-flex mb-3 flex-wrap">
                                    @if (isset($items) && count($items) > 0)
                                        @foreach ($items as $key => $item)
                                            <div class="portfolio-gallery-image mr-2 mt-1 mb-1 d-block position-relative">
                                                <img src={{ Image::path($item['image'], '1_4') }} />
                                            </div>
                                        @endforeach
                                    @endif
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
                            {{-- <a href={{ route('admin.portfolio.destroy', ['id' => $portfolio['id']]) }}
                                class="btn btn-block btn-danger btn-lg">
                                Удалить
                            </a> --}}
                        </div>
                    </div>
                    <div class="col-md-3">
                        {{-- <div class="form-group">
                            <a href={{ route('admin.portfolio.index') }} type="button"
                                class="btn btn-block btn-outline-primary btn-lg">
                                Назад
                            </a>
                        </div> --}}
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
