@extends('admin.layouts.app')

@section('content')
<h1 style="font-size: 36px; text-align:center; font-weight:bold; color: #007bff">
    {{ isset($promotion) ? 'SỬA KHUYẾN MÃI' : 'THÊM KHUYẾN MÃI' }}
</h1>
<form action="{{ isset($promotion) ? route('promotions.update', $promotion) : route('promotions.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($promotion))
        @method('PUT')
    @endif
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $promotion->name ?? old('name') }}" required>
    </div>
    <div class="form-group">
        <label for="enable">Enable</label>
        <input type="checkbox" name="enable" id="enable" {{ (isset($promotion) && $promotion->enable) || old('enable') ? 'checked' : '' }}>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</form>
@endsection
