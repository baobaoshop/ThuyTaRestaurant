@extends('layout.app2') 
@section('content')

<div class="prmotion_header">
    <div class="promotion_background">
        <img src="{{ asset('storage/header.png') }}" alt="">
    </div>
    <div class="promotion_title">Khuyến Mãi Tiệc Cưới</div>
</div>

<div class="promotion_main">
    <div class="promotion_img">
        <img src="{{ asset('storage/promotion.png') }}" alt="">
    </div>
    <table class="promotion_table">
        <tr>
            <th rowspan="2" class="promotion_table_header1">Quà tặng</th>
            <th colspan="{{ $count }}" class="promotion_table_header2">Số bàn đặt chính thức</th>
        </tr>
        <tr class="promotion_table_header1 p4">
            @foreach($tables as $table)
                <th>{{ $table->name }}</th>
            @endforeach
        </tr>
        @foreach($gifts as $gift)
        <tr>
            <td>{{ $gift->name }}</td>
            @foreach($tables as $table)
                @if($gift->reservedTables->contains('name', $table->name))
                    <td class="text-center">X</td>
                @else
                    <td></td>
                @endif
            @endforeach
        </tr>
    @endforeach
    </table>
    <ul class="promotion_notes">
        @foreach ($giftnotes as $giftnote)
            <li class="promotion_note">{{ $giftnote->content }}</li>
        @endforeach
    </ul>
</div>

@endsection