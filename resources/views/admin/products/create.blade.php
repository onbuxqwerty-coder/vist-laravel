@extends('layouts.admin') {{-- Переконайтеся, що у вас є базовий лейаут --}}

@section('content')
<div class="container">
    <h1>Додати новий товар</h1>

    <form action="{{ route('admin.products.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Назва товару</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Категорія</label>
            <select name="category" class="form-control" required>
                @foreach($categoryLabels as $key => $label)
                    <option value="{{ $key }}">{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Ціна (грн)</label>
            <input type="number" name="price" step="0.01" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Зберегти</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Скасувати</a>
    </form>
</div>
@endsection