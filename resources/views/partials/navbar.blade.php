<nav class="navbar">

    <!-- Kiri: Logo -->
    <div class="nav-left">
        <a href="{{ route('welcome') }}" class="logo-box" style="text-decoration:none; color:inherit;">
            <img src="{{ asset('adminlte/dist/img/logo agatha.jpg') }}" alt="Logo">
            AGATHA
        </a>
    </div>

    <!-- Tengah: Menu -->
    <style>
        .active-nav {
            text-decoration: underline !important;
            text-underline-offset: 6px;
            text-decoration-thickness: 2px !important;
        }
    </style>
    <ul class="nav-links" id="nav-links">
        <li><a href="{{ route('menu') }}" class="{{ request()->routeIs('menu') ? 'active-nav' : '' }}">Menu</a></li>
        <li><a href="{{ route('gallery') }}" class="{{ request()->routeIs('gallery') ? 'active-nav' : '' }}">Galeri</a></li>
        <li><a href="{{ route('reservasi') }}" class="{{ request()->routeIs('reservasi') ? 'active-nav' : '' }}">Reservasi</a></li>

        <li><a href="{{ route('history') }}" class="{{ request()->routeIs('history') ? 'active-nav' : '' }}">Riwayat</a></li>
        <li><a href="{{ route('kontak') }}" class="{{ request()->routeIs('kontak') ? 'active-nav' : '' }}">Kontak</a></li>
        <li><a href="{{ route('kritik.index') }}" class="{{ request()->routeIs('kritik.*') ? 'active-nav' : '' }}">Ulasan</a></li>
    </ul>

    <!-- Kanan: Logout -->
    <div class="nav-right" style="display: flex; align-items: center; gap: 18px;">
        <a href="{{ route('cart') }}" style="position: relative; display: inline-flex; align-items: center; color: inherit; text-decoration: none;" title="Keranjang">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="9" cy="21" r="1"></circle>
                <circle cx="20" cy="21" r="1"></circle>
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
            </svg>
            @auth
                @php
                    $cartCount = 0;
                    $cart = \App\Models\Cart::where('user_id', auth()->id())->first();
                    if($cart) {
                        $cartCount = $cart->items->sum('qty');
                    }
                @endphp
                @if($cartCount > 0)
                    <span style="position: absolute; top: -8px; right: -12px; background: #ff5722; color: #fff; font-size: 11px; font-weight: 700; padding: 2px 6px; border-radius: 50px; line-height: 1; min-width: 18px; text-align: center; border: 2px solid #fff;">{{ $cartCount }}</span>
                @endif
            @endauth
        </a>
    @auth
        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
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