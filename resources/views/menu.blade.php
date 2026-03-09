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
}

.menu-desc{
    font-size:14px;
    color:#777;
}

.menu-price{
    font-weight:600;
    color:#5b3a34;
}

.btn-order{
    background:#5b3a34;
    color:white;
    border-radius:25px;
    padding:8px 16px;
    font-size:14px;
    text-decoration:none;
}

.btn-order:hover{
    background:#472c27;
}

</style>

@include('partials.navbar')

<div class="container menu-container">

    <h2 class="text-center mb-4">
        Menu Makanan
    </h2>

    <div class="row">

        @foreach($menus as $menu)

        <div class="col-md-3 mb-4">

            <div class="menu-card">

                <img src="{{ asset('storage/'.$menu->gambar) }}" 
                class="menu-img">

                <div class="menu-body">

                    <div class="menu-title">
                        {{ $menu->nama_menu }}
                    </div>

                    <div class="menu-desc">
                        {{ $menu->deskripsi }}
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-2">

                        <div class="menu-price">
                            Rp {{ number_format($menu->harga) }}
                        </div>

                        <a href="#" class="btn-order">
                            Pesan
                        </a>

                    </div>

                </div>

            </div>

        </div>

        @endforeach

    </div>

</div>

@include('partials.footer')

@endsection