<nav class="{{ $type }}-nav">
    <ul>
        @foreach ($tree[array_key_first($tree)]['children'] as $key => $item)
            <?php
            $class = '';
            
            if ($item['url'] === 'o-kompanii') {
                $class = '-about';
            }
            
            if ($item['url'] === 'zhd-perevozki') {
                $class = '-zhd';
            }
            
            if ($item['url'] === 'shemy-pogruzki') {
                $class = '-scheme';
            }
            
            if ($item['url'] === 'kontakty') {
                $class = '-contacts';
            }
            ?>

            <li>
                <a class="js-subnav-opener js-subnav-opener{{ $class }}"
                    href="{{ route('pages.show', $item['url']) }}">{{ $item['name'] }}</a>
            </li>
        @endforeach
    </ul>
</nav>
