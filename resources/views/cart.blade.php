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

    @php $total = 0; @endphp

    @foreach($cart->items as $item)

    @php
        $subtotal = $item->menu->harga * $item->qty;
        $total += $subtotal;
    @endphp

    <div class="cart-card">
        <div class="card-top">

            <div class="item-icon">🍽️</div>

            <div class="item-info">
                <div class="item-name">{{ $item->menu->nama_menu }}</div>
                <div class="item-price">Rp {{ number_format($item->menu->harga, 0, ',', '.') }}</div>
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

        <form action="{{ route('cart.checkout') }}" method="POST" id="formPesan">
            @csrf
            <input type="hidden" name="note" id="hiddenNote">

            <button type="button" onclick="kirimPesanan()" class="btn-order">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.498 14.382c-.301-.15-1.767-.867-2.04-.966-.273-.101-.473-.15-.673.15-.197.295-.771.964-.944 1.162-.175.195-.349.21-.646.075-.3-.15-1.263-.465-2.403-1.485-.888-.795-1.484-1.77-1.66-2.07-.174-.3-.019-.465.13-.615.136-.135.3-.345.45-.523.146-.181.194-.301.297-.496.1-.21.049-.375-.025-.524-.075-.15-.672-1.62-.922-2.206-.24-.584-.487-.51-.672-.51-.172-.015-.371-.015-.571-.015-.2 0-.523.074-.797.359-.273.3-1.045 1.02-1.045 2.475s1.07 2.865 1.219 3.075c.149.195 2.105 3.195 5.1 4.485.714.3 1.27.48 1.704.629.714.227 1.365.195 1.88.121.574-.091 1.767-.721 2.016-1.426.255-.705.255-1.29.18-1.425-.074-.135-.27-.21-.57-.345z"/>
                    <path d="M20.52 3.449C12.831-3.984.106 1.407.101 11.893c0 2.096.549 4.14 1.595 5.945L0 24l6.335-1.652C8.079 23.354 9.99 23.805 11.889 23.805c9.88.016 16.68-10.54 11.836-18.228A11.908 11.908 0 0020.52 3.449zm-8.621 18.22a9.888 9.888 0 01-5.032-1.378l-.36-.214-3.742.975 1.005-3.645-.235-.375a9.869 9.869 0 01-1.516-5.29c.012-5.463 4.445-9.91 9.917-9.91a9.898 9.898 0 017.008 2.909 9.845 9.845 0 012.905 6.995c-.012 5.477-4.447 9.924-9.95 9.933z"/>
                </svg>
                Pesan via WhatsApp
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
    let pesan = "Halo kak, saya mau pesan ";

    @foreach($cart->items as $item)
        pesan += "- {{ $item->menu->nama_menu }} x{{ $item->qty }}\n";
    @endforeach

    pesan += "\nTotal: Rp {{ number_format($total, 0, ',', '.') }}";

    let note = document.getElementById("note").value;
    if (note) {
        pesan += "\n\nCatatan: " + note;
    }

    document.getElementById("hiddenNote").value = note;

    let nomor = "62895346041061";
    let url = "https://wa.me/" + nomor + "?text=" + encodeURIComponent(pesan);
    window.open(url, '_blank');

    document.getElementById("formPesan").submit();
}
</script>

@endsection