@extends('layouts.app')

@section('content')

<style>
body{
    background:#e9e5e3;
}

.container-admin{
    max-width:900px;
    margin:auto;
    margin-top:120px;
}

.card-admin{
    background:white;
    padding:30px;
    border-radius:20px;
    box-shadow:0 2px 10px rgba(0,0,0,0.08);
}

.btn-main{
    background:#5b3a34;
    color:white;
    border-radius:25px;
    padding:8px 18px;
    border:none;
}

.btn-main:hover{
    background:#472c27;
}

table{
    width:100%;
    border-collapse: collapse;
}

th, td{
    padding:10px;
    text-align:left;
}
</style>

@include('admin.navbar_admin')

<div class="container container-admin">

<div class="card-admin">

<h4 class="mb-4">Manajemen Menu</h4>

{{-- NOTIF SUKSES --}}
@if(session('success'))
    <div style="color:green; margin-bottom:10px;">
        {{ session('success') }}
    </div>
@endif

{{-- MENAMPILKAN ERROR BACKEND DI ATAS FORM --}}
@if ($errors->any())
    <div style="color:red; margin-bottom:15px;">
        <ul style="padding-left: 20px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- FORM (CREATE + EDIT) --}}
<form action="{{ isset($menu) ? route('admin.menu.update',$menu->id) : route('admin.menu.store') }}" 
      method="POST" enctype="multipart/form-data">

@csrf
@if(isset($menu))
    @method('PUT')
@endif

<div class="row">

<div class="col-md-4 mb-3">
<input type="text" name="nama_menu" class="form-control"
    placeholder="Nama Menu"
    value="{{ $menu->nama_menu ?? '' }}" required>
</div>

<div class="col-md-4 mb-3">
<select name="kategori" class="form-control" required>
    <option value="">Pilih Kategori</option>
    <option value="makanan" {{ (isset($menu) && $menu->kategori == 'makanan') ? 'selected' : '' }}>Makanan</option>
    <option value="coffee" {{ (isset($menu) && $menu->kategori == 'coffee') ? 'selected' : '' }}>Coffee</option>
    <option value="non_coffee" {{ (isset($menu) && $menu->kategori == 'non_coffee') ? 'selected' : '' }}>Non Coffee</option>
    <option value="snack" {{ (isset($menu) && $menu->kategori == 'snack') ? 'selected' : '' }}>Snack</option>
</select>
</div>

{{-- INPUT HARGA UMUM (Kelipatan 1000, max 6 digit) --}}
<div class="col-md-4 mb-3">
<input type="number" name="harga" class="form-control"
    placeholder="Harga (Default/Umum)" min="1000" max="100000" step="1000"
    oninput="if(this.value.length > 6) this.value = this.value.slice(0, 6);"
    value="{{ $menu->harga ?? '' }}" required>
</div>

{{-- INPUT HARGA HOT (Kelipatan 1000, max 6 digit) --}}
<div class="col-md-4 mb-3 coffee-price" style="display:none;">
<input type="number" name="harga_hot" class="form-control"
    placeholder="Harga Hot (Kopi)" min="1000" max="100000" step="1000"
    oninput="if(this.value.length > 6) this.value = this.value.slice(0, 6);"
    value="{{ $menu->harga_hot ?? '' }}">
</div>

{{-- INPUT HARGA COLD (Kelipatan 1000, max 6 digit) --}}
<div class="col-md-4 mb-3 coffee-price" style="display:none;">
<input type="number" name="harga_cold" class="form-control"
    placeholder="Harga Cold (Kopi)" min="1000" max="100000" step="1000"
    oninput="if(this.value.length > 6) this.value = this.value.slice(0, 6);"
    value="{{ $menu->harga_cold ?? '' }}">
</div>

<div class="col-md-4 mb-3">
<input type="file" name="gambar" class="form-control">
</div>

</div>

<div class="mb-3">
<textarea name="deskripsi" class="form-control"
    placeholder="Deskripsi Menu" required>{{ $menu->deskripsi ?? '' }}</textarea>
</div>

<button class="btn-main">
    {{ isset($menu) ? 'Update Menu' : 'Tambah Menu' }}
</button>

@if(isset($menu))
    <a href="{{ route('admin.menu') }}" class="btn btn-secondary btn-sm">Batal</a>
@endif

</form>

<hr class="my-4">

<table class="table">

<thead>
<tr>
<th>Gambar</th>
<th>Nama</th>
<th>Kategori</th>
<th>Harga</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>

@foreach($menus as $menuItem)

<tr>

<td width="120">
<img src="{{ asset('storage/'.$menuItem->gambar) }}"
style="width:80px;height:60px;object-fit:cover;border-radius:8px;">
</td>

<td>{{ $menuItem->nama_menu }}</td>

<td>
    @if($menuItem->kategori == 'makanan') Makanan
    @elseif($menuItem->kategori == 'coffee') Coffee
    @elseif($menuItem->kategori == 'non_coffee') Non Coffee
    @elseif($menuItem->kategori == 'snack') Snack
    @else -
    @endif
</td>

<td>Rp {{ number_format($menuItem->harga) }}</td>

<td>

{{-- EDIT --}}
<a href="{{ route('admin.menu.edit', $menuItem->id) }}" class="btn btn-warning btn-sm">
    Edit
</a>

{{-- DELETE --}}
<form action="{{ route('admin.menu.delete', $menuItem->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger btn-sm"
        onclick="return confirm('Yakin mau hapus menu ini?')">
        Hapus
    </button>
</form>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const kategoriSelect = document.querySelector('select[name="kategori"]');
    const coffeePrices = document.querySelectorAll('.coffee-price');

    function toggleCoffeePrices() {
        if(kategoriSelect.value === 'coffee') {
            coffeePrices.forEach(el => el.style.display = 'block');
        } else {
            coffeePrices.forEach(el => {
                el.style.display = 'none';
                // Sengaja dikomentari agar isi inputan tidak terhapus mendadak saat edit form dimuat
                // el.querySelector('input').value = ''; 
            });
        }
    }

    kategoriSelect.addEventListener('change', toggleCoffeePrices);
    toggleCoffeePrices(); // Jalankan pas awal halaman di-refresh
});
</script>

@endsection