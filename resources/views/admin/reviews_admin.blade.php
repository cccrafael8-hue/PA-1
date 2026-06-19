@extends('layouts.app')

@section('content')

@include('admin.navbar_admin')
<div class="container" style="padding: 60px 40px 40px 40px; background: #fff;">
    
    <table border="0" style="width: 100%; border-collapse: collapse; margin-top: 30px; border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
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
            <tr style="text-align: center; border-top: 2px solid #c8a97e; background-color: {{ $key % 2 == 0 ? '#fff' : '#fdf8f4' }};">
                <td style="padding: 20px 12px;">{{ $key + 1 }}</td>
                <td style="padding: 20px 12px;">{{ $item->name }}</td>
                <td style="padding: 20px 12px; color: #ffc107;">
                    @for($i = 1; $i <= 5; $i++)
                        {{ $i <= $item->rating ? '★' : '☆' }}
                    @endfor
                </td>
                <td style="padding: 20px 12px; text-align: left;">{{ $item->comment }}</td>
                <td style="padding: 20px 12px;">{{ $item->created_at->format('d M Y') }}</td>
                <td style="padding: 20px 12px; text-align: left;">
                    @if($item->admin_reply)
                        <div style="background: #e8f5e9; padding: 10px; border-radius: 5px; font-size: 0.9em; margin-bottom: 10px;">
                            <strong>Balasan Admin:</strong><br>
                            {{ $item->admin_reply }}
                        </div>
                        
                        <form action="{{ route('admin.reviews.reply.delete', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus balasan ini?')" style="background-color: #dc3545; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; width: 100%; margin-bottom: 8px;">Hapus Balasan</button>
                        </form>
                    @else
                        <form action="{{ route('admin.reviews.reply', $item->id) }}" method="POST" style="margin-bottom: 10px;">
                            @csrf
                            <textarea name="admin_reply" rows="2" style="width: 100%; padding: 5px; border-radius: 4px; border: 1px solid #ccc; margin-bottom: 5px;" placeholder="Tulis balasan..."></textarea>
                            <button type="submit" style="background-color: #4a342e; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; width: 100%; margin-bottom: 8px;">Balas</button>
                        </form>
                    @endif

                    <form action="{{ route('admin.reviews.delete', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin ingin menghapus ulasan ini secara permanen?')" style="background-color: #212529; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; width: 100%;">Hapus Ulasan</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="padding: 20px; text-align: center; color: #888;">Belum ada kritik masuk.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection