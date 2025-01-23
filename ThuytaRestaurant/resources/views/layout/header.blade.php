<div class="header">
    <a href="{{ route('home.index') }}" class="header_left">
        <img src="{{ asset('storage/logo.png') }}" class="header_logo" alt="">
        <div class="header_name">
            <div class="header_subname">Nhà hàng</div>
            <div class="header_mainname">Thủy Tạ Đầm Sen</div>
        </div>
    </a>
    <div class="header_right">
        <div class="header_main">
            <a href="{{ route('menu.index') }}" class="header_main_item {{ Request::is('menu*') ? 'header_main_item--active' : '' }}">Thực đơn</a>
            <div class="header_main_item header_main_item--dropdown {{ Request::is('banquet*') ? 'header_main_item--active' : '' }}">
                Sảnh tiệc <i class="fa-solid fa-angle-down"></i>
                <div class="header_dropdown">
                    @foreach ($headerDatas as $headerData)
                    <a href="{{ route('banquet.show', ['code' => $headerData->hall_code]) }}" class="header_dropdown_item">{{ $headerData->hall_subname.' '.$headerData->hall_name }}</a>
                    @endforeach
                </div>
            </div>
            <a href="{{ route('conference.index') }}" class="header_main_item {{ Request::is('conference*') ? 'header_main_item--active' : '' }}">Phòng hội nghị</a>
            <a href="{{ route('promotion.index') }}" class="header_main_item {{ Request::is('promotion*') ? 'header_main_item--active' : '' }}">Khuyến mãi tiệc cưới</a>
        </div>
        <div class="header_search">
            <form action="">
                <input type="text" class="header_search_input" placeholder="Tìm kiếm">
                <button class="header_search_btn"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
    </div>
</div>
<div class="header--mobile">
    <div class="header_toggle">
        <div class="header_logo--mobile">
            <a href="{{ route('home.index') }}" class="header_left">
                <img src="{{ asset('storage/logo.png') }}" class="header_logo--mobile" alt="">
            </a>
        </div>
        <button class="hamburger" id="hamburgerBtn"><i class="fa-solid fa-bars"></i></button>
    </div>
    <div class="header_menu header_menu--mobile" id="menu">
        <button class="close" id="closeBtn"><i class="fa-solid fa-xmark"></i></button>
        <div class="header_main header_main--mobile">
            <a href="{{ route('home.index') }}" class="header_left">
                <img src="{{ asset('storage/logo.png') }}" class="header_logo" alt="">
                <div class="header_name header_name--mobile">
                    <div class="header_subname header_subname--mobile">Nhà hàng</div>
                    <div class="header_mainname header_mainname--mobile">Thủy Tạ Đầm Sen</div>
                </div>
            </a>
            <a href="{{ route('menu.index') }}" class="header_main_item header_main_item--mobile {{ Request::is('menu*') ? 'header_main_item--active' : '' }}">Thực đơn</a>
            <a href="{{ route('conference.index') }}" class="header_main_item header_main_item--mobile {{ Request::is('conference*') ? 'header_main_item--active' : '' }}">Phòng hội nghị</a>
            <a href="{{ route('promotion.index') }}" class="header_main_item header_main_item--mobile {{ Request::is('promotion*') ? 'header_main_item--active' : '' }}">Khuyến mãi tiệc cưới</a>
            <div id="mobile_dropdown" class="header_main_item header_main_item--mobile header_main_item--dropdown {{ Request::is('banquet*') ? 'header_main_item--active' : '' }}">
                Sảnh tiệc <i class="fa-solid fa-angle-down"></i>
            </div>
            <div id="mobile_dropdown_main" class="header_dropdown header_dropdown--mobile">
                @foreach ($headerDatas as $headerData)
                <a href="{{ route('banquet.show', ['code' => $headerData->hall_code]) }}" class="header_dropdown_item header_dropdown_item--mobile">{{ $headerData->hall_subname.' '.$headerData->hall_name }}</a>
                @endforeach
            </div>
        </div>
    </div>
</div>