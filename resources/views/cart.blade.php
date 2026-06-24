@extends('layouts.app')

@section('content')

<style>
* { box-sizing: border-box; }

body {
    background: #f0ebe8;
}

.cart-container {
    max-width: 680px;
    margin: auto;
    margin-top: 100px;
    padding: 0 16px 60px;
}

.page-title {
    text-align: center;
    font-size: 20px;
    font-weight: 600;
    color: #3d1f1a;
    margin-bottom: 20px;
}

/* ── CART CARD ── */
.cart-card {
    background: #fff;
    border-radius: 16px;
    padding: 16px 18px;
    margin-bottom: 12px;
    border: 0.5px solid rgba(91,58,52,0.12);
}

.card-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 12px;
}

.item-icon {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    background: #f5ede9;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    flex-shrink: 0;
}

.item-info {
    flex: 1;
}

.item-name {
    font-size: 15px;
    font-weight: 600;
    color: #2c1410;
    margin-bottom: 3px;
}

.item-price {
    font-size: 13px;
    color: #5b3a34;
    font-weight: 500;
}

/* ── QTY CONTROL ── */
.qty-control {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #f5ede9;
    border-radius: 24px;
    padding: 6px 10px;
}

.qty-form {
    display: flex;
    align-items: center;
    gap: 8px;
}

.qty-btn {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    border: none;
    background: #fff;
    color: #5b3a34;
    font-size: 18px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 1px 3px rgba(91,58,52,0.15);
    line-height: 1;
    padding: 0;
}

.qty-num {
    font-size: 14px;
    font-weight: 600;
    color: #2c1410;
    min-width: 22px;
    text-align: center;
    border: none;
    background: transparent;
    outline: none;
}

/* ── CARD BOTTOM ── */
.card-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 12px;
    padding-top: 12px;
    border-top: 0.5px solid rgba(91,58,52,0.1);
}

.item-subtotal {
    font-size: 13px;
    color: #7a5248;
}

.btn-hapus {
    font-size: 12px;
    color: #a84040;
    background: #fdf0f0;
    border: none;
    padding: 5px 14px;
    border-radius: 20px;
    cursor: pointer;
    font-weight: 500;
}

.btn-hapus:hover {
    background: #f7dada;
}

/* ── SUMMARY CARD ── */
.summary-card {
    background: #fff;
    border-radius: 16px;
    padding: 20px 18px;
    border: 0.5px solid rgba(91,58,52,0.12);
    margin-top: 8px;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    font-size: 14px;
    color: #7a5248;
    margin-bottom: 6px;
}

.summary-total {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 12px;
    padding-top: 14px;
    border-top: 1.5px dashed rgba(91,58,52,0.18);
}

.total-label {
    font-size: 15px;
    font-weight: 600;
    color: #3d1f1a;
}

.total-amount {
    font-size: 22px;
    font-weight: 700;
    color: #5b3a34;
}

/* ── NOTE ── */
.note-section {
    margin-top: 16px;
}

.note-label {
    font-size: 13px;
    font-weight: 600;
    color: #7a5248;
    margin-bottom: 6px;
    display: block;
}

.note-input {
    width: 100%;
    border: 1px solid rgba(91,58,52,0.2);
    border-radius: 12px;
    padding: 10px 13px;
    resize: none;
    font-size: 13px;
    color: #2c1410;
    background: #fdf9f8;
    outline: none;
    font-family: inherit;
}

.note-input:focus {
    border-color: #5b3a34;
    background: #fff;
}

/* ── BUTTON ORDER ── */
.btn-order {
    width: 100%;
    margin-top: 16px;
    padding: 14px;
    background: #5b3a34;
    color: #fff;
    border: none;
    border-radius: 30px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    letter-spacing: 0.02em;
    transition: background 0.2s;
}

.btn-order:hover {
    background: #4a2e29;
}

.btn-order svg {
    flex-shrink: 0;
}
</style>

@include('partials.navbar')

