<div class="dashboard_sidebar">
    <span class="close_icon">
        <i class="far fa-bars dash_bar"></i>
        <i class="far fa-times dash_close"></i>
    </span>
    <a href="dsahboard.html" class="dash_logo"><img src="{{ asset('theme/frontend-template/images/logo.png') }}"
            alt="logo" class="img-fluid"></a>
    <ul class="dashboard_link">
        <li><a class="{{ request()->is('user/dashboard') ? 'active' : '' }}" href="{{ route('user.dashboard') }}"><i class="fas fa-tachometer"></i>Dashboard</a></li>
        <li><a class="" href="{{ route('home') }}"><i class="far fa-home"></i> Trang chủ</a></li>
        <li><a class="{{ request()->is('user/dashboard_order') ? 'active' : '' }}" href="dsahboard_order.html"><i class="fas fa-list-ul"></i> Orders</a></li>
        <li><a class="{{ request()->is('user/dashboard_review') ? 'active' : '' }}" href="dsahboard_review.html"><i class="far fa-star"></i> Reviews</a></li>
        <li><a class="{{ request()->is('user/dashboard_wishlist') ? 'active' : '' }}" href="dsahboard_wishlist.html"><i class="far fa-heart"></i> Wishlist</a></li>
        <li><a class="{{ request()->is('user/profile') ? 'active' : '' }}" href="{{ route('user.profile') }}"><i class="far fa-user"></i> My Profile</a></li>
        <li><a class="{{ request()->is('user/dashboard_address') ? 'active' : '' }}" href="dsahboard_address.html"><i class="fal fa-gift-card"></i> Addresses</a></li>

        <li>


            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                      this.closest('form').submit();"><i
                        class="far fa-sign-out-alt"></i> Log out</a>
                </a>
            </form>
        </li>

    </ul>
</div>
