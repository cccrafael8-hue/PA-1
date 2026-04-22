@extends('layouts.app')

@section('content')

<style>
    .dashboard-container {
        min-height: 100vh;
        background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
                    url('https://images.unsplash.com/photo-1509042239860-f550ce710b93');
        background-size: cover;
        background-position: center;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .button-wrapper {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 25px;
        width: 70%;
        max-width: 800px;
    }

    .dashboard-btn {
        background: #3e2723;
        color: #f5d28c;
        padding: 40px 20px;
        text-align: center;
        font-size: 20px;
        font-weight: 600;
        border-radius: 15px;
        text-decoration: none;
        transition: 0.3s ease;
        box-shadow: 0 5px 15px rgba(0,0,0,0.4);
    }

    .dashboard-btn:hover {
        background: #d4a762;
        color: #2c1b10;
        transform: translateY(-5px);
    }

    @media (max-width: 768px) {
        .button-wrapper {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 500px) {
        .button-wrapper {
            grid-template-columns: 1fr;
        }
    }
</style>

@include('admin.navbar_admin')

<div class="dashboard-container">
    <div class="button-wrapper">
        <a href="{{ route('admin.menu') }}" class="dashboard-btn">Menu</a>
        <a href="#" class="dashboard-btn">Gallery</a>
        <a href="{{ route('admin.reservasi') }}" class="dashboard-btn">Reservasi</a>
        <a href="#" class="dashboard-btn">Kontak</a>
        <a href="#" class="dashboard-btn">Order</a>
        <a href="#" class="dashboard-btn">Kritik</a>
    </div>
</div>

@endsection