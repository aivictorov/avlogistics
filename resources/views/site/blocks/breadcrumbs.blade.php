<div class="breadcrumbs">
    @foreach ($parents as $parent)
        @if ($parent['url'] == 'index')
            <a href={{ route('home') }}>{{ $parent['name'] }}</a>
        @else
            <a href={{ route('pages.show', $parent['url']) }}>{{ $parent['name'] }}</a>
        @endif
        <span class="divider">/</span>
    @endforeach

    <span class="no-url">{{ $page['name'] }}</span>
</div>
