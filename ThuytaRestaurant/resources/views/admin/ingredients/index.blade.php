@extends('admin.layouts.app')

@section('content')
<div>
    <h1 style="font-size: 36px; text-align:center; font-weight:bold; color: #007bff">DANH SÁCH NGUYÊN LIỆU</h1>
    <a href="{{ route('ingredients.create') }}" class="btn btn-primary">Add ingredient</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ingredient Code</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ingredients as $ingredient)
                <tr>
                    <td>{{ $ingredient->id }}</td>
                    <td>{{ $ingredient->ingredient_code }}</td>
                    <td>{{ $ingredient->name }}</td>
                    
                    <td>
                        <a href="{{ route('ingredients.edit', $ingredient) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('ingredients.destroy', $ingredient) }}" method="POST" style="display: inline;" onsubmit="return confirmDelete();">
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
