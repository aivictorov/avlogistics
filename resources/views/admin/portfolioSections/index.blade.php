@extends('admin.layouts.main')

@section('title', 'Все категории портфолио')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <x-errors />
            <x-notice />

            <a href={{ route('admin.portfolioSections.create') }} class="btn btn-primary btn-lg mb-3">
                Добавить категорию
            </a>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
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
                                @foreach ($sections as $section)
                                    <tr>
                                        <td>{{ $section['id'] }}</td>
                                        <td>
                                            <a href={{ route('admin.portfolioSections.edit', ['id' => $section['id']]) }}>
                                                {{ $section['name'] }}
                                            </a>
                                        </td>
                                        <td>{{ $section['create_date']->format('Y-m-d') }}</td>
                                        <td>{{ $section['update_date']->format('Y-m-d') }}</td>
                                        <td>
                                            @if ($section['status'] == 1)
                                                <i class="fas fa-eye"></i>
                                            @else
                                                <i class="fas fa-eye-slash"></i>
                                            @endif

                                            <a class="d-inline-block ml-2"
                                                href={{ route('admin.portfolioSections.destroy', ['id' => $section['id']]) }}
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
    </section>
@endsection
