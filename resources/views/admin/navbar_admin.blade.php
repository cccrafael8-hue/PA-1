<nav class="navbar">
    <div class="nav-left">
        <a href="{{ route('admin.dashboard') }}" style="text-decoration: none; color: inherit;">
            <div class="logo-box">
                <img src="{{ asset('adminlte/dist/img/logo agatha.jpg') }}" alt="Logo">
                AGATHA
            </div>
        </a>
    </div>

    <ul class="nav-links">
        <li><a href="{{ route('admin.menu') }}">Menu</a></li>
        <li><a href="{{ route('gallery_admin') }}">Gallery</a></li>
        <li><a href="{{ route('admin.reservasi') }}">Reservasi</a></li>
        <li><a href="{{ route('admin.kontak') }}">Kontak</a></li>
        <li><a href="{{ route('admin.order_admin') }}">Order</a></li>

        <li><a href="{{ route('admin.reviews') }}">Kritik</a></li>
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