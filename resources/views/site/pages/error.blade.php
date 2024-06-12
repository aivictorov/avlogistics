@extends('site.layouts.error')

@section('title', 'Страница не найдена')

@section('content')
    <main class="main">
        <div class="container container--flex">
            <div class="column column--main">
                <article class="article">
                    <div class="article__title">
                        <h1 class="h1">Not Found (#404)</h1>
                    </div>
                    <div class="alert alert-danger">
                        Страница не найдена.
                    </div>

                    <div class="article__content">
                        <p>Произошла ошибка в ходе выполнения запроса.</p>
                        <p>По возможности сообщите об обшибке администрации сайта.</p>
                    </div>
                </article>
            </div>
        </div>
    </main>
@endsection
