@extends('layouts.app')

@section('title', $typeName)

@section('body-class', 'product-catalog-page')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/products-index.css') }}">
@endpush

@section('content')

<main class="workstation-page">


<div class="page-hero">
    <h1>💻 {{ $typeName }}</h1>
    <p>Професійні рішення для вашого бізнесу</p>
</div>

@if($type === 'server')
    <div class="server-static-content">
        <img src="{{ asset('img/products/servers/servers.webp') }}" alt="Серверне обладнання" class="server-main-image">

        <div class="server-text">
            <h2>Надійні серверні рішення для вашого бізнесу</h2>
            <p>Ефективна ІТ-інфраструктура починається з правильно підібраного заліза. Ми забезпечуємо повний цикл постачання серверного обладнання — від аналізу ваших потреб до відвантаження готових конфігурацій. Наша компанія фокусується на індивідуальному підході, пропонуючи рішення, які точно відповідають масштабам та задачам вашого проєкту.</p>

            <h3>Що ми пропонуємо</h3>
            <p>Ми постачаємо широкий спектр обладнання від провідних світових виробників:</p>
            <ul>
                <li><strong>Tower-сервери:</strong> Оптимальний вибір для малих офісів та локальних задач, що не потребують спеціальних серверних стійок.</li>
                <li><strong>Rack-сервери (стійкові):</strong> Компактні та продуктивні рішення для монтажу в 19-дюймові шафи, ідеальні для масштабування дата-центрів.</li>
                <li><strong>Blade-системи:</strong> Високощільні рішення для максимальної обчислювальної потужності при мінімальному використанні простору.</li>
                <li><strong>Сховища даних (NAS/SAN):</strong> Надійні системи для збереження та швидкого доступу до корпоративної інформації.</li>
            </ul>

            <h3>Сервери під індивідуальне замовлення</h3>
            <p>Ми розуміємо, що типові рішення не завжди є ефективними. Тому ми пропонуємо послугу збирання під замовлення:</p>
            <ul>
                <li><strong>Підбір специфікацій:</strong> Процесори, об'єм оперативної пам'яті та тип дискових накопичувачів обираються під конкретне навантаження (бази даних, віртуалізація, рендеринг тощо).</li>
                <li><strong>Оптимізація бюджету:</strong> Ви не переплачуєте за зайві потужності, отримуючи збалансовану систему.</li>
                <li><strong>Гарантія та супровід:</strong> Все обладнання проходить обов'язкове тестування перед передачею замовнику.</li>
            </ul>

            <h3>Маєте запит на розрахунок конфігурації?</h3>
            <p>Наші фахівці допоможуть підібрати обладнання, яке стане надійним фундаментом вашої ІТ-системи. Зв'яжіться з нами для отримання консультації та актуального прайс-листа.</p>
            <a href="{{ route('contact') }}" class="btn-contact-server">Зв'язатися з нами</a>
        </div>
    </div>
