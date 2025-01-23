@extends('admin.layouts.app')

@section('content')
<h1 style="font-size: 36px; text-align:center; font-weight:bold; color: #007bff">
    {{ isset($ingredient) ? 'SỬA NGUYÊN LIỆU' : 'THÊM NGUYÊN LIỆU' }}
</h1>
<form action="{{ isset($ingredient) ? route('ingredients.update', $ingredient) : route('ingredients.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($ingredient))
        @method('PUT')
    @endif
    <div class="form-group">
        <label for="ingredient_code">Code</label>
        <input type="text" name="ingredient_code" id="ingredient_code" class="form-control" value="{{ $ingredient->ingredient_code ?? old('ingredient_code') }}" {{ isset($ingredient) ? 'disabled' : 'required' }}>
    </div>
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $ingredient->name ?? old('name') }}" required>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</form>
@endsection
