@extends('admin.layouts.main')

@section('title', 'Панель управления')

@section('content')
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-6 mb-3">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $pages_count }}</h3>
                            <p>Страниц сайта</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href={{ route('admin.pages.index') }} class="small-box-footer">Открыть список <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6 mb-3">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $portfolio_count }}</h3>
                            <p>Галереи портфолио в <b>{{ $portfolio_section_count }} категориях</b></p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href={{ route('admin.portfolio.index') }} class="small-box-footer">Открыть список <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6 mb-3">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $questions_count }}</h3>
                            <p>Ответов на вопросы в <b>{{ $faq_count }} темах</b></p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href={{ route('admin.faq.index') }} class="small-box-footer">Открыть список <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6 mb-3">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $users_count }}</h3>
                            <p>Пользователей</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href={{ route('admin.users.index') }} class="small-box-footer">Открыть список <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
