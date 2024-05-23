{{-- <div class="header__test">
    <div class="container">
        <div class="header__test-contacts">
            <div class="header__phones">
                <div class="header__phone-main">
                    +7 (812) <span>642-26-40</span>
                </div>
                <div class="header__phone-add">
                    , +7 (812) <span>951-29-84</span>
                </div>
            </div>
            <div class="header__social">
                <a href="mailto:info@zhd.su">
                    info@zhd.su
                </a>
            </div>
        </div>
    </div>
</div> --}}

<header class="header js-main-header">
    <div class="container">
        <div class="header__row">
            <div class="header__left">
                @include('site.blocks.logo')

            </div>
            <div class="header__right">
                @include('site.blocks.header-contacts')
                <div class="header__nav">
                    @include('site.blocks.header-nav', ['type' => 'main'])
                </div>
                <div class="header__mobile-nav">
                    @include('site.blocks.mobile-nav')
                </div>
            </div>
        </div>
    </div>

    @include('site.blocks.header-subnav')

    @include('site.blocks.mobile-subnav')
</header>

{{-- <div class="top-header js-top-header">
    <div class="top-header__in">
        <a href="/" class="top-logo"><img src="/images/logo/logo_min.png"></a>

        @include('layouts.parts.header-nav', ['type' => 'top'])

    </div>
</div> --}}
