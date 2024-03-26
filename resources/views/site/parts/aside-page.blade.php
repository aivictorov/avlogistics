<aside class="main-aside">
    @foreach ($tree[array_key_first($tree)]['children'] as $header)
        @if ($header['id'] == $page['id'])
            <div class="aside-header">
                <a href={{ route('pages.show', $header['url']) }}>{{ $header['name'] }}</a>
            </div>
            @if (isset($header['children']))
                @foreach ($header['children'] as $child)
                    <div class="aside-block-header">
                        <a href={{ route('pages.show', $child['url']) }}>{{ $child['name'] }}</a>
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
        @endif
    @endforeach
</aside>
