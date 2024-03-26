<section class="subnav-blocks js-subnav-blocks">
    <div class="subnav-blocks__block js-subnav-blocks__block subnav-blocks__block--zhd js-subnav-blocks__block--zhd">
        <div class="subnav-blocks__block_in">
            <a class="subnav-blocks__close js-subnav-blocks__close" href="#">закрыть</a>
            <div class="subnav-block-header">
                <h2>{{ $tree[array_key_first($tree)]['children'][3]['name'] }}</h2>
                <a href="№!">В раздел</a>
            </div>
            <div class="subnav-blocks-columns">
                @foreach ($tree[array_key_first($tree)]['children'][3]['children'] as $header)
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
                @endforeach
            </div>
        </div>
    </div>
</section>