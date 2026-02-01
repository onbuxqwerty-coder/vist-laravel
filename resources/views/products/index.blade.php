@extends('layouts.app')

@section('title', $typeName)

@push('styles')
<link rel="stylesheet" href="{{ asset('css/products-index.css') }}">
@endpush

@section('content')

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
                document.getElementById('modalProductName').textContent = currentProduct.name;
                document.getElementById('productNameInput').value = currentProduct.name;
                
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
