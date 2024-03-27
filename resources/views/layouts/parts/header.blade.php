<header class="main-header js-main-header">
    <div class="main-header__container">
        <a href="/" class="logo"><img src="/images/logo@2x.png"></a>

        @include('layouts.parts.header-nav', ['type' => 'main'])

        <div class="main-nav__phones">
            +7 (812) <span>642-26-40</span>, +7 (812) <span>951-29-85</span>
        </div>
        <div class="main-nav__soc">
            <a class="main-nav__soc-icon main-nav__soc-icon--at" href="mailto:info@zhd.su">Обратная связь</a>
        </div>
    </div>
</header>

<div class="top-header js-top-header">
    <div class="top-header__in">
        <a href="/" class="top-logo"><img src="/images/logo_min.png"></a>
        
        @include('layouts.parts.header-nav', ['type' => 'top'])

    </div>
</div>


@include('layouts.parts.header-subnav')
