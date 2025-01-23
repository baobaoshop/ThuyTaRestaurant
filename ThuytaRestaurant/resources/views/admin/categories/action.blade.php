@extends('admin.layouts.app')

@section('content')
<form action="{{ isset($category) ? route('categories.update', $category) : route('categories.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($category))
        @method('PUT')
    @endif
    <h1 style="font-size: 36px; text-align:center; font-weight:bold; color: #007bff">
        {{ isset($category) ? 'CHỈNH SỬA THÔNG TIN LOẠI MÓN ĂN' : 'THÊM LOẠI MÓN ĂN MỚI' }}
    </h1>
    <div class="form-group">
        <label for="code">Code</label>
        <input type="text" name="code" id="code" class="form-control" value="{{ $category->code ?? old('code') }}" {{ isset($category) ? 'disabled' : 'required' }}>
    </div>
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $category->name ?? old('name') }}" required>
    </div>
    <div class="form-group">
        <label for="img">Image</label>
        <input type="file" name="img" id="img" class="form-control">
        @if(isset($category) && $category->img)
            <img src="{{ asset('storage/' . $category->img) }}" alt="{{ $category->name }}" width="50">
        @endif
    </div>
    <div class="form-group">
        <label for="enable">Enable</label>
        <input type="checkbox" name="enable" id="enable" {{ (isset($category) && $category->enable) || old('enable') ? 'checked' : '' }}>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</form>
@endsection
