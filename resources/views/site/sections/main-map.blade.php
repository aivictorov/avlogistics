<section class="main-map">
    <div class="container">
        <div class="main-map__content">
            {{-- <h1 class="main-map__title">ЖД перевозки</h1> --}}
            <h1 class="main-map__title">
                <span class="main-map__title-primary">Перевозки грузов</span>
                <a class="main-map__title-secondary main-map__title-secondary--accent"
                    href="{{ route('pages.show', ['page' => 'zhd-perevozki']) }}">
                    железнодорожным</a><span class="main-map__title-secondary">, автомобильным, морским
                    транспортом</span><span class="main-map__title-secondary main-map__title-secondary--add"> из любой
                    точки России, СНГ, Китая
                </span>
            </h1>
            <div class="main-map__subtitle">
                {{-- <a class="main-map__subtitle-primary" href="{{ route('pages.show', ['page' => 'zhd-perevozki']) }}">
                    грузов в вагонах и контейнерах
                </a> --}}

                {{-- <span class="main-map__subtitle-secondary"> из любой точки России, СНГ, Китая</span> --}}
            </div>
        </div>
    </div>
</section>