@elseif($type === 'ipc')
    <div class="server-static-content">
        <img src="{{ asset('img/products/industrial/industrial_pc.webp') }}" alt="Промислові ПК" class="server-main-image">

        <div class="server-text">
            <h2>Промислові обчислювальні системи: Стабільність у будь-яких умовах</h2>
            <p>ТОВ фірма «ВІСТ» пропонує комплексні рішення у сфері промислової автоматизації. На відміну від звичайних офісних комп'ютерів, наші промислові ПК розроблені для безперебійної роботи в екстремальних умовах, де критично важливими є живучість системи та тривалий життєвий цикл обладнання.</p>

            <h3>Напрямки постачання обладнання</h3>
            <p>Ми забезпечуємо підбір та постачання наступних типів систем:</p>
            <ul>
                <li><strong>Panel PC (Панельні ПК):</strong> Пристрої «все в одному» з інтегрованим сенсорним дисплеєм. Мають захист передньої панелі за стандартом IP65/IP67, що дозволяє використовувати їх у харчовій та хімічній промисловості.</li>
                <li><strong>Box PC (Безвентиляторні системи):</strong> Компактні комп'ютери в герметичних корпусах. Відсутність рухомих частин унеможливлює потрапляння пилу всередину та гарантує безшумну роботу 24/7.</li>
                <li><strong>Стійкові рішення (Rackmount 19"):</strong> Потужні обчислювальні вузли для встановлення в серверні шафи на виробництві, обладнані додатковими слотами розширення (PCI/PCIe).</li>
                <li><strong>Захищені ноутбуки та планшети:</strong> Мобільні пристрої для роботи в польових умовах, стійкі до падінь, вібрацій та вологи.</li>
            </ul>

            <h3>Технічні переваги наших рішень</h3>
            <p>Обладнання, яке постачає ТОВ фірма «ВІСТ», відповідає суворим промисловим стандартам:</p>
            <ul>
                <li><strong>Широкий температурний діапазон:</strong> Стабільна робота при температурах від -40°C до +70°C.</li>
                <li><strong>Стійкість до вібрацій та ударів:</strong> Спеціальне кріплення компонентів та використання виключно промислових SSD/DOM накопичувачів.</li>
                <li><strong>Пило- та вологозахист:</strong> Корпуси з нержавіючої сталі або алюмінію з високим ступенем захисту IP.</li>
                <li><strong>Специфічні інтерфейси:</strong> Наявність портів COM (RS-232/422/485), GPIO, CAN-bus та Dual/Quad LAN для інтеграції з виробничими лініями.</li>
            </ul>

            <h3>Індивідуальна конфігурація під ваші задачі</h3>
            <p>ТОВ фірма «ВІСТ» здійснює постачання промислових ПК під замовлення. Ми допоможемо спроектувати систему, враховуючи:</p>
            <ul>
                <li>Необхідну обчислювальну потужність.</li>
                <li>Специфіку монтажу (DIN-рейка, настінне кріплення, VESA).</li>
                <li>Вимоги до сертифікації та термінів підтримки моделі (Life Cycle до 10-15 років).</li>
            </ul>

            <h3>Отримайте технічну консультацію</h3>
            <p>Якщо вашому підприємству потрібне надійне обладнання для АСУ ТП або моніторингу виробництва, фахівці ТОВ фірма «ВІСТ» готові запропонувати оптимальне рішення.</p>
            <a href="{{ route('contact') }}" class="btn-contact-server">Зв'язатися з нами</a>
        </div>
    </div>
@elseif($type === 'ups')
    <div class="server-static-content">
        <img src="{{ asset('img/products/ups/ups.webp') }}" alt="ДБЖ" class="server-main-image">

        <div class="server-text">
            <h2>Гарантована енергонезалежність вашої ІТ-інфраструктури</h2>
            <p>У сучасних умовах безперебійне електропостачання — це не просто зручність, а критична необхідність для збереження даних та стабільної роботи обладнання. ТОВ фірма «ВІСТ» пропонує професійні рішення у сфері захисту живлення, базуючись на надійному обладнанні від світових лідерів — APC та Eaton.</p>

            <h3>Наші ключові партнери</h3>
            <p>Ми спеціалізуємося на підборі та постачанні систем безперебійного живлення (UPS/ДЖБ) преміального сегмента:</p>
            <ul>
                <li><strong>APC by Schneider Electric:</strong> Еталон надійності для серверних кімнат та дата-центрів. Серії Smart-UPS та Symmetra забезпечують найвищий рівень захисту та інтелектуальне керування енергоспоживанням.</li>
                <li><strong>Eaton:</strong> Технологічні рішення з високим ККД та інноваційними системами моніторингу. ДЖБ Eaton серій 9SX, 9PX та трифазні системи — це ідеальний вибір для промислових об'єктів та складних серверних архітектур.</li>
            </ul>

            <h3>Типи обладнання, що ми постачаємо</h3>
            <p>ТОВ фірма «ВІСТ» здійснює поставки ДЖБ для будь-яких масштабів:</p>
            <ul>
                <li><strong>Лінійно-інтерактивні ДЖБ (Line-Interactive):</strong> Оптимальний захист для робочих станцій, мережевих комутаторів та невеликих серверів.</li>
                <li><strong>ДЖБ з подвійним перетворенням (On-line):</strong> Безкомпромісний захист критичного обладнання. Гарантують нульовий час перемикання на батареї та ідеальну синусоїду на виході.</li>
                <li><strong>Трифазні системи безперебійного живлення:</strong> Потужні рішення для енергозабезпечення цілих офісних будівель, медичних центрів або промислових ліній.</li>
                <li><strong>Додаткові модулі та АКБ:</strong> Зовнішні батарейні блоки для збільшення часу автономної роботи та змінні акумулятори (RBC).</li>
            </ul>

            <h3>Чому варто замовити ДЖБ у ТОВ фірма «ВІСТ»?</h3>
            <ul>
                <li><strong>Технічний аудит:</strong> Ми не просто продаємо пристрій, а розраховуємо необхідну потужність (ВА/Вт) та час автономної роботи відповідно до вашого навантаження.</li>
                <li><strong>Офіційні поставки:</strong> Тільки сертифіковане обладнання з повною гарантійною підтримкою від виробників.</li>
                <li><strong>Системна інтеграція:</strong> Допомагаємо з налаштуванням софту для автоматичного завершення роботи серверів (PowerChute для APC або Intelligent Power Manager для Eaton).</li>
            </ul>

            <h3>Захистіть свій бізнес від перебоїв в електромережі</h3>
            <p>Фахівці ТОВ фірма «ВІСТ» підберуть оптимальне рішення для захисту вашого обладнання — від компактного UPS для офісу до модульних систем для ЦОД.</p>
            <a href="{{ route('contact') }}" class="btn-contact-server">Зв'язатися з нами</a>
        </div>
    </div>
@elseif($products->isEmpty())
    <div style="text-align: center; padding: 80px 20px;">
        <div style="font-size: 64px; opacity: 0.3;">📦</div>
        <h2>Продуктів поки немає</h2>
    </div>
@else
    <div class="products-grid">
        @php
            $hiddenSpecKeys = ['CPU_Type','RAM_Type','GPU_VRAM','Storage_Type','Controller','Controller_Type','Management','Management_Type','Other'];
        @endphp
        @foreach($products as $product)
            @php
                $productData = $product->toArray();
                $productData['specs'] = $product->specs->whereNotIn('spec_key', $hiddenSpecKeys)->values()->toArray();
            @endphp
            <div class="product-card" onclick='openPanel({!! htmlspecialchars(json_encode($productData), ENT_QUOTES, "UTF-8") !!})'>
			<div class="product-card-image">
				@php
					$cardImage = optional(
						$product->images->sortByDesc('is_primary')->first()
					)->image;
				@endphp

				@if($cardImage)
					<img src="{{ $product->main_image_url }}" alt="{{ $product->title }}">
				@else
					<div style="font-size: 64px; opacity: 0.3;">💻</div>
				@endif

				<span class="product-badge">Доступно</span>
			</div>


                <div class="product-card-content">
                    <p class="product-card-sku">Код товару: {{ $product->sku }}</p>
                    <h3 class="product-card-title">{{ $product->title }}</h3>

                    @if($product->subtitle)
                        <p class="product-desc">{{ $product->subtitle }}</p>
                    @endif

                    <div class="product-price">
                        <div class="price-value">
                            {{ number_format($product->price, 0, ',', ' ') }} {{ $product->currency }}
                        </div>
                        <button class="btn-details" >
                            Детальніше →
                        </button>
                    </div>
                </div>

                @php
                    $hoverSpecs = [
                        'Form_Factor' => 'Форм-фактор',
                        'CPU'         => 'Процесор',
                        'GPU'         => 'Дискретна графіка',
                        'RAM'         => 'Оперативна пам\'ять',
                        'Storage'     => 'Об\'єм SSD',
                    ];
                    $specsIdx = $product->specs->keyBy('spec_key');
                @endphp
                <div class="card-specs-popup">
                    @foreach($hoverSpecs as $key => $label)
                        @if($specsIdx->has($key))
                            <div class="popup-spec-row">
                                <span class="popup-spec-label">{{ $label }}:</span>
                                <span class="popup-spec-value">{{ $specsIdx[$key]->spec_value }}</span>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endif

<div class="slide-panel-overlay" onclick="closePanel()"></div>
<div class="slide-panel" id="slidePanel">
    <div class="panel-header">
        <p id="panelSku" style="font-size:12px;color:#999;margin:0 0 2px;"></p>
        <h2 id="panelTitle"></h2>
        <button class="btn-close-panel" onclick="closePanel()">×</button>
    </div>
    
    <div class="panel-image-gallery" id="panelGallery"></div>
    
    <!-- Вкладки -->
    <div class="panel-tabs">
        <button class="tab-button active" onclick="switchTab('specs')">Характеристики</button>
        <button class="tab-button" onclick="switchTab('description')">Опис</button>
        <button class="tab-button" onclick="switchTab('documents')">Документи</button>
    </div>
    
    <div class="panel-content">
        <!-- Характеристики -->
        <div class="tab-pane active" id="tab-specs">
            <table class="specs-table" id="specsTable">
                <!-- Заповнюється через JS -->
            </table>
        </div>
        
        <!-- Опис -->
        <div class="tab-pane" id="tab-description">
            <div class="price-display">
                <div class="price-amount" id="panelPrice"></div>
            </div>
            <div id="panelDescription" style="color: #2c3e50; line-height: 1.8; white-space: pre-line;"></div>
        </div>
        
        <!-- Документи -->
        <div class="tab-pane" id="tab-documents">
            <p style="color: #7f8c8d; text-align: center; padding: 40px 0;">
                📄 Документація буде доступна незабаром
            </p>
        </div>
    </div>
    
    <div class="panel-cta">
        <button class="btn-cta btn-order" onclick="orderProduct()">🛒 Замовити</button>
    </div>
</div>
<!-- Модальне вікно замовлення -->
    <div class="modal-overlay" id="orderModal" onclick="closeOrderModal(event)">
        <div class="modal-content" onclick="event.stopPropagation()">
            <div class="modal-header">
                <h2>🛒 Замовлення продукту</h2>
                <button class="btn-close-modal" onclick="closeOrderModal()">&times;</button>
            </div>
            
            <div class="modal-body">
@if(session('success'))
<div class="alert alert-success" style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #28a745;">
    <strong>✅ Успішно!</strong><br>
    {{ session('success') }}
</div>
@endif
                <div class="product-info-block">
                    <strong>Продукт:</strong> <span id="modalProductName"></span>
                </div>
                
                <form action="{{ route('contact.submit') }}" method="POST" class="order-form">
                    @csrf
                    
                    <input type="hidden" name="product_name" id="productNameInput">
                    <input type="hidden" name="subject" value="order">
                    
                    <div class="form-group">
                        <label for="order_name">Ім'я <span class="required">*</span></label>
                        <input type="text" id="order_name" name="name" required placeholder="Ваше ім'я">
                    </div>
                    
                    <div class="form-group">
                        <label for="order_email">Email <span class="required">*</span></label>
                        <input type="email" id="order_email" name="email" required placeholder="name@company.com">
                    </div>
                    
                    <div class="form-group">
                        <label for="order_phone">Телефон <span class="required">*</span></label>
                        <input type="tel" id="order_phone" name="phone" required placeholder="+38 (0XX) XXX-XX-XX">
                    </div>
                    
                    <div class="form-group">
                        <label for="order_message">Коментар</label>
                        <textarea id="order_message" name="message" rows="4" placeholder="Додаткові побажання або питання..."></textarea>
                    </div>
                    
                    <button type="submit" class="btn-submit-order">
                        📨 Відправити замовлення
                    </button>
                </form>
            </div>
        </div>
    </div>

<script>
let currentProduct = null;

function openPanel(product) {
    currentProduct = product;
    document.getElementById('panelTitle').textContent = product.title;
    document.getElementById('panelSku').textContent = product.sku ? 'Код товару: ' + product.sku : '';
    document.getElementById('panelPrice').textContent = formatPrice(product.price) + ' ' + product.currency;
    document.getElementById('panelDescription').textContent = product.description || product.subtitle || 'Опис продукту';
    
    // Галерея
    const gallery = document.getElementById('panelGallery');
    if (product.images && product.images.length > 0) {
        const mainImg = product.images[0].image;
        let galleryHTML = `
            <div class="main-image" id="mainImage">
                <img src="{{ asset('') }}${mainImg}" alt="${product.title}">
            </div>
        `;
        if (product.images.length > 1) {
            galleryHTML += '<div class="thumbnail-images">';
            product.images.forEach((img, index) => {
                galleryHTML += `
                    <div class="thumbnail ${index === 0 ? 'active' : ''}" onclick="changeMainImage('${img.image}', this)">
                        <img src="{{ asset('') }}${img.image}" alt="Image ${index + 1}">
                    </div>
                `;
            });
            galleryHTML += '</div>';
        }
        gallery.innerHTML = galleryHTML;
    } else {
        gallery.innerHTML = '<div class="main-image"><div style="font-size: 64px; opacity: 0.3;">💻</div></div>';
    }
    
    // Характеристики
    const specsTable = document.getElementById('specsTable');
    let specsHTML = '';
    
    if (product.specs && product.specs.length > 0) {
        product.specs.forEach(spec => {
            const icon = getSpecIcon(spec.spec_key);
            specsHTML += `
                <tr>
                    <td>
                        <div class="spec-key-label">
                            <span>${icon}</span>
                            <span>${formatSpecKey(spec.spec_key)}</span>
                        </div>
                    </td>
                    <td>${spec.spec_value}</td>
                </tr>
            `;
        });
    } else {
        specsHTML = '<tr><td colspan="2" style="text-align: center; color: #7f8c8d; padding: 40px;">Характеристики не вказані</td></tr>';
    }
    
    specsTable.innerHTML = specsHTML;
    
    // Показуємо панель
    document.getElementById('slidePanel').classList.add('active');
    document.querySelector('.slide-panel-overlay').classList.add('active');
    document.body.style.overflow = 'hidden';
    
    // Скидаємо на першу вкладку
    switchTab('specs');
}

function switchTab(tabName) {
    // Деактивуємо всі таби
    document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
    document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('active'));
    
    // Активуємо потрібний
    document.querySelector(`[onclick="switchTab('${tabName}')"]`).classList.add('active');
    document.getElementById(`tab-${tabName}`).classList.add('active');
}

