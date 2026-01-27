@extends('layouts.app')

@section('title', $typeName)

@section('content')
<style>
body {
    background: rgba(188, 208, 255, 1) !important;
}

.workstation-page {
    max-width: 1260px;
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

.products-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
    margin-bottom: 40px;
}

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
    background: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    position: relative;
}

.product-card-image img {
    width: 100%;
    height: 100%;
    object-fit: contain;
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

.product-desc {
    color: #7f8c8d;
    font-size: 14px;
    margin-bottom: 15px;
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
    visibility: hidden;
    transition: all 0.4s ease;
}

.slide-panel-overlay.active {
    opacity: 1;
    visibility: visible;
}

.panel-header {
    position: sticky;
    top: 0;
    background: white;
    padding: 25px 30px;
    border-bottom: 2px solid #ecf0f1;
    display: flex;
    justify-content: space-between;
    align-items: center;
    z-index: 10;
}

.btn-close-panel {
    background: #ecf0f1;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 24px;
    transition: all 0.3s ease;
}

.btn-close-panel:hover {
    background: #d5dbdb;
    transform: rotate(90deg);
}

.panel-image-gallery {
    padding: 20px 30px;
    background: #f8f9fa;
}

.main-image {
    width: 100%;
    height: 400px;
    border-radius: 12px;
    overflow: hidden;
    margin-bottom: 15px;
    background: white;
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
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
}

.thumbnail {
    height: 100px;
    border-radius: 8px;
    overflow: hidden;
    cursor: pointer;
    border: 3px solid transparent;
    transition: all 0.3s ease;
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
}

.thumbnail:hover {
    border-color: #3498db;
}

.thumbnail.active {
    border-color: #3498db;
}

.thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

/* Вкладки */
.panel-tabs {
    display: flex;
    border-bottom: 2px solid #ecf0f1;
    padding: 0 30px;
    background: white;
    position: sticky;
    top: 87px;
    z-index: 9;
}

.tab-button {
    flex: 1;
    padding: 15px 20px;
    background: none;
    border: none;
    border-bottom: 3px solid transparent;
    font-size: 15px;
    font-weight: 600;
    color: #7f8c8d;
    cursor: pointer;
    transition: all 0.3s ease;
}

.tab-button:hover {
    color: #3498db;
}

.tab-button.active {
    color: #3498db;
    border-bottom-color: #3498db;
}

.panel-content {
    padding: 30px;
}

.tab-pane {
    display: none;
}

.tab-pane.active {
    display: block;
}

/* Таблиця характеристик */
.specs-table {
    width: 100%;
    border-collapse: collapse;
}

.specs-table tr {
    border-bottom: 1px solid #ecf0f1;
}

.specs-table td {
    padding: 15px 10px;
}

.specs-table td:first-child {
    font-weight: 600;
    color: #7f8c8d;
    width: 45%;
}

.specs-table td:last-child {
    color: #2c3e50;
    font-weight: 500;
}

.spec-key-label {
    display: flex;
    align-items: center;
    gap: 8px;
}

.price-display {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 20px;
    text-align: center;
}

.price-amount {
    font-size: 32px;
    font-weight: 700;
    color: #27ae60;
}

.panel-cta {
    position: sticky;
    bottom: 0;
    background: white;
    padding: 20px 30px;
    border-top: 2px solid #ecf0f1;
    display: flex;
    gap: 15px;
}

.btn-cta {
    flex: 1;
    padding: 16px 24px;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    border: none;
}

.btn-order {
    background: #27ae60;
    color: white;
}

.btn-request {
    background: #3498db;
    color: white;
}

@media (max-width: 1024px) {
    .products-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}
</style>

<main class="workstation-page">
<div class="page-hero">
    <h1>💻 {{ $typeName }}</h1>
    <p>Професійні рішення для вашого бізнесу</p>
</div>

@if($products->isEmpty())
    <div style="text-align: center; padding: 80px 20px;">
        <div style="font-size: 64px; opacity: 0.3;">📦</div>
        <h2>Продуктів поки немає</h2>
    </div>
@else
    <div class="products-grid">
        @foreach($products as $product)
            <div class="product-card" onclick='openPanel({!! htmlspecialchars(json_encode($product), ENT_QUOTES, "UTF-8") !!})'>
			<div class="product-card-image">
				@php
					$cardImage = optional(
						$product->images->sortByDesc('is_primary')->first()
					)->image;
				@endphp

				@if($cardImage)
					<img src="{{ $product->main_image_url }}" alt="{{ $product->name }}">
				@else
					<div style="font-size: 64px; opacity: 0.3;">💻</div>
				@endif

				<span class="product-badge">Доступно</span>
			</div>

                
                <div class="product-card-content">
                    <h3 class="product-card-title">{{ $product->name }}</h3>
                    
                    @if($product->short_desc)
                        <p class="product-desc">{{ $product->short_desc }}</p>
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
            </div>
        @endforeach
    </div>
@endif

<div class="slide-panel-overlay" onclick="closePanel()"></div>
<div class="slide-panel" id="slidePanel">
    <div class="panel-header">
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
        <button class="btn-cta btn-order">🛒 Замовити</button>
        <button class="btn-cta btn-request">📧 Запит КП</button>
    </div>
</div>

<script>
let currentProduct = null;

function openPanel(product) {
    currentProduct = product;
    document.getElementById('panelTitle').textContent = product.name;
    document.getElementById('panelPrice').textContent = formatPrice(product.price) + ' ' + product.currency;
    document.getElementById('panelDescription').textContent = product.description || product.short_desc || 'Опис продукту';
    
    // Галерея
    const gallery = document.getElementById('panelGallery');
    if (product.images && product.images.length > 0) {
        const mainImg = product.images[0].image;
        let galleryHTML = `
            <div class="main-image" id="mainImage">
                <img src="{{ asset('') }}${mainImg}" alt="${product.name}">
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
    } else if (product.image) {
        gallery.innerHTML = '<div class="main-image"><img src="{{ asset('') }}' + product.image + '" alt="' + product.name + '"></div>';
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
</script>

</main>
@endsection
