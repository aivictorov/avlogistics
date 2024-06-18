@extends('admin.layouts.main')

@section('title', 'Все страницы')

@section('content')
    <section class="content">
        <div class="container">
            <x-errors />
            <x-notice />

            <a href={{ route('admin.pages.create') }} class="btn btn-primary btn-lg mb-3">
                Добавить страницу
            </a>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th class="w-50">Наименование</th>
                                        <th>Дата создания</th>
                                        <th>Дата изменения</th>
                                        <th>Действия</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <form>
                                                <input class="form-control float-right" name="search" placeholder="Поиск">
                                            </form>
                                        </td>

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
                                            <td>{{ $page['create_date']->format('Y-m-d') }}</td>
                                            <td>{{ $page['update_date']->format('Y-m-d') }}</td>

                                            <td>
                                                @if ($page['system_page'] == 0)
                                                    @if ($page['status'] == 1)
                                                        <a href={{ route('admin.pages.publish', ['id' => $page['id'], 'published' => false]) }}
                                                            onclick="return check()">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    @else
                                                        <a href={{ route('admin.pages.publish', ['id' => $page['id'], 'published' => true]) }}
                                                            onclick="return check()">
                                                            <i class="fas fa-eye-slash"></i>
                                                        </a>
                                                    @endif

                                                    <a class="d-inline-block ml-2"
                                                        href={{ route('admin.pages.destroy', ['id' => $page['id']]) }}
                                                        onclick="return check()">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                @else
                                                    <i class="fas fa-lock"></i>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center">
                    {{ $pages->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
