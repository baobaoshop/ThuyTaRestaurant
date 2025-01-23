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
<h1 style="font-size: 36px; text-align:center; font-weight:bold; color: #007bff">
    {{ isset($room) ? 'CHỈNH SỬA THÔNG TIN PHÒNG' : 'THÊM PHÒNG MỚI' }}
</h1>
<form action="{{ isset($room) ? route('conferences.update', $room->id) : route('conferences.store') }}" method="POST">
    @csrf
    @if(isset($room))
        @method('PUT')
    @endif

    <div class="form-group">
        <label for="code" class="form-label">Code</label>
        <input type="text" name="code" id="code" class="form-control" value="{{ old('code', $room->code ?? '') }}" {{ isset($room) ? 'disabled' : 'required' }}>
    </div>

    <div class="form-group">
        <label for="location" class="form-label">Vị trí</label>
        <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $room->location ?? '') }}" required>
    </div>

    <div class="form-group">
        <label for="area" class="form-label">Diện tích</label>
        <input type="number" name="area" id="area" class="form-control" value="{{ old('area', $room->area ?? '') }}" required>
    </div>

    <div class="form-group">
        <label for="guest_theater" class="form-label">Xếp theo kiểu rạp hát</label>
        <input type="number" name="guest_theater" id="guest_theater" class="form-control" value="{{ old('guest_theater', $room->guest_theater ?? '') }}">
    </div>

    <div class="form-group">
        <label for="price_haft_day" class="form-label">Giá nửa ngày</label>
        <input type="number" name="price_haft_day" id="price_haft_day" class="form-control" value="{{ old('price_haft_day', $room->price_haft_day ?? '') }}" >
    </div>

    <div class="form-group">
        <label for="price_full_day" class="form-label">Giá nguyên ngày</label>
        <input type="number" name="price_full_day" id="price_full_day" class="form-control" value="{{ old('price_full_day', $room->price_full_day ?? '') }}" >
    </div>

    <div class="form-group">
        <label for="note_code" class="form-label">Ghi chú</label>
        <select name="note_code" id="note_code" class="form-control" required>
            <option value="">-- Chọn ghi chú --</option>
            @foreach($notes as $note)
                <option value="{{ $note->code }}" {{ old('note_code', $room->note_code ?? '') == $note->code ? 'selected' : '' }}>{{ $note->content }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="capacities" class="form-label">Công suất phòng</label>
        @foreach($capacities as $capacity)
            <div class="form-check">
                <input type="number" name="capacities[{{ $capacity->code }}]" class="form-control" placeholder="{{ $capacity->name }} (Số lượng)" value="{{ old('capacities.' . $capacity->code, isset($room) ? $room->capacities->firstWhere('capacity_code', $capacity->code)->quantity ?? '' : '') }}">
            </div>
        @endforeach
    </div>

    <button type="submit" class="btn btn-primary">{{ isset($room) ? 'Cập nhật' : 'Tạo mới' }}</button>
    <a href="{{ route('conferences.index') }}" class="btn btn-secondary">Hủy</a>
</form>

@endsection
