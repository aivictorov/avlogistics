<aside class="aside">
    <div class="aside__header">
        Типы погрузок
    </div>
    <ul class="aside__blocks-list">
        @foreach ($sections as $section)
            <li>
                <a href="/portfolio#type-{{ $section['url'] }}">{{ $section['name'] }}</a>
                <span class="aside__blocks-count">({{ count($section['items']) }})</span>
            </li>
        @endforeach
    </ul>

    @include('site.blocks.order-button')

</aside>
