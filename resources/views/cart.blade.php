@extends('layouts.app')

@section('content')

<style>

body{
    background:#e9e5e3;
}

.cart-container{
    max-width:900px;
    margin:auto;
    margin-top:120px;
}

/* card */
.cart-card{
    background:white;
    border-radius:15px;
    padding:20px;
    margin-bottom:15px;
    box-shadow:0 2px 10px rgba(0,0,0,0.08);
}

/* nama menu */
.cart-title{
    font-weight:600;
    font-size:16px;
}

/* harga */
.cart-price{
    color:#5b3a34;
    font-weight:600;
}

/* input qty */
.qty-input{
    width:60px;
    border-radius:8px;
    border:1px solid #ddd;
    padding:5px;
    text-align:center;
}

/* tombol */
.btn-update{
    background:#f3e9e6;
    border:none;
    padding:6px 12px;
    border-radius:20px;
    font-size:13px;
}

.btn-delete{
    background:#ffdddd;
    border:none;
    padding:6px 12px;
    border-radius:20px;
    font-size:13px;
}

.btn-wa{
    background:#25D366;
    color:white;
    border:none;
    padding:14px;
    border-radius:30px;
    width:100%;
    font-size:16px;
    margin-top:20px;
}

/* total */
.total-box{
    background:white;
    padding:20px;
    border-radius:15px;
    margin-top:20px;
    box-shadow:0 2px 10px rgba(0,0,0,0.08);
    text-align:center;
}

</style>

@include('partials.navbar')

<div class="cart-container">

    <h2 class="mb-4 text-center">Keranjang Kamu 🛒</h2>

    @php $total = 0; @endphp

    @foreach($cart->items as $item)

    <div class="cart-card">

        <div class="d-flex justify-content-between align-items-center">

            <div>
                <div class="cart-title">
                    {{ $item->menu->nama_menu }}
                </div>

                <div class="cart-price">
                    Rp {{ number_format($item->menu->harga) }}
                </div>
            </div>

            <!-- UPDATE QTY -->
            <form action="{{ route('cart.update') }}" method="POST" class="d-flex align-items-center gap-2">
                @csrf
                <input type="hidden" name="id" value="{{ $item->id }}">

                <input type="number" name="qty" value="{{ $item->qty }}" class="qty-input">

                <button class="btn-update">Update</button>
            </form>

        </div>

        <!-- HAPUS -->
        <form action="{{ route('cart.remove') }}" method="POST" class="mt-2">
            @csrf
            <input type="hidden" name="id" value="{{ $item->id }}">
            <button class="btn-delete">Hapus</button>
        </form>

    </div>

    @php $total += $item->menu->harga * $item->qty; @endphp

    @endforeach

    <!-- TOTAL -->
    <div class="total-box">
        <h4>Total</h4>
        <h3>Rp {{ number_format($total) }}</h3>

        <form action= "{{ route ('cart.checkout') }}" method="POST" id="formPesan">
            @csrf
            <button type="button" onclick="kirimPesanan()" class="btn-wa">
                Pesan
            </button>
        </form>
    </div>

</div>

@include('partials.footer')

<script>
function kirimPesanan() {

    let pesan = "Halo kak, saya mau pesan:\n\n";

    @foreach($cart->items as $item)
        pesan += "- {{ $item->menu->nama_menu }} x{{ $item->qty }}\n";
    @endforeach

    pesan += "\nTotal: Rp {{ number_format($total) }}";

    let nomor = "62895346041061";
    let url = "https://wa.me/" + nomor + "?text=" + encodeURIComponent(pesan);

    window.open(url, '_blank');

    document.getElementById("formPesan").submit();
}
</script>

@endsection