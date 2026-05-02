@extends('layouts.app') {{-- Pastikan ini sesuai dengan layout admin kamu --}}

@section('content')

@include('admin.navbar_admin')
<div class="container" style="padding: 40px; background: #fff;">
    <h2 style="color: #4a342e; margin-bottom: 20px; font-weight: bold;">Daftar Kritik & Saran (Admin)</h2>
    
    <table border="1" style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <thead>
            <tr style="background-color: #4a342e; color: white;">
                <th style="padding: 15px;">No</th>
                <th style="padding: 15px;">Nama Pelanggan</th>
                <th style="padding: 15px;">Rating</th>
                <th style="padding: 15px;">Komentar</th>
                <th style="padding: 15px;">Tanggal</th>
                <th style="padding: 15px;">Aksi / Balasan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reviews as $key => $item)
            <tr style="text-align: center;">
                <td style="padding: 12px;">{{ $key + 1 }}</td>
                <td style="padding: 12px;">{{ $item->name }}</td>
                <td style="padding: 12px; color: #ffc107;">
                    @for($i = 1; $i <= 5; $i++)
                        {{ $i <= $item->rating ? '★' : '☆' }}
                    @endfor
                </td>
                <td style="padding: 12px; text-align: left;">{{ $item->comment }}</td>
                <td style="padding: 12px;">{{ $item->created_at->format('d M Y') }}</td>
                <td style="padding: 12px; text-align: left;">
                    @if($item->admin_reply)
                        <div style="background: #e8f5e9; padding: 10px; border-radius: 5px; font-size: 0.9em; margin-bottom: 10px;">
                            <strong>Balasan Admin:</strong><br>
                            {{ $item->admin_reply }}
                        </div>
                        
                        <!-- Tombol Hapus Balasan -->
                        <form action="{{ route('admin.reviews.reply.delete', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus balasan ini?')" style="background-color: #dc3545; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; width: 100%;">Hapus Balasan</button>
                        </form>
                    @else
                        <form action="{{ route('admin.reviews.reply', $item->id) }}" method="POST" style="margin-bottom: 10px;">
                            @csrf
                            <textarea name="admin_reply" rows="2" style="width: 100%; padding: 5px; border-radius: 4px; border: 1px solid #ccc; margin-bottom: 5px;" placeholder="Tulis balasan..."></textarea>
                            <button type="submit" style="background-color: #4a342e; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; width: 100%;">Balas</button>
                        </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="padding: 20px; text-align: center;">Belum ada kritik masuk.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection