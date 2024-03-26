<nav class="main-nav">
    <ul>
        {{-- @foreach ($menu as $item)
            <li>
                <a class="js-subnav-opener js-subnav-opener-portfolio"
                    href="{{ route('pages.show', $item->url) }}">{{ $item->name }}</a>
            </li>
        @endforeach --}}

        <li>
            <a class="js-subnav-opener js-subnav-opener-zhd" href="{{ route('pages.show', 'zhd-perevozki') }}">ЖД
                перевозки</a>
        </li>
        <li>

            <a class="js-subnav-opener js-subnav-opener-scheme" href="{{ route('pages.show', 'shemy-pogruzki') }}">Схемы
                погрузки</a>
        </li>
        <li>
            <a class="js-subnav-opener js-subnav-opener-portfolio"
                href="{{ route('pages.show', 'portfolio') }}">Портфолио</a>
        </li>
        <li>
            <a class="js-subnav-opener js-subnav-opener-contacts"
                href="{{ route('pages.show', 'kontakty') }}">Контакты</a>
        </li>
    </ul>
</nav>
