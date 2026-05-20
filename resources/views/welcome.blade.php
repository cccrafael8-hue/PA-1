@extends('layouts.app')

@section('title', 'AGATHA SPACE | Quality Coffee · Balige, Toba')

@section('content')

@include('partials.navbar')

{{-- ════════════════════════════════════════
     HERO — Cinematic Full Bleed
════════════════════════════════════════ --}}
<section class="ag-hero" id="hero">
    <div class="ag-hero__bg">
        <img src="{{ asset('adminlte/dist/img/kopi3.png') }}" alt="Agatha Space" class="ag-hero__img" id="heroParallax">
        <div class="ag-hero__overlay"></div>
        <div class="ag-hero__grain"></div>
    </div>

    <div class="ag-hero__content">

        <div class="ag-hero__eyebrow">
            <span class="eyebrow-line"></span>
            <span>Est. Balige · Danau Toba</span>
            <span class="eyebrow-line"></span>
        </div>

        <h1 class="ag-hero__title">
            <em class="ag-hero__script">Agatha</em>
            <span class="ag-hero__word">Space</span>
        </h1>

        <p class="ag-hero__sub">
            Rasakan kehangatan kopi pilihan dengan pemandangan Danau Toba yang memukau —<br>
            setiap cangkir adalah cerita yang tak terlupakan.
        </p>

        <div class="ag-hero__actions">
            <a href="{{ route('menu') }}" class="btn-gold-hero">
                Pesan Sekarang
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
            <a href="{{ route('menu') }}" class="btn-ghost-hero">Lihat Menu</a>
        </div>

        <div class="ag-hero__stats">
            <div class="hero-stat">
                <span class="hero-stat__num" data-count="500">0</span><span class="hero-stat__unit">+</span>
                <span class="hero-stat__label">Pelanggan Setia</span>
            </div>
            <div class="hero-stat__divider"></div>
            <div class="hero-stat">
                <span class="hero-stat__num" data-count="30">0</span><span class="hero-stat__unit">+</span>
                <span class="hero-stat__label">Varian Menu</span>
            </div>
            <div class="hero-stat__divider"></div>
            <div class="hero-stat">
                <span class="hero-stat__num" data-count="4">0</span><span class="hero-stat__unit">.9★</span>
                <span class="hero-stat__label">Rating Google</span>
            </div>
        </div>
    </div>

    <div class="ag-hero__scroll">
        <div class="scroll-pill">
            <div class="scroll-pill__dot"></div>
        </div>
        <span>Scroll</span>
    </div>
</section>


{{-- ════════════════════════════════════════
     BADGE STRIP — Marquee
════════════════════════════════════════ --}}
<div class="ag-strip">
    <div class="ag-strip__track">
        <div class="strip-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
            <span>Specialty Coffee</span>
        </div>
        <span class="strip-dot">✦</span>
        <div class="strip-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
            <span>Open Daily 08.00 – 22.00</span>
        </div>
        <span class="strip-dot">✦</span>
        <div class="strip-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <span>Balige, Toba</span>
        </div>
        <span class="strip-dot">✦</span>
        <div class="strip-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M17 8h1a4 4 0 0 1 0 8h-1"/><path d="M3 8h14v9a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4V8z"/><line x1="6" y1="2" x2="6" y2="4"/><line x1="10" y1="2" x2="10" y2="4"/></svg>
            <span>Lakeside View</span>
        </div>
        <span class="strip-dot">✦</span>
        <div class="strip-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
            <span>Tempat Nongkrong Favorit</span>
        </div>
        <span class="strip-dot">✦</span>
        {{-- duplicate untuk infinite feel --}}
        <div class="strip-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
            <span>Specialty Coffee</span>
        </div>
        <span class="strip-dot">✦</span>
        <div class="strip-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
            <span>Open Daily 08.00 – 22.00</span>
        </div>
        <span class="strip-dot">✦</span>
        <div class="strip-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <span>Balige, Toba</span>
        </div>
        <span class="strip-dot">✦</span>
        <div class="strip-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M17 8h1a4 4 0 0 1 0 8h-1"/><path d="M3 8h14v9a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4V8z"/><line x1="6" y1="2" x2="6" y2="4"/><line x1="10" y1="2" x2="10" y2="4"/></svg>
            <span>Lakeside View</span>
        </div>
        <span class="strip-dot">✦</span>
        <div class="strip-item">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
            <span>Tempat Nongkrong Favorit</span>
        </div>
        <span class="strip-dot">✦</span>
    </div>
</div>


{{-- ════════════════════════════════════════
     ABOUT — Warisan & Cerita
════════════════════════════════════════ --}}
<section class="ag-about" id="about">
    <div class="ag-about__inner">

        <div class="ag-about__visual reveal-left">
            <div class="about-img-frame">
                <img src="{{ asset('adminlte/dist/img/kopi4.png') }}" alt="Agatha Space Interior" class="about-img-main">
                <div class="about-img-accent"></div>
                <div class="about-img-badge">
                    <span class="about-badge-year">2024</span>
                    <span class="about-badge-text">Sejak kami berdiri</span>
                </div>
            </div>
        </div>

        <div class="ag-about__text reveal-right">
            <p class="section-eyebrow">Warisan &amp; Cerita</p>
            <h2 class="section-title">Bukan Sekadar Kafe —<br><em>Ini Rumah Keduamu</em></h2>
            <p class="about-body">
                Agatha Space lahir dari kecintaan mendalam pada kopi dan keindahan alam Danau Toba.
                Di sini, setiap tegukan kopi diramu dengan penuh dedikasi oleh barista kami,
                ditemani pemandangan danau yang memukau — sebuah pengalaman yang hanya bisa kamu rasakan di Balige.
            </p>
            <p class="about-body">
                Kami percaya bahwa kopi yang baik adalah tentang momen: momen tenang di pagi hari,
                obrolan hangat bersama sahabat, atau sekadar jeda yang kamu butuhkan dari rutinitas.
            </p>
            <div class="about-pillars">
                <div class="pillar"><span class="pillar-icon">☕</span><span>Specialty Beans</span></div>
                <div class="pillar"><span class="pillar-icon">🏔️</span><span>Lakeside View</span></div>
                <div class="pillar"><span class="pillar-icon">🤝</span><span>Pelayanan Hangat</span></div>
            </div>
            <a href="{{ route('menu') }}" class="btn-outline-gold">Jelajahi Menu Kami →</a>
        </div>

    </div>
