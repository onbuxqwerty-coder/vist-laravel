@extends('layouts.app')

@section('title', $pageTitle)

@section('content')
<main class="workstation-page">
    <style>
        .workstation-page {
            max-width: 1400px;
            margin: 50px auto;
            padding: 60px 20px;
        }
        
        .page-hero {
            text-align: center;
            margin-bottom: 60px;
        }
        
        .page-hero h1 {
            font-size: 42px;
            color: #2c3e50;
            margin-bottom: 15px;
            font-weight: 700;
        }
        
        .page-hero p {
            font-size: 18px;
            color: #7f8c8d;
            max-width: 600px;
            margin: 0 auto;
        }
        
        /* Grid продуктів */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            margin-bottom: 40px;
        }
        
        /* Картка продукту */
        .product-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
        }
        
        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        }
        
        .product-card-image {
            width: 100%;
            margin: 20px auto 0px;
            height: 250px;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }
        
        .product-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .product-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: #27ae60;
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .product-card-content {
            padding: 25px;
        }
        
        .product-card-title {
            font-size: 18px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 15px;
            line-height: 1.4;
            min-height: 50px;
        }
        
        .product-key-specs {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-bottom: 20px;
        }
        
        .key-spec-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #555;
        }
        
        .key-spec-icon {
            font-size: 18px;
            width: 24px;
            text-align: center;
        }
        
        .key-spec-value {
            font-weight: 600;
            color: #2c3e50;
        }
        
        .product-price {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 20px;
            border-top: 1px solid #ecf0f1;
        }
        
        .price-value {
            font-size: 24px;
            font-weight: 700;
            color: #27ae60;
        }
        
        .price-currency {
            font-size: 16px;
            color: #7f8c8d;
        }
        
        .btn-details {
            background: #3498db;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-details:hover {
            background: #2980b9;
        }
        
        /* Slide-in панель */
        .slide-panel {
            position: fixed;
            top: 0;
            right: -100%;
            width: 600px;
            max-width: 90vw;
            height: 100vh;
            background: white;
            box-shadow: -4px 0 20px rgba(0,0,0,0.2);
            z-index: 9999;
            transition: right 0.4s ease;
            overflow-y: auto;
        }
        
        .slide-panel.active {
            right: 0;
        }
        
        .slide-panel-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 9998;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.4s ease;
        }
        
        .slide-panel-overlay.active {
            opacity: 1;
            pointer-events: all;
        }
        
        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 30px;
            border-bottom: 2px solid #ecf0f1;
            position: sticky;
            top: 0;
            background: white;
            z-index: 10;
        }
        
        .panel-title {
            font-size: 24px;
            font-weight: 700;
            color: #2c3e50;
            margin: 0;
        }
        
        .btn-close-panel {
            background: none;
            border: none;
            font-size: 36px;
            color: #95a5a6;
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s ease;
        }
        
        .btn-close-panel:hover {
            background: #ecf0f1;
            color: #2c3e50;
        }
        
        .panel-image-gallery {
            padding: 30px;
            background: #f8f9fa;
        }
        
        .main-image {
            width: 100%;
            height: 350px;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .main-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        
        .thumbnail-images {
            display: flex;
            gap: 10px;
            justify-content: center;
        }
        
        .thumbnail {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }
        
        .thumbnail:hover,
        .thumbnail.active {
            border-color: #3498db;
            transform: scale(1.05);
        }
        
        .thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .panel-tabs {
            display: flex;
            border-bottom: 2px solid #ecf0f1;
            padding: 0 30px;
            background: white;
            position: sticky;
            top: 90px;
            z-index: 9;
        }
        
        .tab-button {
            padding: 15px 25px;
            background: none;
            border: none;
            font-size: 16px;
            font-weight: 600;
            color: #7f8c8d;
            cursor: pointer;
            position: relative;
            transition: all 0.3s ease;
        }
        
        .tab-button:hover {
            color: #2c3e50;
        }
        
        .tab-button.active {
            color: #3498db;
        }
        
        .tab-button.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 3px;
            background: #3498db;
        }
        
        .panel-content {
            padding: 30px;
        }
        
        .tab-pane {
            display: none;
        }
        
        .tab-pane.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .specs-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 8px;
        }
        
        .specs-table tr {
            background: #f8f9fa;
            transition: all 0.3s ease;
        }
        
        .specs-table tr:hover {
            background: #e9ecef;
            transform: translateX(5px);
        }
        
        .specs-table td {
            padding: 15px;
            border: none;
        }
        
        .specs-table td:first-child {
            font-weight: 600;
            color: #2c3e50;
            width: 40%;
            border-radius: 8px 0 0 8px;
        }
        
        .specs-table td:last-child {
            color: #555;
            border-radius: 0 8px 8px 0;
        }
        
        .spec-key-label {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
        }
        
        .spec-key-label span:first-child {
            font-size: 20px;
        }
        
        .description-content {
            line-height: 1.8;
            color: #555;
        }
        
        .price-display {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 30px;
            border-radius: 16px;
            text-align: center;
            margin-bottom: 30px;
            color: white;
        }
        
        .price-label {
            font-size: 14px;
            opacity: 0.9;
            margin-bottom: 8px;
        }
        
        .price-amount {
            font-size: 36px;
            font-weight: 700;
        }
        
        .panel-cta {
            position: sticky;
            bottom: 0;
            padding: 20px 30px;
            background: white;
            border-top: 2px solid #ecf0f1;
            display: flex;
            gap: 15px;
            z-index: 10;
        }
        
        .btn-cta {
            flex: 1;
            padding: 15px 25px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-order {
            background: #27ae60;
            color: white;
        }
        
        .btn-order:hover {
            background: #229954;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(39, 174, 96, 0.3);
        }
        
        .btn-request {
            background: #3498db;
            color: white;
        }
        
        .btn-request:hover {
            background: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
        }
        
        /* Responsive */
        @media (max-width: 1024px) {
            .products-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 768px) {
            .products-grid {
                grid-template-columns: 1fr;
            }
            
            .slide-panel {
                width: 100%;
            }
            
            .page-hero h1 {
                font-size: 32px;
            }
        }
        
        /* Модальне вікно замовлення */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 10000;
            display: none;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .modal-overlay.active {
            display: flex;
            opacity: 1;
        }
        
        .modal-content {
            background: white;
            border-radius: 16px;
            width: 90%;
            max-width: 550px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            animation: modalSlideIn 0.3s ease;
        }
        
        @keyframes modalSlideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        .modal-header {
            padding: 24px 30px;
            border-bottom: 2px solid #ecf0f1;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .modal-header h2 {
            margin: 0;
            font-size: 24px;
            color: #2c3e50;
        }
        
        .btn-close-modal {
            width: 40px;
            height: 40px;
            border: none;
            background: #f0f0f0;
            color: #666;
            font-size: 28px;
            line-height: 1;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-close-modal:hover {
            background: #e74c3c;
            color: white;
            transform: rotate(90deg);
        }
        
        .modal-body {
            padding: 30px;
        }
        
        .product-info-block {
            background: #f8f9fa;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            border-left: 4px solid #3498db;
        }
        
        .product-info-block strong {
            color: #2c3e50;
        }
        
        .product-info-block span {
            color: #3498db;
            font-weight: 600;
        }
        
        .order-form .form-group {
            margin-bottom: 20px;
        }
        
        .order-form label {
            display: block;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
            font-size: 14px;
        }
        
        .order-form .required {
            color: #e74c3c;
        }
        
        .order-form input,
        .order-form textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #ecf0f1;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s ease;
        }
        
        .order-form input:focus,
        .order-form textarea:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }
        
        .order-form textarea {
            resize: vertical;
            min-height: 100px;
        }
        
        .btn-submit-order {
            width: 100%;
            padding: 15px;
            background: #27ae60;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-submit-order:hover {
            background: #229954;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(39, 174, 96, 0.3);
        }
        
    </style>

    <div class="page-hero">
        <h1>🖥️ Робочі станції VIST</h1>
        <p>Професійні рішення для CAD/CAM/CAE, рендерингу, симуляцій та інженерних задач</p>
    </div>

    @if($products->isEmpty())
        <div style="text-align: center; padding: 60px 0; color: #7f8c8d;">
            <div style="font-size: 64px; margin-bottom: 20px;">🔍</div>
            <h3>Продукти не знайдені</h3>
            <p>Спробуйте змінити параметри фільтрації</p>
        </div>
    @else
        <div class="products-grid">
            @foreach($products as $product)
                <div class="product-card" onclick="openPanel({{ Js::from($product) }})">
                    <div class="product-card-image">
                        <img src="{{ asset($product->main_image) }}" alt="{{ $product->title }}">
                        @if($product->in_stock)
                            <span class="product-badge">В наявності</span>
                        @endif
                    </div>
                    
                    <div class="product-card-content">
                        <h3 class="product-card-title">{{ $product->title }}</h3>
                        
                        @if($product->key_specs->isNotEmpty())
                            <div class="product-key-specs">
                                @foreach($product->key_specs as $spec)
                                    <div class="key-spec-item">
                                        <span class="key-spec-icon">
                                            @switch($spec->spec_key)
                                                @case('CPU') 🔧 @break
                                                @case('RAM') 💾 @break
                                                @case('GPU') 🎮 @break
                                                @case('Storage') 💿 @break
                                                @default ⚙️
                                            @endswitch
                                        </span>
                                        <span class="key-spec-value">{{ Str::limit($spec->spec_value, 20) }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        
                        <div class="product-price">
                            <div>
                                <div class="price-value">
                                    {{ number_format($product->price, 0, ',', ' ') }}
                                    <span class="price-currency">{{ $product->currency }}</span>
                                </div>
                            </div>
                            <button class="btn-details" onclick="event.stopPropagation(); openPanel({{ Js::from($product) }})">
                                Детальніше →
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Slide-in панель -->
    <div class="slide-panel-overlay" onclick="closePanel()"></div>
    <div class="slide-panel" id="slidePanel">
        <div class="panel-header">
            <h2 class="panel-title" id="panelTitle"></h2>
            <button class="btn-close-panel" onclick="closePanel()">×</button>
        </div>
        
        <div class="panel-image-gallery" id="panelGallery">
            <!-- Галерея буде додана через JS -->
        </div>
        
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
                <div class="description-content" id="descriptionContent">
                    <!-- Заповнюється через JS -->
                </div>
            </div>
            
            <!-- Документи -->
            <div class="tab-pane" id="tab-documents">
                <p style="color: #7f8c8d; text-align: center; padding: 40px 0;">
                    📄 Документація буде доступна незабаром
                </p>
            </div>
        </div>
        
        <div class="panel-cta">
            <button class="btn-cta btn-order" onclick="orderProduct()">
                🛒 Замовити
            </button>
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
            
            // Заповнюємо заголовок
            document.getElementById('panelTitle').textContent = product.title;
            
            // Галерея зображень
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
                            <div class="thumbnail ${index === 0 ? 'active' : ''}" onclick="changeMainImage('{{ asset('') }}${img.image}', this)">
                                <img src="{{ asset('') }}${img.image}" alt="Thumbnail">
                            </div>
                        `;
                    });
                    galleryHTML += '</div>';
                }
                
                gallery.innerHTML = galleryHTML;
            } else {
                gallery.innerHTML = `
                    <div class="main-image">
                        <div style="display: flex; align-items: center; justify-content: center; height: 100%; font-size: 64px; opacity: 0.3;">💻</div>
                    </div>
                `;
            }
            
            // Таблиця характеристик
            const specsTable = document.getElementById('specsTable');
            let specsHTML = '';
            
            if (product.all_specs && product.all_specs.length > 0) {
                product.all_specs.forEach(spec => {
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
            
            // Опис
            const descContent = document.getElementById('descriptionContent');
            if (product.description) {
                descContent.innerHTML = `
                    <div class="price-display">
                        <div class="price-label">Ціна</div>
                        <div class="price-amount">${formatPrice(product.price)} ${product.currency}</div>
                    </div>
                    <p>${product.description.replace(/\n/g, '<br>')}</p>
                `;
            } else {
                descContent.innerHTML = '<p style="color: #7f8c8d; text-align: center; padding: 40px;">Опис продукту буде додано незабаром</p>';
            }
            
            // Показуємо панель
            document.getElementById('slidePanel').classList.add('active');
            document.querySelector('.slide-panel-overlay').classList.add('active');
            document.body.style.overflow = 'hidden';
        }
        
        function closePanel() {
            document.getElementById('slidePanel').classList.remove('active');
            document.querySelector('.slide-panel-overlay').classList.remove('active');
            document.body.style.overflow = '';
            
            // Скидаємо на перший таб
            setTimeout(() => {
                switchTab('specs');
            }, 400);
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
            document.querySelector('#mainImage img').src = imgSrc;
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
                'GPU_VRAM': '🎮',
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
                'GPU_VRAM': 'Пам\'ять GPU',
                'Storage': 'Накопичувач',
                'Storage_Type': 'Тип накопичувача',
                'PSU': 'Блок живлення',
                'Form_Factor': 'Форм-фактор',
                'OS': 'Операційна система'
            };
            return names[key] || key;
        }
        
        function formatPrice(price) {
            return new Intl.NumberFormat('uk-UA').format(price);
        }
        
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
        
        function requestQuote() {
            if (currentProduct) {
                alert(`Запит комерційної пропозиції для: ${currentProduct.title}\n\nДана функція буде реалізована незабаром.`);
                // Тут буде форма запиту КП
            }
        }
        
        // Закриття на Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                // Перевіряємо, що відкрито і закриваємо
                const modal = document.getElementById('orderModal');
                if (modal && modal.classList.contains('active')) {
                    closeOrderModal();
                } else {
                    closePanel();
                }
            }
        });
    </script>

</main>
@endsection
