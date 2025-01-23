@extends('admin.layouts.app')

@section('content')
<div>
    <h1 style="font-size: 36px; text-align:center; font-weight:bold; color: #007bff">CÔNG SUẤT PHÒNG</h1>
    <a href="{{ route('capacities.create') }}" class="btn btn-primary">Add capacity</a>
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
            @foreach ($capacities as $capacity)
                <tr>
                    <td>{{ $capacity->id }}</td>
                    <td>{{ $capacity->code }}</td>
                    <td>{{ $capacity->name }}</td>
                    <td>{{ $capacity->enable ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('capacities.edit', $capacity) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('capacities.destroy', $capacity) }}" method="POST" style="display: inline;" onsubmit="return confirmDelete();">
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
