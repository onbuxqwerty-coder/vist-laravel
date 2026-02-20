@extends('layouts.app')

@section('body-class', 'create-product-page')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-products.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin-form.css') }}">
@endpush

@section('content')
<main class="manage-products-page">
    <nav class="admin-nav">
        <div class="admin-nav-title">
            Редагувати продукт
        </div>
        <div class="admin-nav-links">
            <a href="{{ route('admin.products.index') }}" class="nav-link">Продукти</a>
            <a href="{{ route('admin.products.create') }}" class="nav-link">Додати продукт</a>
            <a href="{{ route('admin.appeals.index') }}" class="nav-link">Звернення</a>
            <a href="{{ route('admin.dashboard') }}" class="nav-link">Дашборд</a>
            <a href="{{ route('home') }}" class="nav-link">На головну</a>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="nav-link" style="background: rgba(231, 76, 60, 0.2); border: none; cursor: pointer;">Вихід</button>
            </form>
        </div>
    </nav>


    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-error">
            Помилки при заповненні форми:
            <ul style="margin: 10px 0 0 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-container">
        <div class="form-header">
            <h1>Редагування: {{ $product->title }}</h1>
        </div>

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- ОСНОВНА ІНФОРМАЦІЯ -->
            <div class="form-section">
                <h2>Основна інформація</h2>

                <div class="form-row">
                    <div class="form-group">
                        <label>
                            Назва продукту <span class="required">*</span>
                        </label>
                        <input type="text" name="title" value="{{ old('title', $product->title) }}" required>
                        <span class="help-text">Наприклад: "Сервер Dell PowerEdge R720"</span>
                    </div>

                    <div class="form-group">
                        <label>
                            Slug (URL)
                        </label>
                        <input type="text" name="slug" value="{{ old('slug', $product->slug) }}">
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
                                <option value="{{ $key }}" {{ old('category', $product->category) == $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>
                            Ціна (грн) <span class="required">*</span>
                        </label>
                        <input type="number" name="price" step="0.01" value="{{ old('price', $product->price) }}" required>
                        <span class="help-text">Вкажіть ціну в гривнях</span>
                    </div>
                </div>

                <div class="form-group">
                    <label>Короткий опис</label>
                    <textarea name="subtitle" rows="3">{{ old('subtitle', $product->subtitle) }}</textarea>
                    <span class="help-text">Короткий опис для каталогу (1-2 речення)</span>
                </div>

                <div class="form-group">
                    <label>Повний опис</label>
                    <textarea name="description" rows="6">{{ old('description', $product->description) }}</textarea>
                    <span class="help-text">Детальний опис продукту</span>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                    <label for="is_active">Опублікувати на сайті (активний)</label>
                </div>
            </div>

            <!-- ХАРАКТЕРИСТИКИ -->
            <div class="form-section">
                <h2>Технічні характеристики</h2>

                <div class="specs-container" id="specsContainer">
                    @php
                        $existingSpecs = $product->specs ?? collect();
                        $specIndex = 0;
                    @endphp

                    @forelse($existingSpecs as $spec)
                        <div class="spec-item">
                            <div class="form-group" style="margin: 0;">
                                <label>Назва характеристики</label>
                                <select name="specs[{{ $specIndex }}][name]" class="spec-name-select" onchange="toggleCustomInput(this)">
                                    <option value="">-- Оберіть характеристику --</option>
                                    <option value="Device_Class" {{ $spec->spec_key == 'Device_Class' ? 'selected' : '' }}>Клас пристрою</option>
                                    <option value="CPU" {{ $spec->spec_key == 'CPU' ? 'selected' : '' }}>Процесор</option>
                                    <option value="RAM" {{ $spec->spec_key == 'RAM' ? 'selected' : '' }}>Оперативна пам'ять</option>
                                    <option value="GPU" {{ $spec->spec_key == 'GPU' ? 'selected' : '' }}>Відеокарта</option>
                                    <option value="Storage" {{ $spec->spec_key == 'Storage' ? 'selected' : '' }}>Накопичувач</option>
                                    <option value="PSU" {{ $spec->spec_key == 'PSU' ? 'selected' : '' }}>Блок живлення</option>
                                    <option value="Form_Factor" {{ $spec->spec_key == 'Form_Factor' ? 'selected' : '' }}>Форм-фактор</option>
                                    <option value="OS" {{ $spec->spec_key == 'OS' ? 'selected' : '' }}>Операційна система</option>
                                    <option value="custom">Власна назва...</option>
                                </select>
                                <input type="text" name="specs[{{ $specIndex }}][name_custom]" placeholder="Введіть свою назву" style="margin-top: 5px; display: none;">
                            </div>
                            <div class="form-group" style="margin: 0;">
                                <label>Значення</label>
                                <input type="text" name="specs[{{ $specIndex }}][value]" value="{{ $spec->spec_value }}" placeholder="Наприклад: Intel Xeon E5-2620">
                            </div>
                            <button type="button" class="btn-remove-spec" onclick="removeSpec(this)">🗑️</button>
                        </div>
                        @php $specIndex++; @endphp
                    @empty
                        <div class="spec-item">
                            <div class="form-group" style="margin: 0;">
                                <label>Назва характеристики</label>
                                <select name="specs[0][name]" class="spec-name-select" onchange="toggleCustomInput(this)">
                                    <option value="">-- Оберіть характеристику --</option>
                                    <option value="Device_Class">Клас пристрою</option>
                                    <option value="CPU">Процесор</option>
                                    <option value="RAM">Оперативна пам'ять</option>
                                    <option value="GPU">Відеокарта</option>
                                    <option value="Storage">Накопичувач</option>
                                    <option value="PSU">Блок живлення</option>
                                    <option value="Form_Factor">Форм-фактор</option>
                                    <option value="OS">Операційна система</option>
                                    <option value="custom">Власна назва...</option>
                                </select>
                                <input type="text" name="specs[0][name_custom]" placeholder="Введіть свою назву" style="margin-top: 5px; display: none;">
                            </div>
                            <div class="form-group" style="margin: 0;">
                                <label>Значення</label>
                                <input type="text" name="specs[0][value]" placeholder="Наприклад: Intel Xeon E5-2620">
                            </div>
                            <button type="button" class="btn-remove-spec" onclick="removeSpec(this)">🗑️</button>
                        </div>
                        @php $specIndex = 1; @endphp
                    @endforelse
                </div>

                <button type="button" class="btn-add-spec" onclick="addSpec()">Додати характеристику</button>
            </div>

            <!-- ЗОБРАЖЕННЯ -->
            <div class="form-section">
                <h2>Зображення продукту</h2>

                <div class="images-container">
                    <div class="form-group">
                        <label>Фото 1 (головне)</label>
                        <div class="file-input-wrapper">
                            <input type="file" name="images[]" id="image1" accept="image/*">
                            <label for="image1" class="file-input-label">
                                Вибрати зображення
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Фото 2</label>
                        <div class="file-input-wrapper">
                            <input type="file" name="images[]" id="image2" accept="image/*">
                            <label for="image2" class="file-input-label">
                                Вибрати зображення
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Фото 3</label>
                        <div class="file-input-wrapper">
                            <input type="file" name="images[]" id="image3" accept="image/*">
                            <label for="image3" class="file-input-label">
                                Вибрати зображення
                            </label>
                        </div>
                    </div>

                    <span class="help-text">
                        Підтримуються: JPG, PNG, GIF, WebP. Макс. 5MB на файл.
                    </span>
                </div>
            </div>

            <!-- КНОПКИ -->
            <div class="form-actions">
                <button type="submit" class="btn-submit">Оновити продукт</button>
                <a href="{{ route('admin.products.index') }}" class="btn-reset" style="text-align: center; text-decoration: none; display: flex; align-items: center; justify-content: center;">Скасувати</a>
            </div>
        </form>
    </div>

    <script>
        let specCounter = {{ $specIndex }};

        function addSpec() {
            const container = document.getElementById('specsContainer');
            const newSpec = document.createElement('div');
            newSpec.className = 'spec-item';
            newSpec.innerHTML = `
                <div class="form-group" style="margin: 0;">
                    <label>Назва характеристики</label>
                    <select name="specs[${specCounter}][name]" class="spec-name-select" onchange="toggleCustomInput(this)">
                        <option value="">-- Оберіть характеристику --</option>
                        <option value="Device_Class">Клас пристрою</option>
                        <option value="CPU">Процесор</option>
                        <option value="RAM">Оперативна пам'ять</option>
                        <option value="GPU">Відеокарта</option>
                        <option value="Storage">Накопичувач</option>
                        <option value="PSU">Блок живлення</option>
                        <option value="Form_Factor">Форм-фактор</option>
                        <option value="OS">Операційна система</option>
                        <option value="custom">Власна назва...</option>
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

        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', function() {
                const label = this.nextElementSibling;
                if (this.files.length > 0) {
                    label.textContent = this.files[0].name;
                    label.style.background = 'rgba(39, 174, 96, 0.2)';
                    label.style.borderColor = 'rgba(39, 174, 96, 0.5)';
                    label.style.color = '#a0ffb0';
                } else {
                    label.textContent = 'Вибрати зображення';
                    label.style.background = '';
                    label.style.borderColor = '';
                    label.style.color = '';
                }
            });
        });

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