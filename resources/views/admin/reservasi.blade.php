@extends('layouts.app')

@section('content')

<style>
body {
    background-color: #f8f5f2;
    font-family: 'Poppins', sans-serif;
    color: #3e2c27;
}

.container {
    max-width: 1100px;
    margin: 80px auto;
}

.card {
    background: #ffffff;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    border: none;
}

h2 {
    text-align: center;
    margin-bottom: 30px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

thead {
    background-color: #4b2e2e;
    color: white;
}

th, td {
    padding: 14px;
    text-align: center;
}

th {
    font-weight: 600;
    font-size: 14px;
}

tbody tr {
    border-bottom: 1px solid #eee;
    transition: 0.2s;
}

tbody tr:hover {
    background-color: #f4ece8;
}

.status-pending {
    background: #fce8d5;
    color: #b7791f;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
}

.status-paid {
    background: #d4edda;
    color: #155724;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
}

.btn-paid {
    background-color: #4b2e2e;
    color: white;
    border: none;
    padding: 7px 15px;
    border-radius: 20px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    transition: 0.3s;
    font-size: 13px;
}

.btn-paid:hover {
    background-color: #2e1b1b;
}

.btn-delete {
    background-color: #b02a37;
    color: white;
    border: none;
    padding: 7px 15px;
    border-radius: 20px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
    font-size: 13px;
}

.btn-delete:hover {
    background-color: #7a1c24;
}

form {
    display: inline;
}

.summary-box {
    background: #fff;
    padding: 20px;
    border-radius: 15px;
    margin-bottom: 25px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.05);
    text-align: center;
}

.summary-box h4 {
    margin-bottom: 10px;
}

/* Dropdown menu */
.dropbtn {
    background-color: transparent;
    color: #4b2e2e;
    padding: 0;
    font-size: 20px;
    border: none;
    cursor: pointer;
    font-weight: bold;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: background 0.3s;
}

.dropbtn:hover {
    background-color: #f4ece8;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    right: 0;
    background-color: white;
    min-width: 140px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.1);
    z-index: 10;
    border-radius: 8px;
    overflow: hidden;
    border: 1px solid #eee;
}

.dropdown-content a, .dropdown-content form button {
    color: #3e2c27;
    padding: 10px 16px;
    text-decoration: none;
    display: block;
    width: 100%;
    text-align: left;
    background: none;
    border: none;
    font-size: 13px;
    font-family: 'Poppins', sans-serif;
    cursor: pointer;
}

.dropdown-content form {
    margin: 0;
    padding: 0;
    display: block;
}

.dropdown-content a:hover, .dropdown-content form button:hover {
    background-color: #f4ece8;
}

.show {display:block;}
</style>

@include('admin.navbar_admin')

<div class="container">

<h2>Data Reservasi</h2>

@if(session('success'))
    <div style="background: #edf7ef; border: 1px solid #b4d9bc; color: #2a6b38; padding: 11px 16px; border-radius: 10px; margin-bottom: 15px; font-size:13.5px; font-weight:500;">✓ {{ session('success') }}</div>
@endif
@if(session('error'))
    <div style="background: #fdecea; border: 1px solid #f0b4b4; color: #8b1a1a; padding: 11px 16px; border-radius: 10px; margin-bottom: 15px; font-size:13.5px; font-weight:500;">✗ {{ session('error') }}</div>
@endif

<div class="summary-box">
    <h4>Total Pendapatan</h4>
    <strong style="font-size:20px;">
        Rp {{ number_format($reservations->where('status','paid')->sum('total_price')) }}
    </strong>
</div>

<div class="card">
<table>
    <thead>
    <tr>
        <th>Nama</th>
        <th>Tanggal</th>
        <th>Orang</th>
        <th>Total</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    </thead>

    <tbody>
    @foreach($reservations as $r)
    <tr>
        <td>{{ $r->name }}</td>
        <td>{{ $r->date }}</td>
        <td>{{ $r->guest_count }}</td>
        <td>Rp {{ number_format($r->total_price) }}</td>
        <td>
            @if($r->status == 'pending')
                <span class="status-pending">Menunggu</span>
            @else
                <span class="status-paid">Dibayar</span>
            @endif
        </td>
        <td>
            <div class="dropdown">
                <button onclick="toggleDropdown({{ $r->id }})" class="dropbtn">⋮</button>
                <div id="dropdown-{{ $r->id }}" class="dropdown-content">
                    @if($r->status == 'pending')
                    <a href="/admin/reservation/{{ $r->id }}/paid">
                        Tandai Dibayar
                    </a>
                    @else
                    <form action="/admin/reservation/{{ $r->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="color:#b02a37;" onclick="return confirm('Hapus riwayat reservation ini?')">Hapus</button>
                    </form>
                    @endif
                </div>
            </div>
        </td>
    </tr>
    @endforeach
    </tbody>

</table>
</div>

</div>

<script>
function toggleDropdown(id) {
    document.getElementById("dropdown-" + id).classList.toggle("show");
}

window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}
</script>

@endsection