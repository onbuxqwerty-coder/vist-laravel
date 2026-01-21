
<footer>
    <div class="footer_wrapper">
        <div class="footer_logo"> 
            <a href="<?php echo e(route('home')); ?>">
                <img src="<?php echo e(asset('img/logo/vist_logo_w.png')); ?>" alt="Vist Logo">
            </a>
        </div>

        <nav>
            <ul class="footer_service">
                <li><strong>ТОВ "ВІСТ"</strong></li>
                <li>Тел: <a href="tel:+380563700707">+380 56 370-07-07</a></li>
                <li>Моб: <a href="tel:+380773700707">+380 77 370-07-07</a></li>
                <li>E-mail: <a href="mailto:info@vist.dp.ua">info@vist.dp.ua</a></li>
                <li>Viber: <a href="viber://chat?number=+380773700707">+380 77 370-07-07</a></li>
                <li>WhatsApp: <a href="https://wa.me/380773700707">+380 77 370-07-07</a></li>
            </ul>
        </nav>
        
        <nav>
            <ul class="footer_menu">
                <li><a href="<?php echo e(route('workstations.index')); ?>">Робочі станції</a></li>
                <li><a href="<?php echo e(route('servers.index')); ?>">Серверне обладнання</a></li>
                <li><a href="<?php echo e(route('industrial.index')); ?>">Промислові ПК</a></li>
                <li><a href="<?php echo e(route('ups.index')); ?>">ДБЖ</a></li>
                <li><a href="<?php echo e(route('support.index')); ?>">Підтримка</a></li>
                <li><a href="<?php echo e(route('about')); ?>">Про компанію</a></li>
            </ul>
        </nav>

        <div class="social_networks">
            <a href="https://facebook.com/vist" target="_blank" rel="noopener" class="facebook_logo">
                <img width="40" height="40" src="<?php echo e(asset('img/media/facebook_logo_120x120.png')); ?>" alt="Facebook">
            </a>
            <a href="https://instagram.com/vist" target="_blank" rel="noopener" class="instagram_logo">
                <img width="40" height="40" src="<?php echo e(asset('img/media/instagram_logo_120x120.png')); ?>" alt="Instagram">
            </a>
            <a href="https://linkedin.com/company/vist" target="_blank" rel="noopener" class="linkedin_logo">
                <img width="40" height="40" src="<?php echo e(asset('img/media/linkedIn_logo_120x120.png')); ?>" alt="Linkedin">
            </a>
            <a href="https://reddit.com/r/vist" target="_blank" rel="noopener" class="reddit_logo">
                <img width="40" height="40" src="<?php echo e(asset('img/media/reddit_logo_120x120.png')); ?>" alt="Reddit">
            </a>
        </div>
    </div>
    <p style="text-align: center; font-size: 0.9em; margin-top: 2rem;">
        © 1996–<?php echo e(date('Y')); ?> ТОВ фірма "ВІСТ" | Комп'ютери в місті Дніпро
    </p>
</footer>
</body>
</html><?php /**PATH C:\Users\liqwood\Herd\vist-laravel\resources\views/layouts/footer.blade.php ENDPATH**/ ?>