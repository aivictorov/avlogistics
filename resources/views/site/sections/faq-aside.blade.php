<aside class="aside">
    <div class="aside__header ">Вопросы</div>
    <ul class="aside__blocks-list">
        @foreach ($faq_categories as $category)
            <li>
                <a href="/faq/{{ $category['url'] }}">{{ $category['name'] }}</a>
                @if (!empty($category['items']))
                    <span class="aside__blocks-count">
                        ({{ count($category['items']) }})
                    </span>
                @endif
            </li>
        @endforeach
    </ul>
    @include('site.blocks.order-button')
</aside>
