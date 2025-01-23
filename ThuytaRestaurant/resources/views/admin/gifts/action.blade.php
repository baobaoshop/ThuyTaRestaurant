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
    {{ isset($gift) ? 'SỬA QUÀ TẶNG' : 'THÊM QUÀ TẶNG' }}
</h1>
<form action="{{ isset($gift) ? route('gifts.update', $gift) : route('gifts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($gift))
        @method('PUT')
    @endif
    <div class="form-group">
        <label for="code">Code</label>
        <input type="text" name="code" id="code" class="form-control" value="{{ $gift->code ?? old('code') }}" {{ isset($gift) ? 'disabled' : 'required' }}>
    </div>
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $gift->name ?? old('name') }}" required>
    </div>
    <div class="form-group">
        <label for="enable">Enable</label>
        <input type="checkbox" name="enable" id="enable" {{ (isset($gift) && $gift->enable) || old('enable') ? 'checked' : '' }}>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</form>
@endsection
