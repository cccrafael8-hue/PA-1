@extends('layouts.app')

@section('content')

<style>

body{
    background-color:#f8f5f2;
    font-family:'Poppins',sans-serif;
    color:#3e2c27;
}

.container{
    max-width:900px;
    margin:100px auto;
}

.card{
    background:#ffffff;
    border-radius:15px;
    padding:30px;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
}

h2{
    text-align:center;
    margin-bottom:25px;
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#4b2e2e;
    color:white;
    padding:12px;
}

td{
    padding:12px;
    border-bottom:1px solid #eee;
    text-align:center;
}

tr:hover{
    background:#f3f3f3;
}

.status{
    padding:6px 12px;
    border-radius:20px;
    font-size:13px;
}

.pending{
    background:#ffeeba;
}

.success{
    background:#c3e6cb;
}

.btn-delete{
    background:#e74c3c;
    color:white;
    border:none;
    padding:6px 12px;
    border-radius:8px;
    cursor:pointer;
    font-size:13px;
}

.btn-delete:hover{
    background:#c0392b;
}

</style>
@include('admin.navbar_admin')

<div class="container">
    <div class="card">
        <h2>Daftar Pesanan Pelanggan</h2>

        <table>

        <thead>
            <tr>
                <th>Nama</th>
                <th>Menu</th>
                <th>Total</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
    @foreach($orders as $order)
    <tr>
        <td>{{ $order->nama }}</td>
        <td>{{ $order->menu}}</td>
        <td>Rp {{ number_format($order->total) }}</td>

        <td>
            @if($order->status == 'menunggu')
                <span class="status pending">Menunggu</span>
            @else
                <span class="status success">Dibayar</span>
            @endif
        </td>

        <td>{{ $order->created_at->format('d M Y') }}</td>

        <td>
            <form action="{{ route('admin.order.delete', $order->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus pesanan ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete">Hapus</button>
            </form>
        </td>

    </tr>
    @endforeach
</tbody>
        </table>
    </div>
</div>
@endsection
