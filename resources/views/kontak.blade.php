@extends('layouts.app')

@section('content')

@include('partials.navbar')

<div class="contact-page">

    <div class="contact-hero">
        <span class="contact-tag">Sampaikan Pesan Anda</span>
        <h1 class="contact-title">Hubungi <span>Kami</span></h1>
    </div>

    <div class="contact-divider"></div>

    <div class="contact-grid">

        {{-- Kiri: Info --}}
        <div class="contact-info">
            <div class="info-num">01</div>

            <div class="info-block">
                <div class="info-label">Alamat</div>
                <div class="info-value">
                    Jl. Siliwangi, Kec. Balige<br>
                    Toba, Sumatera Utara
                </div>
            </div>

            <div class="info-divider"></div>

            <div class="info-block">
                <div class="info-label">Instagram</div>
                <div class="info-value">@agathaspace.balige</div>
            </div>

            <div class="info-social">
                <div class="info-social-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="rgba(0,0,0,0.5)" stroke-width="1.6">
                        <rect x="2" y="2" width="20" height="20" rx="5"/>
                        <circle cx="12" cy="12" r="4"/>
                        <circle cx="17.5" cy="6.5" r="1" fill="rgba(0,0,0,0.5)" stroke="none"/>
                    </svg>
                </div>
                <span class="info-social-text">@agathaspace.balige</span>
            </div>
        </div>

        {{-- Kanan: Form --}}
        <div class="contact-form-panel">
            <div>
                <div class="form-num">02</div>
                <div class="form-heading">Kirim Pesan</div>
            </div>

            <form action="{{ route('contact.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="name" placeholder="Nama lengkap Anda" required>
                </div>

                <div class="form-group">
                    <label>Pesan</label>
                    <textarea name="message" placeholder="Tulis pesan Anda di sini..." required></textarea>
                </div>

                <button type="submit" class="btn-submit">
                    Kirim Pesan
                    <svg viewBox="0 0 12 12" fill="none" stroke="#f5d28c" stroke-width="1.8" width="12" height="12">
                        <path d="M2 10L10 2M10 2H4M10 2V8"/>
                    </svg>
                </button>
            </form>
        </div>

    </div>
</div>

@include('partials.footer')

<style>
html, body {
    background: #e9e5e3 !important;
    font-family: 'DM Sans', sans-serif;
    color: #1a1a1a;
}

.contact-page {
    background: #e9e5e3;
    min-height: 100vh;
    padding: 80px 48px 60px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

/* ── Hero ── */
.contact-hero {
    width: 100%;
    max-width: 900px;
    padding-bottom: 32px;
}

.contact-tag {
    display: block;
    font-size: 11px;
    letter-spacing: .22em;
    text-transform: uppercase;
    color: rgba(0,0,0,.4);
    margin-bottom: 10px;
    font-weight: 400;
}

.contact-title {
    font-family: 'Georgia', 'Times New Roman', serif;
    font-size: 42px;
    font-weight: 600;
    color: #1a1a1a;
    line-height: 1.1;
    letter-spacing: -.01em;
    margin: 0;
}

.contact-title span {
    color: transparent;
    -webkit-text-stroke: 1px rgba(0,0,0,.2);
}

/* ── Divider ── */
.contact-divider {
    width: 100%;
    max-width: 900px;
    height: 1px;
    background: linear-gradient(90deg,
        transparent,
        rgba(0,0,0,.1) 20%,
        rgba(0,0,0,.1) 80%,
        transparent
    );
    margin-bottom: 36px;
}

/* ── Grid ── */
.contact-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3px;
    border-radius: 20px;
    overflow: hidden;
    width: 100%;
    max-width: 900px;
}

/* ── Info Panel ── */
.contact-info {
    background: #d9d4cf;
    padding: 40px 36px;
    display: flex;
    flex-direction: column;
    gap: 28px;
}

.info-num {
    font-size: 11px;
    font-weight: 500;
    color: rgba(0,0,0,.25);
    letter-spacing: .1em;
}

.info-label {
    font-size: 10px;
    letter-spacing: .2em;
    text-transform: uppercase;
    color: rgba(0,0,0,.35);
    margin-bottom: 8px;
}

.info-value {
    font-family: 'Georgia', serif;
    font-size: 15px;
    color: #1a1a1a;
    line-height: 1.6;
}

.info-divider {
    height: 1px;
    background: rgba(0,0,0,.1);
}

.info-social {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-top: auto;
    padding-top: 24px;
    border-top: 1px solid rgba(0,0,0,.1);
}

.info-social-icon {
    width: 32px; height: 32px;
    border-radius: 50%;
    border: 1px solid rgba(0,0,0,.18);
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}

.info-social-icon svg {
    width: 14px; height: 14px;
}

.info-social-text {
    font-size: 12.5px;
    color: rgba(0,0,0,.5);
    letter-spacing: .03em;
}

/* ── Form Panel ── */
.contact-form-panel {
    background: #cfc9c3;
    padding: 40px 36px;
    display: flex;
    flex-direction: column;
    gap: 18px;
}

.form-num {
    font-size: 11px;
    font-weight: 500;
    color: rgba(0,0,0,.25);
    letter-spacing: .1em;
    margin-bottom: 4px;
}

.form-heading {
    font-family: 'Georgia', serif;
    font-size: 18px;
    color: #1a1a1a;
    font-weight: 600;
    margin-bottom: 12px;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.form-group label {
    font-size: 10px;
    letter-spacing: .18em;
    text-transform: uppercase;
    color: rgba(0,0,0,.38);
}

.form-group input,
.form-group textarea {
    width: 100%;
    background: rgba(233,229,227,0.6);
    border: 1px solid rgba(0,0,0,.12);
    border-radius: 10px;
    padding: 12px 14px;
    font-family: 'DM Sans', sans-serif;
    font-size: 13px;
    color: #1a1a1a;
    outline: none;
    transition: border-color .25s, background .25s;
    resize: none;
}

.form-group input:focus,
.form-group textarea:focus {
    border-color: rgba(0,0,0,.35);
    background: rgba(233,229,227,0.9);
}

.form-group textarea { height: 120px; }

.btn-submit {
    align-self: flex-start;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: #3e2723;
    color: #f5d28c;
    border: none;
    padding: 13px 28px;
    font-family: 'DM Sans', sans-serif;
    font-size: 12px;
    font-weight: 500;
    letter-spacing: .12em;
    text-transform: uppercase;
    cursor: pointer;
    transition: background .3s;
    border-radius: 100px;
    margin-top: 4px;
}

.btn-submit:hover { background: #2c1b10; }

.btn-submit svg {
    transition: transform .3s;
}

.btn-submit:hover svg {
    transform: translate(2px, -2px);
}

/* ── Responsive ── */
@media (max-width: 768px) {
    .contact-page { padding: 70px 20px 40px; }
    .contact-grid { grid-template-columns: 1fr; }
    .contact-title { font-size: 30px; }
}
</style>

@endsection