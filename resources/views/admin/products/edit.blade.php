@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Редагувати: {{ $product->title }}</h1>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label>Назва товару</label>
            <input type="text" name="title" value="{{ $product->title }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Категорія</label>
            <select name="category" class="form-control" required>
                @foreach($categoryLabels as $key => $label)
                    <option value="{{ $key }}" {{ $product->category == $key ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Ціна (грн)</label>
            <input type="number" name="price" value="{{ $product->price }}" step="0.01" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Оновити</button>
    </form>
</div>
@endsection