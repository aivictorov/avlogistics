<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="/admin_panel/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">ООО "Авангард"</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            {{-- <div class="image">
                <img src="/admin_panel/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div> --}}

            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href={{ route('admin.home') }} class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Главная
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
                    <a href={{ route('admin.portfolio.index') }} class="nav-link">
                        <i class="nav-icon fas fa-image"></i>
                        <p>
                            Портфолио
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href={{ route('admin.portfolioSections.index') }} class="nav-link">
                        <i class="nav-icon fas fa-images"></i>
                        <p>
                            Категории портфолио
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href={{ route('admin.faq.index') }} class="nav-link">
                        <i class="nav-icon fas fa-reply"></i>
                        <p>
                            FAQ
                        </p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href={{ route('admin.faq.index') }} class="nav-link">
                        <i class="nav-icon fas fa-reply-all"></i>
                        <p>
                            FAQ (категории)
                        </p>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a href={{ route('admin.users.index') }} class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Пользователи
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
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
