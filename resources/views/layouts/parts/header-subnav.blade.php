<section class="subnav-blocks js-subnav-blocks">
    <div class="subnav-blocks__block js-subnav-blocks__block subnav-blocks__block--zhd js-subnav-blocks__block--about">
        <div class="subnav-blocks__block_in">
            <a class="subnav-blocks__close js-subnav-blocks__close" href="#">закрыть</a>
            <div class="subnav-block-header">
                <h2>{{ $tree[array_key_first($tree)]['children'][2]['name'] }}</h2>
                <a href={{ route('pages.show', $tree[array_key_first($tree)]['children'][2]['url']) }}>В раздел</a>
            </div>
            <div class="subnav-blocks-columns subnav-blocks-columns--about">
                <div class="subnav-blocks-column subnav-blocks-column--1">
                    @foreach ($tree[array_key_first($tree)]['children'][2]['children'] as $header)
                        <div class="subnav-column-header">
                            <a href={{ route('pages.show', $header['url']) }}>{{ $header['name'] }}</a>
                        </div>
                        @if (isset($header['children']))
                            <ul class="subnav-list-menu">
                                @foreach ($header['children'] as $child)
                                    <li><a href={{ route('pages.show', $child['url']) }}>{{ $child['name'] }}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    @endforeach
                </div>

                <div class="subnav-blocks-column subnav-blocks-column--2">
                    <div class="subnav-column-header subnav-column-header--blog">
                        Записи в <a href="/blog/">блоге</a>
                    </div>
                    <div class="subnav-blog-block">
                        <div class="subnav-blog-block__item">
                            <a href="/blog/perevozka-stroitelnoy-tehniki-zhd-transportom/">Перевозка строительной
                                техники железнодорожным транспортом</a><span class="subnav-blog-block__item-date"> 23 /
                                05 / 2017</span>
                        </div>
                    </div>
                </div>

                <div class="subnav-blocks-column subnav-blocks-column--3">
                    <div class="subnav-column-header subnav-column-header--portfolio">
                        <a href="/portfolio/">Портфолио</a>
                    </div>
                    <div class="subnav-portfolio">
                        <div class="subnav-portfolio__in js-subnav-portfolio-slider" data-count="10">
                            <div class="subnav-portfolio__item">
                                <a href="/portfolio/zhd-perevozka-burovoy-ustanovki-bauer-bg20h/">
                                    <img class="subnav-porfolio__image"
                                        src="/upload/portfolio_avatar/124/1993/sizes/header_1.jpg"
                                        alt="Перевозка буровой установки Bauer BG20H">
                                </a>
                            </div>
                            <div class="subnav-portfolio__item">
                                <a href="/portfolio/zhd-perevozka-drobilki-metso-lokotrack-lt1213/">
                                    <img class="subnav-porfolio__image"
                                        src="/upload/portfolio_avatar/123/1978/sizes/header_p1430784.jpg"
                                        alt="Перевозка дробилки Metso Lokotrack LT1213 ">
                                </a>
                            </div>
                            <div class="subnav-portfolio__item">
                                <a href="/portfolio/zhd-perevozka-metallicheskoy-estakady/">
                                    <img class="subnav-porfolio__image"
                                        src="/upload/portfolio_avatar/122/1950/sizes/header_dsc00227.jpg"
                                        alt="Перевозка металлической эстакады">
                                </a>
                            </div>
                            <div class="subnav-portfolio__item">
                                <a href="/portfolio/zhd-perevozka-ekskavatorov-komatsu-pc210-i-komatsu-pw140/">
                                    <img class="subnav-porfolio__image"
                                        src="/upload/portfolio_avatar/121/1886/sizes/header_dsc00329.jpg"
                                        alt="Перевозка экскаваторов Komatsu PC210 и Komatsu PW140">
                                </a>
                            </div>
                            <div class="subnav-portfolio__item">
                                <a href="/portfolio/zhd-perevozka-parovyh-kotlov-tt200/">
                                    <img class="subnav-porfolio__image"
                                        src="/upload/portfolio_avatar/120/1860/sizes/header_dsc08845.jpg"
                                        alt="Перевозка паровых котлов ТТ200">
                                </a>
                            </div>
                            <div class="subnav-portfolio__item">
                                <a href="/portfolio/perevozka-konteynernyh-avtozapravochnyh-stanciy/">
                                    <img class="subnav-porfolio__image"
                                        src="/upload/portfolio_avatar/119/1852/sizes/header_dsc00232.jpg"
                                        alt="Перевозка контейнерных автозаправочных станций">
                                </a>
                            </div>
                            <div class="subnav-portfolio__item">
                                <a href="/portfolio/zhd-perevozka-traktorov-kirovec-k-704/">
                                    <img class="subnav-porfolio__image"
                                        src="/upload/portfolio_avatar/118/1831/sizes/header_dsc00089.jpg"
                                        alt="Перевозка тракторов Кировец К-704">
                                </a>
                            </div>
                            <div class="subnav-portfolio__item">
                                <a href="/portfolio/zhd-perevozka-traktora-john-deere-9410r/">
                                    <img class="subnav-porfolio__image"
                                        src="/upload/portfolio_avatar/107/1387/sizes/header_img_0065.jpg"
                                        alt="Перевозка трактора John Deere 9410R">
                                </a>
                            </div>
                            <div class="subnav-portfolio__item">
                                <a href="/portfolio/zhd-perevozka-ekskavatorov-hitachi-zx240/">
                                    <img class="subnav-porfolio__image"
                                        src="/upload/portfolio_avatar/101/1121/sizes/header_p1350322.jpg"
                                        alt="Перевозка экскаваторов Hitachi ZX240">
                                </a>
                            </div>
                            <div class="subnav-portfolio__item">
                                <a href="/portfolio/zhd-perevozka-ekskavatora-volvo-ec460/">
                                    <img class="subnav-porfolio__image"
                                        src="/upload/portfolio_avatar/98/952/sizes/header_p1350354.jpg"
                                        alt="Перевозка экскаватора Volvo EC460">
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="subnav-column__porfolio-arrows" unselectable="on">
                        <span class="subnav-column__porfolio-arrows_right js-subnav_porfolio-arrows_right">&gt;</span>
                        <span class="subnav-column__porfolio-arrows_left js-subnav_porfolio-arrows_left">&lt;</span>
                    </div>
                    <div class="subnav-column__porfolio-text">
                        Ознакомьтесь с <a href="/portfolio/">портфолио</a> железнодорожных перевозок
                    </div>
                </div>

            </div>
        </div>
    </div>

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
                        @if (isset($header['children']))
                            <ul class="subnav-list-menu">
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
                        @if (isset($header['children']))
                            <ul class="subnav-list-menu">
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
