@extends('layouts.app')

@section('content')

@include('partials.navbar')

<div class="gallery-page">

    <div class="gallery-hero" style="flex-direction: column; align-items: flex-start; gap: 15px;">
        <a href="{{ route('gallery') }}" style="text-decoration: none; color: #4b2e2e; font-size: 14px; font-weight: 500; display: inline-flex; align-items: center; gap: 5px;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            Kembali ke Album
        </a>
        <div style="display: flex; align-items: flex-end; justify-content: space-between; width: 100%;">
            <div class="gallery-hero-left">
                <span class="gallery-tag">Album Galeri</span>
                <h1 class="gallery-title">{{ $album->name }}</h1>
            </div>
            <div class="gallery-count">
                Menampilkan <strong>{{ $galleries->total() }}</strong> foto
            </div>
        </div>
    </div>

    <div class="gallery-divider"></div>

    <div class="container-fluid gallery-container">
        @if($galleries->isEmpty())
            <div style="text-align: center; padding: 50px 0; color: #888;">
                <h5>Belum ada foto di album ini.</h5>
            </div>
        @else
            <div class="gallery-grid">
                @foreach($galleries as $index => $item)
                <div class="gallery-card" onclick="openLightbox({{ $index }})">
                    <div class="gallery-img-wrap">
                        <img src="{{ asset('storage/'.$item->image) }}"
                             class="gallery-img"
                             alt="{{ $item->title }}">
                    </div>
                    <div class="gallery-overlay"></div>
                    <div class="gallery-overlay-top"></div>
                    <div class="gallery-info">
                        <h5 class="gallery-caption">{{ $item->title }}</h5>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- PAGINATION -->
            <div style="margin-top: 50px; display: flex; justify-content: center;">
                {{ $galleries->links('vendor.pagination.circle') }}
            </div>
        @endif
    </div>

</div>

@include('partials.footer')

<!-- LIGHTBOX MODAL -->
<div id="lightbox" class="lightbox-overlay" style="display:none;">
    <button class="lightbox-close" onclick="closeLightbox()">&times;</button>
    <button class="lightbox-prev" onclick="changeLightbox(-1)">&#10094;</button>
    <button class="lightbox-next" onclick="changeLightbox(1)">&#10095;</button>
    
    <div class="lightbox-content">
        <img id="lightbox-img" src="" alt="">
        <div id="lightbox-caption" class="lightbox-caption"></div>
    </div>
</div>

<script>
    var lightboxImages = [
        @foreach($galleries as $item)
        { src: "{{ asset('storage/'.$item->image) }}", title: "{{ $item->title }}" },
        @endforeach
    ];
    var currentIndex = 0;

    function openLightbox(index) {
        currentIndex = index;
        updateLightbox();
        document.getElementById('lightbox').style.display = 'flex';
        document.body.style.overflow = 'hidden'; // disable background scroll
    }

    function closeLightbox() {
        document.getElementById('lightbox').style.display = 'none';
        document.body.style.overflow = 'auto'; // re-enable background scroll
    }

    function changeLightbox(dir) {
        currentIndex += dir;
        if (currentIndex < 0) {
            currentIndex = lightboxImages.length - 1; // loop back
        } else if (currentIndex >= lightboxImages.length) {
            currentIndex = 0; // loop forward
        }
        updateLightbox();
    }

    function updateLightbox() {
        var img = document.getElementById('lightbox-img');
        var cap = document.getElementById('lightbox-caption');
        img.src = lightboxImages[currentIndex].src;
        cap.textContent = lightboxImages[currentIndex].title;
    }
</script>

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

.custom-pagination {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
    gap: 8px;
    align-items: center;
}

.custom-pagination .page-item .page-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    border-radius: 50%;
    border: 2px solid #ddd;
    background-color: transparent;
    color: #555;
    text-decoration: none;
    font-weight: 500;
    font-size: 16px;
    transition: all 0.2s ease;
}

.custom-pagination .page-item:not(.disabled) .page-link:hover {
    border-color: #4285F4;
    color: #4285F4;
}

.custom-pagination .page-item.active .page-link {
    background-color: #4285F4;
    border-color: #4285F4;
    color: white;
}

.custom-pagination .page-item.disabled .page-link {
    opacity: 0.5;
    cursor: not-allowed;
    border-color: #eee;
    color: #aaa;
}

/* ── LIGHTBOX STYLES ── */
.lightbox-overlay {
    position: fixed;
    top: 0; left: 0; width: 100%; height: 100%;
    background: rgba(0,0,0,0.92);
    z-index: 9999;
    justify-content: center;
    align-items: center;
}
.lightbox-content {
    position: relative;
    max-width: 85%;
    max-height: 85vh;
    text-align: center;
}
#lightbox-img {
    max-width: 100%;
    max-height: 85vh;
    object-fit: contain;
    border-radius: 8px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.5);
    transition: transform 0.3s ease;
}
.lightbox-caption {
    color: #fff;
    margin-top: 15px;
    font-size: 16px;
    font-weight: 500;
    letter-spacing: 0.03em;
}
.lightbox-close {
    position: absolute;
    top: 20px;
    right: 30px;
    color: #fff;
    font-size: 40px;
    background: transparent;
    border: none;
    cursor: pointer;
    transition: color 0.2s;
    z-index: 10000;
}
.lightbox-prev, .lightbox-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    color: rgba(255,255,255,0.7);
    font-size: 48px;
    background: transparent;
    border: none;
    cursor: pointer;
    padding: 20px;
    transition: color 0.2s;
    z-index: 10000;
}
.lightbox-prev { left: 20px; }
.lightbox-next { right: 20px; }
.lightbox-prev:hover, .lightbox-next:hover, .lightbox-close:hover {
    color: #fff;
}
@media (max-width: 768px) {
    .lightbox-prev { left: 0px; font-size: 36px; }
    .lightbox-next { right: 0px; font-size: 36px; }
    .lightbox-content { max-width: 95%; }
}
</style>

@endsection
