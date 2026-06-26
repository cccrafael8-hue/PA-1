@extends('layouts.app')

@section('content')

@include('partials.navbar')

<div class="gallery-page">

    <div class="gallery-hero">
        <div class="gallery-hero-left">
            <span class="gallery-tag">Lihat bagaimana AGATHA SPACE hadir dalam keseharian.</span>
            <h1 class="gallery-title">Galeri <span>Foto</span></h1>
        </div>
        <div class="gallery-count">
            Menampilkan <strong>{{ $albums->count() }}</strong> album
        </div>
    </div>

    <div class="gallery-divider"></div>

    <div class="container-fluid gallery-container">
        <div class="gallery-grid">
            @foreach($albums as $index => $album)
            <a href="{{ route('gallery.show', $album->id) }}" style="text-decoration: none;">
                <div class="gallery-card album-card">
                    <div class="gallery-img-wrap">
                        @if($album->latestGallery)
                            <img src="{{ asset('storage/'.$album->latestGallery->image) }}"
                                 class="gallery-img"
                                 alt="{{ $album->name }}">
                        @else
                            <div style="height: 240px; background: #c0b5af; display: flex; align-items: center; justify-content: center; color: white;">
                                <span>Tidak ada foto</span>
                            </div>
                        @endif
                    </div>
                    <div class="gallery-overlay"></div>
                    <div class="gallery-overlay-top"></div>
                    
                    <div class="album-badge">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                        {{ $album->galleries_count }} Foto
                    </div>

                    <div class="gallery-info">
                        <h5 class="gallery-caption">{{ $album->name }}</h5>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>

</div>

@include('partials.footer')

<style>
html, body {
    background-color: #e9e5e3 !important;
}

.gallery-page {
    background: #e9e5e3;
    min-height: 100vh;
    padding-top: 80px;
    padding-bottom: 60px;
}

.gallery-hero {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    padding: 48px 48px 32px;
}

.gallery-tag {
    display: block;
    font-size: 11px;
    letter-spacing: 0.22em;
    text-transform: uppercase;
    color: rgba(0,0,0,0.4);
    margin-bottom: 10px;
    font-weight: 400;
}

.gallery-title {
    font-family: 'Georgia', 'Times New Roman', serif;
    font-size: 42px;
    font-weight: 600;
    color: #1a1a1a;
    line-height: 1.1;
    letter-spacing: -0.01em;
    margin: 0;
}

.gallery-title span {
    color: transparent;
    -webkit-text-stroke: 1px rgba(0,0,0,0.2);
}

.gallery-count {
    font-size: 13px;
    color: rgba(0,0,0,0.45);
    letter-spacing: 0.04em;
    padding-bottom: 6px;
}

.gallery-count strong {
    color: rgba(0,0,0,0.75);
    font-weight: 500;
}

.gallery-divider {
    height: 1px;
    background: linear-gradient(90deg,
        transparent,
        rgba(0,0,0,0.1) 20%,
        rgba(0,0,0,0.1) 80%,
        transparent
    );
    margin: 0 48px 36px;
}

.gallery-container {
    padding-left: 48px;
    padding-right: 48px;
}

.gallery-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 3px;
    border-radius: 20px;
    overflow: hidden;
}

.gallery-card {
    position: relative;
    overflow: hidden;
    cursor: pointer;
    background: #d4cfcb;
}

.gallery-img-wrap {
    overflow: hidden;
}

.gallery-img {
    width: 100%;
    height: 240px;
    object-fit: cover;
    display: block;
    transition:
        transform 0.7s cubic-bezier(.22,.68,0,1.1),
        filter 0.5s ease;
    filter: brightness(0.98) saturate(1.02);
}

.gallery-card:hover .gallery-img {
    transform: scale(1.09);
    filter: brightness(1.02) saturate(1.05);
}

.gallery-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        155deg,
        transparent 25%,
        rgba(0,0,0,0.45) 100%
    );
    pointer-events: none;
}

.gallery-overlay-top {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        180deg,
        rgba(0,0,0,0.15) 0%,
        transparent 45%
    );
    opacity: 0;
    transition: opacity 0.4s ease;
    pointer-events: none;
}

.gallery-card:hover .gallery-overlay-top {
    opacity: 1;
}

.album-badge {
    position: absolute;
    top: 14px;
    left: 16px;
    background: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(4px);
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 6px;
    z-index: 10;
}

.gallery-num {
    position: absolute;
    top: 14px;
    left: 16px;
    font-size: 11px;
    font-weight: 500;
    color: rgba(255,255,255,0.5);
    letter-spacing: 0.1em;
    transition: color 0.3s ease;
    pointer-events: none;
}

.gallery-card:hover .gallery-num {
    color: rgba(255,255,255,0.85);
}

.gallery-info {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 20px 18px 17px;
    pointer-events: none;
}

.gallery-caption {
    font-size: 13px;
    font-weight: 500;
    color: #fff;
    margin: 0;
    letter-spacing: 0.025em;
    text-shadow: 0 2px 14px rgba(0,0,0,0.5);
    line-height: 1.35;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 100%;
    transition: transform 0.35s ease;
}

.gallery-card:hover .gallery-caption {
    transform: translateY(-2px);
}

@media (max-width: 992px) {
    .gallery-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    .gallery-hero {
        padding: 36px 24px 24px;
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }
    .gallery-divider {
        margin: 0 24px 28px;
    }
    .gallery-container {
        padding-left: 24px;
        padding-right: 24px;
    }
}

@media (max-width: 576px) {
    .gallery-grid {
        grid-template-columns: 1fr;
        border-radius: 14px;
    }
    .gallery-title {
        font-size: 30px;
    }
    .gallery-img {
        height: 200px;
    }
}
</style>

@endsection