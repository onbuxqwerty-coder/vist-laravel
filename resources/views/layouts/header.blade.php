{{-- resources/views/layouts/header.blade.php --}}
<header class="site-header">
    <div class="container header-grid">

        <!-- ЛОГО -->
        <div class="logo-block">
            <a href="{{ route('home') }}">
                <img src="{{ asset('img/logo/vist_logo_w.webp') }}" alt="Vist Group" width="100" height="100">
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
                    <a href="{{ route('service.index') }}">Сервісний центр</a>
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
                <a href="{{ route('service.index') }}">Сервісний центр</a>
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

        if (toggle && header) {
            toggle.addEventListener('click', function () {
                header.classList.toggle('mobile-menu-open');
            });
        }

        let lastScrollY = window.pageYOffset;
        const THRESHOLD = 80;

        function onScroll() {
            if (!header) return;
            const scrollY = window.pageYOffset;

            // Фон: з'являється після THRESHOLD
            if (scrollY > THRESHOLD) {
                header.classList.add('is-solid');
            } else {
                header.classList.remove('is-solid');
            }

            // Sticky reveal: ховаємо при скролі вниз, показуємо при скролі вгору
            if (scrollY > lastScrollY && scrollY > THRESHOLD) {
                header.classList.add('is-hidden');
            } else {
                header.classList.remove('is-hidden');
            }

            lastScrollY = scrollY;
        }

        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();
    });
</script>
