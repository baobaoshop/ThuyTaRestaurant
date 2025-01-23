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
<h1 style="font-size: 36px; text-align:center; font-weight:bold; color: #007bff">THÊM SẢNH TIỆC MỚI</h1>
<form action="{{ route('banquet_halls.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="hall_code">Code</label>
        <input type="text" name="hall_code" id="hall_code" class="form-control"required }}>
    </div>
    <div class="form-group">
        <label for="hall_subname">Subname</label>
        <input type="text" name="hall_subname" id="hall_subname" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="hall_name">Name</label>
        <input type="text" name="hall_name" id="hall_name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="enable">Enable</label>
        <input type="checkbox" name="enable" id="enable" >
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</form>
@endsection