</section>


{{-- ════════════════════════════════════════
     MENU SHOWCASE — Food & Beverage
════════════════════════════════════════ --}}
<section class="ag-showcase" id="menu-showcase">

    <div class="ag-showcase__header reveal-up">
        <p class="section-eyebrow">Sajian Unggulan</p>
        <h2 class="section-title" style="color:#fff">Kelezatan yang<br><em>Tak Terlupakan</em></h2>
        <p class="showcase-sub">Dari kopi Arabika Toba yang kaya aroma hingga kuliner pilihan yang menggugah selera — setiap sajian kami hadirkan dengan standar kualitas tertinggi.</p>
    </div>

    <div class="showcase-grid">

        <div class="showcase-card showcase-card--featured reveal-up" style="--d:0ms">
            <div class="showcase-card__img-wrap">
                <img src="{{ asset('adminlte/dist/img/kopi3.png') }}" alt="Signature Coffee" class="showcase-card__img">
                <div class="showcase-card__overlay"></div>
            </div>
            <div class="showcase-card__info">
                <span class="card-pill">Bestseller</span>
                <h3>Signature Toba Coffee</h3>
                <p>Kopi Arabika single origin dari pegunungan Toba, diseduh dengan metode pour-over untuk menghasilkan rasa yang bersih dan kompleks.</p>
                <a href="{{ route('menu') }}" class="card-link">Lihat Detail →</a>
            </div>
        </div>

        <div class="showcase-col-right">
            <div class="showcase-card showcase-card--half reveal-up" style="--d:120ms">
                <div class="showcase-card__img-wrap">
                    <img src="{{ asset('adminlte/dist/img/cold_brew.png') }}" alt="Cold Brew" class="showcase-card__img">
                    <div class="showcase-card__overlay"></div>
                </div>
                <div class="showcase-card__info">
                    <span class="card-pill">Favorit</span>
                    <h3>Cold Brew Danau</h3>
                    <p>Diseduh dingin 16 jam untuk rasa yang halus dan menyegarkan.</p>
                    <a href="{{ route('menu') }}" class="card-link">Pesan →</a>
                </div>
            </div>

            <div class="showcase-card showcase-card--half reveal-up" style="--d:240ms">
                <div class="showcase-card__img-wrap">
                    <img src="{{ asset('adminlte/dist/img/kopi3.png') }}" alt="Snack" class="showcase-card__img" style="object-position:center 60%">
                    <div class="showcase-card__overlay"></div>
                </div>
                <div class="showcase-card__info">
                    <span class="card-pill">New Menu</span>
                    <h3>Snack Premium</h3>
                    <p>Camilan pilihan yang sempurna menemani sesi kopi kamu.</p>
                    <a href="{{ route('menu') }}" class="card-link">Pesan →</a>
                </div>
            </div>
        </div>

    </div>

    @if(isset($popularMenu) && $popularMenu)
    <div class="popular-menu-banner reveal-up">
        <div class="popular-menu-banner__inner">
            <span class="popular-label">⭐ Menu Terpopuler Minggu Ini</span>
            <h3>{{ $popularMenu->nama_menu }}</h3>
            <p>{{ Str::limit($popularMenu->deskripsi, 100) }}</p>
            <a href="{{ route('menu') }}" class="btn-gold-sm">Pesan Sekarang</a>
        </div>
        <div class="popular-menu-banner__img">
            <img src="{{ asset('storage/' . $popularMenu->gambar) }}" alt="{{ $popularMenu->nama_menu }}">
        </div>
    </div>
    @endif

    <div class="showcase-cta reveal-up">
        <a href="{{ route('menu') }}" class="btn-gold-hero">
            Lihat Semua Menu
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
        </a>
    </div>

</section>


{{-- ════════════════════════════════════════
     EXPERIENCE — Kapasitas & Fasilitas
════════════════════════════════════════ --}}
<section class="ag-experience" id="fasilitas">
    <div class="experience-bg-text">AGATHA</div>
    <div class="ag-experience__inner">

        <div class="experience-text reveal-left">
            <p class="section-eyebrow">Fasilitas &amp; Suasana</p>
            <h2 class="section-title" style="color:#fff">Tempat Terbaik<br><em>untuk Setiap Momen</em></h2>
            <p class="experience-body">
                Agatha Space menyediakan ruang yang nyaman dan instagramable —
                sempurna untuk gathering teman, arisan keluarga, meeting santai,
                hingga sesi foto yang estetik dengan latar Danau Toba.
            </p>

            <div class="experience-features">
                <div class="exp-feature reveal-up" style="--d:0ms">
                    <div class="exp-feature__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    </div>
                    <div>
                        <strong>Indoor &amp; Outdoor Area</strong>
                        <span>Pilihan tempat duduk yang beragam sesuai suasana hatimu</span>
                    </div>
                </div>
                <div class="exp-feature reveal-up" style="--d:100ms">
                    <div class="exp-feature__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                    </div>
                    <div>
                        <strong>Free Wi-Fi Kencang</strong>
                        <span>Produktif atau santai, koneksi kami selalu siap mendukung</span>
                    </div>
                </div>
                <div class="exp-feature reveal-up" style="--d:200ms">
                    <div class="exp-feature__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <div>
                        <strong>Cocok untuk Gathering</strong>
                        <span>Private area untuk acara komunitas, arisan, dan ulang tahun</span>
                    </div>
                </div>
                <div class="exp-feature reveal-up" style="--d:300ms">
                    <div class="exp-feature__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
                    </div>
                    <div>
                        <strong>Parkir Luas &amp; Aman</strong>
                        <span>Area parkir yang memadai untuk roda dua dan empat</span>
                    </div>
                </div>
            </div>

            <a href="{{ route('reservasi') }}" class="btn-gold-hero" style="margin-top:36px;display:inline-flex">
                Reservasi Sekarang
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>

        <div class="experience-visual reveal-right">
            <div class="exp-img-stack">
                <div class="exp-img exp-img--main">
                    <img src="{{ asset('adminlte/dist/img/kopi4.png') }}" alt="Agatha Space Suasana">
                </div>
                <div class="exp-img exp-img--float">
                    <img src="{{ asset('adminlte/dist/img/kopi3.png') }}" alt="Agatha Space View">
                </div>
                <div class="exp-badge-lake">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/></svg>
                    <span>Lakeside View<br><small>Balige, Toba</small></span>
                </div>
            </div>
        </div>

    </div>
