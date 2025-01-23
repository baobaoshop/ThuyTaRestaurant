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
<form method="POST" action="{{ route('contents.update', $content->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <h1 style="font-size: 36px; text-align:center; font-weight:bold; color: #007bff">CHỈNH SỬA NỘI DUNG</h1>
    <div class="form-group">
        <label for="hall_code">Code</label>
        <input class="form-control" type="text" name="hall_code" value="{{ $content->hall_code }}" required readonly>
    </div>

    <div id="contents" class="form-group">
        <div class="content-item">
            <span style="font-weight: bold">Type: </span>
            <input class="form-control" type="text" name="type" value="{{ $content->type }}" readonly>

            <hr style="margin: 20px 0; border: 1px solid #333">
            @if ($content->type === 'text')
                <span style="font-weight: bold">Subtype: </span>
                <select id="subtype" name="subtype" class="subtype-select form-control">
                    <option value="normal" {{ $content->subtype === 'normal' ? 'selected' : '' }}>Normal</option>
                    <option value="highlight" {{ $content->subtype === 'highlight' ? 'selected' : '' }}>Highlight</option>
                    <option value="caption" {{ $content->subtype === 'caption' ? 'selected' : '' }}>Caption</option>
                    <option value="title" {{ $content->subtype === 'title' ? 'selected' : '' }}>Title</option>
                </select>
            @endif

            <label for="content">Content: </label>
            <div id="content-wrapper">
                @if ($content->type === 'text')
                    <!-- Hiển thị input text nếu là text -->
                    <input class="form-control" type="text" id="content" name="content" value="{{ $content->content }}" required>
                @elseif ($content->type === 'img')
                    <!-- Hiển thị input file nếu là img -->
                    <input class="form-control" type="file" id="content" name="image" accept="image/*">
                    <div>
                        <img src="{{ asset('storage/' . $content->content) }}" alt="Current Image" style="max-width: 200px; margin-bottom: 10px;">
                    </div>
                @endif
            </div>
        </div>
    </div>

    <button class="btn btn-primary" type="submit">Update</button>
</form>


@endsection
