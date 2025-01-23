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
<h1 style="font-size: 36px; text-align:center; font-weight:bold; color: #007bff">{{ $banquethall->hall_subname }} {{ $banquethall->hall_name }}</h1>
<form method="POST" action="{{ route('contents.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="hall_code">Code</label>
        <input class="form-control" type="text" name="hall_code" value="{{ $banquethall->hall_code }}" required readonly>
    </div>

    <div id="contents" class="form-group">
        <div class="content-item">
            <span style="font-weight: bold">Type: </span>
            <select id="type" name="type" class="type-select form-control-inline">
                <option value="text">Text</option>
                <option value="img">Image</option>
            </select>

            <span style="font-weight: bold">Subtype: </span>
            <select id="subtype" name="subtype" class="subtype-select form-control-inline">
                <option value="normal">Normal</option>
                <option value="highlight">Highlight</option>
                <option value="caption">Caption</option>
                <option value="title">Title</option>
            </select>

            <label for="content">Content: </label>
            <div id="content-wrapper">
                <!-- Mặc định là input text -->
                <input class="form-control" type="text" id="content" name="content" required>
            </div>
        </div>
    </div>
    <button class="btn" type="submit">ADD</button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const typeSelect = document.querySelector('#type');
        const contentWrapper = document.querySelector('#content-wrapper');

        // Hàm thay đổi giữa input text và file upload
        const updateContentInput = () => {
            const selectedType = typeSelect.value;
            contentWrapper.innerHTML = '';

            if (selectedType === 'img') {
                const fileInput = document.createElement('input');
                fileInput.type = 'file';
                fileInput.name = 'image';
                fileInput.id = 'content';
                fileInput.classList.add('form-control');
                fileInput.accept = 'image/*';
                fileInput.required = true;
                contentWrapper.appendChild(fileInput);
            } else {
                const textInput = document.createElement('input');
                textInput.type = 'text';
                textInput.name = 'content';
                textInput.id = 'content';
                textInput.classList.add('form-control');
                textInput.required = true;
                contentWrapper.appendChild(textInput);
            }
        };

        // Gắn sự kiện khi thay đổi dropdown
        typeSelect.addEventListener('change', updateContentInput);

        // Cập nhật ngay khi trang tải xong
        updateContentInput();
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.type-select').forEach(select => {
            select.addEventListener('change', function () {
                const subtypeField = this.closest('.content-item').querySelector('.subtype-select');

                if (this.value === 'text') {
                    // Kích hoạt và chọn giá trị đầu tiên nếu type là 'text'
                    subtypeField.disabled = false;
                    subtypeField.selectedIndex = 0; // Chọn giá trị đầu tiên
                } else {
                    // Vô hiệu hóa và xóa lựa chọn nếu type không phải 'text'
                    subtypeField.disabled = true;
                    subtypeField.value = ''; 
                }
            });
        });
    });
</script>



@endsection
