@extends('layouts.app')

@section('content')

@include('partials.navbar')

<div class="history-page">

    <div class="history-hero">
        <div class="history-hero-left">
            <span class="history-tag">Riwayat Transaksi</span>
            <h1 class="history-title">History <span>Pembelian</span></h1>
        </div>
        <div class="history-count">
            Menampilkan <strong>{{ $orders->count() }}</strong> pesanan
        </div>
    </div>

    <div class="history-divider"></div>

    <div class="orders-list">
        @forelse ($orders as $index => $order)
        <div class="order-card">
            <div class="order-card-inner">

                {{-- Nomor urut --}}
                <div class="order-num">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>

                {{-- Body --}}
                <div class="order-body">
                    <div class="order-top">
                        <span class="order-id">Order #{{ $order->id }}</span>
                        <span class="order-date">{{ $order->created_at->format('d M Y · H:i') }}</span>
                    </div>
                    <div class="order-details">
                        <span><strong>Menu:</strong> {{ $order->menu }}</span>
                    </div>
                    @if($order->note)
                    <div class="order-note">{{ $order->note }}</div>
                    @endif
                </div>

                {{-- Status & Total --}}
                <div class="order-status-wrap">
                    <span class="order-badge
                        @if($order->status == 'Pending') badge-pending
                        @elseif($order->status == 'Proses') badge-proses
                        @elseif($order->status == 'Selesai') badge-selesai
                        @else badge-other
                        @endif">
                        <svg width="7" height="7" viewBox="0 0 7 7" fill="currentColor"><circle cx="3.5" cy="3.5" r="3.5"/></svg>
                        {{ $order->status }}
                    </span>
                    <span class="order-total">Rp{{ number_format($order->total) }}</span>
                </div>

            </div>

            {{-- Arrow --}}
            <div class="order-arrow">
                <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 12 12" fill="none" stroke="rgba(0,0,0,0.5)" stroke-width="1.8">
                    <path d="M2 10L10 2M10 2H4M10 2V8"/>
                </svg>
            </div>
        </div>
        @empty
        <div class="order-empty">
            <div class="order-empty-icon">🧾</div>
            Belum ada pesanan.
        </div>
        @endforelse
    </div>

</div>

@include('partials.footer')

<style>
html, body {
    background-color: #e9e5e3 !important;
}

.history-page {
    background: #e9e5e3;
    min-height: 100vh;
    padding: 80px 48px 60px;
}

/* ── Hero ── */
.history-hero {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    padding-bottom: 32px;
}

.history-tag {
    display: block;
    font-size: 11px;
    letter-spacing: .22em;
    text-transform: uppercase;
    color: rgba(0,0,0,.4);
    margin-bottom: 10px;
    font-weight: 400;
}

.history-title {
    font-family: 'Georgia', 'Times New Roman', serif;
    font-size: 42px;
    font-weight: 600;
    color: #1a1a1a;
    line-height: 1.1;
    letter-spacing: -.01em;
    margin: 0;
}

.history-title span {
    color: transparent;
    -webkit-text-stroke: 1px rgba(0,0,0,.2);
}

.history-count {
    font-size: 13px;
    color: rgba(0,0,0,.45);
    letter-spacing: .04em;
    padding-bottom: 6px;
}

.history-count strong {
    color: rgba(0,0,0,.75);
    font-weight: 500;
}

/* ── Divider ── */
.history-divider {
    height: 1px;
    background: linear-gradient(90deg,
        transparent,
        rgba(0,0,0,.1) 20%,
        rgba(0,0,0,.1) 80%,
        transparent
    );
    margin-bottom: 36px;
}

/* ── List & Card ── */
.orders-list {
    display: flex;
    flex-direction: column;
    gap: 3px;
    border-radius: 20px;
    overflow: hidden;
}

.order-card {
    background: #d9d4cf;
    position: relative;
    overflow: hidden;
    cursor: pointer;
    transition: background .3s ease;
}

.order-card:hover { background: #cfc9c3; }

.order-card-inner {
    display: grid;
    grid-template-columns: 56px 1fr auto;
    align-items: center;
}

/* Nomor */
.order-num {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    padding: 28px 0;
    font-size: 11px;
    font-weight: 500;
    color: rgba(0,0,0,.25);
    letter-spacing: .1em;
    border-right: 1px solid rgba(0,0,0,.08);
    transition: color .3s;
}

.order-card:hover .order-num { color: rgba(0,0,0,.5); }

/* Body */
.order-body {
    padding: 22px 28px;
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.order-top {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
}

.order-id {
    font-family: 'Georgia', serif;
    font-size: 15px;
    font-weight: 600;
    color: #1a1a1a;
}

.order-date {
    font-size: 11px;
    color: rgba(0,0,0,.38);
    letter-spacing: .04em;
}

.order-details {
    font-size: 12.5px;
    color: rgba(0,0,0,.55);
}

.order-details strong { color: rgba(0,0,0,.75); font-weight: 500; }

.order-note {
    font-size: 11.5px;
    color: rgba(0,0,0,.4);
    font-style: italic;
    padding-left: 10px;
    border-left: 2px solid rgba(0,0,0,.12);
}

/* Status & Total */
.order-status-wrap {
    padding: 22px 28px;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    justify-content: space-between;
    gap: 16px;
    border-left: 1px solid rgba(0,0,0,.08);
    height: 100%;
}

.order-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 10.5px;
    font-weight: 500;
    letter-spacing: .1em;
    text-transform: uppercase;
    padding: 5px 12px;
    border-radius: 100px;
}

.badge-pending  { background: rgba(180,140,60,.13); color: #8a6a1a; }
.badge-proses   { background: rgba(60,100,180,.12); color: #1a3a8a; }
.badge-selesai  { background: rgba(40,130,80,.12);  color: #1a5a30; }
.badge-other    { background: rgba(0,0,0,.08);       color: rgba(0,0,0,.5); }

.order-total {
    font-family: 'Georgia', serif;
    font-size: 18px;
    font-weight: 600;
    color: #1a1a1a;
    letter-spacing: -.02em;
}

/* Arrow */
.order-arrow {
    position: absolute;
    bottom: 18px; right: 18px;
    width: 28px; height: 28px;
    border-radius: 50%;
    border: 1px solid rgba(0,0,0,.18);
    display: flex; align-items: center; justify-content: center;
    opacity: 0;
    transform: scale(.65) translateY(8px);
    transition: opacity .3s ease, transform .35s cubic-bezier(.22,.68,0,1.3);
}

.order-card:hover .order-arrow {
    opacity: 1;
    transform: scale(1) translateY(0);
}

/* Empty */
.order-empty {
    text-align: center;
    padding: 80px 40px;
    color: rgba(0,0,0,.3);
    font-size: 14px;
    letter-spacing: .05em;
    background: #d9d4cf;
}

/* ── Responsive ── */
@media (max-width: 768px) {
    .history-page { padding: 70px 20px 40px; }
    .history-hero { flex-direction: column; align-items: flex-start; gap: 12px; }
    .history-title { font-size: 30px; }
    .order-card-inner { grid-template-columns: 40px 1fr; }
    .order-status-wrap { display: none; }
    .order-badge { position: absolute; top: 16px; right: 16px; }
}
</style>

@endsection