@extends('layouts.app')

@section('title', 'VIST — Компʼютери для бізнесу та життя')

@section('content')

<!----------------------------------------------- HERO 1 ----------------------------------------------->

<div class="background-video-container">
    <video autoplay loop muted id="myVideo">
        <source src="{{ asset('img/video/vist__cinematic.mp4') }}" type="video/mp4">
        Ваш браузер не поддерживает тег video.
    </video>
    <div class="content">
        <h1>Підвищена Продуктивність</h1>
        <p>Професійно розроблені робочі станції та сервери для найвимогливіших застосувань</p>

        <div class="content-button">
            <button class="specialist-button">
                Поговорити з Спеціалістом
            </button>
            <button class="specialist-button">
                Замовити дзвінок
            </button>
        </div>
    </div>
</div>

<!---------------------------------- ПРОБЛЕМА / БІЛЬ КЛІЄНТА ---------------------------------->
<section class="vist-productivity-section">
    <div class="vist-productivity-wrapper">
        <!-- Ліва частина 2/3 з трьома плашками -->
        <div class="vist-text-column">
            <h2>Коли техніка гальмує бізнес</h2>

            <!-- Частина 1 — Проблема швидкодії -->
            <div class="vist-card">
                <div class="vist-card-content">
                    <div class="vist-card-title">Проблема швидкодії</div>
                    <p>Продуктивність команди напряму залежить від надійності та швидкості робочих станцій.</p>
                    <p>Повільні машини гальмують увесь процес: рендери, симуляції, BIM-моделі, 3D-сцени, великі креслення.</p>
                </div>
            </div>

            <div class="vist-card">
                <div class="vist-card-content">
                    <div class="vist-card-title">Фінансові втрати</div>
                    <p>Неправильно підібране обладнання коштує бізнесу грошей — переплата за непотрібне та втрата продуктивності через нестачу ресурсів.</p>
                </div>
            </div>

            <div class="vist-card">
                <div class="vist-card-content">
                    <div class="vist-card-title">Нестабільність і ризики</div>
                    <p>Складні робочі процеси не витримує «звичайне залізо» — проєкти сповільнюються, дедлайни зсуваються.</p>
                    <p>Без гарантії стабільної роботи під навантаженням ІТ-відділ постійно «гасить пожежі».</p>
                </div>
            </div>
        </div>

        <!-- Права частина 1/3 з картинкою -->
        <div class="vist-image-column">
            <img src="{{ asset('img/waiting.jpg') }}" alt="Співробітник, що чекає через повільний комп'ютер">
        </div>
    </div>
</section>

<!---------------------------------- РІШЕННЯ VIST ---------------------------------->

<section class="vist-productivity-section vist-productivity-section--reversed">
    <div class="vist-productivity-wrapper vist-productivity-wrapper--reversed">
        
        <!-- СПОЧАТКУ картки (через row-reverse будуть справа) -->
        <div class="vist-text-column vist-text-column--reversed">
            <h2>Рішення від VIST</h2>
            <div class="vist-card vist-card--reversed">
                <div class="vist-card-content">
                    <div class="vist-card-title">Максимальна продуктивність у професійних робочих процесах</div>
                    <p>Робочі станції забезпечують високу швидкість у рендерах, обчисленнях, моделюванні, AI та HPC.</p>
                    <p>Системи оптимізовані для стабільної роботи під тривалими та ресурсоємними навантаженнями.</p>
                </div>
            </div>

            <div class="vist-card vist-card--reversed">
                <div class="vist-card-content">
                    <div class="vist-card-title">Точні конфігурації під спеціалізоване професійне ПЗ</div>
                    <p>Станції налаштовуються під SolidWorks, AutoCAD, Revit, Blender, Maya, Houdini, ANSYS, Adobe Suite.</p>
                    <p>Enterprise-компоненти — ECC-пам'ять, GPU і серверні плати — забезпечують корпоративну надійність.</p>
                </div>
            </div>

            <div class="vist-card vist-card--reversed">
                <div class="vist-card-content">
                    <div class="vist-card-title">Технічна підтримка, масштабованість та ефективність бюджету</div>
                    <p>VIST забезпечує підбір, складання, тестування, оптимізацію та супровід професійних систем.</p>
                    <p>Інфраструктура готова до зростання: сервери, GPU-вузли, віртуалізація та оптимальні інвестиції.</p>
                </div>
            </div>
        </div>

        <!-- ПОТІМ зображення (через row-reverse буде зліва) -->
        <div class="vist-image-column vist-image-column--reversed">
            <img src="{{ asset('img/success.jpg') }}" alt="Успішна команда з продуктивними робочими станціями">
        </div>

    </div>
