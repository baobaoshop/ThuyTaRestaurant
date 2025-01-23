@extends('admin.layouts.app')

@section('content')
<h1 style="font-size: 36px; text-align:center; font-weight:bold; color: #007bff">DANH SÁCH MÓN ĂN</h1>
    <a href="{{ route('meals.create') }}" class="btn btn-primary">Add Meal</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Dish Code</th>
                <th>Subname</th>
                <th>Name</th>
                <th>Image</th>
                <th>Category</th>
                <th>Content</th>
                <th>Min Price</th>
                <th>Max Price</th>
                <th>Ingredients</th>
                <th>Enable</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($meals as $meal)
                <tr>
                    <td>{{ $meal->id }}</td>
                    <td>{{ $meal->dish_code }}</td>
                    <td>{{ $meal->subname }}</td>
                    <td>{{ $meal->dish_name }}</td>
                    <td>
                        @if($meal->img)
                            <img src="{{ asset('storage/' . $meal->img) }}" alt="{{ $meal->name }}" width="50">
                        @endif
                    </td>
                    <td>{{ $meal->category->name }}</td>
                    <td>{{ $meal->content }}</td>
                    <td>{{ $meal->min_price }}</td>
                    <td>{{ $meal->max_price }}</td>
                    <td>{{ $meal->ingredients->pluck('name')->join(', ') }}</td>
                    <td>{{ $meal->enable ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('meals.edit', $meal) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('meals.destroy', $meal) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
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
