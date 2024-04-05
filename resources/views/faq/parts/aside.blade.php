<aside class="main-aside">
    <div class="aside-header">Вопросы</div>
    <ul class="aside-sections">
        @foreach ($faq_categories as $category)
            <li>
                <a href="/faq/{{ $category['url'] }}/">{{ $category['name'] }}</a>
                <span class="aside-section-count">(3)</span>
            </li>
        @endforeach
    </ul>

    <a href="#" class="js-form-open main-aside__send-form">Рассчитать стоимость</a>
</aside>
