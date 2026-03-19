@extends('layouts.app')

@section('content')

<style>
body {
    background-color: #f8f5f2;
    font-family: 'Poppins', sans-serif;
    color: #3e2c27;
}

.container {
    max-width: 600px;
    margin: 100px auto;
}

.card {
    background: #ffffff;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    border: none;
}

.form-control {
    width: 100%;
    padding: 12px;
    border-radius: 10px;
    border: 1px solid #ddd;
    margin-bottom: 15px;
}

.form-control:focus {
    outline: none;
    border-color: #4b2e2e;
    box-shadow: 0 0 0 2px rgba(75,46,46,0.1);
}

.btn-dark {
    background-color: #4b2e2e;
    color: white;
    border: none;
    padding: 12px;
    border-radius: 30px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
}

.btn-dark:hover {
    background-color: #2e1b1b;
}

h2 {
    text-align: center;
    margin-bottom: 25px;
}
</style>

<div class="container">

    <h2>Reservasi Meja</h2>

    @if(session('success'))
        <div style="background:#d4edda;padding:10px;border-radius:8px;margin-bottom:15px;">
            {{ session('success') }}
        </div>
    @endif

    @include('partials.navbar')

    <form action="{{ route('reservasi.store') }}" method="POST" class="card" id="formReservasi">
        @csrf

        <input type="text" name="nama" id="nama" placeholder="Nama" class="form-control" required>

        <input type="date" name="tanggal" id="tanggal" class="form-control" required>

        <input type="time" name="waktu" id="waktu" class="form-control" required>

        <input type="number" name="jumlah_orang" id="jumlah_orang" placeholder="Jumlah Orang" class="form-control" required>

        <button class="btn-dark" type="button" onclick="kirimReservasi()">Reservasi Sekarang</button>
    </form>

    <hr style="margin:50px 0;">

</div>

@include('partials.footer')

<script>
function kirimReservasi() {

    let nama = document.getElementById("nama").value;
    let tanggal = document.getElementById("tanggal").value;
    let waktu = document.getElementById("waktu").value;
    let orang = document.getElementById("jumlah_orang").value;

    let pesan = `Halo Kakk,

Saya ingin melakukan reservasi meja.

Nama : ${nama}
Tanggal : ${tanggal}
Jam : ${waktu}
Jumlah Orang : ${orang}

Saya juga akan melakukan pembayaran melalui QRIS.

Terima kasih Kakk.`;

    let nomorAdmin = "62895346041061";

    let url = "https://wa.me/" + nomorAdmin + "?text=" + encodeURIComponent(pesan);

    window.open(url, '_blank');

    document.getElementById("formReservasi").submit();
}
</script>

@endsection