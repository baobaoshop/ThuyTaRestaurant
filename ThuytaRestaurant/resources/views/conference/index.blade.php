@extends('layout.app2') 
@section('content')

<div class="prmotion_header">
    <div class="promotion_background">
        <img src="{{ asset('storage/header.png') }}" alt="">
    </div>
    <div class="promotion_title">Phòng Hội Nghị</div>
</div>

<div class="promotion_main">
    <div class="promotion_img">
        <img src="{{ asset('storage/conferenceroom.png') }}" alt="">
    </div>

    <div class="conference_title">
        <p class="conference_maintitle">Giá cho thuê phòng hội nghị</p>
        <p class="conference_subtitle">(Đã bao gồm 10% thuế VAT)</p>
    </div>

    
    <table class="promotion_table">
        <tr class="promotion_table_header1">
            <th rowspan="2">Vị trí</th>
            <th rowspan="2">Diện tích</th>
            <th rowspan="2">Xếp theo kiểu rạp hát</th>
            <th class="promotion_table_header2" colspan="{{ $roomcapacities->count() }}">Công suất phòng</th>
            <th rowspan="2">Nửa ngày (VNĐ)</th>
            <th rowspan="2">Nguyên ngày (VNĐ)</th>
            <th rowspan="2" style="min-width: 180px">Ghi chú</th>
        </tr>
        <tr class="promotion_table_header1 p40">
            @foreach ($roomcapacities as $roomcapacity)
                <th>{{ $roomcapacity->name }}</th>
            @endforeach
        </tr>
    
        @php
            $previousNote = null;
            $rowspan = 0;
            $new = true;
        @endphp
    
        @foreach ($conferences as $conference)
            @if ($previousNote != $conference->note->content)
                @php
                    $previousNote = $conference->note->content;
                    $rowspan = $notesCount[$conference->note->content];
                    $new = true;
                @endphp
            @endif
            
            <tr>
                <td class="text_nowrap">{{ $conference->location }}</td>
                <td class="text_nowrap">{{ $conference->area }}m²</td>
                <td class="text_nowrap">{{ $conference->guest_theater!==null ? $conference->guest_theater.' khách' : '' }} </td>
    
                @foreach ($roomcapacities as $roomcapacity)
                    @php
                        $capacity = $conference->capacities->firstWhere('name', $roomcapacity->name);
                    @endphp
                    <td>{{ $capacity ? $capacity->pivot->quantity : '' }}</td>
                @endforeach
                <td>
                    {{ $conference->price_haft_day !== null ? number_format($conference->price_haft_day, 0, ',', '.') : '' }}
                </td>
                <td>
                    {{ $conference->price_full_day !== null ? number_format($conference->price_full_day, 0, ',', '.') : '' }}
                </td>                
                @if ($new)
                    <td rowspan="{{ $rowspan }}">{{ $conference->note->content }}</td>
                    @php
                        $new = false;
                    @endphp 
                @endif
            </tr>
    
        @endforeach
    </table>
    
    <table class="promotion_table">
        <tr class="promotion_table_header1">
            <th colspan="4">Khuyến mãi</th>
        </tr>
        @foreach ($promotions->chunk(4) as $row)
        <tr>
            @foreach ($row as $item)
                <th style="color: #ED7D31">{{ $item->name }}</th>
            @endforeach
            @for ($i = $row->count(); $i < 4; $i++)
                <th></th>
            @endfor
        </tr>
    @endforeach
    </table>
</div>

@endsection