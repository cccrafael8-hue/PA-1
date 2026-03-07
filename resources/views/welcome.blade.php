@extends('layouts.app')

@section('title', 'AGATHA SPACE | Premium Experience')

@section('content')

@include('partials.navbar')

<section class="hero-banner">
    <div class="hero-content">
        <img src=>
        <h1>Agatha Space</h1>
        <h2>Quality Coffee<br>Premium Taste</h2>
        <p>Rasakan kehangatan kopi pilihan dengan pemandangan danau yang memukau. Kami hadir untuk memberikan momen relaksasi terbaik untuk Anda.</p>
        <div style="display: flex; gap: 20px; font-size: 18px; color: var(--gold);">
            <i class="fab fa-instagram"></i>
            <i class="fab fa-facebook"></i>
            <i class="fab fa-youtube"></i>
        </div>
    </div>
</section>

<section class="news">
    <div class="section-header">
        <h2>News & Updates</h2>
        <div class="line"></div>
    </div>

    <div class="news-container">
        <div class="news-card">
            <img src="https://images.unsplash.com/photo-1556740738-b6a63e27c4df" alt="Donasi">
            <div class="content">
                <h3>Agatha Peduli Sesama</h3>
                <p>Program donasi rutin kami untuk membantu komunitas di sekitar danau sebagai bentuk rasa syukur.</p>
                <a href="#" class="btn-card">Pelajari Selengkapnya →</a>
            </div>
        </div>

        <div class="news-card">
            <img src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085" alt="Promo">
            <div class="content">
                <h3>Golden Hours Promo</h3>
                <p>Nikmati diskon 20% untuk semua varian Signature Latte setiap hari Senin - Jumat pukul 14.00 - 17</p>
</div>
</div>
</div>
</section>

@include('partials.footer')
@endsection