function changeMainImage(imgSrc, thumbnail) {
    document.querySelector('#mainImage img').src = '{{ asset('') }}' + imgSrc;
    document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
    thumbnail.classList.add('active');
}

function getSpecIcon(key) {
    const icons = {
        'Device_Class': '🏢',
        'CPU': '🔧',
        'RAM': '💾',
        'RAM_Type': '💾',
        'GPU': '🎮',
        'Storage': '💿',
        'Storage_Type': '💿',
        'PSU': '⚡',
        'Form_Factor': '📐',
        'OS': '🖥️'
    };
    return icons[key] || '⚙️';
}

function formatSpecKey(key) {
    const names = {
        'Device_Class': 'Клас пристрою',
        'CPU': 'Процесор',
        'RAM': 'Оперативна пам\'ять',
        'RAM_Type': 'Тип пам\'яті',
        'GPU': 'Відеокарта',
        'Storage': 'Накопичувач',
        'Storage_Type': 'Тип накопичувача',
        'PSU': 'Блок живлення',
        'Form_Factor': 'Форм-фактор',
        'OS': 'Операційна система'
    };
    return names[key] || key;
}

function closePanel() {
    document.getElementById('slidePanel').classList.remove('active');
    document.querySelector('.slide-panel-overlay').classList.remove('active');
    document.body.style.overflow = '';
}

