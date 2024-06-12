<aside class="main-sidebar sidebar-dark-primary">
    <div class="sidebar d-flex flex-column justify-content-between">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href={{ route('admin.home') }} class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Панель управления
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href={{ route('admin.pages.index') }} class="nav-link">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>
                            Страницы
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href={{ route('admin.galleries.index') }} class="nav-link">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>
                            Контекстные галереи
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href={{ route('admin.portfolio.index') }} class="nav-link">
                        <i class="nav-icon fas fa-image"></i>
                        <p>
                            Портфолио
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href={{ route('admin.portfolioSections.index') }} class="nav-link">
                        <i class="nav-icon fas fa-id-card"></i>
                        <p>
                            Категории портфолио
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href={{ route('admin.faq.index') }} class="nav-link">
                        <i class="nav-icon fas fa-question"></i>
                        <p>
                            Вопросы и ответы
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href={{ route('admin.users.index') }} class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Пользователи
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href={{ route('home') }} class="nav-link" target="_blank" rel="noopener noreferrer">
                        <i class="nav-icon fas fa-reply"></i>
                        <p>
                            Вернуться на сайт
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href={{ route('user.logout') }} class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Выход
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
