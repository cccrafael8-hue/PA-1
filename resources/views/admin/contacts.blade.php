@extends('layouts.app')

@section('content')

<style>
body {
    background: linear-gradient(135deg, #f3eeea, #e7dfd8);
    font-family: 'Poppins', sans-serif;
}

.admin-container {
    max-width: 1200px;
    margin: 120px auto;
}

.admin-title {
    font-size: 28px;
    font-weight: 600;
    margin-bottom: 30px;
    color: #3e2c27;
}

.message-card {
    background: rgba(255, 255, 255, 0.7);
    backdrop-filter: blur(12px);
    border-radius: 20px;
    padding: 25px;
    margin-bottom: 20px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.08);
    transition: 0.3s;
}

.message-card:hover {
    transform: translateY(-3px);
}

.message-header {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}

.message-name {
    font-weight: 600;
    font-size: 18px;
    color: #3e2c27;
}

.message-date {
    font-size: 12px;
    color: #999;
}

.message-body {
    background: #f9f6f4;
    padding: 15px;
    border-radius: 10px;
    font-size: 14px;
}

/* tombol hapus */
.btn-delete {
    background: #e74c3c;
    color: white;
    border: none;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    cursor: pointer;
    transition: 0.3s;
}

.btn-delete:hover {
    background: #c0392b;
}

.empty {
    text-align: center;
    padding: 50px;
    color: #aaa;
}

/* alert */
.alert-success {
    background: #d4edda;
    color: #155724;
    padding: 12px;
    border-radius: 10px;
    margin-bottom: 20px;
}
</style>

<div class="admin-container">

    <div class="admin-title">
        Pesan Masuk
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($contacts->count() > 0)

        @foreach($contacts as $c)
            <div class="message-card">

                <div class="message-header">

                    <div class="message-name">
                        {{ $c->name }}
                    </div>

                    <div style="display:flex; gap:10px; align-items:center;">
                        
                        <div class="message-date">
                            {{ $c->created_at->format('d M Y H:i') }}
                        </div>

                        <!-- TOMBOL HAPUS -->
                        <form action="{{ route('admin.kontak.delete', $c->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn-delete"
                                onclick="return confirm('Yakin mau hapus pesan ini?')">
                                Hapus
                            </button>
                        </form>

                    </div>

                </div>

                <div class="message-body">
                    {{ $c->message }}
                </div>

            </div>
        @endforeach

    @else
        <div class="empty">
            Belum ada pesan masuk 😴
        </div>
    @endif

</div>

@endsection