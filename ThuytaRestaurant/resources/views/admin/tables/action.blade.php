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
    {{ isset($table) ? 'SỬA LOẠI BÀN' : 'THÊM LOẠI BÀN' }}
</h1>
<form action="{{ isset($table) ? route('tables.update', $table) : route('tables.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($table))
        @method('PUT')
    @endif
    <div class="form-group">
        <label for="code">Code</label>
        <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror" value="{{ $table->code ?? old('code') }}" {{ isset($table) ? 'disabled' : 'required' }}>
        @error('code')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $table->name ?? old('name') }}" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group input_checkbox_gr">
        <label style="font-weight: bold">Gifts:</label>
        @foreach ($gifts as $gift)
            <div>
                <input type="checkbox" id="{{ $gift->code }}" name="gifts[]" value="{{ $gift->code }}" 
                {{ (isset($table) && in_array($gift->code, $table->gifts->pluck('code')->toArray())) || (is_array(old('gifts')) && in_array($gift->code, old('gifts'))) ? 'checked' : '' }}>
                <label for="{{ $gift->code }}">{{ $gift->name }}</label>
            </div>
        @endforeach
        @error('gifts')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="enable">Enable</label>
        <input type="checkbox" name="enable" id="enable" {{ (isset($table) && $table->enable) || old('enable') ? 'checked' : '' }}>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>

@endsection
