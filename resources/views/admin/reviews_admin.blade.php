@extends('layouts.app') {{-- Pastikan ini sesuai dengan layout admin kamu --}}

@section('content')
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
            </tr>
            @empty
            <tr>
                <td colspan="5" style="padding: 20px; text-align: center;">Belum ada kritik masuk.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection