<aside class="main-aside">
    @foreach ($tree as $menu)
        @foreach ($menu['children'] as $header)
            <div class="aside-header">
                <a href="#!">{{ $header['name'] }}</a>
            </div>
            @if (isset($header['children']))
                @foreach ($header['children'] as $child)
                    <div class="aside-block-header">
                        <a href="#!">{{ $child['name'] }}</a>
                    </div>
                    <ul class="aside-block-list-menu">
                        @if (isset($child['children']))
                            @foreach ($child['children'] as $subchild)
                                <li>
                                    <a href="#!">{{ $subchild['name'] }}</a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                @endforeach
            @endif
        @endforeach
    @endforeach
</aside>