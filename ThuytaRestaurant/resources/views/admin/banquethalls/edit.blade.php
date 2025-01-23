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
<form action="{{ route('banquet_halls.update', $banquetHall) }}" method="POST" >
    @csrf
    @method('PUT')
    <h1 style="font-size: 36px; text-align:center; font-weight:bold; color: #007bff">SỬA SẢNH TIỆC</h1>
    <div class="form-group">
        <label for="hall_code">Code</label>
        <input type="text" name="hall_code" id="hall_code" class="form-control" value="{{ $banquetHall->hall_code ?? old('hall_code') }}" disabled }}>
    </div>
    <div class="form-group">
        <label for="hall_subname">Subname</label>
        <input type="text" name="hall_subname" id="hall_subname" class="form-control" value="{{ $banquetHall->hall_subname ?? old('hall_subname') }}" required>
    </div>
    <div class="form-group">
        <label for="hall_name">Name</label>
        <input type="text" name="hall_name" id="hall_name" class="form-control" value="{{ $banquetHall->hall_name ?? old('hall_name') }}" required>
    </div>
    <div class="form-group">
        <label for="enable">Enable</label>
        <input type="checkbox" name="enable" id="enable" {{ (isset($banquetHall) && $banquetHall->enable) || old('enable') ? 'checked' : '' }}>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</form>
<hr style="margin: 20px;">
<h1 style="font-size: 36px; text-align:center; font-weight:bold; color: #007bff">NỘI DUNG CỦA SẢNH TIỆC</h1>
<table class="table">
    <thead>
        <tr>
            <th>Type</th>
            <th>Content</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($contents as $content)
            <tr>
                <td>
                    @if($content->type === 'text')
                        {{ $content->type . ' - ' . $content->subtype }}
                    @else
                        {{ $content->type }}
                    @endif

                </td>
                <td>
                    @if($content->type === 'img')
                    <img src="{{ asset('storage/' . $content->content) }}" alt="" style="height: 100px; object-fit:cover; margin:auto">
                    @else
                        @if ($content->subtype == 'normal')
                            <p class="banquet_container_normal">{{ $content->content }}</p>
                        @elseif ($content->subtype == 'highlight')
                            <p class="banquet_container_highlight">{{ $content->content }}</p>
                        @elseif ($content->subtype == 'caption')
                            <p class="banquet_container_caption">{{ $content->content }}</p>
                        @elseif ($content->subtype == 'title')
                            <p class="banquet_container_title">{{ $content->content }}</p>
                        @endif
                    @endif
                </td>
                <td>
                    <a href="{{ route('contents.edit', $content) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('contents.destroy', $content) }}" method="POST" style="display: inline;" onsubmit="return confirmDelete();">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<a href="{{ route('contents.create', $banquetHall->hall_code) }}" class="btn btn-primary">Add Content</a>
<script>
    function confirmDelete() {
        return confirm('Chắc chắn xóa? Bạn sẽ không thể hoàn tác.');
    }
</script>
@endsection
