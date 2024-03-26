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


{{-- @foreach ($tree[array_key_first($tree)]['children'][3]['children'] as $header)
<div class="subnav-blocks-column subnav-blocks-column--1">
    <div class="subnav-column-header">
        <a href="#!">{{ $header['name'] }}</a>
    </div>
    <ul class="subnav-list-menu">
        @if (isset($header['children']))
            @foreach ($header['children'] as $child)
                <li><a href="#!">{{ $child['name'] }}</a></li>
            @endforeach
        @endif
    </ul>
</div>
@endforeach --}}