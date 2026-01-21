<?php $__env->startSection('title', $pageTitle); ?>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/catalog.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<main class="product-catalog-page">
    <div class="page-hero">
        <h1><?php echo e($config['title']); ?></h1>
        <p><?php echo e($config['subtitle']); ?></p>
    </div>

    <?php if($products->isEmpty()): ?>
        <div style="text-align: center; padding: 60px 0; color: #7f8c8d;">
            <div style="font-size: 64px; margin-bottom: 20px;"><?php echo e($config['empty_icon']); ?></div>
            <h3>Продукти не знайдені</h3>
            <p>На жаль, у цій категорії наразі немає доступних товарів.</p>
        </div>
    <?php else: ?>
        <div class="products-grid">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="product-card" onclick="openPanel(<?php echo e(Js::from($product)); ?>)">
                    <div class="product-card-image">
                        <?php
                            // Отримуємо primary зображення з колекції images
                            $primaryImage = $product->images->where('is_primary', 1)->first();
                            $imageUrl = $primaryImage ? $primaryImage->image : ($product->images->first()->image ?? 'img/placeholder-product.jpg');
                        ?>
                        <img src="<?php echo e(asset($imageUrl)); ?>" alt="<?php echo e($product->title); ?>">
                        <?php if($product->status === 'in_stock'): ?>
                            <span class="product-badge">В наявності</span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="product-card-content">
                        <h3 class="product-card-title"><?php echo e($product->title); ?></h3>
                        
                        <?php if($product->specs && $product->specs->isNotEmpty()): ?>
                            <div class="product-key-specs">
                                <?php $__currentLoopData = $product->specs->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $spec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="key-spec-item">
                                        <span class="key-spec-icon">
                                            <?php
                                                $icon = match(strtoupper($spec->spec_key)) {
                                                    'CPU' => '🔧',
                                                    'RAM' => '💾',
                                                    'GPU' => '🎮',
                                                    'STORAGE' => '💿',
                                                    default => '⚙️'
                                                };
                                            ?>
                                            <?php echo e($icon); ?>

                                        </span>
                                        <span class="key-spec-value"><?php echo e(Str::limit($spec->spec_value, 20)); ?></span>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="product-price">
                            <div class="price-value">
                                <?php echo e(number_format($product->price, 0, ',', ' ')); ?>

                                <span class="price-currency"><?php echo e($product->currency); ?></span>
                            </div>
                            <button class="btn-details" onclick="event.stopPropagation(); openPanel(<?php echo e(Js::from($product)); ?>)">
                                Детальніше →
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="pagination-container">
            <?php echo e($products->links()); ?>

        </div>
    <?php endif; ?>

    <div class="side-panel-overlay" id="panelOverlay" onclick="closePanel()"></div>
    <div class="side-panel" id="sidePanel">
        <div class="panel-header">
            <h2 class="panel-title" id="panelTitle">Назва продукту</h2>
            <button class="close-panel" onclick="closePanel()">&times;</button>
        </div>
        
        <div class="panel-body">
            <div class="panel-image-section">
                <img id="mainPreviewImage" class="main-preview-image" src="" alt="">
                <div id="thumbnailList" class="thumbnail-list"></div>
            </div>
            
            <div id="panelDescription" class="panel-description"></div>
            
            <h3 class="panel-section-title">Технічні характеристики</h3>
            <div id="panelSpecs" class="specs-grid"></div>
            
            <div class="panel-info">
                <div class="info-row">
                    <span class="info-label">Категорія:</span>
                    <span class="info-value" id="panelCategory"></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Статус:</span>
                    <span class="info-value" id="panelStatus"></span>
                </div>
            </div>
        </div>
        
        <div class="panel-footer">
            <div class="panel-price">
                <span class="price-label">Ціна:</span>
                <span class="price-value" id="panelPrice"></span>
            </div>
            <button class="btn-quote" onclick="requestQuote()">Запитати КП</button>
            <button class="btn-order" onclick="orderProduct()">Замовити</button>
        </div>
    </div>

    <script>
        let currentProduct = null;

        function openPanel(product) {
            currentProduct = product;
            document.getElementById('panelTitle').innerText = product.title;
            
            // Головне зображення - шукаємо primary
            let mainImage = 'img/placeholder-product.jpg';
            if (product.images && product.images.length > 0) {
                const primaryImg = product.images.find(img => img.is_primary === 1);
                mainImage = primaryImg ? primaryImg.image : product.images[0].image;
            }
            document.getElementById('mainPreviewImage').src = `/${mainImage}`;
            
            // Галерея мініатюр
            const thumbList = document.getElementById('thumbnailList');
            thumbList.innerHTML = '';
            if (product.images && product.images.length > 1) {
                product.images.forEach((img, index) => {
                    const thumb = document.createElement('img');
                    thumb.src = `/${img.image}`;
                    thumb.className = 'thumbnail' + (img.is_primary ? ' active' : '');
                    thumb.alt = img.alt_text || product.title;
                    thumb.onclick = () => updateMainImage(thumb.src, thumb);
                    thumbList.appendChild(thumb);
                });
            }

            // Опис
            const descElement = document.getElementById('panelDescription');
            descElement.innerHTML = product.description || '<p>Опис відсутній</p>';

            // Технічні характеристики
            const specsGrid = document.getElementById('panelSpecs');
            specsGrid.innerHTML = '';
            if (product.specs && product.specs.length > 0) {
                product.specs.forEach(spec => {
                    specsGrid.innerHTML += `
                        <div class="spec-row">
                            <span class="spec-label">${getSpecIcon(spec.spec_key)} ${formatSpecKey(spec.spec_key)}</span>
                            <span class="spec-value">${spec.spec_value}</span>
                        </div>
                    `;
                });
            }
            
            // Категорія
            const categoryNames = {
                'workstation': 'Робоча станція',
                'server': 'Сервер',
                'ipc': 'Промисловий ПК',
                'ups': 'ДБЖ'
            };
            document.getElementById('panelCategory').innerText = categoryNames[product.category] || product.category;
            
            // Статус
            const statusNames = {
                'in_stock': 'В наявності',
                'out_of_stock': 'Немає в наявності',
                'by_order': 'Під замовлення'
            };
            document.getElementById('panelStatus').innerText = statusNames[product.status] || product.status;
            
            // Ціна
            document.getElementById('panelPrice').innerText = 
                new Intl.NumberFormat('uk-UA').format(product.price) + ' ' + product.currency;

            document.getElementById('panelOverlay').classList.add('active');
            document.getElementById('sidePanel').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closePanel() {
            document.getElementById('panelOverlay').classList.remove('active');
            document.getElementById('sidePanel').classList.remove('active');
            document.body.style.overflow = '';
        }

        function updateMainImage(imgSrc, thumbnail) {
            document.getElementById('mainPreviewImage').src = imgSrc;
            document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
            thumbnail.classList.add('active');
        }

        function getSpecIcon(key) {
            const icons = {
                'CPU': '🔧',
                'CPU_Type': '⚙️',
                'RAM': '💾',
                'RAM_Type': '🔲',
                'GPU': '🎮',
                'GPU_VRAM': '🎯',
                'Storage': '💿',
                'Storage_Type': '📀',
                'PSU': '⚡',
                'OS': '🖥️',
                'Controller': '🎛️',
                'Management': '🔐',
                'Device_Class': '📦',
                'Form_Factor': '📐'
            };
            return icons[key] || '⚙️';
        }

        function formatSpecKey(key) {
            const names = {
                'CPU': 'Процесор',
                'CPU_Type': 'Тип процесора',
                'RAM': 'Оперативна пам\'ять',
                'RAM_Type': 'Тип пам\'яті',
                'GPU': 'Відеокарта',
                'GPU_VRAM': 'Відеопам\'ять',
                'Storage': 'Накопичувач',
                'Storage_Type': 'Тип накопичувача',
                'PSU': 'Блок живлення',
                'OS': 'Операційна система',
                'Controller': 'Контролер',
                'Controller_Type': 'Тип контролера',
                'Management': 'Керування',
                'Management_Type': 'Тип керування',
                'Device_Class': 'Клас пристрою',
                'Form_Factor': 'Форм-фактор'
            };
            return names[key] || key;
        }

        function orderProduct() {
            if (!currentProduct) return;
            alert(`Замовлення продукту: ${currentProduct.title}\nФункція в розробці`);
        }
        
        function requestQuote() {
            if (!currentProduct) return;
            alert(`Запит комерційної пропозиції для: ${currentProduct.title}\nФункція в розробці`);
        }

        // Закриття панелі по Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closePanel();
            }
        });
    </script>
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\liqwood\Herd\vist-laravel\resources\views/products/catalog.blade.php ENDPATH**/ ?>