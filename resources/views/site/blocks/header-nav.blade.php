<nav class="{{ $type }}-nav">
    <ul>
        @foreach ($tree[array_key_first($tree)]['children'] as $key => $item)
            <?php
            $subnav = '';
            
            if ($item['url'] === 'o-kompanii') {
                $subnav = 'about';
            }
            
            if ($item['url'] === 'perevozki-gruzov') {
                $subnav = 'zhd';
            }
            
            if ($item['url'] === 'shemy-pogruzki') {
                $subnav = 'scheme';
            }
            
            if ($item['url'] === 'kontakty') {
                $subnav = 'contacts';
            }
            ?>

            <li>
                <a class="js-subnav-opener" data-subnav="{{ $subnav }}"
                    href="{{ route('pages.show', $item['url']) }}">{{ $item['name'] }}</a>
            </li>
        @endforeach
    </ul>
</nav>
