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

.batal {
    background-color:#fdecea;
    color: #8b1a1a;
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

.btn-proof {
    background: #17a2b8;
    color: white;
    border: none;
    padding: 6px 10px;
    border-radius: 8px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: 0.3s;
}

.btn-proof:hover {
    background: #117a8b;
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
                <th>Catatan</th>
                <th>Bukti Bayar</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>

        <tbody>
        @if($activeOrders->isEmpty())
            <tr>
                <td colspan="7" style="padding: 20px;">Tidak ada pesanan aktif.</td>
            </tr>
        @else
        @foreach($activeOrders as $order)
        <tr>
            <td>{{ $order->name }}</td>
            <td>{{ $order->items }}</td>
            <td>Rp {{ number_format($order->total) }}</td>

            <!-- NOTE -->
            <td class="note-cell">
                {{ $order->note ?? '-' }}
            </td>

            <td>
                @if($order->payment_proof)
                    <button type="button" class="btn-proof" onclick="showProofModal('{{ asset('storage/'.$order->payment_proof) }}')" title="Lihat Bukti">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </button>
                @else
                    <span style="color:#999; font-size:12px;">Tidak Ada</span>
                @endif
            </td>

            <td>
                @if($order->status == 'selesai')
                    <span class="status-select selesai" style="cursor:default; border:none; display:inline-block;">Selesai</span>
                @else
                    <form action="{{ route('admin.order.status', $order->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT')
                        <select name="status" onchange="this.form.submit()" class="status-select {{ $order->status }}">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="proses" {{ $order->status == 'proses' ? 'selected' : '' }}>Proses</option>
                            <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="batal" {{ $order->status == 'batal' ? 'selected' : '' }}>Batal</option>
                        </select>
                    </form>
                @endif
            </td>

            <td>{{ $order->created_at->format('d M Y') }}</td>

        </tr>
        @endforeach
        @endif
        </tbody>

        </table>
    </div>

    <!-- ARSIP PESANAN SELESAI -->
    <div class="card" style="margin-top: 30px;">
        <div style="display: flex; justify-content: space-between; align-items: center; cursor: pointer; padding-bottom: 10px;" onclick="toggleArsip()">
            <h2 style="margin-bottom: 0;">Arsip Pesanan (Selesai)</h2>
            <svg id="chevron-arsip" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="transition: transform 0.3s; transform: rotate(0deg); color: #8a6050;">
                <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
        </div>

        <div id="arsip-content" style="display: none; margin-top: 15px;">
        <table>

        <thead>
            <tr>
                <th>Nama</th>
                <th>Menu</th>
                <th>Total</th>
                <th>Catatan</th>
                <th>Bukti Bayar</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>

        <tbody>
        @if($archivedOrders->isEmpty())
            <tr>
                <td colspan="7" style="padding: 20px;">Belum ada pesanan yang selesai.</td>
            </tr>
        @else
        @foreach($archivedOrders as $order)
        <tr>
            <td>{{ $order->name }}</td>
            <td>{{ $order->items }}</td>
            <td>Rp {{ number_format($order->total) }}</td>
            <td class="note-cell">{{ $order->note ?? '-' }}</td>
            <td>
                @if($order->payment_proof)
                    <button type="button" class="btn-proof" onclick="showProofModal('{{ asset('storage/'.$order->payment_proof) }}')" title="Lihat Bukti">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </button>
                @else
                    <span style="color:#999; font-size:12px;">Tidak Ada</span>
                @endif
            </td>
            <td>
                @if($order->status == 'batal')
                    <span class="status-select batal" style="cursor:default; border:none; display:inline-block;">Dibatalkan</span>
                @else
                    <span class="status-select selesai" style="cursor:default; border:none; display:inline-block;">Selesai</span>
                @endif
            </td>
            <td>{{ $order->created_at->format('d M Y') }}</td>
        </tr>
        @endforeach
        @endif
        </tbody>

        </table>
        </div>
    </div>


</div>

<!-- Modal Bukti Pembayaran -->
<div id="proofModal" style="display:none; position:fixed; z-index:9999; left:0; top:0; width:100%; height:100%; background-color:rgba(0,0,0,0.8); justify-content:center; align-items:center;">
    <div style="position:relative; background:#fff; padding:20px; border-radius:12px; max-width:90%; max-height:90%; overflow:auto;">
        <span onclick="closeProofModal()" style="position:absolute; top:10px; right:15px; font-size:28px; font-weight:bold; cursor:pointer; color:#333;">&times;</span>
        <h4 style="margin-top:0; color:#5b3a34;">Bukti Pembayaran</h4>
        <img id="proofImage" src="" alt="Bukti Pembayaran" style="max-width:100%; max-height:70vh; display:block; margin:15px auto 0;">
    </div>
</div>

<script>
function toggleArsip() {
    let content = document.getElementById('arsip-content');
    let chevron = document.getElementById('chevron-arsip');
    if (content.style.display === 'none' || content.style.display === '') {
        content.style.display = 'block';
        chevron.style.transform = 'rotate(180deg)';
    } else {
        content.style.display = 'none';
        chevron.style.transform = 'rotate(0deg)';
    }
}

function showProofModal(imgSrc) {
    document.getElementById('proofImage').src = imgSrc;
    document.getElementById('proofModal').style.display = 'flex';
}

function closeProofModal() {
    document.getElementById('proofModal').style.display = 'none';
    document.getElementById('proofImage').src = '';
}
</script>

@endsection