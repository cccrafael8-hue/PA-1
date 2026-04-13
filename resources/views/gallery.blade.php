@extends('layouts.app')

@section('content')

@include('partials.navbar')
<div class="container mt-4">
    <h4>Galeri Foto</h4>

    <div class="row mt-3">
        @foreach($galleries as $item)
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow gallery-card">
                <img src="{{ asset('storage/'.$item->image) }}" class="card-img">

                <div class="overlay"></div>

                <div class="card-img-overlay d-flex align-items-end">
                    <h5 class="text-white">{{ $item->title }}</h5>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@include('partials.footer')
<style>
.gallery-card {
    border-radius: 15px;
    overflow: hidden;
    position: relative;
}

.gallery-card img {
    height: 200px;
    object-fit: cover;
}

.overlay {
    position: absolute;
    width: 100%;
    height: 100%;
    background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
}
</style>

@endsection