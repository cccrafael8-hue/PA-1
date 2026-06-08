@extends('layouts.app')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">

<style>
:root {
    --bg:           #f0ebe8;
    --surface:      #faf6f4;
    --card:         #ffffff;
    --border:       rgba(43,30,22,0.08);
    --border-mid:   rgba(43,30,22,0.14);
    --border-strong:rgba(43,30,22,0.22);

    --brown:        #2b1e16;
    --brown-mid:    #4a2e1e;
    --brown-soft:   #7a4a3a;
    --brown-muted:  #a07060;
    --brown-pale:   #d4bbb4;
    --brown-faint:  #efe7e3;

    --accent:       #2b1e16;
    --text-primary: #2b1e16;
    --text-muted:   #8a6050;
    --text-faint:   #b89488;
}

* { box-sizing: border-box; margin: 0; padding: 0; }

body {
    background: var(--bg);
    font-family: 'DM Sans', sans-serif;
    color: var(--text-primary);
}

.menu-container {
    max-width: 1120px;
    margin: 110px auto 80px;
    padding: 0 24px;
}

/* ── HERO ── */
.menu-hero {
    position: relative;
    margin-bottom: 36px;
    padding: 40px 52px;
    background: var(--brown);
    border-radius: 24px;
    overflow: hidden;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 24px;
}

.menu-hero::before {
    content: '';
    position: absolute;
    top: -70px; right: -70px;
    width: 260px; height: 260px;
    background: rgba(255,255,255,0.03);
    border-radius: 50%;
    pointer-events: none;
}

.menu-hero::after {
    content: '';
    position: absolute;
    bottom: -60px; left: 30%;
    width: 200px; height: 200px;
    background: rgba(255,255,255,0.02);
    border-radius: 50%;
    pointer-events: none;
}

.menu-hero-text { position: relative; z-index: 1; }

.menu-hero-eyebrow {
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 3.5px;
    text-transform: uppercase;
    color: var(--brown-pale);
    margin-bottom: 10px;
    opacity: 0.7;
}

.menu-hero-title {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 36px;
    font-weight: 600;
    color: #fff;
    line-height: 1.18;
}

.menu-hero-title span { color: var(--brown-pale); }

.btn-cart {
    position: relative;
    z-index: 1;
    display: flex;
    align-items: center;
    gap: 10px;
    background: rgba(255,255,255,0.10);
    border: 1px solid rgba(255,255,255,0.18);
    color: #fff;
    padding: 13px 24px;
    border-radius: 50px;
    font-size: 13.5px;
    font-weight: 500;
    text-decoration: none;
    transition: background 0.22s, transform 0.18s;
    white-space: nowrap;
    font-family: 'DM Sans', sans-serif;
}

.btn-cart:hover {
    background: rgba(255,255,255,0.18);
    color: #fff;
    text-decoration: none;
    transform: translateY(-1px);
}

/* ── ALERT ── */
.alert-custom {
    display: flex;
    align-items: center;
    gap: 10px;
    background: #edf7ef;
    border: 1px solid #b4d9bc;
    color: #2a6b38;
    padding: 13px 20px;
    border-radius: 14px;
    font-size: 13.5px;
    font-weight: 500;
    margin-bottom: 28px;
}

.alert-custom::before {
    content: '\2713';
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 22px; height: 22px;
    background: #2a6b38;
    color: #fff;
    border-radius: 50%;
    font-size: 12px;
    font-weight: 700;
    flex-shrink: 0;
}

/* ── FILTERS ── */
.filter-section { margin-bottom: 30px; }

.filter-label {
    font-size: 10px;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    color: var(--text-faint);
    font-weight: 600;
    margin-bottom: 14px;
}

.category-filters {
    display: flex;
    gap: 10px;
    overflow-x: auto;
    padding-bottom: 4px;
    scrollbar-width: none;
}
.category-filters::-webkit-scrollbar { display: none; }

.filter-btn {
    padding: 9px 22px;
    border: 1.5px solid var(--border-mid);
    background: var(--card);
    color: var(--brown-soft);
    border-radius: 50px;
    cursor: pointer;
    font-size: 13px;
    font-weight: 500;
    transition: all 0.22s ease;
    white-space: nowrap;
    font-family: 'DM Sans', sans-serif;
}

.filter-btn:hover {
    border-color: var(--brown);
    color: var(--brown);
    background: var(--brown-faint);
}

.filter-btn.active {
    background: var(--brown);
    border-color: var(--brown);
    color: #fff;
    box-shadow: 0 4px 16px rgba(43,30,22,0.22);
}

/* ── DIVIDER ── */
.menu-section-label {
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    color: var(--text-faint);
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 14px;
}

.menu-section-label::after {
    content: '';
    flex: 1;
    height: 1px;
    background: var(--border);
}

