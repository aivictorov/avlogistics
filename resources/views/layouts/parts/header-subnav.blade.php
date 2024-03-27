<section class="subnav-blocks js-subnav-blocks">
    <div class="subnav-blocks__block js-subnav-blocks__block subnav-blocks__block--zhd js-subnav-blocks__block--zhd">
        <div class="subnav-blocks__block_in">
            <a class="subnav-blocks__close js-subnav-blocks__close" href="#">закрыть</a>
            <div class="subnav-block-header">
                <h2>{{ $tree[array_key_first($tree)]['children'][3]['name'] }}</h2>
                <a href={{ route('pages.show', $tree[array_key_first($tree)]['children'][3]['url']) }}>В раздел</a>
            </div>
            <div class="subnav-blocks-columns">
                @foreach ($tree[array_key_first($tree)]['children'][3]['children'] as $header)
                    <div class="subnav-blocks-column subnav-blocks-column--1">
                        <div class="subnav-column-header">
                            <a href={{ route('pages.show', $header['url']) }}>{{ $header['name'] }}</a>
                        </div>
                        <ul class="subnav-list-menu">
                            @if (isset($header['children']))
                                @foreach ($header['children'] as $child)
                                    <li><a href={{ route('pages.show', $child['url']) }}>{{ $child['name'] }}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="subnav-blocks__block js-subnav-blocks__block subnav-blocks__block--zhd js-subnav-blocks__block--about">
        <div class="subnav-blocks__block_in">
            <a class="subnav-blocks__close js-subnav-blocks__close" href="#">закрыть</a>
            <div class="subnav-block-header">
                <h2>{{ $tree[array_key_first($tree)]['children'][2]['name'] }}</h2>
                <a href={{ route('pages.show', $tree[array_key_first($tree)]['children'][2]['url']) }}>В раздел</a>
            </div>
            <div class="subnav-blocks-columns">
                @foreach ($tree[array_key_first($tree)]['children'][2]['children'] as $header)
                    <div class="subnav-blocks-column subnav-blocks-column--1">
                        <div class="subnav-column-header">
                            <a href={{ route('pages.show', $header['url']) }}>{{ $header['name'] }}</a>
                        </div>
                        <ul class="subnav-list-menu">
                            @if (isset($header['children']))
                                @foreach ($header['children'] as $child)
                                    <li><a href={{ route('pages.show', $child['url']) }}>{{ $child['name'] }}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="subnav-blocks__block js-subnav-blocks__block subnav-blocks__block--zhd js-subnav-blocks__block--scheme">
        <div class="subnav-blocks__block_in">
            <a class="subnav-blocks__close js-subnav-blocks__close" href="#">закрыть</a>
            <div class="subnav-block-header">
                <h2>{{ $tree[array_key_first($tree)]['children'][4]['name'] }}</h2>
                <a href={{ route('pages.show', $tree[array_key_first($tree)]['children'][4]['url']) }}>В раздел</a>
            </div>
            <div class="subnav-blocks-columns">
                @foreach ($tree[array_key_first($tree)]['children'][4]['children'] as $header)
                    <div class="subnav-blocks-column subnav-blocks-column--1">
                        <div class="subnav-column-header">
                            <a href={{ route('pages.show', $header['url']) }}>{{ $header['name'] }}</a>
                        </div>
                        <ul class="subnav-list-menu">
                            @if (isset($header['children']))
                                @foreach ($header['children'] as $child)
                                    <li><a href={{ route('pages.show', $child['url']) }}>{{ $child['name'] }}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div
        class="subnav-blocks__block js-subnav-blocks__block subnav-blocks__block--contacts js-subnav-blocks__block--contacts">
        <div class="subnav-blocks__block_in">
            <a class="subnav-blocks__close js-subnav-blocks__close" href="#">закрыть</a>
            <div class="subnav-block-header">
                <h2>{{ $tree[array_key_first($tree)]['children'][5]['name'] }}</h2>
                <a href={{ route('pages.show', $tree[array_key_first($tree)]['children'][5]['url']) }}>В раздел</a>
            </div>
            <div class="subnav-blocks-columns">
                <div class="subnav-blocks-column subnav-blocks-column--1">
                    <div class="subnav-column-header">
                        Офис компании
                    </div>
                    <div class="subnav-plain-text">
                        Адрес офиса: <br>
                        191119, г. Санкт-Петербург, Звенигородская ул., д. 22, лит. А, офис 134 <br><br>
                        Тел.: +7 (812) 642-26-40 <br>
                        E-mail: <a href="mailto:info@zhd.su">info@zhd.su</a><br>
                    </div>
                </div>
                <div class="subnav-blocks-column subnav-blocks-column--2">
                    <div class="subnav-column-header">
                        Организация перевозок грузов
                    </div>
                    <div class="subnav-plain-text">
                        По вопросам, связанным с организацией перевозок грузов железнодорожным транспортом: <br><br>
                        Тел.: +7 (812) 642-26-40, +7 (812) 951-29-84 <br>
                        E-mail: <a href="mailto:info@zhd.su">info@zhd.su</a><br>
                    </div>
                </div>
                <div class="subnav-blocks-column subnav-blocks-column--3">
                    <div class="subnav-column-header">
                        Разработка схем погрузки
                    </div>
                    <div class="subnav-plain-text">
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
