@extends('admin.layouts.main')

@section('title', 'FAQ')

@section('content')
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-2">
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <a href={{ route('admin.faq.create') }} type="button"
                                class="btn btn-block btn-primary btn-lg">
                                Добавить страницу
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
                                    @foreach ($faq_categories as $item)
                                        <tr>
                                            <td>{{ $item['id'] }}</td>
                                            <td>{{ $item['name'] }}</td>
                                            <td>11-7-2014</td>
                                            <td><span class="tag tag-success">Approved</span></td>
                                            <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
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
