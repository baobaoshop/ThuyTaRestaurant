@extends('admin.layouts.app')

@section('content')
<form action="{{ isset($introduction) ? route('introductions.update', $introduction) : route('introductions.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($introduction))
        @method('PUT')
    @endif
    <h1 style="font-size: 36px; text-align:center; font-weight:bold; color: #007bff">
        {{ isset($introduction) ? 'SỬA BANNER' : 'THÊM BANNER' }}
    </h1>
    <div class="form-group">
        <label for="code">Code</label>
        <input type="text" name="code" id="code" class="form-control" value="{{ $introduction->code ?? old('code') }}" {{ isset($introduction) ? 'disabled' : 'required' }}>
    </div>
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ $introduction->title ?? old('title') }}" required>
    </div>
    <div class="form-group">
        <label for="subtitle">Subtitle</label>
        <input type="text" name="subtitle" id="subtitle" class="form-control" value="{{ $introduction->subtitle ?? old('subtitle') }}" required>
    </div>
    <div class="form-group">
        <label for="content">Content</label>
        <input type="text" name="content" id="content" class="form-control" value="{{ $introduction->content ?? old('content') }}" required>
    </div>
    <div class="form-group">
        <label for="img">Image</label>
        <input type="file" name="img" id="img" class="form-control">
        @if(isset($introduction) && $introduction->img)
            <img src="{{ asset('storage/' . $introduction->img) }}" alt="{{ $introduction->name }}" width="50">
        @endif
    </div>
    <div class="form-group">
        <label for="enable">Enable</label>
        <input type="checkbox" name="enable" id="enable" {{ (isset($introduction) && $introduction->enable) || old('enable') ? 'checked' : '' }}>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</form>
@endsection
