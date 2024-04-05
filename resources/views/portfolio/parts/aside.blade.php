<aside class="main-aside">
    <div class="aside-header">
        Типы погрузок
    </div>
    <ul class="aside-sections">
        @foreach ($sections as $section)
            <li>
                <a href="/portfolio#type-{{ $section['url'] }}">{{ $section['name'] }}</a>
                <span class="aside-section-count">(1)</span>
            </li>
        @endforeach
    </ul>
    <a href="{{ route('contactForm') }}" class="main-aside__send-form">Рассчитать стоимость</a>
    {{-- <a href="{{ route('contactForm') }}" class="js-form-open main-aside__send-form">Рассчитать стоимость</a> --}}
</aside>