function formatPrice(price) {
    return new Intl.NumberFormat('uk-UA').format(price);
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closePanel();
});
function orderProduct() {
            if (currentProduct) {
                // Заповнюємо назву продукту
                document.getElementById('modalProductName').textContent = currentProduct.title;
                document.getElementById('productNameInput').value = currentProduct.title;
                
                // Відкриваємо модальне вікно
                document.getElementById('orderModal').classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        }
        
        function closeOrderModal(event) {
            // Закриваємо тільки якщо клік по overlay або кнопці закриття
            if (event && event.target.classList.contains('modal-content')) {
                return;
            }
            
            document.getElementById('orderModal').classList.remove('active');
            document.body.style.overflow = '';
        }
        
        // Закриття модалки на Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const modal = document.getElementById('orderModal');
                if (modal && modal.classList.contains('active')) {
                    closeOrderModal();
                } else {
                    closePanel();
                }
            }
        });
// Автоматично відкриваємо модалку при успішній відправці
        @if(session('success') && session()->has('success'))
        window.addEventListener('DOMContentLoaded', function() {
            // Якщо є збережений продукт в localStorage - відкриваємо модалку
            const lastProduct = localStorage.getItem('lastOrderedProduct');
            if (lastProduct) {
                currentProduct = JSON.parse(lastProduct);
                orderProduct();
                // Очищаємо після показу
                setTimeout(() => {
                    localStorage.removeItem('lastOrderedProduct');
                }, 1000);
            }
        });
        @endif

</script>

</main>
@endsection
