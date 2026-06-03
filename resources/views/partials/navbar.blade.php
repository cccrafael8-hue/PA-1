<nav class="navbar">

    <!-- Kiri: Logo -->
    <div class="nav-left">
        <a href="{{ route('welcome') }}" class="logo-box" style="text-decoration:none; color:inherit;">
            <img src="{{ asset('adminlte/dist/img/logo agatha.jpg') }}" alt="Logo">
            AGATHA
        </a>
    </div>

    <!-- Tengah: Menu -->
    <ul class="nav-links" id="nav-links">
        <li><a href="{{ route('menu') }}">Menu</a></li>
        <li><a href="{{ route('gallery') }}">Gallery</a></li>
        <li><a href="{{ route('reservasi') }}">Reservasi</a></li>
        <li><a href="{{ route('cart') }}">Keranjang</a></li>
        <li><a href="{{ route('history') }}">History</a></li>
        <li><a href="{{ route('kontak') }}">Kontak</a></li>
        <li><a href="{{ route('kritik.index') }}">Ulasan</a></li>
    </ul>

    <!-- Kanan: Logout -->
    <div class="nav-right">
    @auth
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">LOGOUT</button>
        </form>
    @else
        <a href="{{ route('login') }}" class="btn-login" style="text-decoration:none;">LOGIN</a>
    @endauth
    </div>

    <!-- Hamburger Menu -->
    <button class="hamburger" id="hamburger">
        <span></span>
        <span></span>
        <span></span>
    </button>

</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const hamburger = document.getElementById('hamburger');
        const navLinks = document.getElementById('nav-links');

        if(hamburger) {
            hamburger.addEventListener('click', () => {
                hamburger.classList.toggle('active');
                navLinks.classList.toggle('active');
            });
        }
    });
</script>