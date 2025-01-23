@extends('admin.layouts.app')

@section('content')
<div>
    <h1 style="font-size: 36px; text-align:center; font-weight:bold; color: #007bff">DANH SÁCH LOẠI MÓN ĂN</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">Add Category</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>Name</th>
                <th>Image</th>
                <th>Enable</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->code }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        @if($category->img)
                            <img src="{{ asset('storage/' . $category->img) }}" alt="{{ $category->name }}" width="50">
                        @endif
                    </td>
                    <td>{{ $category->enable ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display: inline;" onsubmit="return confirmDelete();">
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