</section>


{{-- ════════════════════════════════════════
     COUNTER STRIP
════════════════════════════════════════ --}}
<section class="ag-counter">
    <div class="ag-counter__inner">
        <div class="counter-item reveal-up" style="--d:0ms">
            <span class="counter-num" data-count="500">0</span><span class="counter-unit">+</span>
            <span class="counter-label">Pelanggan per Bulan</span>
        </div>
        <div class="counter-divider"></div>
        <div class="counter-item reveal-up" style="--d:100ms">
            <span class="counter-num" data-count="30">0</span><span class="counter-unit">+</span>
            <span class="counter-label">Varian Menu</span>
        </div>
        <div class="counter-divider"></div>
        <div class="counter-item reveal-up" style="--d:200ms">
            <span class="counter-num" data-count="4">0</span><span class="counter-unit">.9★</span>
            <span class="counter-label">Rating Google Maps</span>
        </div>
        <div class="counter-divider"></div>
        <div class="counter-item reveal-up" style="--d:300ms">
            <span class="counter-num" data-count="100">0</span><span class="counter-unit">%</span>
            <span class="counter-label">Halal &amp; Terjamin</span>
        </div>
    </div>
</section>


{{-- ════════════════════════════════════════
     NEWS & GALLERY
════════════════════════════════════════ --}}
<section class="ag-news" id="news">

    <div class="ag-news__header reveal-up">
        <p class="section-eyebrow">Update Terbaru</p>
        <h2 class="section-title">News &amp; <em>Gallery</em></h2>
        <div class="title-underline"></div>
    </div>

    <div class="ag-news__grid">

        @if(isset($latestGallery) && $latestGallery)
        <div class="news-card reveal-up" style="--d:0ms">
            <div class="news-card__img-wrap">
                <img src="{{ asset('storage/' . $latestGallery->image) }}" alt="{{ $latestGallery->title ?? 'Galeri Agatha' }}">
                <span class="news-card__pill">Gallery Update</span>
            </div>
            <div class="news-card__body">
                <h3>{{ $latestGallery->title ?? 'Momen Terbaru di Agatha' }}</h3>
                <p>Lihat momen-momen indah terbaru yang kami abadikan di Agatha Space. Dari sesi kopi pagi hingga sore yang hangat.</p>
                <a href="{{ route('gallery') }}" class="news-card__link">Lihat Galeri →</a>
            </div>
        </div>
        @else
        <div class="news-card reveal-up" style="--d:0ms">
            <div class="news-card__img-wrap">
                <img src="{{ asset('adminlte/dist/img/kopi3.png') }}" alt="Gallery">
                <span class="news-card__pill">Gallery</span>
            </div>
            <div class="news-card__body">
                <h3>Momen Indah di Agatha Space</h3>
                <p>Abadikan setiap momen berharga bersama orang-orang tersayang di tepi Danau Toba yang memukau.</p>
                <a href="{{ route('gallery') }}" class="news-card__link">Lihat Galeri →</a>
            </div>
        </div>
        @endif

        @if(isset($popularMenu) && $popularMenu)
        <div class="news-card reveal-up" style="--d:140ms">
            <div class="news-card__img-wrap">
                <img src="{{ asset('storage/' . $popularMenu->gambar) }}" alt="{{ $popularMenu->nama_menu }}">
                <span class="news-card__pill">Bestseller</span>
            </div>
            <div class="news-card__body">
                <h3>{{ $popularMenu->nama_menu }}</h3>
                <p>{{ Str::limit($popularMenu->deskripsi, 100) }}</p>
                <a href="{{ route('menu') }}" class="news-card__link">Pesan Sekarang →</a>
            </div>
        </div>
        @else
        <div class="news-card reveal-up" style="--d:140ms">
            <div class="news-card__img-wrap">
                <img src="{{ asset('adminlte/dist/img/kopi4.png') }}" alt="Menu Favorit">
                <span class="news-card__pill">Bestseller</span>
            </div>
            <div class="news-card__body">
                <h3>Signature Toba Coffee</h3>
                <p>Menu andalan kami yang selalu menjadi favorit pelanggan. Rasa autentik dari biji kopi pilihan terbaik Toba.</p>
                <a href="{{ route('menu') }}" class="news-card__link">Pesan Sekarang →</a>
            </div>
        </div>
        @endif

        <div class="news-card reveal-up" style="--d:280ms">
            <div class="news-card__img-wrap">
                <img src="{{ asset('adminlte/dist/img/kopi3.png') }}" alt="Promo" style="object-position:center 30%">
                <span class="news-card__pill news-card__pill--promo">🎉 Promo</span>
            </div>
            <div class="news-card__body">
                <h3>Happy Hour 14.00 – 17.00</h3>
                <p>Nikmati diskon spesial untuk semua minuman setiap hari di jam Happy Hour. Ajak temanmu dan rasakan serunya!</p>
                <a href="{{ route('menu') }}" class="news-card__link">Klaim Promo →</a>
            </div>
        </div>

    </div>
</section>


