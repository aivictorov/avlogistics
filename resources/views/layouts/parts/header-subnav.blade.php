<section class="subnav js-subnav-blocks">
    <div class="subnav-block subnav-block--about js-subnav-blocks__block js-subnav-blocks__block--about">
        <div class="container">
            <a class="subnav-block__close js-subnav-blocks__close" href="#">закрыть</a>

            <div class="subnav-block__header">
                <h2>{{ $tree[array_key_first($tree)]['children'][2]['name'] }}</h2>
                <a href={{ route('pages.show', $tree[array_key_first($tree)]['children'][2]['url']) }}>В раздел</a>
            </div>

            <div class="subnav-block__columns">
                @foreach ($tree[array_key_first($tree)]['children'][2]['children'] as $header)
                    <div class="subnav-column">
                        <div class="subnav-column__header">
                            <a href={{ route('pages.show', $header['url']) }}>{{ $header['name'] }}</a>
                        </div>
                        @if (isset($header['children']))
                            <ul class="subnav-column__list-menu">
                                @foreach ($header['children'] as $child)
                                    <li><a href={{ route('pages.show', $child['url']) }}>{{ $child['name'] }}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    <div class="subnav-block subnav-block--zhd js-subnav-blocks__block js-subnav-blocks__block--zhd">
        <div class="container">
            <a class="subnav-block__close js-subnav-blocks__close" href="#">закрыть</a>
            <div class="subnav-block__header">
                <h2>{{ $tree[array_key_first($tree)]['children'][3]['name'] }}</h2>
                <a href={{ route('pages.show', $tree[array_key_first($tree)]['children'][3]['url']) }}>В раздел</a>
            </div>
            <div class="subnav-block__columns">
                @foreach ($tree[array_key_first($tree)]['children'][3]['children'] as $header)
                    <div class="subnav-column subnav-column">
                        <div class="subnav-column__header">
                            <a href={{ route('pages.show', $header['url']) }}>{{ $header['name'] }}</a>
                        </div>
                        @if (isset($header['children']))
                            <ul class="subnav-column__list-menu">
                                @foreach ($header['children'] as $child)
                                    <li><a href={{ route('pages.show', $child['url']) }}>{{ $child['name'] }}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="subnav-block subnav-block--scheme js-subnav-blocks__block js-subnav-blocks__block--scheme">
        <div class="container">
            <a class="subnav-block__close js-subnav-blocks__close" href="#">закрыть</a>
            <div class="subnav-block__header">
                <h2>{{ $tree[array_key_first($tree)]['children'][4]['name'] }}</h2>
                <a href={{ route('pages.show', $tree[array_key_first($tree)]['children'][4]['url']) }}>В раздел</a>
            </div>
            <div class="subnav-block__columns">
                @foreach ($tree[array_key_first($tree)]['children'][4]['children'] as $header)
                    <div class="subnav-column">
                        <div class="subnav-column__header">
                            <a href={{ route('pages.show', $header['url']) }}>{{ $header['name'] }}</a>
                        </div>
                        @if (isset($header['children']))
                            <ul class="subnav-column__list-menu">
                                @foreach ($header['children'] as $child)
                                    <li><a href={{ route('pages.show', $child['url']) }}>{{ $child['name'] }}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="subnav-block subnav-block--contacts js-subnav-blocks__block js-subnav-blocks__block--contacts">
        <div class="container">
            <a class="subnav-block__close js-subnav-blocks__close" href="#">закрыть</a>
            <div class="subnav-block__header">
                <h2>{{ $tree[array_key_first($tree)]['children'][5]['name'] }}</h2>
                <a href={{ route('pages.show', $tree[array_key_first($tree)]['children'][5]['url']) }}>В раздел</a>
            </div>
            <div class="subnav-block__columns">
                <div class="subnav-column">
                    <div class="subnav-column__header subnav-column__header--gray">
                        Офис компании
                    </div>
                    <div class="subnav-column__text">
                        Адрес офиса: <br>
                        191119, г. Санкт-Петербург, Звенигородская ул., д. 22, лит. А, офис 134 <br><br>
                        Тел.: +7 (812) 642-26-40 <br>
                        E-mail: <a href="mailto:info@zhd.su">info@zhd.su</a><br>
                    </div>
                </div>
                <div class="subnav-column">
                    <div class="subnav-column__header subnav-column__header--gray">
                        Организация перевозок грузов
                    </div>
                    <div class="subnav-column__text">
                        По вопросам, связанным с организацией перевозок грузов железнодорожным транспортом: <br><br>
                        Тел.: +7 (812) 642-26-40, +7 (812) 951-29-84 <br>
                        E-mail: <a href="mailto:info@zhd.su">info@zhd.su</a><br>
                    </div>
                </div>
                <div class="subnav-column">
                    <div class="subnav-column__header subnav-column__header--gray">
                        Разработка схем погрузки
                    </div>
                    <div class="subnav-column__text">
                        По вопросам, связанным с разработкой и согласованием схем размещения и крепления грузов:
                        <br><br>
                        Тел.: +7 (812) 642-26-40 <br>
                        E-mail: <a href="mailto:projects@zhd.su">projects@zhd.su</a><br>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
