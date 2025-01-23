@extends('admin.layouts.app')

@section('content')
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<h1 style="font-size: 36px; text-align:center; font-weight:bold; color: #007bff">
    {{ isset($meal) ? 'CHỈNH SỬA MÓN ĂN' : 'THÊM MÓN ĂN MỚI' }}
</h1>
<form action="{{ isset($meal) ? route('meals.update', $meal) : route('meals.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($meal))
        @method('PUT')
    @endif
    <div class="form-group">
        <label for="dish_code">Code</label>
        <input type="text" name="dish_code" id="dish_code" class="form-control @error('dish_code') is-invalid @enderror" value="{{ $meal->dish_code ?? old('dish_code') }}" {{ isset($meal) ? 'disabled' : 'required' }}>
        @error('dish_code')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="subname">Subname</label>
        <input type="text" name="subname" id="subname" class="form-control @error('subname') is-invalid @enderror" value="{{ $meal->subname ?? old('subname') }}" required>
        @error('subname')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="dish_name">Name</label>
        <input type="text" name="dish_name" id="dish_name" class="form-control @error('dish_name') is-invalid @enderror" value="{{ $meal->dish_name ?? old('dish_name') }}" required>
        @error('dish_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="img">Image</label>
        <input type="file" name="img" id="img" class="form-control @error('img') is-invalid @enderror">
        @if(isset($meal) && $meal->img)
            <img src="{{ asset('storage/' . $meal->img) }}" alt="{{ $meal->name }}" width="50">
        @endif
        @error('img')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label>Category:</label>
        <select name="category_code" required class="form-control @error('category_id') is-invalid @enderror">
            @foreach ($categories as $category)
                <option value="{{ $category->code }}" {{ (isset($meal) && $meal->category_id == $category->code) || old('category_id') == $category->code ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="content">Content</label>
        <input type="text" name="content" id="content" class="form-control @error('content') is-invalid @enderror" value="{{ $meal->content ?? old('content') }}" required>
        @error('content')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="min_price">Min Price</label>
        <input type="number" name="min_price" id="min_price" class="form-control @error('min_price') is-invalid @enderror" value="{{ $meal->min_price ?? old('min_price') }}" required>
        @error('min_price')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="max_price">Max Price</label>
        <input type="number" name="max_price" id="max_price" class="form-control @error('max_price') is-invalid @enderror" value="{{ $meal->max_price ?? old('max_price') }}" required>
        @error('max_price')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group input_checkbox_gr">
        <label style="font-weight: bold">Ingredients:</label>
        @foreach ($ingredients as $ingredient)
            <div>
                <input type="checkbox" id="{{ $ingredient->ingredient_code }}" name="ingredients[]" value="{{ $ingredient->ingredient_code }}" 
                {{ (isset($meal) && in_array($ingredient->ingredient_code, $meal->ingredients->pluck('ingredient_code')->toArray())) || (is_array(old('ingredients')) && in_array($ingredient->ingredient_code, old('ingredients'))) ? 'checked' : '' }}>
                <label for="{{ $ingredient->ingredient_code }}">{{ $ingredient->name }}</label>
            </div>
        @endforeach
        @error('ingredients')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="enable">Enable</label>
        <input type="checkbox" name="enable" id="enable" {{ (isset($meal) && $meal->enable) || old('enable') ? 'checked' : '' }}>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>

@endsection
