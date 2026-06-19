@extends('layouts.app')

@section('content')

<style>

body{
    background-color:#f8f5f2;
    font-family:'Poppins',sans-serif;
    color:#3e2c27;
}

.container{
    max-width:1000px;
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

/* biar catatan gak kepanjangan */
.note-cell{
    max-width:200px;
    word-wrap:break-word;
    text-align:left;
}

.status-select {
    padding:6px 12px;
    border-radius:20px;
    font-size:13px;
    border: 1px solid #ccc;
    outline: none;
    cursor: pointer;
    font-weight: bold;
}

.pending {
    background-color:#ffeeba;
    color: #856404;
}

.proses {
    background-color:#b8daff;
    color: #004085;
}

.selesai {
    background-color:#c3e6cb;
    color: #155724;
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
                <th>Catatan</th> <!-- 🔥 TAMBAHAN -->
                <th>Status</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{ $order->name }}</td>
            <td>{{ $order->items }}</td>
            <td>Rp {{ number_format($order->total) }}</td>

            <!-- NOTE -->
            <td class="note-cell">
                {{ $order->note ?? '-' }}
            </td>

            <td>
                <form action="{{ route('admin.order.status', $order->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PUT')
                    <select name="status" onchange="this.form.submit()" class="status-select {{ $order->status }}">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="proses" {{ $order->status == 'proses' ? 'selected' : '' }}>Proses</option>
                        <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </form>
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