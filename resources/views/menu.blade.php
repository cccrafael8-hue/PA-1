@extends('layouts.app')

@section('content')

<style>

body{
    background:#e9e5e3;
}

.menu-container{
    max-width:1100px;
    margin:auto;
    margin-top:120px;
}

.menu-card{
    background:white;
    border-radius:15px;
    overflow:hidden;
    box-shadow:0 2px 10px rgba(0,0,0,0.08);
    transition:0.2s;
}

.menu-card:hover{
    transform:translateY(-5px);
}

.menu-img{
    width:100%;
    height:170px;
    object-fit:cover;
}

.menu-body{
    padding:15px;
}

.menu-title{
    font-weight:600;
    font-size:16px;
}

.menu-desc{
    font-size:13px;
    color:#777;
}

.menu-price{
    font-weight:600;
    color:#5b3a34;
}

/* tombol */
.btn-cart{
    background:#5b3a34;
    color:white;
    border-radius:25px;
    padding:7px 14px;
    font-size:13px;
    transition:0.2s;
    width:100%;
}

.btn-cart:hover{
    background:#472c27;
}

/* tombol lihat cart */
.btn-lihat{
    background:#f3e9e6;
    color:#5b3a34;
    border-radius:25px;
    padding:8px 18px;
    text-decoration:none;
    font-size:14px;
}

.btn-lihat:hover{
    background:#e0d3cf;
}

/* notifikasi */
.alert-custom{
    background:#d4edda;
    color:#155724;
    padding:10px;
    border-radius:10px;
    text-align:center;
    margin-bottom:20px;
}

</style>

@include('partials.navbar')

<div class="container menu-container">

    <!-- NOTIFIKASI -->
    @if(session('success'))
        <div class="alert-custom">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Menu Makanan</h2>

        <!-- TOMBOL KE KERANJANG -->
        <a href="{{ route('cart') }}" class="btn-lihat">
            🛒 Lihat Keranjang
        </a>

    </div>

    <div class="row">

        @foreach($menus as $menu)

        <div class="col-md-3 mb-4">

            <div class="menu-card">

                <img src="{{ asset('storage/'.$menu->gambar) }}" class="menu-img">

                <div class="menu-body">

                    <div class="menu-title">
                        {{ $menu->nama_menu }}
                    </div>

                    <div class="menu-desc">
                        {{ $menu->deskripsi }}
                    </div>

                    <div class="menu-price mt-2">
                        Rp {{ number_format($menu->harga) }}
                    </div>

                    <!-- TOMBOL KERANJANG -->
                    <form action="{{ route('cart.add') }}" method="POST" class="mt-3">
                        @csrf
                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">

                        <button type="submit" class="btn-cart border-0">
                            🛒 Tambah ke Keranjang
                        </button>
                    </form>

                </div>

            </div>

        </div>

        @endforeach

    </div>

</div>

@include('partials.footer')

@endsection