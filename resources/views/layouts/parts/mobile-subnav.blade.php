<section class="mobile-subnav js-mobile-subnav">
    <div class="mobile-subnav-block js-mobile-subnav-block">
        <div class="container">
            <a class="mobile-subnav-block__close js-mobile-subnav-block__close" href="#">закрыть</a>
            <div class="mobile-subnav-block__columns">
                @for ($i = 2; $i < 6; $i++)
                    <div class="mobile-subnav-column">
                        <div class="mobile-subnav-block__header">
                            <a href={{ route('pages.show', $tree[array_key_first($tree)]['children'][$i]['url']) }}>
                                <h2>{{ $tree[array_key_first($tree)]['children'][$i]['name'] }}</h2>
                            </a>
                        </div>

                        @if (isset($tree[array_key_first($tree)]['children'][$i]['children']))
                            @foreach ($tree[array_key_first($tree)]['children'][$i]['children'] as $header)
                                <div class="mobile-subnav-column__header">
                                    <a href={{ route('pages.show', $header['url']) }}>{{ $header['name'] }}</a>
                                    @if (isset($header['children']))
                                        <button type="button" class="js-forward-button">-----></button>
                                    @endif
                                </div>

                                @if (isset($header['children']))
                                    <ul class="mobile-subnav-column__list-menu">
                                        @foreach ($header['children'] as $child)
                                            <li><a
                                                    href={{ route('pages.show', $child['url']) }}>{{ $child['name'] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            @endforeach
                        @endif
                    </div>
                @endfor

                <div class="mobile-subnav-column">
                    <div class="mobile-subnav-block__header">
                        <a href={{ route('portfolio.index') }}>
                            <h2>Портфолио</h2>
                        </a>
                    </div>
                </div>
            </div>

            <div class="mobile-subnav-contacts">
                <div class="mobile-subnav__phones">
                    <div class="header__phone-main">
                        +7 (812) <span>642-26-40</span>
                    </div>
                    <div class="header__phone-main">
                        +7 (812) <span>951-29-84</span>
                    </div>
                </div>
                <a href="mailto:info@zhd.su">
                    info@zhd.su
                </a>
                <button class="button">
                    Перезвоните мне
                </button>
            </div>

        </div>
    </div>
</section>
