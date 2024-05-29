<div class="mobile-subnav js-mobile-subnav">
    <div class="container">
        <div class="mobile-subnav-block__columns">
            @for ($i = 2; $i <= 3; $i++)
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
                                    <div class="mobile-subnav-column__header-arrow">
                                        <svg class="icon icon--arrow-down">
                                            <use xlink:href="/images/icons/sprite.svg#arrow-down"></use>
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            @if (isset($header['children']))
                                <ul class="mobile-subnav-column__list-menu">
                                    @foreach ($header['children'] as $child)
                                        <li>
                                            <a href={{ route('pages.show', $child['url']) }}>{{ $child['name'] }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        @endforeach
                    @endif
                </div>
            @endfor

            @for ($i = 145; $i <= 145; $i++)
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
                            </div>
                            @if (isset($header['children']))
                                <ul class="mobile-subnav-column__list-menu">
                                    @foreach ($header['children'] as $child)
                                        <li>
                                            <a href={{ route('pages.show', $child['url']) }}>{{ $child['name'] }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        @endforeach
                    @endif
                </div>
            @endfor

            @for ($i = 4; $i <= 4; $i++)
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
                            </div>
                            @if (isset($header['children']))
                                <ul class="mobile-subnav-column__list-menu">
                                    @foreach ($header['children'] as $child)
                                        <li>
                                            <a href={{ route('pages.show', $child['url']) }}>{{ $child['name'] }}</a>
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

            <div class="mobile-subnav-column">
                <div class="mobile-subnav-block__header">
                    <a href={{ route('pages.show', $tree[array_key_first($tree)]['children'][5]['url']) }}>
                        <h2>{{ $tree[array_key_first($tree)]['children'][5]['name'] }}</h2>
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
                    +7 (921) <span>951-29-84</span>
                </div>
            </div>
            <div class="mobile-subnav__email">
                <span>e-mail: </span>
                <a href="mailto:info@zhd.su">
                    info@zhd.su
                </a>
            </div>

            {{-- <button class="button">
                Перезвоните мне
            </button> --}}
        </div>
    </div>
</div>