{{-- ════════════════════════════════════════
     LOKASI
════════════════════════════════════════ --}}
<section class="ag-location" id="lokasi">
    <div class="ag-location__inner">

        <div class="location-info reveal-left">
            <p class="section-eyebrow">Kunjungi Kami</p>
            <h2 class="section-title">Temukan Kami di<br><em>Balige, Toba</em></h2>

            <div class="loc-details">
                <div class="loc-item">
                    <div class="loc-item__icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    </div>
                    <div>
                        <strong>Alamat</strong>
                        <span>Jl. Siliwangi, Pardede Onan<br>Balige, Kabupaten Toba, Sumatera Utara</span>
                    </div>
                </div>
                <div class="loc-item">
                    <div class="loc-item__icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
                    </div>
                    <div>
                        <strong>Jam Operasional</strong>
                        <span>Weekdays 11.00 - 22.00 | Weekend 11.00 - 23.00<br><em>Last Order: 22.00</em></span>
                    </div>
                </div>
                <div class="loc-item">
                    <div class="loc-item__icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13 19.79 19.79 0 0 1 1.64 4.35 2 2 0 0 1 3.6 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.11 6.11l.96-.96a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    </div>
                    <div>
                        <strong>Hubungi Kami</strong>
                        <span>0878 9421 0997<br>@agathaspace.balige</span>
                    </div>
                </div>
            </div>

            <div class="loc-services">
                <p class="loc-services__title">Layanan Kami:</p>
                <div class="loc-services__list">
                    <span>☕ Dine-in</span>
                    <span>📦 Take Away</span>
                    <span>🎂 Gathering &amp; Event</span>
                    <span>📸 Photo Session</span>
                </div>
            </div>

            <a href="https://wa.me/62811608376" target="_blank" class="btn-gold-hero" style="display:inline-flex;margin-top:28px">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
                Reservasi via WhatsApp
            </a>
        </div>

        <div class="location-map reveal-right">
            <div class="map-frame">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3984.9!2d99.0638!3d2.3352!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x302df7b3b3b3b3b3%3A0x0!2sJl.%20Siliwangi%2C%20Pardede%20Onan%2C%20Balige%2C%20Kabupaten%20Toba%2C%20Sumatera%20Utara!5e0!3m2!1sid!2sid!4v1700000000001"
                    width="100%" height="100%" style="border:0" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade" title="Lokasi Agatha Space Balige">
                </iframe>
                <div class="map-pin-label">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="#c5a059"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/></svg>
                    Agatha Space · Balige, Toba
                </div>
            </div>
        </div>

    </div>
</section>


{{-- ════════════════════════════════════════
     CTA BANNER PENUTUP
════════════════════════════════════════ --}}
<section class="ag-cta-banner reveal-up">
    <div class="cta-banner__bg">
        <img src="{{ asset('adminlte/dist/img/kopi3.png') }}" alt="">
        <div class="cta-banner__overlay"></div>
    </div>
    <div class="cta-banner__content">
        <p class="section-eyebrow" style="text-align:center">Tunggu Apa Lagi?</p>
        <h2>Kunjungi Kami &amp; Rasakan<br><em>Bedanya Agatha Space</em></h2>
        <p>Dari Senin hingga Minggu, selalu ada alasan untuk datang.</p>
        <div class="cta-banner__buttons">
            <a href="{{ route('menu') }}" class="btn-gold-hero">Lihat Menu</a>
            <a href="https://wa.me/6287894210997" target="_blank" class="cta-ghost-white">Hubungi Kami</a>
        </div>
    </div>
</section>


@include('partials.footer')


{{-- ════════════════════════════════════════
     CSS
════════════════════════════════════════ --}}
<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400;1,700&family=Lato:wght@300;400;700;900&display=swap');

:root {
    --gold:      #c5a059;
    --gold-lt:   #d4b06a;
    --gold-dk:   #a8862f;
    --espresso:  #2A1E17;
    --espresso2: #1a120e;
    --linen:     #faf8f5;
    --linen2:    #f3ede4;
    --taupe:     #7a6b5d;
    --white:     #ffffff;
    --ease-out:  cubic-bezier(0.22, 1, 0.36, 1);
}

/* ── SCROLL REVEAL ── */
.reveal-up, .reveal-left, .reveal-right {
    opacity: 0;
    transition: opacity 0.9s var(--ease-out), transform 0.9s var(--ease-out);
    transition-delay: var(--d, 0ms);
}
.reveal-up    { transform: translateY(56px); }
.reveal-left  { transform: translateX(-64px); }
.reveal-right { transform: translateX(64px); }
.reveal-up.visible, .reveal-left.visible, .reveal-right.visible {
    opacity: 1; transform: translate(0, 0);
}

/* ── GLOBAL ── */
.section-eyebrow {
    display: block;
    font-size: 10px; font-weight: 700;
    letter-spacing: 4px; text-transform: uppercase;
    color: var(--gold); margin-bottom: 12px;
}
.section-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(26px, 3.5vw, 44px);
    font-weight: 700; color: var(--espresso);
    line-height: 1.15; margin-bottom: 20px;
}
.section-title em { font-style: italic; color: var(--gold); }
.title-underline {
    width: 52px; height: 3px; border-radius: 2px;
    background: var(--gold); margin: 16px auto 0;
}

.btn-gold-hero {
    display: inline-flex; align-items: center; gap: 8px;
    background: var(--gold); color: var(--espresso);
    padding: 13px 30px; border-radius: 40px;
    text-decoration: none; font-weight: 800;
    font-size: 12px; letter-spacing: 1.5px; text-transform: uppercase;
    transition: background 0.25s, transform 0.2s;
    white-space: nowrap;
}
.btn-gold-hero:hover { background: var(--gold-lt); transform: translateY(-2px); color: var(--espresso); }

.btn-gold-sm {
    display: inline-block; background: var(--gold); color: var(--espresso);
    padding: 10px 24px; border-radius: 40px; text-decoration: none;
    font-weight: 700; font-size: 11px; letter-spacing: 1px; text-transform: uppercase;
    transition: background 0.2s;
}
.btn-gold-sm:hover { background: var(--gold-lt); color: var(--espresso); }

.btn-outline-gold {
    display: inline-block; border: 1.5px solid var(--gold); color: var(--gold);
    padding: 12px 28px; border-radius: 40px; text-decoration: none;
    font-weight: 700; font-size: 12px; letter-spacing: 1px; text-transform: uppercase;
    transition: background 0.2s, color 0.2s; margin-top: 28px;
}
.btn-outline-gold:hover { background: var(--gold); color: var(--espresso); }

