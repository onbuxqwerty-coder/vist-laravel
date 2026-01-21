



<?php $__env->startSection('content'); ?>
    <main class="manage-products-page">
        <nav class="admin-nav">
            <div class="admin-nav-title">
                🛠️ Панель управління продуктами
                <span style="font-size: 14px; opacity: 0.8; margin-left: 10px;">
                    (<?php echo e(auth()->user()->name); ?>)
                </span>
            </div>
            <div class="admin-nav-links">
                <a href="<?php echo e(route('admin.products.create')); ?>" class="nav-link">➕ Додати продукт</a>
                <a href="<?php echo e(route('products.index')); ?>" class="nav-link active">📋 Список продуктів</a>
                <a href="<?php echo e(route('home')); ?>" class="nav-link">🏠 На головну</a>
                <a href="<?php echo e(route('logout')); ?>" class="nav-link" style="background: rgba(231, 76, 60, 0.2); border-color: rgba(231, 76, 60, 0.3);">🚪 Вихід</a>
            </div>
        </nav>

        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-error">
                ❌ <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        <div class="stats-bar">
            <div class="stat-card">
                <span class="stat-label">Всього продуктів</span>
                <span class="stat-value"><?php echo e($products->count()); ?></span>
            </div>
            <div class="stat-card">
                <span class="stat-label">Активних</span>
                <span class="stat-value active-color"><?php echo e($products->where('is_active', true)->count()); ?></span>
            </div>
            <div class="stat-card">
                <span class="stat-label">Неактивних</span>
                <span class="stat-value inactive-color"><?php echo e($products->where('is_active', false)->count()); ?></span>
            </div>
        </div>

        <form method="POST" action="<?php echo e(route('products.update-statuses')); ?>" id="publishForm">
            <?php echo csrf_field(); ?>
            <div class="publish-controls">
                <div class="publish-controls-left">
                    <div class="publish-info">
                        📢 Публікація на фронтенді:
                        <strong id="selectedCount">0</strong> обрано
                    </div>
                    <button type="button" class="btn-select-all" onclick="selectAll()">☑️ Вибрати всі</button>
                    <button type="button" class="btn-deselect-all" onclick="deselectAll()">☐ Зняти всі</button>
                    <a href="<?php echo e(route('admin.products.create')); ?>" class="btn-add-new" style="margin-left: 15px;">➕ Додати новий продукт</a>
                </div>
                <button type="submit" name="update_statuses" class="btn-save-statuses" id="saveButton">💾 Зберегти зміни</button>
            </div>

            <div class="products-table">
                <?php if($products->isEmpty()): ?>
                    <div class="empty-state">
                        <div class="empty-state-icon">📭</div>
                        <h2>Продуктів поки немає</h2>
                        <p>Додайте перший продукт, щоб побачити його тут</p>
                        <br>
                        <a href="<?php echo e(route('admin.products.create')); ?>" class="btn-add-new">➕ Додати перший продукт</a>
                    </div>
                <?php else: ?>
                    <table>
                        <thead>
                        <tr>
                            <th style="width: 60px;">
                                <input type="checkbox" id="selectAllCheckbox" class="product-checkbox" onchange="toggleAll(this)" title="Вибрати/зняти всі">
                            </th>
                            <?php
                                $getSortLink = function($column) use ($sortColumn, $sortOrder) {
                                    $newOrder = ($column === $sortColumn && $sortOrder === 'asc') ? 'desc' : 'asc';
                                    return route('products.index', ['sort' => $column, 'order' => $newOrder]);
                                };
                                $getSortIcon = function($column) use ($sortColumn, $sortOrder) {
                                    if ($column !== $sortColumn) return '<span class="sort-icon">⇅</span>';
                                    return $sortOrder === 'asc' ? '<span class="sort-icon active">▲</span>' : '<span class="sort-icon active">▼</span>';
                                };
                            ?>
                            <th class="sortable"><a href="<?php echo e($getSortLink('id')); ?>">ID <?php echo $getSortIcon('id'); ?></a></th>
                            <th class="sortable"><a href="<?php echo e($getSortLink('title')); ?>">Назва <?php echo $getSortIcon('title'); ?></a></th>
                            <th class="sortable"><a href="<?php echo e($getSortLink('category')); ?>">Категорія <?php echo $getSortIcon('category'); ?></a></th>
                            <th class="sortable"><a href="<?php echo e($getSortLink('price')); ?>">Ціна <?php echo $getSortIcon('price'); ?></a></th>
                            <th class="sortable"><a href="<?php echo e($getSortLink('is_active')); ?>">Статус <?php echo $getSortIcon('is_active'); ?></a></th>
                            <th>Дані</th>
                            <th class="sortable"><a href="<?php echo e($getSortLink('created_at')); ?>">Створено <?php echo $getSortIcon('created_at'); ?></a></th>
                            <th>Дії</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $category = $product->category ?? 'other';
                                $categoryLabel = $categoryLabels[$category] ?? $category;
                            ?>
                            <tr class="<?php echo e($product->is_active ? '' : 'inactive-row'); ?>" data-product-id="<?php echo e($product->id); ?>">
                                <td class="checkbox-cell">
                                    <input type="checkbox" name="active_products[]" value="<?php echo e($product->id); ?>" class="product-checkbox checkbox-item" <?php echo e($product->is_active ? 'checked' : ''); ?> onchange="updateCount(); highlightRow(this);" title="<?php echo e($product->is_active ? 'Опубліковано' : 'Не опубліковано'); ?>">
                                </td>
                                <td class="product-id">#<?php echo e($product->id); ?></td>
                                <td class="product-title" title="<?php echo e($product->title); ?>"><?php echo e(Str::limit($product->title, 50)); ?></td>
                                <td>
                                    <span class="category-badge <?php echo e($category); ?>"><?php echo e($categoryLabel); ?></span>
                                </td>
                                <td class="product-price"><?php echo e(number_format($product->price, 2, ',', ' ')); ?> <?php echo e($product->currency); ?></td>
                                <td>
                                    <?php if($product->is_active): ?>
                                        <span class="badge badge-active">✓ Активний</span>
                                    <?php else: ?>
                                        <span class="badge badge-inactive">✗ Неактивний</span>
                                    <?php endif; ?>
                                    <a href="<?php echo e(route('products.toggle-status', $product->id)); ?>" class="quick-toggle" onclick="return confirm('Змінити статус цього продукту?')" title="Швидка зміна статусу">🔄</a>
                                </td>
                                <td>
                                    <span class="badge badge-info">📊 <?php echo e($product->specs_count); ?> характеристик</span>
                                    <span class="badge badge-info">🖼️ <?php echo e($product->images_count); ?> зображень</span>
                                </td>
                                <td><?php echo e($product->created_at->format('d.m.Y H:i')); ?></td>
                                <td>
                                    <div class="actions">
                                        <a href="<?php echo e(route('admin.products.edit', $product->id)); ?>" class="btn-action btn-edit">✏️ Редагувати</a>
                                        <button onclick="deleteProduct(<?php echo e($product->id); ?>, '<?php echo e(addslashes($product->title)); ?>')" class="btn-action btn-delete">🗑️ Видалити</button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </form>

        <script>
            function updateCount() {
                const checkboxes = document.querySelectorAll('.checkbox-item:checked');
                const count = checkboxes.length;
                document.getElementById('selectedCount').textContent = count;
                const allCheckboxes = document.querySelectorAll('.checkbox-item');
                const selectAllCheckbox = document.getElementById('selectAllCheckbox');
                selectAllCheckbox.checked = count === allCheckboxes.length && count > 0;
                selectAllCheckbox.indeterminate = count > 0 && count < allCheckboxes.length;
            }
            function highlightRow(checkbox) {
                const row = checkbox.closest('tr');
                if (checkbox.checked) {
                    row.classList.remove('inactive-row');
                } else {
                    row.classList.add('inactive-row');
                }
            }
            function selectAll() {
                const checkboxes = document.querySelectorAll('.checkbox-item');
                checkboxes.forEach(cb => {
                    cb.checked = true;
                    highlightRow(cb);
                });
                updateCount();
            }
            function deselectAll() {
                const checkboxes = document.querySelectorAll('.checkbox-item');
                checkboxes.forEach(cb => {
                    cb.checked = false;
                    highlightRow(cb);
                });
                updateCount();
            }
            function toggleAll(checkbox) {
                const checkboxes = document.querySelectorAll('.checkbox-item');
                checkboxes.forEach(cb => {
                    cb.checked = checkbox.checked;
                    highlightRow(cb);
                });
                updateCount();
            }
            document.getElementById('publishForm').addEventListener('submit', function(e) {
                const checkedCount = document.querySelectorAll('.checkbox-item:checked').length;
                const totalCount = document.querySelectorAll('.checkbox-item').length;
                if (!confirm(`Ви впевнені?\n\nБуде опубліковано: ${checkedCount} з ${totalCount} продуктів\nНеопубліковано: ${totalCount - checkedCount} продуктів`)) {
                    e.preventDefault();
                }
            });
            document.addEventListener('DOMContentLoaded', function() {
                updateCount();
                document.querySelectorAll('.checkbox-item').forEach(cb => {
                    highlightRow(cb);
                });
            });
            function deleteProduct(id, title) {
                if (confirm(`Ви впевнені, що хочете видалити продукт:\n\n"${title}"\n\nЦю дію неможливо скасувати!`)) {
                    fetch(`<?php echo e(route('admin.products.destroy', '')); ?>/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                            'Accept': 'application/json'
                        }
                    }).then(response => {
                        if (response.ok) {
                            window.location.reload();
                        }
                    });
                }
            }
        </script>
    </main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\liqwood\Herd\vist-laravel\resources\views/admin/products/index.blade.php ENDPATH**/ ?>