@extends('admin.layouts.main')

@section('title', 'Пользователи')

@section('content')
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <a href={{ route('admin.users.create') }} type="button" class="btn btn-block btn-primary btn-lg">
                                Добавить пользователя
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
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th class="w-50">Имя пользователя</th>
                                        <th class="w-50">Электронная почта</th>
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
                                            <td>
                                                {{ $user['email'] }}
                                            </td>
                                            <td>{{ $user['updated_at'] }}</td>
                                            <td>
                                                {{-- @if ($user['status'] == 1) --}}
                                                <i class="fas fa-eye"></i>
                                                {{-- @else --}}
                                                {{-- <i class="fas fa-eye-slash"></i> --}}
                                                {{-- @endif --}}
                                            </td>
                                            <td>
                                                <a href={{ route('admin.users.destroy', ['id' => $user['id']]) }}
                                                    rel="nofollow">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
