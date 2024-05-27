@extends('admin.layouts.main')

@section('title', 'Все контекстные галереи')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <x-errors />
            <x-notice />

            <a href={{ route('admin.galleries.create') }} class="btn btn-primary btn-lg mb-3">
                Добавить галерею
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
                                    @foreach ($galleries as $gallery)
                                        <tr>
                                            <td>{{ $gallery['id'] }}</td>
                                            <td>
                                                <a href={{ route('admin.galleries.edit', ['id' => $gallery['id']]) }}>
                                                    {{ $gallery['name'] }}
                                                </a>
                                            </td>
                                            <td>{{ $gallery['create_date']->format('Y-m-d') }}</td>
                                            <td>{{ $gallery['update_date']->format('Y-m-d') }}</td>
                                            <td>
                                                @if ($gallery['status'] == 1)
                                                    <a href={{ route('admin.galleries.publish', ['id' => $gallery['id'], 'published' => false]) }}
                                                        onclick="return check()">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                @else
                                                    <a href={{ route('admin.galleries.publish', ['id' => $gallery['id'], 'published' => true]) }}
                                                        onclick="return check()">
                                                        <i class="fas fa-eye-slash"></i>
                                                    </a>
                                                @endif

                                                <a class="d-inline-block ml-2"
                                                    href={{ route('admin.galleries.destroy', ['id' => $gallery['id']]) }}
                                                    onclick="return check()">
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
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center">
                    {{ $galleries->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