/* ── GRID ── */
.menu-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
    gap: 18px;
}

/* ── CARD ── */
.menu-card {
    background: var(--card);
    border-radius: 20px;
    overflow: hidden;
    border: 1px solid var(--border);
    transition: transform 0.28s cubic-bezier(.22,.68,0,1.2), box-shadow 0.28s ease;
    animation: fadeUp 0.45s ease both;
}

.menu-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 48px rgba(43,30,22,0.12);
    border-color: var(--border-mid);
}

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(18px); }
    to   { opacity: 1; transform: translateY(0); }
}

.menu-grid .menu-card:nth-child(1) { animation-delay: 0.04s; }
.menu-grid .menu-card:nth-child(2) { animation-delay: 0.08s; }
.menu-grid .menu-card:nth-child(3) { animation-delay: 0.12s; }
.menu-grid .menu-card:nth-child(4) { animation-delay: 0.16s; }
.menu-grid .menu-card:nth-child(5) { animation-delay: 0.20s; }
.menu-grid .menu-card:nth-child(6) { animation-delay: 0.24s; }
.menu-grid .menu-card:nth-child(7) { animation-delay: 0.28s; }
.menu-grid .menu-card:nth-child(8) { animation-delay: 0.32s; }

/* ── IMAGE ── */
.menu-img-wrap {
    position: relative;
    height: 178px;
    overflow: hidden;
}

.menu-img {
    width: 100%; height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.45s ease;
}

.menu-card:hover .menu-img { transform: scale(1.07); }

.kategori-badge {
    position: absolute;
    top: 12px; left: 12px;
    background: rgba(43,30,22,0.72);
    backdrop-filter: blur(6px);
    color: var(--brown-pale);
    font-size: 9.5px;
    font-weight: 700;
    letter-spacing: 1.8px;
    text-transform: uppercase;
    padding: 5px 11px;
    border-radius: 20px;
}

/* ── BODY ── */
.menu-body { padding: 16px 18px 18px; }