.btn-ghost-hero {
    color: rgba(255,255,255,0.65); text-decoration: none;
    font-size: 12px; font-weight: 600; letter-spacing: 1px; text-transform: uppercase;
    display: inline-flex; align-items: center; gap: 6px;
    transition: color 0.2s;
}
.btn-ghost-hero:hover { color: var(--gold); }

/* ═══════════════════════
   HERO
═══════════════════════ */
.ag-hero {
    position: relative; height: 100vh; min-height: 620px;
    display: flex; align-items: flex-end;
    padding: 0 7% 10vh; overflow: hidden; margin-top: 64px;
}
.ag-hero__bg { position: absolute; inset: 0; z-index: 0; }
.ag-hero__img {
    width: 100%; height: 110%; object-fit: cover;
    display: block; will-change: transform;
}
.ag-hero__overlay {
    position: absolute; inset: 0;
    background: linear-gradient(155deg, rgba(26,18,14,0.95) 0%, rgba(26,18,14,0.65) 55%, rgba(26,18,14,0.3) 100%);
    z-index: 1;
}
.ag-hero__grain {
    position: absolute; inset: 0; z-index: 2; pointer-events: none; opacity: 0.35;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.07'/%3E%3C/svg%3E");
}
.ag-hero__content {
    position: relative; z-index: 3; max-width: 680px;
    opacity: 0; animation: heroReveal 1s var(--ease-out) 0.1s forwards;
}
@keyframes heroReveal {
    from { opacity: 0; transform: translateY(40px); }
    to   { opacity: 1; transform: translateY(0); }
}
.ag-hero__eyebrow {
    display: flex; align-items: center; gap: 12px; margin-bottom: 20px;
}
.eyebrow-line { flex: 1; max-width: 40px; height: 1px; background: var(--gold); opacity: 0.6; }
.ag-hero__eyebrow > span:not(.eyebrow-line) {
    font-size: 10px; letter-spacing: 4px; text-transform: uppercase;
    color: var(--gold); font-weight: 700;
}
.ag-hero__title { margin: 0 0 16px; line-height: 0.95; }
.ag-hero__script {
    display: block;
    font-family: 'Playfair Display', serif;
    font-size: clamp(80px, 13vw, 140px);
    font-style: italic; color: var(--gold);
    font-weight: 400; line-height: 1;
}
.ag-hero__word {
    display: block;
    font-family: 'Lato', sans-serif;
    font-size: clamp(32px, 5.5vw, 64px);
    font-weight: 900; color: #fff;
    text-transform: uppercase; letter-spacing: 10px; margin-left: 4px;
}
.ag-hero__sub {
    font-size: 14px; color: rgba(255,255,255,0.55);
    font-weight: 300; line-height: 1.9;
    margin-bottom: 32px; max-width: 440px;
}
.ag-hero__actions {
    display: flex; gap: 16px; align-items: center; margin-bottom: 44px;
}
.ag-hero__stats {
    display: inline-flex; gap: 0; align-items: center;
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.1);
    backdrop-filter: blur(16px);
    border-radius: 16px; padding: 18px 28px; width: fit-content;
}
.hero-stat { text-align: center; padding: 0 24px; }
.hero-stat:first-child { padding-left: 0; }
.hero-stat__num {
    font-family: 'Playfair Display', serif; font-size: 26px;
    font-weight: 700; color: var(--gold);
}
.hero-stat__unit { font-size: 15px; color: var(--gold); font-weight: 700; }
.hero-stat__label {
    display: block; font-size: 9px; letter-spacing: 1.5px;
    color: rgba(255,255,255,0.4); text-transform: uppercase; margin-top: 4px;
}
.hero-stat__divider { width: 1px; height: 36px; background: rgba(255,255,255,0.12); flex-shrink: 0; }

.ag-hero__scroll {
    position: absolute; bottom: 44px; right: 7%;
    display: flex; flex-direction: column; align-items: center; gap: 8px;
    z-index: 3;
    opacity: 0; animation: fadeIn 1s ease 1.4s forwards;
}
.ag-hero__scroll > span {
    font-size: 9px; letter-spacing: 3px; color: rgba(255,255,255,0.3);
    text-transform: uppercase; writing-mode: vertical-rl;
}
.scroll-pill {
    width: 22px; height: 38px; border: 1.5px solid rgba(255,255,255,0.18);
    border-radius: 12px; display: flex; align-items: flex-start;
    justify-content: center; padding: 5px 0;
}
.scroll-pill__dot {
    width: 4px; height: 8px; border-radius: 2px; background: var(--gold);
    animation: scrollBob 2.2s ease-in-out infinite;
}
@keyframes scrollBob {
    0%,100% { transform: translateY(0); opacity: 1; }
    70%      { transform: translateY(14px); opacity: 0; }
}
@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

/* ═══════════════════════
   BADGE STRIP MARQUEE
═══════════════════════ */
.ag-strip { background: var(--gold); overflow: hidden; }
.ag-strip__track {
    display: inline-flex; align-items: center; gap: 32px;
    padding: 14px 32px; white-space: nowrap;
    animation: marquee 30s linear infinite;
}
.strip-item {
    display: inline-flex; align-items: center; gap: 10px;
    color: var(--espresso); flex-shrink: 0;
}
.strip-item span { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; }
.strip-item svg { color: var(--espresso); }
.strip-dot { color: var(--espresso); font-size: 8px; opacity: 0.4; }
@keyframes marquee { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }

/* ═══════════════════════
   ABOUT
═══════════════════════ */
.ag-about { background: var(--linen); padding: 108px 7%; }
.ag-about__inner {
    display: grid; grid-template-columns: 1fr 1fr;
    gap: 88px; align-items: center;
    max-width: 1200px; margin: 0 auto;
}
.about-img-frame { position: relative; max-width: 480px; }
.about-img-main {
    width: 100%; aspect-ratio: 4/5; object-fit: cover;
    display: block; border-radius: 6px; position: relative; z-index: 2;
}
.about-img-accent {
    position: absolute; top: -18px; right: -18px; bottom: 18px; left: 18px;
    background: var(--gold); opacity: 0.15; border-radius: 6px; z-index: 1;
}
.about-img-badge {
    position: absolute; bottom: -22px; right: -22px;
    background: var(--espresso); color: #fff;
    padding: 20px 24px; border-radius: 10px; z-index: 3;
    text-align: center; box-shadow: 0 16px 40px rgba(42,30,23,0.22);
}
.about-badge-year {
    display: block; font-family: 'Playfair Display', serif;
    font-size: 36px; font-weight: 700; color: var(--gold); line-height: 1;
}
.about-badge-text {
    display: block; font-size: 9px; letter-spacing: 2px;
    text-transform: uppercase; color: rgba(255,255,255,0.4); margin-top: 4px;
}
.about-body {
    font-family: 'Lato', sans-serif; font-size: 15px;
    font-weight: 300; color: var(--taupe); line-height: 1.9; margin-bottom: 16px;
}
.about-pillars { display: flex; gap: 12px; margin: 28px 0; flex-wrap: wrap; }
.pillar {
    display: flex; align-items: center; gap: 8px;
    background: #fff; border: 1px solid #e8e2d8;
    padding: 10px 18px; border-radius: 40px;
    font-size: 12px; font-weight: 700; color: var(--espresso);
}
.pillar-icon { font-size: 16px; }

/* ═══════════════════════
   SHOWCASE
═══════════════════════ */
.ag-showcase { background: var(--espresso); padding: 108px 7%; }
.ag-showcase__header { text-align: center; margin-bottom: 60px; }
.showcase-sub {
    color: rgba(255,255,255,0.4); font-size: 14px; font-weight: 300;
    line-height: 1.8; max-width: 520px; margin: 0 auto;
}
.showcase-grid {
    display: grid; grid-template-columns: 1.15fr 0.85fr;
    gap: 18px; max-width: 1200px; margin: 0 auto 18px;
}
.showcase-col-right { display: flex; flex-direction: column; gap: 18px; }
.showcase-card {
    border-radius: 14px; overflow: hidden; position: relative; cursor: pointer;
    transition: transform 0.5s var(--ease-out);
}
.showcase-card:hover { transform: scale(1.018); }
.showcase-card__img-wrap { position: relative; overflow: hidden; }
.showcase-card--featured .showcase-card__img-wrap { height: 560px; }
.showcase-card--half .showcase-card__img-wrap { height: 265px; }
.showcase-card__img {
    width: 100%; height: 100%; object-fit: cover; display: block;
    transition: transform 0.7s var(--ease-out);
}
.showcase-card:hover .showcase-card__img { transform: scale(1.06); }
.showcase-card__overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to top, rgba(26,18,14,0.92) 0%, transparent 52%);
}
.showcase-card__info { position: absolute; bottom: 0; left: 0; right: 0; padding: 24px 26px; z-index: 2; }
.showcase-card__info h3 {
    font-family: 'Playfair Display', serif; font-size: 22px;
    font-weight: 700; color: #fff; margin: 8px 0 6px; line-height: 1.2;
}
.showcase-card--half .showcase-card__info h3 { font-size: 17px; }
.showcase-card__info p { font-size: 12px; color: rgba(255,255,255,0.55); font-weight: 300; line-height: 1.7; margin-bottom: 12px; }
.card-pill {
    display: inline-block; background: var(--gold); color: var(--espresso);
    font-size: 9px; font-weight: 700; letter-spacing: 2px;
    text-transform: uppercase; padding: 4px 12px; border-radius: 20px;
}
.card-link {
    color: var(--gold); text-decoration: none; font-size: 11px;
    font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase;
    transition: letter-spacing 0.2s; display: inline-block;
}
.card-link:hover { letter-spacing: 3px; color: var(--gold); }
.popular-menu-banner {
    max-width: 1200px; margin: 0 auto 48px;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(197,160,89,0.22);
    border-radius: 14px; display: flex; align-items: center; overflow: hidden;
}
.popular-menu-banner__inner { padding: 36px 40px; flex: 1; }
.popular-label {
    display: block; font-size: 10px; letter-spacing: 2px;
    text-transform: uppercase; color: var(--gold); font-weight: 700; margin-bottom: 10px;
}
.popular-menu-banner__inner h3 {
    font-family: 'Playfair Display', serif; font-size: 26px; color: #fff; margin-bottom: 10px;
}
.popular-menu-banner__inner p { font-size: 13px; color: rgba(255,255,255,0.45); line-height: 1.7; margin-bottom: 20px; }
.popular-menu-banner__img { width: 200px; height: 160px; flex-shrink: 0; }
.popular-menu-banner__img img { width: 100%; height: 100%; object-fit: cover; display: block; }
.showcase-cta { text-align: center; }

/* ═══════════════════════
   EXPERIENCE (dark)
═══════════════════════ */
.ag-experience { background: var(--espresso2); padding: 108px 7%; position: relative; overflow: hidden; }
.experience-bg-text {
    position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
    font-family: 'Playfair Display', serif;
    font-size: clamp(80px, 20vw, 260px);
    font-weight: 700; color: rgba(255,255,255,0.018);
    white-space: nowrap; pointer-events: none; user-select: none;
    letter-spacing: 28px; z-index: 0;
}
.ag-experience__inner {
    display: grid; grid-template-columns: 1fr 1fr;
    gap: 88px; align-items: center;
    max-width: 1200px; margin: 0 auto; position: relative; z-index: 1;
}
.experience-body {
    font-size: 15px; color: rgba(255,255,255,0.45);
    font-weight: 300; line-height: 1.9; margin-bottom: 36px;
}
.experience-features { display: flex; flex-direction: column; gap: 22px; }
.exp-feature { display: flex; gap: 18px; align-items: flex-start; }
.exp-feature__icon {
    width: 48px; height: 48px; flex-shrink: 0; color: var(--gold);
    background: rgba(197,160,89,0.08); border: 1px solid rgba(197,160,89,0.18);
    border-radius: 12px; display: flex; align-items: center; justify-content: center;
    transition: background 0.25s;
}
.exp-feature:hover .exp-feature__icon { background: rgba(197,160,89,0.18); }
.exp-feature div strong { display: block; font-size: 14px; font-weight: 700; color: #fff; margin-bottom: 3px; }
.exp-feature div span { font-size: 12px; color: rgba(255,255,255,0.38); font-weight: 300; line-height: 1.7; }
.exp-img-stack { position: relative; height: 540px; }
.exp-img { border-radius: 14px; overflow: hidden; position: absolute; }
.exp-img img { width: 100%; height: 100%; object-fit: cover; display: block; }
.exp-img--main { width: 78%; height: 420px; top: 0; left: 0; z-index: 2; }
.exp-img--float {
    width: 56%; height: 260px; bottom: 0; right: 0; z-index: 3;
    box-shadow: 0 28px 64px rgba(0,0,0,0.45);
    border: 4px solid var(--espresso2);
}
.exp-badge-lake {
    position: absolute; top: 20px; right: -4px;
    background: var(--gold); color: var(--espresso);
    padding: 14px 16px; border-radius: 12px;
    display: flex; align-items: center; gap: 10px; z-index: 4;
    font-size: 13px; font-weight: 700;
    box-shadow: 0 8px 24px rgba(197,160,89,0.35);
}
.exp-badge-lake small { display: block; font-size: 10px; font-weight: 400; opacity: 0.65; }

/* ═══════════════════════
   COUNTER
═══════════════════════ */
.ag-counter { background: var(--gold); padding: 60px 7%; }
.ag-counter__inner {
    display: flex; justify-content: center; align-items: center;
    gap: 0; flex-wrap: wrap; max-width: 900px; margin: 0 auto;
}
.counter-item { text-align: center; padding: 14px 44px; flex: 1; min-width: 150px; }
.counter-num {
    font-family: 'Playfair Display', serif; font-size: 48px;
    font-weight: 700; color: var(--espresso); line-height: 1;
}
.counter-unit { font-size: 26px; font-weight: 700; color: var(--espresso); }
.counter-label {
    display: block; font-size: 10px; letter-spacing: 2px;
    text-transform: uppercase; color: rgba(42,30,23,0.5);
    margin-top: 8px; font-weight: 700;
}
.counter-divider { width: 1px; height: 64px; background: rgba(42,30,23,0.14); flex-shrink: 0; }

/* ═══════════════════════
   NEWS
═══════════════════════ */
.ag-news { background: var(--linen); padding: 108px 7%; }
.ag-news__header { text-align: center; margin-bottom: 56px; }
.ag-news__grid {
    display: grid; grid-template-columns: repeat(3, 1fr);
    gap: 22px; max-width: 1200px; margin: 0 auto;
}
.news-card {
    background: #fff; border-radius: 16px; overflow: hidden;
    border: 1px solid rgba(42,30,23,0.07);
    transition: transform 0.45s var(--ease-out), box-shadow 0.45s var(--ease-out);
}
.news-card:hover { transform: translateY(-10px); box-shadow: 0 28px 56px rgba(42,30,23,0.09); }
.news-card__img-wrap { position: relative; overflow: hidden; }
.news-card__img-wrap img {
    width: 100%; height: 220px; object-fit: cover; display: block;
    transition: transform 0.6s var(--ease-out);
}
.news-card:hover .news-card__img-wrap img { transform: scale(1.06); }
.news-card__pill {
    position: absolute; top: 14px; left: 14px;
    background: var(--espresso); color: var(--gold);
    font-size: 9px; font-weight: 700; letter-spacing: 2px;
    text-transform: uppercase; padding: 5px 12px; border-radius: 20px;
}
.news-card__pill--promo { background: var(--gold); color: var(--espresso); }
.news-card__body { padding: 24px 26px; }
.news-card__body h3 {
    font-family: 'Playfair Display', serif; font-size: 18px;
    font-weight: 700; color: var(--espresso); margin-bottom: 10px; line-height: 1.3;
}
.news-card__body p { font-size: 13px; color: var(--taupe); line-height: 1.75; margin-bottom: 18px; font-weight: 300; }
.news-card__link {
    color: var(--gold); text-decoration: none; font-size: 11px;
    font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase;
    transition: letter-spacing 0.2s;
}
.news-card__link:hover { letter-spacing: 2.5px; color: var(--gold); }

/* ═══════════════════════
   LOKASI
═══════════════════════ */
.ag-location { background: var(--linen2); padding: 108px 7%; }
.ag-location__inner {
    display: grid; grid-template-columns: 1fr 1fr;
    gap: 72px; align-items: start;
    max-width: 1200px; margin: 0 auto;
}
.loc-details { margin: 32px 0; display: flex; flex-direction: column; gap: 22px; }
.loc-item { display: flex; gap: 18px; align-items: flex-start; }
.loc-item__icon {
    width: 46px; height: 46px; background: #fff;
    border: 1px solid #e8e2d8; border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; color: var(--gold);
}
.loc-item strong { display: block; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: var(--espresso); margin-bottom: 3px; }
.loc-item span { font-size: 14px; color: var(--taupe); line-height: 1.75; font-weight: 300; }
.loc-item em { font-style: normal; font-size: 12px; color: var(--gold); }
.loc-services__title { font-size: 10px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: var(--espresso); margin-bottom: 12px; }
.loc-services__list { display: flex; flex-wrap: wrap; gap: 10px; }
.loc-services__list span {
    background: #fff; border: 1px solid #e8e2d8;
    padding: 8px 16px; border-radius: 40px;
    font-size: 12px; font-weight: 600; color: var(--espresso);
}
.map-frame { position: relative; height: 420px; border-radius: 16px; overflow: hidden; box-shadow: 0 24px 56px rgba(42,30,23,0.12); }
.map-frame iframe { width: 100%; height: 100%; }
.map-pin-label {
    position: absolute; top: 16px; left: 16px; background: #fff;
    padding: 10px 16px; border-radius: 10px;
    font-size: 12px; font-weight: 700; color: var(--espresso);
    display: flex; align-items: center; gap: 6px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.12);
}

