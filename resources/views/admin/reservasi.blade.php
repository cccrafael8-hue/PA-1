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
</style>

@include('admin.navbar_admin')

<div class="container">

<h2>Data Reservasi</h2>

<div class="summary-box">
    <h4>Total Pendapatan</h4>
    <strong style="font-size:20px;">
        Rp {{ number_format($reservasis->where('status','paid')->sum('total_bayar')) }}
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
    @foreach($reservasis as $r)
    <tr>
        <td>{{ $r->nama }}</td>
        <td>{{ $r->tanggal }}</td>
        <td>{{ $r->jumlah_orang }}</td>
        <td>Rp {{ number_format($r->total_bayar) }}</td>
        <td>
            @if($r->status == 'pending')
                <span class="status-pending">Menunggu</span>
            @else
                <span class="status-paid">Dibayar</span>
            @endif
        </td>
        <td>
            @if($r->status == 'pending')
            <a href="/admin/reservasi/{{ $r->id }}/paid" class="btn-paid">
                Tandai Dibayar
            </a>
            @endif

            <form action="/admin/reservasi/{{ $r->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn-delete">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>

</table>
</div>

</div>

@endsection