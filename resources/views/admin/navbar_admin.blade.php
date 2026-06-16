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
        <li><a href="{{ route('admin.reservasi') }}" class="{{ request()->routeIs('admin.reservasi*') ? 'active-nav' : '' }}">Reservasi</a></li>
        <li><a href="{{ route('admin.kontak') }}" class="{{ request()->routeIs('admin.kontak*') ? 'active-nav' : '' }}">Kontak</a></li>
        <li><a href="{{ route('admin.order_admin') }}" class="{{ request()->routeIs('admin.order*') ? 'active-nav' : '' }}">Order</a></li>
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