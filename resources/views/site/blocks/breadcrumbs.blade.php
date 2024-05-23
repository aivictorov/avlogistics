<div class="breadcrumbs">
    @foreach ($parents as $parent)
        <a href={{ route('pages.show', $parent['url']) }}>{{ $parent['name'] }}</a>
        <span class="divider">/</span>
    @endforeach

    <span class="no-url">{{ $page['name'] }}</span>
</div>
