<aside class="main-aside">
    <div class="aside-header">
        Типы погрузок
    </div>
    <ul class="aside-sections">
        @foreach ($sections as $section)
            <li>
                <a href="/portfolio#type-{{ $section['url'] }}">{{ $section['name'] }}</a>
                <span class="aside-section-count">({{ count($section['items']) }})</span>
            </li>
        @endforeach
    </ul>

    @include('site.parts.calculate-button')

</aside>
