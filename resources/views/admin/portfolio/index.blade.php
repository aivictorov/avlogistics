@extends('admin.layouts.main')

@section('title', 'Все страницы портфолио')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <x-errors />
                    <x-notice />
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-md-2">
                    <div class="card">
                        <a href={{ route('admin.portfolio.create') }} type="button" class="btn btn-block btn-primary btn-lg">
                            Добавить страницу
                        </a>
                    </div>
                </div>
            </div> --}}

            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-header">
                            <a href={{ route('admin.portfolio.create') }} type="button" class="btn btn-primary">
                                Добавить страницу
                            </a>
                            <div class="card-tools">
                                <ul class="pagination pagination-sm float-right">
                                    <li class="page-item"><a class="page-link" href="#">«</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">»</a></li>
                                </ul>
                            </div>
                        </div>


                        <div class="card-body table-responsive p-0">
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
                                    @foreach ($portfolioItems as $item)
                                        <tr>
                                            <td>{{ $item['id'] }}</td>
                                            <td>
                                                <a href={{ route('admin.portfolio.edit', ['id' => $item['id']]) }}>
                                                    {{ $item['name'] }}
                                                </a>
                                            </td>
                                            <td>{{ $item['update_date']->format('Y-m-d') }}</td>
                                            <td>
                                                @if ($item['status'] == 1)
                                                    <i class="fas fa-eye"></i>
                                                @else
                                                    <i class="fas fa-eye-slash"></i>
                                                @endif
                                            </td>
                                            <td>
                                                <a href={{ route('admin.portfolio.destroy', ['id' => $item['id']]) }}
                                                    rel="nofollow">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>



                            {{-- <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Reason</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" name="table_search" class="form-control float-right"
                                                placeholder="ID">
                                        </td>
                                        <td>
                                            <input type="text" name="table_search" class="form-control float-right"
                                                placeholder="User">
                                        </td>
                                        <td>
                                            <input type="text" name="table_search" class="form-control float-right"
                                                placeholder="Date">
                                        </td>
                                        <td>
                                            <input type="text" name="table_search" class="form-control float-right"
                                                placeholder="Status">
                                        </td>
                                        <td>
                                            <input type="text" name="table_search" class="form-control float-right"
                                                placeholder="Reason">
                                        </td>
                                    </tr>
                                    @foreach ($portfolioItems as $item)
                                        <tr>
                                            <td>{{ $item['id'] }}</td>
                                            <td>{{ $item['name'] }}</td>
                                            <td>11-7-2014</td>
                                            <td><span class="tag tag-success">Approved</span></td>
                                            <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table> --}}
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
