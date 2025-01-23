@extends('admin.layouts.app')

@section('content')
<div>
    <h1 style="font-size: 36px; text-align:center; font-weight:bold; color: #007bff">SẢNH TIỆC</h1>
    <a href="{{ route('banquet_halls.create') }}" class="btn btn-primary">Add banquethall</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>Subname</th>
                <th>Name</th>
                <th>Date</th>
                <th>Enable</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($banquet_halls as $banquethall)
                <tr>
                    <td>{{ $banquethall->id }}</td>
                    <td>{{ $banquethall->hall_code }}</td>
                    <td>{{ $banquethall->hall_subname }}</td>
                    <td>{{ $banquethall->hall_name }}</td>
                    <td>{{ $banquethall->date }}</td>
                    <td>{{ $banquethall->enable ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('banquet_halls.edit', $banquethall) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('banquet_halls.destroy', $banquethall) }}" method="POST" style="display: inline;" onsubmit="return confirmDelete();">
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
