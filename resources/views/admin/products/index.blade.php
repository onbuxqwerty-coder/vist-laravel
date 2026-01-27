{{--
    Файл: resources/views/admin/products/index.blade.php
    Blade-шаблон для сторінки управління продуктами
--}}

@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-products.css') }}">
@endpush

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
            <a href="{{ route('admin.products.index') }}" class="nav-link active">📋 Список продуктів</a>
            <a href="{{ route('home') }}" class="nav-link">🏠 На головну</a>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="nav-link" style="background: rgba(231, 76, 60, 0.2); border: none; cursor: pointer;">🚪 Вихід</button>
            </form>
        </div>
    </nav>

    @if(session('success'))
        <div class="alert alert-success">
            ✅ {{ session('success') }}
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
            <span class="stat-value">{{ $products->total() }}</span>
        </div>
        <div class="stat-card">
            <span class="stat-label">Активних</span>
            <span class="stat-value active-color">{{ \App\Models\Product::where('is_active', true)->count() }}</span>
        </div>
        <div class="stat-card">
            <span class="stat-label">Неактивних</span>
            <span class="stat-value inactive-color">{{ \App\Models\Product::where('is_active', false)->count() }}</span>
        </div>
    </div>

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
        <button type="button" class="btn-save-statuses" id="saveButton" onclick="saveStatuses()">💾 Зберегти зміни</button>
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
                        <input type="checkbox" id="selectAllCheckbox" class="product-checkbox" onchange="toggleAll(this)">
                    </th>
                    @php
                        $getSortLink = function($column) use ($sortColumn, $sortOrder) {
                            $newOrder = ($column === $sortColumn && $sortOrder === 'asc') ? 'desc' : 'asc';
                            return route('admin.products.index', ['sort' => $column, 'order' => $newOrder]);
                        };
                        $getSortIcon = function($column) use ($sortColumn, $sortOrder) {
                            if ($column !== $sortColumn) return '<span class="sort-icon">⇅</span>';
                            return $sortOrder === 'asc' ? '<span class="sort-icon active">▲</span>' : '<span class="sort-icon active">▼</span>';
                        };
                    @endphp
                    <th class="sortable"><a href="{{ $getSortLink('id') }}">ID {!! $getSortIcon('id') !!}</a></th>
                    <th class="sortable"><a href="{{ $getSortLink('name') }}">Назва {!! $getSortIcon('name') !!}</a></th>
                    <th class="sortable"><a href="{{ $getSortLink('type') }}">Категорія {!! $getSortIcon('type') !!}</a></th>
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
                        $type = $product->type ?? 'other';
                        $typeLabel = $typeLabels[$type] ?? $type;
                        $specsCount = $product->specs()->count();
                        $imagesCount = $product->images()->count();
                    @endphp
                    <tr class="{{ $product->is_active ? '' : 'inactive-row' }}" data-product-id="{{ $product->id }}">
                        <td class="checkbox-cell">
                            <input type="checkbox" 
                                   name="active_products[]" 
                                   value="{{ $product->id }}" 
                                   class="product-checkbox checkbox-item" 
                                   {{ $product->is_active ? 'checked' : '' }} 
                                   onchange="updateCount(); highlightRow(this);">
                        </td>
                        <td class="product-id">#{{ $product->id }}</td>
                        <td class="product-title" title="{{ $product->name }}">{{ Str::limit($product->name, 50) }}</td>
                        <td>
                            <span class="category-badge {{ $type }}">{{ $typeLabel }}</span>
                        </td>
                        <td class="product-price">{{ number_format($product->price, 2, ',', ' ') }} {{ $product->currency }}</td>
                        <td>
                            @if($product->is_active)
                                <span class="badge badge-active">✓ Активний</span>
                            @else
                                <span class="badge badge-inactive">✗ Неактивний</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge badge-info">📊 {{ $specsCount }} характеристик</span>
                            <span class="badge badge-info">🖼️ {{ $imagesCount }} зображень</span>
                        </td>
                        <td>{{ $product->created_at->format('d.m.Y H:i') }}</td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-action btn-edit">✏️ Редагувати</a>
                                <button onclick="deleteProduct({{ $product->id }}, '{{ addslashes($product->name) }}')" class="btn-action btn-delete">🗑️ Видалити</button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="pagination">
                {{ $products->links() }}
            </div>
        @endif
    </div>

    <script>
        function updateCount() {
            const checkboxes = document.querySelectorAll('.checkbox-item:checked');
            document.getElementById('selectedCount').textContent = checkboxes.length;
            
            const allCheckboxes = document.querySelectorAll('.checkbox-item');
            const selectAllCheckbox = document.getElementById('selectAllCheckbox');
            selectAllCheckbox.checked = checkboxes.length === allCheckboxes.length && checkboxes.length > 0;
        }

        function highlightRow(checkbox) {
            const row = checkbox.closest('tr');
            row.classList.toggle('inactive-row', !checkbox.checked);
        }

        function selectAll() {
            document.querySelectorAll('.checkbox-item').forEach(cb => {
                cb.checked = true;
                highlightRow(cb);
            });
            updateCount();
        }

        function deselectAll() {
            document.querySelectorAll('.checkbox-item').forEach(cb => {
                cb.checked = false;
                highlightRow(cb);
            });
            updateCount();
        }

        function toggleAll(checkbox) {
            document.querySelectorAll('.checkbox-item').forEach(cb => {
                cb.checked = checkbox.checked;
                highlightRow(cb);
            });
            updateCount();
        }

        function saveStatuses() {
            const checkedIds = Array.from(document.querySelectorAll('.checkbox-item:checked')).map(cb => cb.value);
            
            if (!confirm(`Зберегти зміни?\n\nАктивних: ${checkedIds.length} продуктів`)) {
                return;
            }

            fetch('{{ route("admin.products.index") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ active_ids: checkedIds })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            });
        }

        function deleteProduct(id, name) {
            if (confirm(`Видалити продукт:\n\n"${name}"?\n\nЦю дію неможливо скасувати!`)) {
                fetch(`{{ route('admin.products.index') }}/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                }).then(response => {
                    if (response.ok) {
                        location.reload();
                    }
                });
            }
        }

        document.addEventListener('DOMContentLoaded', updateCount);
    </script>
</main>
@endsection