<aside class="aside">
    <div class="aside__header ">Вопросы</div>
    <ul class="aside__blocks-list">
        @foreach ($faq_categories as $category)
            <li>
                <a href="/faq/{{ $category['url'] }}/">{{ $category['name'] }}</a>
                <span class="aside__blocks-count">(3)</span>
            </li>
        @endforeach
    </ul>
    @include('site.blocks.order-button')
</aside>
.
.
