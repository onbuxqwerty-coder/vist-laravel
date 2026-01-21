{{--
    Файл: resources/views/products/index.blade.php
    Blade-шаблон для сторінки управління продуктами
--}}

@extends('layouts.app')

@section('content')
    <main class="manage-products-page">
        <nav class="admin-nav">
            <div class="admin-nav-title">
                🛠️ Панель управління продуктами
                <span style="font-size: 14px; opacity: 0.8; margin-left: 10px;">
                    ({{ auth()->user()->name }})
                </span>
            </div>
            <div class="admin-nav-links">
                <a href="{{ route('admin.products.create') }}" class="nav-link">➕ Додати продукт</a>
                <a href="{{ route('products.index') }}" class="nav-link active">📋 Список продуктів</a>
                <a href="{{ route('home') }}" class="nav-link">🏠 На головну</a>
                <a href="{{ route('logout') }}" class="nav-link" style="background: rgba(231, 76, 60, 0.2); border-color: rgba(231, 76, 60, 0.3);">🚪 Вихід</a>
            </div>
        </nav>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                ❌ {{ session('error') }}
            </div>
        @endif

        <div class="stats-bar">
            <div class="stat-card">
                <span class="stat-label">Всього продуктів</span>
                <span class="stat-value">{{ $products->count() }}</span>
            </div>
            <div class="stat-card">
                <span class="stat-label">Активних</span>
                <span class="stat-value active-color">{{ $products->where('is_active', true)->count() }}</span>
            </div>
            <div class="stat-card">
                <span class="stat-label">Неактивних</span>
                <span class="stat-value inactive-color">{{ $products->where('is_active', false)->count() }}</span>
            </div>
        </div>

        <form method="POST" action="{{ route('products.update-statuses') }}" id="publishForm">
            @csrf
            <div class="publish-controls">
                <div class="publish-controls-left">
                    <div class="publish-info">
                        📢 Публікація на фронтенді:
                        <strong id="selectedCount">0</strong> обрано
                    </div>
                    <button type="button" class="btn-select-all" onclick="selectAll()">☑️ Вибрати всі</button>
                    <button type="button" class="btn-deselect-all" onclick="deselectAll()">☐ Зняти всі</button>
                    <a href="{{ route('admin.products.create') }}" class="btn-add-new" style="margin-left: 15px;">➕ Додати новий продукт</a>
                </div>
                <button type="submit" name="update_statuses" class="btn-save-statuses" id="saveButton">💾 Зберегти зміни</button>
            </div>

            <div class="products-table">
                @if($products->isEmpty())
                    <div class="empty-state">
                        <div class="empty-state-icon">📭</div>
                        <h2>Продуктів поки немає</h2>
                        <p>Додайте перший продукт, щоб побачити його тут</p>
                        <br>
                        <a href="{{ route('admin.products.create') }}" class="btn-add-new">➕ Додати перший продукт</a>
                    </div>
                @else
                    <table>
                        <thead>
                        <tr>
                            <th style="width: 60px;">
                                <input type="checkbox" id="selectAllCheckbox" class="product-checkbox" onchange="toggleAll(this)" title="Вибрати/зняти всі">
                            </th>
                            @php
                                $getSortLink = function($column) use ($sortColumn, $sortOrder) {
                                    $newOrder = ($column === $sortColumn && $sortOrder === 'asc') ? 'desc' : 'asc';
                                    return route('products.index', ['sort' => $column, 'order' => $newOrder]);
                                };
                                $getSortIcon = function($column) use ($sortColumn, $sortOrder) {
                                    if ($column !== $sortColumn) return '<span class="sort-icon">⇅</span>';
                                    return $sortOrder === 'asc' ? '<span class="sort-icon active">▲</span>' : '<span class="sort-icon active">▼</span>';
                                };
                            @endphp
                            <th class="sortable"><a href="{{ $getSortLink('id') }}">ID {!! $getSortIcon('id') !!}</a></th>
                            <th class="sortable"><a href="{{ $getSortLink('title') }}">Назва {!! $getSortIcon('title') !!}</a></th>
                            <th class="sortable"><a href="{{ $getSortLink('category') }}">Категорія {!! $getSortIcon('category') !!}</a></th>
                            <th class="sortable"><a href="{{ $getSortLink('price') }}">Ціна {!! $getSortIcon('price') !!}</a></th>
                            <th class="sortable"><a href="{{ $getSortLink('is_active') }}">Статус {!! $getSortIcon('is_active') !!}</a></th>
                            <th>Дані</th>
                            <th class="sortable"><a href="{{ $getSortLink('created_at') }}">Створено {!! $getSortIcon('created_at') !!}</a></th>
                            <th>Дії</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            @php
                                $category = $product->category ?? 'other';
                                $categoryLabel = $categoryLabels[$category] ?? $category;
                            @endphp
                            <tr class="{{ $product->is_active ? '' : 'inactive-row' }}" data-product-id="{{ $product->id }}">
                                <td class="checkbox-cell">
                                    <input type="checkbox" name="active_products[]" value="{{ $product->id }}" class="product-checkbox checkbox-item" {{ $product->is_active ? 'checked' : '' }} onchange="updateCount(); highlightRow(this);" title="{{ $product->is_active ? 'Опубліковано' : 'Не опубліковано' }}">
                                </td>
                                <td class="product-id">#{{ $product->id }}</td>
                                <td class="product-title" title="{{ $product->title }}">{{ Str::limit($product->title, 50) }}</td>
                                <td>
                                    <span class="category-badge {{ $category }}">{{ $categoryLabel }}</span>
                                </td>
                                <td class="product-price">{{ number_format($product->price, 2, ',', ' ') }} {{ $product->currency }}</td>
                                <td>
                                    @if($product->is_active)
                                        <span class="badge badge-active">✓ Активний</span>
                                    @else
                                        <span class="badge badge-inactive">✗ Неактивний</span>
                                    @endif
                                    <a href="{{ route('products.toggle-status', $product->id) }}" class="quick-toggle" onclick="return confirm('Змінити статус цього продукту?')" title="Швидка зміна статусу">🔄</a>
                                </td>
                                <td>
                                    <span class="badge badge-info">📊 {{ $product->specs_count }} характеристик</span>
                                    <span class="badge badge-info">🖼️ {{ $product->images_count }} зображень</span>
                                </td>
                                <td>{{ $product->created_at->format('d.m.Y H:i') }}</td>
                                <td>
                                    <div class="actions">
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-action btn-edit">✏️ Редагувати</a>
                                        <button onclick="deleteProduct({{ $product->id }}, '{{ addslashes($product->title) }}')" class="btn-action btn-delete">🗑️ Видалити</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
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
                    fetch(`{{ route('admin.products.destroy', '') }}/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
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
@endsection