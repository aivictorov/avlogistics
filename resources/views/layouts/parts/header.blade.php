<div class="header__test">
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
</div>

<header class="header js-main-header">
    <div class="container">
        <div class="header__row">
            <div class="header__left">
                <div class="header__logo">
                    <a href="/" class="logo"><img src="/images/logo/logo@2x.png"></a>
                </div>
            </div>
            <div class="header__right">
                <div class="header__contacts">
                    <div class="header__phones">
                        <div class="header__phone-main">
                            +7 (812) <span>642-26-40</span>
                        </div>
                        <div class="header__phone-add">
                            , +7 (812) <span>951-29-84</span>
                        </div>
                    </div>
                    <div class="header__social">
                        <a class="header__social-icon header__social-icon--at" href="mailto:info@zhd.su">
                            Обратная связь
                        </a>
                    </div>
                </div>
                <div class="header__nav">
                    @include('layouts.parts.header-nav', ['type' => 'main'])
                </div>
                <div class="header__mobile-nav">
                    @include('layouts.parts.mobile-nav')
                </div>
            </div>
        </div>
    </div>

    @include('layouts.parts.header-subnav')

    @include('layouts.parts.mobile-subnav')
</header>

<div class="top-header js-top-header">
    <div class="top-header__in">
        <a href="/" class="top-logo"><img src="/images/logo/logo_min.png"></a>

        @include('layouts.parts.header-nav', ['type' => 'top'])

    </div>
</div>
