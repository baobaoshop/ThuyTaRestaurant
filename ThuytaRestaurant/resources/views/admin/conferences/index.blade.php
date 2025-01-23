@extends('admin.layouts.app')
@section('content')
<div class="container">
    <h1 style="font-size: 36px; text-align:center; font-weight:bold; color: #007bff">PHÒNG HỘI NGHỊ</h1>
    <a href="{{ route('conferences.create') }}" class="btn btn-primary">Add ConferenceRoom</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>Vị trí</th>
                <th>Diện tích</th>
                <th>Xếp theo kiểu rạp hát</th>
                <th>Giá nửa ngày</th>
                <th>Giá nguyên ngày</th>
                <th>Công suất phòng</th>
                <th>Ghi chú</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rooms as $room)
                <tr>
                    <td>{{ $room->id }}</td>
                    <td>{{ $room->code }}</td>
                    <td>{{ $room->location }}</td>
                    <td>{{ $room->area }}m²</td>
                    <td>{{ $room->guest_theater!==null ? $room->guest_theater.' khách' : '' }}</td>
                    <td>{{ $room->price_haft_day }}</td>
                    <td>{{ $room->price_full_day }}</td>
                    <td>
                            @foreach($room->capacities as $capacity)
                            {{ $capacity->code.': '.$capacity->pivot->quantity.'; ' }}
                            @endforeach
                    </td>
                    <td>{{ optional($room->note)->code ?? '' }}</td>
                    <td>
                        <a href="{{ route('conferences.edit', $room->id) }}" class="btn btn-warning">Sửa</a>
                        <form action="{{ route('conferences.destroy', $room->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Xác nhận xóa?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection