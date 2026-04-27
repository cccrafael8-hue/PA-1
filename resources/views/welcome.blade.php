@extends('layouts.app')

@section('title', 'AGATHA SPACE | Premium Experience')

@section('content')

@include('partials.navbar')


{{-- ════════════════════════════
     HERO
════════════════════════════ --}}
<section class="hero-banner">

    <div class="hero-bg"></div>

    <div class="hero-img-wrap">
        <img src="{{ asset('adminlte/dist/img/kopi3.png') }}" class="hero-img" alt="Agatha Space">
    </div>

    <div class="hero-overlay"></div>

    <div class="hero-content">
        <div class="hero-script">Agatha</div>
        <h2 class="hero-title">Quality Coffee<br>Premium Taste</h2>
        <p class="hero-sub">
            Rasakan kehangatan kopi pilihan dengan pemandangan Danau Toba yang memukau —
            setiap cangkir adalah cerita.
        </p>
        <div class="hero-actions">
            <a href="{{ route('menu') }}" class="btn-gold">Pesan Sekarang</a>
            <a href="{{ route('menu') }}" class="btn-ghost-hero">
                Lihat Menu
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                    <line x1="5" y1="12" x2="19" y2="12"/>
                    <polyline points="12 5 19 12 12 19"/>
                </svg>
            </a>
        </div>
    </div>

</section>


{{-- ════════════════════════════
     STRIP KEUNGGULAN
════════════════════════════ --}}
<div class="badge-strip">
    <div class="strip-item">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2A1E17" stroke-width="2.5" stroke-linecap="round">
            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
        </svg>
        <span>Specialty Coffee</span>
    </div>
    <div class="strip-item">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2A1E17" stroke-width="2.5" stroke-linecap="round">
            <circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/>
        </svg>
        <span>Open Daily 08.00 – 22.00</span>
    </div>
    <div class="strip-item">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2A1E17" stroke-width="2.5" stroke-linecap="round">
            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
            <circle cx="12" cy="10" r="3"/>
        </svg>
        <span>Balige, Toba</span>
    </div>
</div>


{{-- ════════════════════════════
     ABOUT
════════════════════════════ --}}
<div class="ag-about">
    <p class="ag-label">Tentang Kami</p>
    <p class="ag-title">Agatha Space · Balige, Toba</p>

    <div class="ag-frame">
        <div class="ag-photo-wrap">
            <div class="ag-photo-bg"></div>
            <img src="{{ asset('adminlte/dist/img/kopi4.png') }}" class="ag-photo" alt="Agatha Space">
        </div>

        <div class="ag-quote-card">
            <span class="ag-quote-mark">"</span>
            <p class="ag-quote-text">Agatha Space hadir sebagai ruang untuk menikmati momen — dari kopi pagi yang menenangkan hingga sore yang hangat bersama orang tersayang, di tepi danau paling indah di Indonesia.</p>
            <div class="ag-divider"></div>
            <span class="ag-author">Pendiri Agatha Space</span>
            <span class="ag-author-role">Balige, Toba</span>
        </div>
    </div>
</div>


{{-- ════════════════════════════
     NEWS & UPDATES
════════════════════════════ --}}
<section class="news">

    <div class="section-header">
        <p class="section-tag">Berita Terkini</p>
        <h2>News &amp; Updates</h2>
        <div class="line"></div>
    </div>

    <div class="news-container">

        <div class="news-card">
            @if(isset($latestGallery) && $latestGallery)
                <img src="{{ asset('storage/' . $latestGallery->image) }}" alt="{{ $latestGallery->title ?? 'Galeri Agatha' }}">
                <div class="content">
                    <span class="news-tag-pill">Gallery Update</span>
                    <h3>{{ $latestGallery->title ?? 'Momen Terbaru di Agatha' }}</h3>
                    <p>Lihat momen-momen indah terbaru yang kami abadikan di Agatha Space. Cek galeri kami untuk selengkapnya.</p>
                    <a href="{{ route('gallery') }}" class="btn-card">Lihat Galeri →</a>
                </div>
            @endif
        </div>

        <div class="news-card">
            @if(isset($popularMenu) && $popularMenu)
                <img src="{{ asset('storage/' . $popularMenu->gambar) }}" alt="{{ $popularMenu->nama_menu }}">
                <div class="content">
                    <span class="news-tag-pill">Bestseller</span>
                    <h3>{{ $popularMenu->nama_menu }}</h3>
                    <p>{{ Str::limit($popularMenu->deskripsi, 80) }}</p>
                    <a href="{{ route('menu') }}" class="btn-card">Pesan Sekarang →</a>
                </div>
            @endif
        </div>

    </div>

</section>


@include('partials.footer')


{{-- ════════════════════════════
     PAGE-SPECIFIC CSS
════════════════════════════ --}}
<style>

    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=Lato:wght@300;400;700&display=swap');

    /* ── HERO ── */
    .hero-banner {
        position: relative;
        height: 560px;
        overflow: hidden;
        display: flex;
        align-items: center;
        padding: 0 8%;
        margin-top: 64px;
    }

    .hero-bg {
        position: absolute;
        inset: 0;
        background: var(--espresso);
        z-index: 0;
    }

    .hero-img-wrap {
        position: absolute;
        right: 0; top: 0;
        width: 62%; height: 100%;
        z-index: 1;
    }

    .hero-img {
        width: 100%; height: 100%;
        object-fit: cover;
        opacity: 0.5;
        display: block;
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to right, #2A1E17 36%, rgba(42,30,23,0.15) 100%);
        z-index: 2;
    }

    .hero-content {
        position: relative;
        z-index: 3;
        max-width: 540px;
    }

    .hero-script {
        font-family: 'Georgia', 'Times New Roman', serif;
        font-size: 78px;
        color: var(--gold);
        line-height: 1;
        font-style: italic;
        letter-spacing: -1px;
        margin-bottom: 2px;
    }

    .hero-title {
        font-size: 40px;
        font-weight: 800;
        color: #fff;
        text-transform: uppercase;
        line-height: 1.05;
        letter-spacing: -0.5px;
        margin-bottom: 16px;
    }

    .hero-sub {
        font-size: 14px;
        color: rgba(255,255,255,0.65);
        font-weight: 300;
        line-height: 1.75;
        margin-bottom: 30px;
        max-width: 380px;
    }

    .hero-actions {
        display: flex;
        gap: 16px;
        align-items: center;
    }

    .btn-gold {
        background: var(--gold);
        color: var(--espresso);
        padding: 12px 28px;
        border-radius: 40px;
        text-decoration: none;
        font-weight: 800;
        font-size: 12px;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        transition: background 0.25s;
    }

    .btn-gold:hover {
        background: #d4b06a;
        color: var(--espresso);
    }

    .btn-ghost-hero {
        color: rgba(255,255,255,0.7);
        text-decoration: none;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 1px;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: color 0.2s;
    }

    .btn-ghost-hero:hover { color: var(--gold); }


    /* ── BADGE STRIP ── */
    .badge-strip {
        background: var(--gold);
        padding: 14px 8%;
        display: flex;
        justify-content: center;
        gap: 60px;
        flex-wrap: wrap;
    }

    .strip-item {
        display: flex;
        align-items: center;
        gap: 9px;
        color: var(--espresso);
    }

    .strip-item span {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }


    /* ── ABOUT ── */
    .ag-about {
        background: #faf8f5;
        padding: 80px 6% 100px;
        font-family: 'Lato', sans-serif;
    }

    .ag-label {
        text-align: center;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 4px;
        text-transform: uppercase;
        color: #c5a059;
        margin-bottom: 10px;
    }

    .ag-title {
        text-align: center;
        font-family: 'Playfair Display', serif;
        font-size: 13px;
        font-weight: 400;
        color: #888;
        letter-spacing: 3px;
        text-transform: uppercase;
        margin-bottom: 52px;
    }

    .ag-frame {
        position: relative;
        max-width: 700px;
        margin: 0 auto;
    }

    .ag-photo-wrap {
        position: relative;
        width: 72%;
        margin: 0 auto;
        z-index: 1;
    }

    .ag-photo-bg {
        position: absolute;
        inset: -14px -14px 14px 14px;
        background: #e8e2d8;
        border-radius: 4px;
        z-index: 0;
    }

    .ag-photo {
        position: relative;
        z-index: 1;
        width: 100%;
        aspect-ratio: 3/4;
        object-fit: cover;
        display: block;
        border-radius: 4px;
    }

    .ag-quote-card {
        position: absolute;
        right: -2%;
        bottom: 12%;
        width: 46%;
        background: #fff;
        padding: 24px 22px 20px;
        box-shadow: 0 12px 40px rgba(42,30,23,0.10);
        z-index: 10;
        border-radius: 2px;
    }

    .ag-quote-mark {
        font-family: 'Playfair Display', serif;
        font-size: 52px;
        line-height: 0.6;
        color: #c5a059;
        display: block;
        margin-bottom: 14px;
        font-style: italic;
    }

    .ag-quote-text {
        font-family: 'Lato', sans-serif;
        font-size: 13px;
        font-weight: 300;
        color: #3a2c22;
        line-height: 1.8;
        margin: 0 0 16px;
    }

    .ag-divider {
        width: 32px;
        height: 1px;
        background: #c5a059;
        margin: 0 0 12px;
    }

    .ag-author {
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: #c5a059;
    }

    .ag-author-role {
        font-size: 10px;
        font-weight: 400;
        color: #999;
        letter-spacing: 1px;
        display: block;
        margin-top: 2px;
    }


    /* ── NEWS ── */
    .news {
        padding: 72px 6%;
        background: var(--linen);
    }

    .section-header {
        text-align: center;
        margin-bottom: 48px;
    }

    .section-header h2 {
        font-weight: 800;
        font-size: 26px;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: var(--espresso);
    }

    .section-header .line {
        width: 50px; height: 2px;
        background: var(--gold);
        margin: 14px auto 0;
        border: none;
    }

    .news-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 22px;
        max-width: 860px;
        margin: auto;
    }

    .news-card {
        background: var(--white);
        border-radius: 18px;
        overflow: hidden;
        border: 0.5px solid rgba(42,30,23,0.08);
        transition: transform 0.35s, border-color 0.35s;
    }

    .news-card:hover {
        transform: translateY(-6px);
        border-color: rgba(197,160,89,0.5);
    }

    .news-card img {
        width: 100%; height: 200px;
        object-fit: cover;
        display: block;
    }

    .news-card .content { padding: 22px 24px; }

    .news-tag-pill {
        display: inline-block;
        font-size: 9px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        background: #f5ede3;
        color: #b8902f;
        padding: 4px 10px;
        border-radius: 20px;
        margin-bottom: 10px;
    }

    .news-card .content h3 {
        font-size: 16px;
        font-weight: 700;
        color: var(--espresso);
        margin-bottom: 8px;
        line-height: 1.3;
    }

    .news-card .content p {
        font-size: 12px;
        color: var(--taupe);
        line-height: 1.75;
        margin-bottom: 16px;
    }

    .btn-card {
        color: var(--gold);
        text-decoration: none;
        font-weight: 700;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: gap 0.2s;
    }

    .btn-card:hover { gap: 9px; color: var(--gold); }


    /* ── RESPONSIVE ── */
    @media (max-width: 768px) {
        .hero-banner { height: auto; padding: 80px 6% 60px; margin-top: 56px; }
        .hero-img-wrap { width: 100%; opacity: 0.25; }
        .hero-script { font-size: 56px; }
        .hero-title { font-size: 28px; }
        .badge-strip { gap: 24px; padding: 14px 6%; }
        .ag-photo-wrap { width: 90%; }
        .ag-quote-card {
            position: static;
            width: 90%;
            margin: 24px auto 0;
            box-shadow: 0 6px 20px rgba(42,30,23,0.08);
        }
    }

</style>

@endsection