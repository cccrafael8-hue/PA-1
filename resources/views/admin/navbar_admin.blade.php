<nav class="navbar">

    <!-- Kiri: Logo -->
    <div class="nav-left">
        <div class="logo-box">
            <img src="{{ asset('adminlte/dist/img/logo agatha.jpg') }}" alt="Logo">
            AGATHA
        </div>
    </div>

    <!-- Tengah: Menu -->
    <ul class="nav-links">
        <li><a href="{{ route('admin.menu') }}">Menu</a></li>
        <li><a href="{{ route('gallery') }}">Gallery</a></li>
        <li><a href="{{ route('admin.reservasi') }}">Reservasi</a></li>
        <li><a href="{{ route('admin.contact') }}">Kontak</a></li>
        <li><a href="{{ route('admin.order_admin') }}">Order</a></li>
    </ul>

    <!-- Kanan: Sign In -->
    <div class="nav-right">
    @auth
 

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">LOGOUT</button>
        </form>
    @endauth

</div>

</nav>