</section>

<!----------------------------------------------- Brand Slider ----------------------------------------------->

<div class="brands-slider swiper">
    <div class="swiper-wrapper">
        <div class="swiper-slide"><img src="{{ asset('img/logo/hard/intel-logo.webp') }}" alt="intel"></div>
        <div class="swiper-slide"><img src="{{ asset('img/logo/hard/amd-logo.webp') }}" alt="AMD"></div>
        <div class="swiper-slide"><img src="{{ asset('img/logo/hard/asus-logo.webp') }}" alt="asus"></div>
        <div class="swiper-slide"><img src="{{ asset('img/logo/hard/nvidia-logo.webp') }}" alt="nvidia"></div>
		<div class="swiper-slide"><img src="{{ asset('img/logo/hard/dell-logo.webp') }}" alt="dell-logo"></div>
        <div class="swiper-slide"><img src="{{ asset('img/logo/hard/radeon-logo.webp') }}" alt="radeon"></div>
		<div class="swiper-slide"><img src="{{ asset('img/logo/hard/apc-logo.webp') }}" alt="apc-logo"></div>
		<div class="swiper-slide"><img src="{{ asset('img/logo/hard/gigabyte-logo.webp') }}" alt="gigabyte-logo"></div>
        <div class="swiper-slide"><img src="{{ asset('img/logo/hard/aruba-logo.webp') }}" alt="aruba-logo"></div>
		<div class="swiper-slide"><img src="{{ asset('img/logo/hard/hp-logo.webp') }}" alt="hp-logo"></div>
        <div class="swiper-slide"><img src="{{ asset('img/logo/hard/eaton-logo.webp') }}" alt="eaton-logo"></div>
 		<div class="swiper-slide"><img src="{{ asset('img/logo/hard/grandstream-logo.webp') }}" alt="grandstream-logo"></div>
        <div class="swiper-slide"><img src="{{ asset('img/logo/hard/kingston-logo.webp') }}" alt="kingston-logo"></div>
        <div class="swiper-slide"><img src="{{ asset('img/logo/hard/logitech-logo.webp') }}" alt="logitech-logo"></div>
        <div class="swiper-slide"><img src="{{ asset('img/logo/hard/msi-logo.webp') }}" alt="msi-logo"></div>
		<div class="swiper-slide"><img src="{{ asset('img/logo/hard/supermicro-logo.webp') }}" alt="supermicro-logo"></div>
        <div class="swiper-slide"><img src="{{ asset('img/logo/hard/synology-logo.webp') }}" alt="synology-logo"></div>
        <div class="swiper-slide"><img src="{{ asset('img/logo/hard/transcend-logo.webp') }}" alt="transcend-logo"></div>
    </div>
</div>

<!---------------------------------- ПЕРЕВАГИ СПІВПРАЦІ ---------------------------------->

