@extends('layouts.app')

@section('content')

<style>
body {
    background: #f0ebe8;
}

.menu-container {
    max-width: 1100px;
    margin: 110px auto 60px;
    padding: 0 16px;
}

.menu-topbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.menu-heading {
    font-size: 20px;
    font-weight: 600;
    color: #3d1f1a;
}

.btn-lihat {
    display: flex;
    align-items: center;
    gap: 7px;
    background: #fff;
    border: 0.5px solid rgba(91,58,52,0.2);
    color: #5b3a34;
    padding: 9px 18px;
    border-radius: 24px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: background 0.2s;
}

.btn-lihat:hover {
    background: #f5ede9;
    color: #5b3a34;
    text-decoration: none;
}

/* ── ALERT ── */
.alert-custom {
    background: #eaf5ec;
    border: 0.5px solid rgba(60,130,70,0.2);
    color: #2e6b38;
    padding: 11px 16px;
    border-radius: 12px;
    font-size: 13px;
    text-align: center;
    margin-bottom: 20px;
}

.menu-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 16px;
}

.menu-card {
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    border: 0.5px solid rgba(91,58,52,0.1);
    transition: transform 0.2s;
}

.menu-card:hover {
    transform: translateY(-4px);
}

.menu-img {
    width: 100%;
    height: 160px;
    object-fit: cover;
    display: block;
}

.menu-body {
    padding: 14px;
}

.menu-name {
    font-size: 14px;
    font-weight: 600;
    color: #2c1410;
    margin-bottom: 4px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.menu-desc {
    font-size: 12px;
    color: #9a7068;
    line-height: 1.5;
    margin-bottom: 0;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.menu-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 10px;
    padding-top: 10px;
    border-top: 0.5px solid rgba(91,58,52,0.1);
}

.menu-price {
    font-size: 14px;
    font-weight: 600;
    color: #5b3a34;
}

.btn-add {
    width: 34px;
    height: 34px;
    background: #5b3a34;
    border: none;
    border-radius: 50%;
    color: #fff;
    font-size: 22px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    line-height: 1;
    padding: 0;
    transition: background 0.2s;
    flex-shrink: 0;
}

.btn-add:hover {
    background: #4a2e29;
}
</style>

@include('partials.navbar')

<div class="menu-container">

    @if(session('success'))
        <div class="alert-custom">
            {{ session('success') }}
        </div>
    @endif

    <div class="menu-topbar">
        <h2 class="menu-heading">Menu Kami</h2>
        <a href="{{ route('cart') }}" class="btn-lihat">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#5b3a34" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
            </svg>
            Lihat Keranjang
        </a>
    </div>

    <!-- Category Shortcuts -->
    <div class="category-filters" style="display: flex; gap: 10px; margin-bottom: 25px; overflow-x: auto; padding-bottom: 5px;">
        <button class="filter-btn active" data-filter="all" style="padding: 8px 16px; border: 1px solid #5b3a34; background: #5b3a34; color: #fff; border-radius: 20px; cursor: pointer; font-size: 14px; font-weight: 500; transition: 0.3s; white-space: nowrap;">Semua</button>
        <button class="filter-btn" data-filter="makanan" style="padding: 8px 16px; border: 1px solid #5b3a34; background: transparent; color: #5b3a34; border-radius: 20px; cursor: pointer; font-size: 14px; font-weight: 500; transition: 0.3s; white-space: nowrap;">Makanan</button>
        <button class="filter-btn" data-filter="coffee" style="padding: 8px 16px; border: 1px solid #5b3a34; background: transparent; color: #5b3a34; border-radius: 20px; cursor: pointer; font-size: 14px; font-weight: 500; transition: 0.3s; white-space: nowrap;">Coffee</button>
        <button class="filter-btn" data-filter="non_coffee" style="padding: 8px 16px; border: 1px solid #5b3a34; background: transparent; color: #5b3a34; border-radius: 20px; cursor: pointer; font-size: 14px; font-weight: 500; transition: 0.3s; white-space: nowrap;">Non Coffee</button>
    </div>

    <div class="menu-grid">

        @foreach($menus as $menu)

        <div class="menu-card" data-kategori="{{ $menu->kategori }}">

            <img
                src="{{ asset('storage/'.$menu->gambar) }}"
                class="menu-img"
                alt="{{ $menu->nama_menu }}"
            >

            <div class="menu-body">

                <div class="menu-name">{{ $menu->nama_menu }}</div>
                <div class="menu-desc">{{ $menu->deskripsi }}</div>

                <div class="menu-footer">
                    <span class="menu-price">Rp {{ number_format($menu->harga, 0, ',', '.') }}</span>

                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                        <button type="submit" class="btn-add" title="Tambah ke Keranjang">+</button>
                    </form>
                </div>

            </div>

        </div>

        @endforeach

    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const menuCards = document.querySelectorAll('.menu-card');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Update active state
            filterBtns.forEach(b => {
                b.style.background = 'transparent';
                b.style.color = '#5b3a34';
                b.classList.remove('active');
            });
            this.style.background = '#5b3a34';
            this.style.color = '#fff';
            this.classList.add('active');

            const filterValue = this.getAttribute('data-filter');

            menuCards.forEach(card => {
                if (filterValue === 'all') {
                    card.style.display = 'block';
                } else {
                    if (card.getAttribute('data-kategori') === filterValue) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                }
            });
        });
    });
});
</script>

@include('partials.footer')

@endsection