.menu-name {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 15.5px;
    font-weight: 500;
    color: var(--text-primary);
    margin-bottom: 5px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.menu-desc {
    font-size: 12px;
    color: var(--text-muted);
    line-height: 1.65;
    margin-bottom: 14px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* ── SELECT ── */
.tipe-select {
    width: 100%;
    padding: 7px 32px 7px 10px;
    font-size: 12.5px;
    font-family: 'DM Sans', sans-serif;
    border-radius: 10px;
    border: 1.5px solid var(--border-mid);
    background: var(--brown-faint);
    color: var(--brown-mid);
    font-weight: 500;
    outline: none;
    cursor: pointer;
    margin-bottom: 14px;
    transition: border-color 0.2s;
    appearance: none;
    -webkit-appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='13' height='13' viewBox='0 0 24 24' fill='none' stroke='%234a2e1e' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 10px center;
}

.tipe-select:focus { border-color: var(--brown); }

/* ── CARD FOOTER ── */
.menu-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 14px;
    border-top: 1px solid var(--border);
}

.price-wrap { display: flex; flex-direction: column; gap: 1px; }

.price-label {
    font-size: 9.5px;
    color: var(--text-faint);
    font-weight: 600;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.menu-price {
    font-size: 15px;
    font-weight: 600;
    color: var(--brown);
    letter-spacing: -0.2px;
}

.btn-add {
    width: 38px; height: 38px;
    background: var(--brown);
    border: none;
    border-radius: 50%;
    color: #fff;
    font-size: 24px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    line-height: 1;
    padding: 0;
    transition: background 0.2s, transform 0.15s;
    flex-shrink: 0;
}

.btn-add:hover {
    background: var(--brown-mid);
    transform: scale(1.1);
}

.btn-add:active { transform: scale(0.94); }

/* ── RESPONSIVE ── */
@media (max-width: 640px) {
    .menu-hero { flex-direction: column; align-items: flex-start; padding: 28px; }
    .menu-hero-title { font-size: 28px; }
    .menu-container { margin-top: 80px; }
}
</style>

@include('partials.navbar')

<div class="menu-container">

    @if(session('success'))
        <div class="alert-custom">{{ session('success') }}</div>
    @endif

    {{-- Hero --}}
    <div class="menu-hero">
        <div class="menu-hero-text">
            <div class="menu-hero-eyebrow">Pilihan Terbaik Kami</div>
            <h1 class="menu-hero-title">Menu <span>Kami</span></h1>
        </div>

    </div>

    {{-- Filters --}}
    <div class="filter-section">
        <div class="filter-label">Kategori</div>
        <div class="category-filters">
            <button class="filter-btn active" data-filter="all">Semua</button>
            <button class="filter-btn" data-filter="makanan">Makanan</button>
            <button class="filter-btn" data-filter="coffee">Coffee</button>
            <button class="filter-btn" data-filter="non_coffee">Non Coffee</button>
            <button class="filter-btn" data-filter="snack">Snack</button>
        </div>
    </div>

    <div class="menu-section-label">
        <span id="menu-count">{{ count($menus) }} item tersedia</span>
    </div>

    {{-- Grid --}}
    <div class="menu-grid" id="menuGrid">

        @foreach($menus as $menu)
        <div class="menu-card" data-kategori="{{ $menu->kategori }}">

            <div class="menu-img-wrap">
                <img
                    src="{{ asset('storage/'.$menu->gambar) }}"
                    class="menu-img"
                    alt="{{ $menu->nama_menu }}"
                    loading="lazy"
                >
                <span class="kategori-badge">
                    @if($menu->kategori == 'coffee') Coffee
                    @elseif($menu->kategori == 'non_coffee') Non Coffee
                    @elseif($menu->kategori == 'snack') Snack
                    @else Makanan
                    @endif
                </span>
            </div>

            <div class="menu-body">
                <div class="menu-name">{{ $menu->nama_menu }}</div>
                <div class="menu-desc">{{ $menu->deskripsi }}</div>

                @if($menu->kategori == 'coffee')
                    <select class="tipe-select"
                            data-harga-hot="{{ $menu->harga_hot ?? $menu->harga }}"
                            data-harga-cold="{{ $menu->harga_cold ?? $menu->harga }}"
                            onchange="updatePriceAndType(this)">
                        <option value="hot">Hot</option>
                        <option value="cold">Cold / Iced</option>
                    </select>
                @endif

                <div class="menu-footer">
                    <div class="price-wrap">
                        <span class="price-label">Harga</span>
                        <span class="menu-price price-display">
                            @if($menu->kategori == 'coffee')
                                Rp {{ number_format($menu->harga_hot ?? $menu->harga, 0, ',', '.') }}
                            @else
                                Rp {{ number_format($menu->harga, 0, ',', '.') }}
                            @endif
                        </span>
                    </div>

                    <form action="{{ route('cart.add') }}" method="POST" class="form-add-cart">
                        @csrf
                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                        @if($menu->kategori == 'coffee')
                            <input type="hidden" name="tipe" class="tipe-input" value="hot">
                        @endif
                        <button type="submit" class="btn-add" title="Tambah ke Keranjang" aria-label="Tambah {{ $menu->nama_menu }} ke keranjang">+</button>
                    </form>
                </div>
            </div>

        </div>
        @endforeach

    </div>
</div>

<script>
function updatePriceAndType(selectEl) {
    const card = selectEl.closest('.menu-card');
    const priceDisplay = card.querySelector('.price-display');
    const tipeInput = card.querySelector('.tipe-input');
    const isHot = selectEl.value === 'hot';
    const price = isHot ? selectEl.getAttribute('data-harga-hot') : selectEl.getAttribute('data-harga-cold');
    priceDisplay.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(price);
    if (tipeInput) tipeInput.value = selectEl.value;
}

document.addEventListener("DOMContentLoaded", function () {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const menuCards  = document.querySelectorAll('.menu-card');
    const countEl    = document.getElementById('menu-count');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const filterValue = this.getAttribute('data-filter');
            let visible = 0;

            menuCards.forEach(card => {
                const match = filterValue === 'all' || card.getAttribute('data-kategori') === filterValue;
                card.style.display = match ? 'block' : 'none';
                if (match) visible++;
            });

            countEl.textContent = visible + ' item tersedia';
        });
    });

    const cartForms = document.querySelectorAll('.form-add-cart');
    cartForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = this.querySelector('.btn-add');
            const originalText = btn.innerHTML;
            btn.innerHTML = '...';
            btn.disabled = true;

            fetch(this.action, {
                method: 'POST',
                body: new FormData(this),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    btn.innerHTML = '&#10003;';
                    btn.style.background = '#2a6b38';
                    
                    const cartLink = document.querySelector('.nav-right a[href$="cart"]');
                    if(cartLink) {
                        let badge = cartLink.querySelector('span');
                        if(badge) {
                            badge.textContent = data.cartCount;
                        } else {
                            cartLink.innerHTML += `<span style="position: absolute; top: -8px; right: -12px; background: #ff5722; color: #fff; font-size: 11px; font-weight: 700; padding: 2px 6px; border-radius: 50px; line-height: 1; min-width: 18px; text-align: center; border: 2px solid #fff;">${data.cartCount}</span>`;
                        }
                    }

                    setTimeout(() => {
                        btn.innerHTML = originalText;
                        btn.style.background = '';
                        btn.disabled = false;
                    }, 1500);
                }
            })
            .catch(err => {
                console.error(err);
                btn.innerHTML = originalText;
                btn.disabled = false;
            });
        });
    });
});
</script>

@include('partials.footer')

@endsection