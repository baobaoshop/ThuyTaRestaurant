@extends('layout.app2') 
@section('content')

<div class="prmotion_header">
    <div class="promotion_background">
        <img src="{{ asset('storage/header.png') }}" alt="">
    </div>
    <div class="promotion_subtitle">{{ $banquetHall->hall_subname }}</div>
    <div class="promotion_title">{{ $banquetHall->hall_name }}</div>
</div>
<div class="banquet_container">
    @php
        $imageGroup = [];
        $groupIndex = 0; // Biến đếm nhóm hình ảnh
    @endphp

    @foreach ($banquetHall->contents as $content)
        @if ($content->type == 'img')
            @php
                $imageGroup[] = $content->content;
            @endphp

            <!-- Nếu nhóm hình ảnh đủ 3 hình thì hiển thị và reset -->
            @if (count($imageGroup) == 3)
                @php
                    $groupClass = ($groupIndex % 3) + 1; // Tính nhóm: 1, 2, 3
                @endphp
                @if ($groupClass == 1)
                    <div class="banquet_container_img_gr1">
                        <img src="{{ asset('storage/' . $imageGroup[0]) }}" alt="" class="banquet_container_img_single">
                        <div class="banquet_container_img_subgroup">
                            <img src="{{ asset('storage/' . $imageGroup[1]) }}" alt="" class="banquet_container_img_double">
                            <img src="{{ asset('storage/' . $imageGroup[2]) }}" alt="" class="banquet_container_img_double">
                        </div>
                    </div>
                @elseif ($groupClass == 2)
                    <div class="banquet_container_img_gr2">
                        <div class="banquet_container_img_subgroup">
                            <img src="{{ asset('storage/' . $imageGroup[0]) }}" alt="" class="banquet_container_img_double">
                            <img src="{{ asset('storage/' . $imageGroup[1]) }}" alt="" class="banquet_container_img_double">
                        </div>
                        <img src="{{ asset('storage/' . $imageGroup[2]) }}" alt="" class="banquet_container_img_single">
                    </div>
                @elseif ($groupClass == 3)
                    <div class="banquet_container_img_gr3">
                        <img src="{{ asset('storage/' . $imageGroup[0]) }}" alt="" class="banquet_container_img_tripple">
                        <img src="{{ asset('storage/' . $imageGroup[1]) }}" alt="" class="banquet_container_img_tripple">
                        <img src="{{ asset('storage/' . $imageGroup[2]) }}" alt="" class="banquet_container_img_tripple">
                    </div>
                @endif
                @php
                    $imageGroup = [];
                    $groupIndex++; // Tăng chỉ số nhóm
                @endphp
            @endif
        @else
            <!-- Hiển thị nhóm hình ảnh còn lại trước khi chuyển sang nội dung khác -->
            @if (!empty($imageGroup))
                <div class="{{ count($imageGroup) == 2 ? 'banquet_container_img_gr_final2' : 'banquet_container_img_gr_final1' }}">
                    @foreach ($imageGroup as $image)
                        <img src="{{ asset('storage/' . $image) }}" alt="" class="banquet_container_img">
                    @endforeach
                </div>
                @php
                    $imageGroup = [];
                    $groupIndex=1; 
                @endphp
            @endif

            <!-- Hiển thị nội dung dạng text -->
            @if ($content->type == 'text')
                @if ($content->subtype == 'normal')
                    <p class="banquet_container_normal">{{ $content->content }}</p>
                @elseif ($content->subtype == 'highlight')
                    <p class="banquet_container_highlight">{{ $content->content }}</p>
                @elseif ($content->subtype == 'caption')
                    <p class="banquet_container_caption">{{ $content->content }}</p>
                @elseif ($content->subtype == 'title')
                    <p class="banquet_container_title">{{ $content->content }}</p>
                @endif
                @php 
                    $groupIndex = 0;
                @endphp
            @endif
        @endif
    @endforeach

    <!-- Hiển thị nhóm hình ảnh cuối cùng nếu còn -->
    @if (!empty($imageGroup))
        <div class="{{ count($imageGroup) == 2 ? 'banquet_container_img_gr_final2' : 'banquet_container_img_gr_final1' }}">
            @foreach ($imageGroup as $image)
                <img src="{{ asset('storage/' . $image) }}" alt="" class="banquet_container_img">
            @endforeach
        </div>
        @php
            $imageGroup = [];
            $groupIndex=1; 
        @endphp
    @endif


</div>

@endsection