@extends('layouts.app')

@section('content')

<style>
body {
    background: #f3eeea;
    font-family: 'Poppins', sans-serif;
    color: #3e2c27;
}

.contact-container {
    max-width: 1100px;
    margin: 120px auto;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
}

.contact-info {
    padding: 20px;
}

.contact-info h2 {
    font-weight: 600;
    margin-bottom: 20px;
}

.contact-card {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
}

.contact-form {
    background: white;
    padding: 30px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

.contact-form input,
.contact-form textarea {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border-radius: 10px;
    border: 1px solid #ddd;
    outline: none;
}

.contact-form input:focus,
.contact-form textarea:focus {
    border-color: #6b4f4f;
}

.btn-submit {
    width: 100%;
    background: #5a3e36;
    color: white;
    padding: 12px;
    border: none;
    border-radius: 30px;
    font-weight: 500;
    transition: 0.3s;
}

.btn-submit:hover {
    background: #3e2c27;
}

@media(max-width: 768px){
    .contact-container {
        grid-template-columns: 1fr;
    }
}
</style>

@include('partials.navbar')

<div class="contact-container">

    <!-- KIRI -->
    <div class="contact-info">
        <h2>Hubungi Kami</h2>

        <div class="contact-card">
            <p><strong>Alamat</strong></p>
            <p>Jl. Siliwangi, Kec. Balige, Toba, Sumatera Utara</p>

            <p><strong>Instagram</strong></p>
            <p>@agathaspace.balige</p>
        </div>
    </div>

    <!-- KANAN -->
    <div class="contact-form">
        <form action="{{ route('contact.store') }}" method="POST">
            @csrf

            <input type="text" name="name" placeholder="Nama" required>
            
            <textarea name="message" rows="5" placeholder="Pesan..." required></textarea>

            <button type="submit" class="btn-submit">
                Kirim Pesan
            </button>
        </form>
    </div>

</div>
@include('partials.footer')

@endsection