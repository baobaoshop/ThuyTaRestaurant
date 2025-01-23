@extends('admin.layouts.app')

@section('content')
<h1 style="font-size: 36px; text-align:center; font-weight:bold; color: #007bff">CÁC LOẠI BÀN</h1>
    <a href="{{ route('tables.create') }}" class="btn btn-primary">Add table</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>Name</th>
                <th>Gifts</th>
                <th>Enable</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tables as $table)
                <tr>
                    <td>{{ $table->id }}</td>
                    <td>{{ $table->code }}</td>
                    <td>{{ $table->name }}</td>
                    <td>
                        {{ $table->gifts ? $table->gifts->pluck('name')->join('; ') : 'No gifts available' }}
                    </td>                    
                    <td>{{ $table->enable ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('tables.edit', $table) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('tables.destroy', $table) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