<section class="partner">
  <div class="partner__inner">
    <div class="partner__head">
      <h2 class="partner__title">Чому VIST — правильний технічний партнер</h2>
      <p class="partner__subtitle">
        Інженерний підхід, сервіс бізнес-рівня та відповідальність за результат.
      </p>
    </div>

    <div class="partner__grid">
      <article class="partner__card">
        <div class="partner__icon">🧠</div>
        <h3 class="partner__cardTitle">Експертиза та досвід</h3>
        <p class="partner__text">
          Професійні робочі станції та серверні рішення для бізнесу.
        </p>
      </article>

      <article class="partner__card">
        <div class="partner__icon">🛡️</div>
        <h3 class="partner__cardTitle">Гарантія та сервіс</h3>
        <p class="partner__text">
          <span class="partner__badge">До 3 років</span>
          гарантії та сервісна підтримка бізнес-рівня.
        </p>
      </article>

      <article class="partner__card">
        <div class="partner__icon">🎯</div>
        <h3 class="partner__cardTitle">Розуміння бізнес-задач</h3>
        <p class="partner__text">
          Інженерні, медіа, виробничі та ІТ-команди — говоримо однією мовою.
        </p>
      </article>

      <article class="partner__card">
        <div class="partner__icon">⚙️</div>
        <h3 class="partner__cardTitle">Оптимізація та стабільність</h3>
        <p class="partner__text">
          Налаштування, оптимізація та розгін (за потреби) з акцентом на стабільну роботу.
        </p>
      </article>

      <article class="partner__card">
        <div class="partner__icon">🧪</div>
        <h3 class="partner__cardTitle">Процес впровадження</h3>
        <p class="partner__text">
          Комунікація з клієнтом, професійне тестування та контроль якості перед запуском.
        </p>
      </article>

      <article class="partner__card partner__card--accent">
        <div class="partner__icon">💬</div>
        <h3 class="partner__cardTitle">Чесний підхід до бюджету</h3>
        <p class="partner__text">
          Без продажу зайвого — лише ті рішення, які реально дають результат.
        </p>
      </article>
    </div>
  </div>
</section>

<!---------------------------------- ФІНАЛЬНИЙ CTA ---------------------------------->

<section class="vist-section vist-section--highlight">
    <div class="vist-section-inner vist-cta-center">
        <div class="vist-section-title">
            <h2>Готові підвищити продуктивність команди?</h2>
            <hr class="short-line">
        </div>

        <p class="vist-cta-text">
            Ми підберемо оптимальну робочу станцію або сервер для вашого програмного забезпечення, задач і бюджету. 
            Залиште свої контакти — і наш спеціаліст допоможе знайти найкраще рішення для вашого бізнесу.
        </p>

        <div class="content-button">
            <button class="specialist-button">
                Проконсультуватися зі спеціалістом
            </button>
            <button class="specialist-button">
                Замовити дзвінок
            </button>
        </div>
    </div>
</section>


<!----------------------------------------------- HERO 4 ----------------------------------------------->

<div class="cards-grid-hero4">

<h1>Рішення для інженерних та виробничих компаній</h1>

