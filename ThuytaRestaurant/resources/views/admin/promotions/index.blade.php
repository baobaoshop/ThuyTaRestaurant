@extends('admin.layouts.app')

@section('content')
<div>
    <h1 style="font-size: 36px; text-align:center; font-weight:bold; color: #007bff">KHUYẾN MÃI PHÒNG HỘI NGHỊ</h1>
    <a href="{{ route('promotions.create') }}" class="btn btn-primary">Add promotion</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Enable</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($promotions as $promotion)
                <tr>
                    <td>{{ $promotion->id }}</td>
                    <td>{{ $promotion->name }}</td>
                    <td>{{ $promotion->enable ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('promotions.edit', $promotion) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('promotions.destroy', $promotion) }}" method="POST" style="display: inline;" onsubmit="return confirmDelete();">
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
