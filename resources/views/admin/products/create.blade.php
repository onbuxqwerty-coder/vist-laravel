@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-form.css') }}">
@endpush

@section('content')
<main class="add-product-page">
    <nav class="admin-nav">
        <div class="admin-nav-title">
            ➕ Додати новий продукт
            <span style="font-size: 14px; opacity: 0.8; margin-left: 10px;">
                ({{ auth()->user()->name }})
            </span>
        </div>
        <div class="admin-nav-links">
            <a href="{{ route('admin.products.index') }}" class="nav-link">📋 Список продуктів</a>
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

    @if($errors->any())
        <div class="alert alert-error">
            ❌ Помилки при заповненні форми:
            <ul style="margin: 10px 0 0 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-container">
        <div class="form-header">
            <h1>📦 Новий продукт</h1>
        </div>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- ОСНОВНА ІНФОРМАЦІЯ -->
            <div class="form-section">
                <h2>Основна інформація</h2>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>
                            Назва продукту <span class="required">*</span>
                        </label>
                        <input type="text" name="title" value="{{ old('title') }}" required>
                        <span class="help-text">Наприклад: "Сервер Dell PowerEdge R720"</span>
                    </div>

                    <div class="form-group">
                        <label>
                            Slug (URL)
                        </label>
                        <input type="text" name="slug" value="{{ old('slug') }}">
                        <span class="help-text">Залиште порожнім для автогенерації</span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>
                            Категорія <span class="required">*</span>
                        </label>
                        <select name="category" required>
                            <option value="">-- Оберіть категорію --</option>
                            @foreach($typeLabels as $key => $label)
                                <option value="{{ $key }}" {{ old('category') == $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>
                            Ціна (грн) <span class="required">*</span>
                        </label>
                        <input type="number" name="price" step="0.01" value="{{ old('price') }}" required>
                        <span class="help-text">Вкажіть ціну в гривнях</span>
                    </div>
                </div>

                <div class="form-group">
                    <label>Короткий опис</label>
                    <textarea name="subtitle" rows="3">{{ old('subtitle') }}</textarea>
                    <span class="help-text">Короткий опис для каталогу (1-2 речення)</span>
                </div>

                <div class="form-group">
                    <label>Повний опис</label>
                    <textarea name="description" rows="6">{{ old('description') }}</textarea>
                    <span class="help-text">Детальний опис продукту</span>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                    <label for="is_active">✓ Опублікувати на сайті (активний)</label>
                </div>
            </div>

            <!-- ХАРАКТЕРИСТИКИ -->
            <div class="form-section">
                <h2>📊 Технічні характеристики</h2>
                
                <div class="specs-container" id="specsContainer">
                    <!-- Початкова характеристика -->
                    <div class="spec-item">
                        <div class="form-group" style="margin: 0;">
                            <label>Назва характеристики</label>
                            <select name="specs[0][name]" class="spec-name-select" onchange="toggleCustomInput(this)">
                                <option value="">-- Оберіть характеристику --</option>
                                <option value="Device_Class">Device_Class</option>
                                <option value="CPU">CPU</option>
                                <option value="CPU_Type">CPU_Type</option>
                                <option value="RAM">RAM</option>
                                <option value="RAM_Type">RAM_Type</option>
                                <option value="GPU">GPU</option>
                                <option value="GPU_VRAM">GPU_VRAM</option>
                                <option value="Storage">Storage</option>
                                <option value="Storage_Type">Storage_Type</option>
                                <option value="PSU">PSU</option>
                                <option value="Form_Factor">Form_Factor</option>
                                <option value="Controller">Controller</option>
                                <option value="Controller_Type">Controller_Type</option>
                                <option value="Management">Management</option>
                                <option value="Management_Type">Management_Type</option>
                                <option value="OS">OS</option>
                                <option value="Other">Other</option>
                                <option value="custom">✏️ Власна назва...</option>
                            </select>
                            <input type="text" name="specs[0][name_custom]" placeholder="Введіть свою назву" style="margin-top: 5px; display: none;">
                        </div>
                        <div class="form-group" style="margin: 0;">
                            <label>Значення</label>
                            <input type="text" name="specs[0][value]" placeholder="Наприклад: Intel Xeon E5-2620">
                        </div>
                        <button type="button" class="btn-remove-spec" onclick="removeSpec(this)">🗑️</button>
                    </div>
                </div>
                
                <button type="button" class="btn-add-spec" onclick="addSpec()">Додати характеристику</button>
            </div>

            <!-- ЗОБРАЖЕННЯ -->
            <div class="form-section">
                <h2>🖼️ Зображення продукту</h2>
                
                <div class="images-container">
                    <div class="form-group">
                        <label>Фото 1 (головне)</label>
                        <div class="file-input-wrapper">
                            <input type="file" name="images[]" id="image1" accept="image/*">
                            <label for="image1" class="file-input-label">
                                📁 Вибрати зображення (файлка)
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Фото 2</label>
                        <div class="file-input-wrapper">
                            <input type="file" name="images[]" id="image2" accept="image/*">
                            <label for="image2" class="file-input-label">
                                📁 Вибрати зображення (файлка)
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Фото 3</label>
                        <div class="file-input-wrapper">
                            <input type="file" name="images[]" id="image3" accept="image/*">
                            <label for="image3" class="file-input-label">
                                📁 Вибрати зображення (файлка)
                            </label>
                        </div>
                    </div>
                    
                    <span class="help-text">
                        📌 Підтримуються: JPG, PNG, GIF, WebP. Макс. 5MB на файл.
                    </span>
                </div>
            </div>

            <!-- КНОПКИ -->
            <div class="form-actions">
                <button type="submit" class="btn-submit">💾 Зберегти продукт</button>
                <a href="{{ route('admin.products.index') }}" class="btn-reset" style="text-align: center; text-decoration: none; display: flex; align-items: center; justify-content: center;">❌ Скасувати</a>
            </div>
        </form>
    </div>

    <script>
        let specCounter = 1;

        function addSpec() {
            const container = document.getElementById('specsContainer');
            const newSpec = document.createElement('div');
            newSpec.className = 'spec-item';
            newSpec.innerHTML = `
                <div class="form-group" style="margin: 0;">
                    <label>Назва характеристики</label>
                    <select name="specs[${specCounter}][name]" class="spec-name-select" onchange="toggleCustomInput(this)">
                        <option value="">-- Оберіть характеристику --</option>
                        <option value="Device_Class">Device_Class</option>
                        <option value="CPU">CPU</option>
                        <option value="CPU_Type">CPU_Type</option>
                        <option value="RAM">RAM</option>
                        <option value="RAM_Type">RAM_Type</option>
                        <option value="GPU">GPU</option>
                        <option value="GPU_VRAM">GPU_VRAM</option>
                        <option value="Storage">Storage</option>
                        <option value="Storage_Type">Storage_Type</option>
                        <option value="PSU">PSU</option>
                        <option value="Form_Factor">Form_Factor</option>
                        <option value="Controller">Controller</option>
                        <option value="Controller_Type">Controller_Type</option>
                        <option value="Management">Management</option>
                        <option value="Management_Type">Management_Type</option>
                        <option value="OS">OS</option>
                        <option value="Other">Other</option>
                        <option value="custom">✏️ Власна назва...</option>
                    </select>
                    <input type="text" name="specs[${specCounter}][name_custom]" placeholder="Введіть свою назву" style="margin-top: 5px; display: none;">
                </div>
                <div class="form-group" style="margin: 0;">
                    <label>Значення</label>
                    <input type="text" name="specs[${specCounter}][value]" placeholder="Наприклад: 32 GB DDR4">
                </div>
                <button type="button" class="btn-remove-spec" onclick="removeSpec(this)">🗑️</button>
            `;
            container.appendChild(newSpec);
            specCounter++;
        }

        function removeSpec(button) {
            const container = document.getElementById('specsContainer');
            if (container.children.length > 1) {
                button.parentElement.remove();
            } else {
                alert('Має залишитись хоча б одна характеристика!');
            }
        }

        function toggleCustomInput(select) {
            const customInput = select.nextElementSibling;
            if (select.value === 'custom') {
                customInput.style.display = 'block';
                customInput.required = true;
            } else {
                customInput.style.display = 'none';
                customInput.required = false;
                customInput.value = '';
            }
        }

        // Показ назв файлів при виборі
        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', function() {
                const label = this.nextElementSibling;
                if (this.files.length > 0) {
                    label.textContent = '✅ ' + this.files[0].name;
                    label.style.background = '#d4edda';
                    label.style.borderColor = '#27ae60';
                    label.style.color = '#155724';
                } else {
                    label.innerHTML = '📁 Вибрати зображення (файлка)';
                    label.style.background = 'white';
                    label.style.borderColor = '#3498db';
                    label.style.color = '#3498db';
                }
            });
        });

        // Ініціалізація для першого select
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.spec-name-select').forEach(select => {
                select.addEventListener('change', function() {
                    toggleCustomInput(this);
                });
            });
        });
    </script>
</main>
@endsection