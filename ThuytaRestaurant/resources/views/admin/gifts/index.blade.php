@extends('admin.layouts.app')

@section('content')
<div>
    <h1 style="font-size: 36px; text-align:center; font-weight:bold; color: #007bff">QUÀ TẶNG</h1>
    <a href="{{ route('gifts.create') }}" class="btn btn-primary">Add gift</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>Name</th>
                <th>Enable</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gifts as $gift)
                <tr>
                    <td>{{ $gift->id }}</td>
                    <td>{{ $gift->code }}</td>
                    <td>{{ $gift->name }}</td>
                    <td>{{ $gift->enable ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('gifts.edit', $gift) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('gifts.destroy', $gift) }}" method="POST" style="display: inline;" onsubmit="return confirmDelete();">
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
