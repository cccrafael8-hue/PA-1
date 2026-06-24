<nav class="navbar">
    <div class="nav-left">
        <a href="{{ route('admin.dashboard') }}" style="text-decoration: none; color: inherit;">
            <div class="logo-box">
                <img src="{{ asset('adminlte/dist/img/logo agatha.jpg') }}" alt="Logo">
                AGATHA
            </div>
        </a>
    </div>

    <style>
        .active-nav {
            text-decoration: underline !important;
            text-underline-offset: 6px;
            text-decoration-thickness: 2px !important;
        }
    </style>
    <ul class="nav-links">
        <li><a href="{{ route('admin.menu') }}" class="{{ request()->routeIs('admin.menu*') ? 'active-nav' : '' }}">Menu</a></li>
        <li><a href="{{ route('gallery_admin') }}" class="{{ request()->routeIs('gallery_admin*') ? 'active-nav' : '' }}">Galeri</a></li>
        
        @php
            $pendingReservations = \App\Models\Reservation::where('status', 'pending')->count();
        @endphp
        <li>
            <a href="{{ route('admin.reservation') }}" class="{{ request()->routeIs('admin.reservation*') ? 'active-nav' : '' }}" style="position: relative;">
                Reservasi
                @if($pendingReservations > 0)
                    <span style="position: absolute; top: -8px; right: -15px; background: #ff5722; color: #fff; font-size: 10px; font-weight: bold; padding: 2px 6px; border-radius: 50px; line-height: 1;">{{ $pendingReservations }}</span>
                @endif
            </a>
        </li>

        <li><a href="{{ route('admin.kontak') }}" class="{{ request()->routeIs('admin.kontak*') ? 'active-nav' : '' }}">Kontak</a></li>

        @php
            $pendingOrders = \App\Models\Order::where('status', 'pending')->where('is_hidden', false)->count();
        @endphp
        <li>
            <a href="{{ route('admin.order_admin') }}" class="{{ request()->routeIs('admin.order*') ? 'active-nav' : '' }}" style="position: relative;">
                Pesanan
                @if($pendingOrders > 0)
                    <span style="position: absolute; top: -8px; right: -15px; background: #ff5722; color: #fff; font-size: 10px; font-weight: bold; padding: 2px 6px; border-radius: 50px; line-height: 1;">{{ $pendingOrders }}</span>
                @endif
            </a>
        </li>
        <li><a href="{{ route('admin.payment_settings') }}" class="{{ request()->routeIs('admin.payment_settings*') ? 'active-nav' : '' }}">Pembayaran</a></li>
        <li><a href="{{ route('admin.reviews') }}" class="{{ request()->routeIs('admin.reviews*') ? 'active-nav' : '' }}">Ulasan</a></li>
    </ul>

    <div class="nav-right">
    @auth
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">LOGOUT</button>
        </form>
    @endauth
    </div>
</nav>