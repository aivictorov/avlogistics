@extends('layouts.main')

@section('content')
    <section class="main-section main-section__container--page">
        <div class="main-section__container main-section__container--aside">
            <article class="aside-page">
                {{-- views/layouts/parts/breadcrumbs --}}
                <h1 class="page-h1">{{ $page->name }}</h1>


                {{-- avatar --}}


                <?php /*
                                        <?php if ($webpage->system_page): ?>
                ?>
                ?>
                <div class="page-nav">
                    <?php foreach ($webpage->children as $i => $child): ?>

                    <div class="subnav-column-header">
                        <?= Html::a($child->name, ['site/page', 'url' => $child->url]) ?>
                    </div>
                    <?php if ($child->children): ?>
                    <ul class="subnav-list-menu">
                        <?php foreach($child->children as $subchild): ?>
                        <li><?= Html::a($subchild->name, ['site/page', 'url' => $subchild->url]) ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>

                    <?php endforeach; ?>
                </div>
                <?php endif; ?> */ ?>

                <div class="page-content">
                    {!! $page->text !!}
                </div>

            </article>

            {{-- parts/aside-page --}}
        </div>
    </section>
@endsection
