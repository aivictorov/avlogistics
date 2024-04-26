@extends('admin.layouts.main')

@section('title', 'Все страницы портфолио')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <x-errors />
            <x-notice />

            <a href={{ route('admin.portfolio.create') }} class="btn btn-primary btn-lg mb-3">
                Добавить портфолио
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
                                    @foreach ($portfolioItems as $item)
                                        <tr>
                                            <td>{{ $item['id'] }}</td>
                                            <td>
                                                <a href={{ route('admin.portfolio.edit', ['id' => $item['id']]) }}>
                                                    {{ $item['name'] }}
                                                </a>
                                            </td>
                                            <td>{{ $item['create_date']->format('Y-m-d') }}</td>
                                            <td>{{ $item['update_date']->format('Y-m-d') }}</td>
                                            <td>
                                                @if ($item['status'] == 1)
                                                    <i class="fas fa-eye"></i>
                                                @else
                                                    <i class="fas fa-eye-slash"></i>
                                                @endif

                                                <a class="d-inline-block ml-2"
                                                    href={{ route('admin.portfolio.destroy', ['id' => $item['id']]) }}
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
        </div>
    </section>
@endsection
