@extends('admin.layouts.app')

@section('content')
<h1 style="font-size: 36px; text-align:center; font-weight:bold; color: #007bff">
    {{ isset($capacity) ? 'CHỈNH SỬA' : 'THÊM MỚI' }}
</h1>
<form action="{{ isset($capacity) ? route('capacities.update', $capacity) : route('capacities.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($capacity))
        @method('PUT')
    @endif
    <div class="form-group">
        <label for="code">Code</label>
        <input type="text" name="code" id="code" class="form-control" value="{{ $capacity->code ?? old('code') }}" {{ isset($capacity) ? 'disabled' : 'required' }}>
    </div>
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $capacity->name ?? old('name') }}" required>
    </div>
    <div class="form-group">
        <label for="enable">Enable</label>
        <input type="checkbox" name="enable" id="enable" {{ (isset($capacity) && $capacity->enable) || old('enable') ? 'checked' : '' }}>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</form>
@endsection
