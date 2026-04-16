@extends('layouts.app')

@section('content')
<div class="container" style="padding: 50px;">
    <div style="max-width: 600px; margin: auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
        <h2 style="color: #4a342e; font-family: serif; margin-bottom: 25px;">Kritik & Saran</h2>

        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
                {{ session('success') }}
            </div>
        @endif

        {{-- PERHATIKAN: Route-nya sudah diganti ke kritik.store --}}
        <form action="{{ route('kritik.store') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Nama kamu" style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;" required>
            
            <select name="rating" style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;" required>
                <option value="5">⭐⭐⭐⭐⭐ (Sangat Puas)</option>
                <option value="4">⭐⭐⭐⭐ (Puas)</option>
                <option value="3">⭐⭐⭐ (Cukup)</option>
                <option value="2">⭐⭐ (Kurang)</option>
                <option value="1">⭐ (Buruk)</option>
            </select>

            <textarea name="comment" rows="5" placeholder="Tulis komentar..." style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;" required></textarea>
            
            <button type="submit" style="background: #4a342e; color: white; border: none; padding: 10px 25px; border-radius: 20px; cursor: pointer;">Kirim</button>
        </form>
    </div>
</div>
@endsection