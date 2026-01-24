{{-- resources/views/layouts/header.blade.php --}}
<header class="site-header">
    <div class="container header-grid">

        <!-- ЛОГО -->
        <div class="logo-block">
            <a href="{{ route('home') }}">
                <img src="{{ asset('img/logo/vist_logo_w.png') }}" alt="Vist Group">
            </a>
        </div>

        <!-- PHONE -->
        <div class="header-right">
            <div class="header-contacts">
                <div class="header-contact-item">
                    <div class="header-contact-value">
                        <img src="{{ asset('img/icon/phone_30x30.png') }}" alt="Phone">&emsp;
                        <a href="tel:+380563700707">+38&nbsp;(056)&nbsp;370-07-07</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- MENU: справа знизу -->
        <div class="header-bottom">
            <div class="nav-row">
                <nav class="main-menu" aria-label="Головне меню">
                    <a href="{{ route('workstations.index') }}">Робочі станції</a>
                    <a href="{{ route('servers.index') }}">Серверне обладнання</a>
                    <a href="{{ route('industrial.index') }}">Промислові ПК</a>
                    <a href="{{ route('ups.index') }}">ДБЖ</a>
                    <a href="{{ route('support.index') }}">Підтримка</a>
                    <a href="{{ route('about') }}">Про компанію</a>
                    <a href="{{ route('contact') }}">Контакти</a>
                </nav>

                <!-- бургер для мобільного -->
                <button class="menu-toggle" type="button" aria-label="Відкрити меню">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>

            <!-- Мобільне меню -->
            <nav class="mobile-menu" aria-label="Мобільне меню">
                <a href="{{ route('workstations.index') }}">Робочі станції</a>
                <a href="{{ route('servers.index') }}">Серверне обладнання</a>
                <a href="{{ route('industrial.index') }}">Промислові ПК</a>
                <a href="{{ route('ups.index') }}">ДБЖ</a>
                <a href="{{ route('support.index') }}">Підтримка</a>
                <a href="{{ route('about') }}">Про компанію</a>
                <a href="{{ route('contact') }}">Контакти</a>
            </nav>
        </div>

    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const header = document.querySelector('.site-header');
        const toggle = document.querySelector('.menu-toggle');

        // Відкриття/закриття мобільного меню
        if (toggle && header) {
            toggle.addEventListener('click', function () {
                header.classList.toggle('mobile-menu-open');
            });
        }

        // Стискання хедера при прокрутці
        function onScroll() {
            if (!header) return;

            const scrollY = window.pageYOffset || document.documentElement.scrollTop;

            // тільки на десктопі стискаємо
            if (window.innerWidth > 720) {
                if (scrollY > 80) {
                    header.classList.add('shrink');
                } else {
                    header.classList.remove('shrink');
                }
            } else {
                header.classList.remove('shrink');
            }
        }

        window.addEventListener('scroll', onScroll);
        window.addEventListener('resize', onScroll);
        onScroll();
    });
</script>
