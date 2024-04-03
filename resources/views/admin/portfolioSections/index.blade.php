@extends('admin.layouts.main')

@section('title', 'Все категории портфолио')

@section('content')
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-2">
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <a href={{ route('admin.portfolioSections.create') }} type="button"
                                class="btn btn-block btn-primary btn-lg">
                                Добавить категорию
                            </a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th class="w-50">Наименование</th>
                                    <th>Дата изменения</th>
                                    <th>Статус</th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td><input id="search" class="form-control float-right" placeholder="Поиск"></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                @foreach ($sections as $section)
                                    <tr>
                                        <td>{{ $section['id'] }}</td>
                                        <td>
                                            <a href={{ route('admin.portfolioSections.edit', ['id' => $section['id']]) }}>
                                                {{ $section['name'] }}
                                            </a>
                                        </td>
                                        <td>{{ $section['update_date'] }}</td>
                                        <td>
                                            @if ($section['status'] == 1)
                                                <i class="fas fa-eye"></i>
                                            @else
                                                <i class="fas fa-eye-slash"></i>
                                            @endif
                                        </td>
                                        <td>
                                            <a href={{ route('admin.portfolioSections.destroy', ['id' => $section['id']]) }}
                                                rel="nofollow">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
