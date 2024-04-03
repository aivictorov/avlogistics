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
                                    @foreach ($faq_categories as $faq_category)
                                        <tr>
                                            <td>{{ $faq_category['id'] }}</td>
                                            <td>
                                                <a href={{ route('admin.faq.edit', ['id' => $faq_category['id']]) }}>
                                                    {{ $faq_category['name'] }}
                                                </a>
                                            </td>
                                            <td>{{ $faq_category['update_date'] }}</td>
                                            <td>
                                                @if ($faq_category['status'] == 1)
                                                    <i class="fas fa-eye"></i>
                                                @else
                                                    <i class="fas fa-eye-slash"></i>
                                                @endif
                                            </td>
                                            <td>
                                                <a href={{ route('admin.portfolioSections.destroy', ['id' => $faq_category['id']]) }}
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
