@extends('admin.layouts.main')

@section('title', 'Пользователи')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <x-errors />
            <x-notice />

            <a href={{ route('admin.users.create') }} class="btn btn-primary btn-lg mb-3">
                Добавить пользователя
            </a>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th class="w-50">Имя пользователя</th>
                                        <th class="w-25">Электронная почта</th>
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
                                        <td></td>
                                    </tr>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user['id'] }}</td>
                                            <td>
                                                <a href={{ route('admin.users.edit', ['id' => $user['id']]) }}>
                                                    {{ $user['name'] }}
                                                </a>
                                            </td>
                                            <td>{{ $user['email'] }}</td>
                                            <td>{{ $user['created_at']->format('Y-m-d') }}</td>
                                            <td>{{ $user['updated_at']->format('Y-m-d') }}</td>

                                            <td>
                                                @if ($user['status'] == 1)
                                                    <a href={{ route('admin.users.publish', ['id' => $user['id'], 'published' => false]) }}
                                                        onclick="return check()">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                @else
                                                    <a href={{ route('admin.users.publish', ['id' => $user['id'], 'published' => true]) }}
                                                        onclick="return check()">
                                                        <i class="fas fa-eye-slash"></i>
                                                    </a>
                                                @endif

                                                <a class="d-inline-block ml-2"
                                                    href={{ route('admin.users.destroy', ['id' => $user['id']]) }}
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
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