<div class="cards-grid">
    <div class="card">
        <img src="{{ asset('img/icon/cad.jpg') }}" alt="CAD/CAM/CAE" class="icon">
        <h3>Інженерні та виробничі компанії</h3>
        <h3>🛠 CAD / CAM / CAE, симуляції, моделювання</h3>
        <p>Оптимізовані під SolidWorks, Siemens NX, 🏗 BIM-проекти і складні сцени AutoCAD, Fusion 360, ANSYS. Скорочують час рендеру та обчислень у 2–5 разів.</p>
    </div>

    <div class="card">
        <img src="{{ asset('img/icon/arch.jpg') }}" alt="CAD/CAM/CAE" class="icon">
        <h3>Архітектурні та будівельні бюро (AEC)</h3>
        <h3>🏗 BIM-проекти і складні сцени</h3>
        <p>Підтримка Revit, ArchiCAD, 3ds Max, Twinmotion, Lumion. Стабільна робота з великими файлами та проєктами.</p>
    </div>

    <div class="card">
        <img src="{{ asset('img/icon/media.jpg') }}" alt="CAD/CAM/CAE" class="icon">
        <h3>Медіа-студії та відеопродакшн</h3>
        <h3>🎬 Монтаж, VFX, колор-грейдинг, 3D-анимація</h3>
        <p>DaVinci Resolve, Adobe Suite, Blender, Maya, Houdini. Прискорення рендера кадрів та плавна робота з 4K/8K.</p>
    </div>

    <div class="card">
        <img src="{{ asset('img/icon/data.jpg') }}" alt="CAD/CAM/CAE" class="icon">
        <h3>AI-команди та Data Science</h3>
        <h3>🤖 Machine Learning, Python-ML, моделі LLM, GPU-кластеризація</h3>
        <p>Системи з RTX / A-серією NVIDIA, оптимізовані під TensorFlow, PyTorch. Збільшення швидкості тренування моделей у кілька разів.</p>
    </div>

    <div class="card">
        <img src="{{ asset('img/icon/hpc.jpg') }}" alt="CAD/CAM/CAE" class="icon">
        <h3>Компанії з великими обчислювальними навантаженнями (HPC)</h3>
        <h3>⚙ Наука, фінансові моделі, сімуляції, багатопотокові задачі</h3>
        <p>Серверні рішення та робочі станції з 64–128 ядрами, ECC-пам'яттю.</p>
    </div>

    <div class="card">
        <img src="{{ asset('img/icon/it6.jpg') }}" alt="CAD/CAM/CAE" class="icon">
        <h3>IT-відділи, інтегратори та реселери</h3>
        <h3>💼 Корпоративна інфраструктура, віртуалізація, розгортання</h3>
        <p>Налаштування корпоративних робочих станцій, серверів та кластерів. Можливі партнерські програми та інтеграції.</p>
    </div>
</div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    console.log('🔍 Анімація карток запущена');
    
    // Звичайні картки (виїжджають зліва)
    const cards = document.querySelectorAll('.vist-card:not(.vist-card--reversed)');
    console.log(`📦 Знайдено звичайних карток: ${cards.length}`);
    
    // Дзеркальні картки (виїжджають справа)
    const reversedCards = document.querySelectorAll('.vist-card--reversed');
    console.log(`📦 Знайдено дзеркальних карток: ${reversedCards.length}`);

    // Observer для звичайних карток
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            const card = entry.target;
            const allCards = document.querySelectorAll('.vist-card:not(.vist-card--reversed)');
            const index = Array.from(allCards).indexOf(card);
            
            if (entry.isIntersecting) {
                console.log(`✨ Показую звичайну картку ${index + 1}`);
                setTimeout(() => {
                    card.classList.add('is-visible');
                }, index * 500);
            } else {
                console.log(`👻 Ховаю звичайну картку ${index + 1}`);
                card.classList.remove('is-visible');
            }
        });
    }, {
        threshold: 0.2,
        rootMargin: '0px'
    });

    // Observer для дзеркальних карток
    const reversedObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            const card = entry.target;
            const allReversedCards = document.querySelectorAll('.vist-card--reversed');
            const index = Array.from(allReversedCards).indexOf(card);
            
            if (entry.isIntersecting) {
                console.log(`✨ Показую дзеркальну картку ${index + 1}`);
                setTimeout(() => {
                    card.classList.add('is-visible');
                }, index * 500);
            } else {
                console.log(`👻 Ховаю дзеркальну картку ${index + 1}`);
                card.classList.remove('is-visible');
            }
        });
    }, {
        threshold: 0.2,
        rootMargin: '0px'
    });

    // Спостерігаємо за звичайними картками
    cards.forEach((card, index) => {
        console.log(`🎯 Спостерігаю за звичайною карткою ${index + 1}`);
        observer.observe(card);
    });

    // Спостерігаємо за дзеркальними картками
    reversedCards.forEach((card, index) => {
        console.log(`🎯 Спостерігаю за дзеркальною карткою ${index + 1}`);
        reversedObserver.observe(card);
    });
    
    console.log('✅ Ініціалізація завершена');
});
</script>
@endpush