<div class="cart-container">

    <p class="page-title">Keranjang Kamu 🛒</p>

    @if(session('error'))
        <div style="background: #fdf0f0; border: 1px solid #f7dada; color: #a84040; padding: 12px 16px; border-radius: 12px; margin-bottom: 20px; font-size: 14px; font-weight: 500;">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div style="background: #edf7ef; border: 1px solid #b4d9bc; color: #2a6b38; padding: 12px 16px; border-radius: 12px; margin-bottom: 20px; font-size: 14px; font-weight: 500;">
            {{ session('success') }}
        </div>
    @endif

    @php $total = 0; @endphp

    @foreach($cart->items as $item)

    @php
        $price = $item->menu->price;
        if($item->menu->category == 'coffee') {
            if($item->type == 'hot' && $item->menu->price_hot) $price = $item->menu->price_hot;
            if($item->type == 'cold' && $item->menu->price_cold) $price = $item->menu->price_cold;
        }
        $subtotal = $price * $item->qty;
        $total += $subtotal;
    @endphp

    <div class="cart-card">
        <div class="card-top">

            <div class="item-icon">🍽️</div>

            <div class="item-info">
                <div class="item-name">
                    {{ $item->menu->name }}
                    @if($item->type)
                        <span style="font-size:12px; color:#a8862f;">({{ ucfirst($item->type) }})</span>
                    @endif
                </div>
                <div class="item-price">Rp {{ number_format($price, 0, ',', '.') }}</div>
            </div>

            <!-- UPDATE QTY -->
            <form action="{{ route('cart.update') }}" method="POST" class="qty-form">
                @csrf
                <input type="hidden" name="id" value="{{ $item->id }}">
                <div class="qty-control">
                    <button type="button" class="qty-btn" onclick="decreaseQty(this)">−</button>
                    <input type="number" name="qty" value="{{ $item->qty }}" class="qty-num" min="1" id="qty-{{ $item->id }}" onchange="this.form.submit()">
                    <button type="button" class="qty-btn" onclick="increaseQty(this)">+</button>
                </div>
            </form>

        </div>

        <div class="card-bottom">
            <span class="item-subtotal">Subtotal: Rp {{ number_format($subtotal, 0, ',', '.') }}</span>

            <!-- HAPUS -->
            <form action="{{ route('cart.remove') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $item->id }}">
                <button class="btn-hapus">Hapus</button>
            </form>
        </div>
    </div>

    @endforeach

    <!-- SUMMARY -->
    <div class="summary-card">

        <div class="summary-row">
            <span>{{ $cart->items->count() }} item</span>
            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
        </div>

        <div class="summary-total">
            <span class="total-label">Total</span>
            <span class="total-amount">Rp {{ number_format($total, 0, ',', '.') }}</span>
        </div>

        <div class="note-section">
            <label class="note-label">Catatan pesanan</label>
            <textarea
                id="note"
                class="note-input"
                rows="3"
                placeholder="Contoh: tanpa sambal, extra pedas, dll..."
            ></textarea>
        </div>

        <form action="{{ route('cart.checkout') }}" method="POST" id="formPesan" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="note" id="hiddenNote">

            <div class="note-section">
                <label class="note-label" style="text-align: center; margin-top: 10px;">QRIS Pembayaran</label>
                @php
                    $qrCode = \App\Models\Setting::where('key', 'qr_code_payment')->first();
                @endphp
                @if($qrCode && $qrCode->value)
                    <div style="text-align: center; margin-bottom: 15px;">
                        <img src="{{ asset('storage/' . $qrCode->value) }}" alt="QRIS" style="max-width: 220px; border-radius: 12px; border: 1px solid rgba(91,58,52,0.2);">
                    </div>
                @else
                    <div style="text-align: center; margin-bottom: 15px; color: #a84040; font-size: 13px;">QRIS Belum Tersedia.</div>
                @endif
                
                <label class="note-label">Upload Bukti Transfer (Wajib)</label>
                <input type="file" name="payment_proof" class="note-input" accept="image/png, image/jpeg, image/jpg" required style="padding: 8px; background: #fff;">
                @error('payment_proof')
                    <div style="color:red; font-size:12px; margin-top:5px;">{{ $message }}</div>
                @enderror
            </div>

            <button type="button" onclick="kirimPesanan()" class="btn-order">
                Pesan Sekarang
            </button>
        </form>

    </div>

</div>

@include('partials.footer')

<script>
function increaseQty(btn) {
    const input = btn.parentElement.querySelector('.qty-num');
    input.value = parseInt(input.value) + 1;
    input.form.submit();
}

function decreaseQty(btn) {
    const input = btn.parentElement.querySelector('.qty-num');
    const val = parseInt(input.value);
    if (val > 1) {
        input.value = val - 1;
        input.form.submit();
    }
}

function kirimPesanan() {
    let itemCount = {{ $cart->items->count() }};
    if (itemCount === 0) {
        // Biarkan controller yang menangani pesan error-nya
        document.getElementById("formPesan").submit();
        return;
    }
    let form = document.getElementById("formPesan");
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    let note = document.getElementById("note").value;
    document.getElementById("hiddenNote").value = note;

    form.submit();
}
</script>

@endsection