/* ═══════════════════════
   CTA BANNER
═══════════════════════ */
.ag-cta-banner { position: relative; padding: 120px 7%; text-align: center; overflow: hidden; }
.cta-banner__bg { position: absolute; inset: 0; z-index: 0; }
.cta-banner__bg img { width: 100%; height: 100%; object-fit: cover; display: block; }
.cta-banner__overlay { position: absolute; inset: 0; background: rgba(26,18,14,0.87); }
.cta-banner__content { position: relative; z-index: 2; max-width: 640px; margin: 0 auto; }
.cta-banner__content h2 {
    font-family: 'Playfair Display', serif;
    font-size: clamp(28px, 4vw, 50px);
    font-weight: 700; color: #fff; line-height: 1.2; margin-bottom: 16px;
}
.cta-banner__content h2 em { color: var(--gold); font-style: italic; }
.cta-banner__content p { font-size: 15px; color: rgba(255,255,255,0.45); font-weight: 300; line-height: 1.8; }
.cta-banner__buttons {
    display: flex; gap: 16px; justify-content: center;
    flex-wrap: wrap; margin-top: 36px;
}
.cta-ghost-white {
    border: 1.5px solid rgba(255,255,255,0.25);
    padding: 13px 30px; border-radius: 40px;
    color: #fff; text-decoration: none; font-weight: 700;
    font-size: 12px; letter-spacing: 1.5px; text-transform: uppercase;
    transition: border-color 0.2s, background 0.2s;
}
.cta-ghost-white:hover { border-color: var(--gold); background: rgba(197,160,89,0.1); color: #fff; }

/* ═══════════════════════
   RESPONSIVE
═══════════════════════ */
@media (max-width: 1024px) {
    .showcase-grid { grid-template-columns: 1fr; }
    .showcase-card--featured .showcase-card__img-wrap { height: 400px; }
    .showcase-col-right { flex-direction: row; }
    .showcase-card--half { flex: 1; }
}
@media (max-width: 768px) {
    .ag-hero { padding: 0 6% 88px; }
    .ag-hero__script { font-size: 64px; }
    .ag-hero__word { font-size: 30px; letter-spacing: 5px; }
    .ag-hero__stats { padding: 14px 18px; }
    .hero-stat { padding: 0 14px; }
    .hero-stat__num { font-size: 22px; }
    .ag-about__inner, .ag-experience__inner, .ag-location__inner { grid-template-columns: 1fr; gap: 52px; }
    .about-img-badge { right: -8px; bottom: -10px; }
    .ag-news__grid { grid-template-columns: 1fr; }
    .showcase-col-right { flex-direction: column; }
    .counter-item { padding: 14px 20px; min-width: 120px; }
    .counter-num { font-size: 36px; }
    .exp-img-stack { height: 360px; }
    .exp-img--main { height: 300px; width: 82%; }
    .exp-img--float { height: 190px; width: 56%; }
    .popular-menu-banner { flex-direction: column; }
    .popular-menu-banner__img { width: 100%; height: 180px; }
    .ag-cta-banner { padding: 80px 6%; }
}
</style>


{{-- ════════════════════════════════════════
     JAVASCRIPT
════════════════════════════════════════ --}}
<script>
(function () {
    'use strict';

    /* ── 1. SCROLL REVEAL ── */
    const revealEls = document.querySelectorAll('.reveal-up, .reveal-left, .reveal-right');
    if ('IntersectionObserver' in window) {
        const obs = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('visible');
                    obs.unobserve(e.target);
                }
            });
        }, { threshold: 0.13 });
        revealEls.forEach(el => obs.observe(el));
    } else {
        revealEls.forEach(el => el.classList.add('visible'));
    }

    /* ── 2. COUNT-UP ANIMATION ── */
    function countUp(el, target, duration) {
        const isDecimal = !Number.isInteger(target);
        let startTime = null;
        function step(ts) {
            if (!startTime) startTime = ts;
            const p = Math.min((ts - startTime) / duration, 1);
            const eased = 1 - Math.pow(1 - p, 4); // easeOutQuart
            el.textContent = isDecimal
                ? (eased * target).toFixed(1)
                : Math.floor(eased * target);
            if (p < 1) requestAnimationFrame(step);
            else el.textContent = isDecimal ? target.toFixed(1) : target;
        }
        requestAnimationFrame(step);
    }

    const counters = document.querySelectorAll('.counter-num, .hero-stat__num');
    const cObs = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                const target = parseFloat(e.target.dataset.count);
                countUp(e.target, target, 2000);
                cObs.unobserve(e.target);
            }
        });
    }, { threshold: 0.5 });
    counters.forEach(el => cObs.observe(el));

    /* ── 3. HERO PARALLAX ── */
    const heroImg = document.getElementById('heroParallax');
    if (heroImg) {
        let ticking = false;
        const onScroll = () => {
            if (!ticking) {
                requestAnimationFrame(() => {
                    heroImg.style.transform = `translateY(${window.scrollY * 0.32}px)`;
                    ticking = false;
                });
                ticking = true;
            }
        };
        window.addEventListener('scroll', onScroll, { passive: true });
    }

    /* ── 4. SHOWCASE CARD TILT ── */
    document.querySelectorAll('.showcase-card').forEach(card => {
        card.addEventListener('mousemove', e => {
            const r = card.getBoundingClientRect();
            const x = ((e.clientX - r.left) / r.width - 0.5) * 6;
            const y = ((e.clientY - r.top)  / r.height - 0.5) * 6;
            card.style.transform = `scale(1.018) rotateY(${x}deg) rotateX(${-y}deg)`;
            card.style.transition = 'transform 0.1s linear';
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = '';
            card.style.transition = 'transform 0.5s cubic-bezier(0.22,1,0.36,1)';
        });
    });

    /* ── 5. NEWS CARD STAGGER on scroll ── */
    const newsCards = document.querySelectorAll('.news-card');
    const ncObs = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.style.transitionDelay = e.target.style.getPropertyValue('--d') || '0ms';
                e.target.classList.add('visible');
                ncObs.unobserve(e.target);
            }
        });
    }, { threshold: 0.1 });
    newsCards.forEach(nc => ncObs.observe(nc));

})();
</script>

@endsection