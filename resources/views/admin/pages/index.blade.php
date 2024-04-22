@extends('admin.layouts.main')

@section('title', 'Все страницы')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <a href={{ route('admin.pages.create') }} type="button" class="btn btn-block btn-primary btn-lg">
                                Добавить страницу
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th class="w-50">Наименование</th>
                                        <th>Дата изменения</th>
                                        <th>Статус</th>
                                        <th>Защита</th>
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
                                        <td></td>
                                    </tr>
                                    @foreach ($pages as $page)
                                        <tr>
                                            <td>{{ $page['id'] }}</td>
                                            <td>
                                                <a href={{ route('admin.pages.edit', ['id' => $page['id']]) }}>
                                                    {{ $page['name'] }}
                                                </a>
                                            </td>
                                            <td>{{ $page['update_date'] }}</td>
                                            <td>
                                                @if ($page['status'] == 1)
                                                    <i class="fas fa-eye"></i>
                                                @else
                                                    <i class="fas fa-eye-slash"></i>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($page['system_page'] == 0)
                                                    <i class="fas fa-lock-open"></i>
                                                @else
                                                    <i class="fas fa-lock"></i>
                                                @endif
                                            </td>
                                            <td>
                                                <a href={{ route('admin.pages.destroy', ['id' => $page['id']]) }}
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
        </div>
    </section>
@endsection
