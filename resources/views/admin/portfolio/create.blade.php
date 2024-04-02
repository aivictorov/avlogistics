@extends('admin.layouts.main')

@section('title', 'Добавить страницу портфолио')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Заполните форму</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action={{ route('admin.portfolio.store') }} method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Название</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="form-group">
                                    <label>Категория</label>
                                    <select class="form-control">
                                        @foreach ($sections as $section)
                                            <option value={{ $section['id']  }}>{{ $section['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="url">URL</label>
                                    <input type="text" class="form-control" id="url" name="url">
                                </div>
                                <div class="form-group">
                                    <label for="h1">Заголовок</label>
                                    <input type="text" class="form-control" id="h1" name="h1">
                                </div>
                                <div class="form-group">
                                    <label for="image">Изображение</label>
                                    <div class="input-group">
                                        <input type="file" id="image" name="image">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Текст</label>
                                    <textarea class="form-control" rows="3" name="text"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="sort_key">Ключ сортировки</label>
                                    <input type="text" class="form-control" id="sort_key" name="sort_key">
                                </div>
                                <div class="form-group">
                                    <label for="images">Галерея изображений</label>
                                    <div class="input-group">
                                        <input type="file" id="images" name="images" multiple>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Создать</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
