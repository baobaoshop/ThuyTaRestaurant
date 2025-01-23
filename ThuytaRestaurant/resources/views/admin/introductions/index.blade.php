@extends('admin.layouts.app')

@section('content')
<div>
    <h1 style="font-size: 36px; text-align:center; font-weight:bold; color: #007bff">BANNER GIỚI THIỆU</h1>
    <a href="{{ route('introductions.create') }}" class="btn btn-primary">Add Introduction</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>Subtitle</th>
                <th>Title</th>
                <th>Content</th>
                <th>Image</th>
                <th>Enable</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($introductions as $introduction)
                <tr>
                    <td>{{ $introduction->id }}</td>
                    <td>{{ $introduction->code }}</td>
                    <td>{{ $introduction->subtitle }}</td>
                    <td>{{ $introduction->title }}</td>
                    <td>{{ $introduction->content }}</td>
                    <td>
                        @if($introduction->img)
                            <img src="{{ asset('storage/' . $introduction->img) }}" alt="{{ $introduction->name }}" width="50">
                        @endif
                    </td>
                    <td>{{ $introduction->enable ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('introductions.edit', $introduction) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('introductions.destroy', $introduction) }}" method="POST" style="display: inline;" onsubmit="return confirmDelete();">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
    function confirmDelete() {
        return confirm('Chắc chắn xóa? Bạn sẽ không thể hoàn tác.');
    }
</script>
@endsection
