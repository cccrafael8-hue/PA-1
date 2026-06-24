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

{{-- ← ADDED: style notif --}}
.notif-success {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #edf7ef;
    border: 1px solid #b4d9bc;
    color: #2a6b38;
    padding: 11px 16px;
    border-radius: 10px;
    font-size: 13.5px;
    font-weight: 500;
    margin-bottom: 16px;
}

.notif-error {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #fdecea;
    border: 1px solid #f0b4b4;
    color: #8b1a1a;
    padding: 11px 16px;
    border-radius: 10px;
    font-size: 13.5px;
    font-weight: 500;
    margin-bottom: 8px;
}
</style>

@include('admin.navbar_admin')

<div class="container container-admin">

<div class="card-admin">

<h4 class="mb-4">Manajemen Menu</h4>

{{-- NOTIF --}}
@if(session('success'))
    <div class="notif-success">✓ {{ session('success') }}</div>
@endif

@if($errors->any())
    <div style="color:red; margin-bottom:10px;">
        <ul style="margin:0; padding-left:20px;">
            @foreach($errors->all() as $error)
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
<input type="text" name="name" class="form-control"
    placeholder="Nama Menu"
    value="{{ $menu->name ?? '' }}" required>
</div>

<div class="col-md-4 mb-3">
<select name="category" class="form-control" required>
    <option value="">Pilih Kategori</option>
    <option value="makanan" {{ (isset($menu) && $menu->category == 'makanan') ? 'selected' : '' }}>Makanan</option>
    <option value="coffee" {{ (isset($menu) && $menu->category == 'coffee') ? 'selected' : '' }}>Coffee</option>
    <option value="non_coffee" {{ (isset($menu) && $menu->category == 'non_coffee') ? 'selected' : '' }}>Non Coffee</option>
    <option value="snack" {{ (isset($menu) && $menu->category == 'snack') ? 'selected' : '' }}>Snack</option>
</select>
</div>

<div class="col-md-4 mb-3">
<input type="text" name="price_display" class="form-control"
    placeholder="Harga (Default/Umum)" required>
<input type="hidden" name="price" value="{{ old('price', $menu->price ?? '') }}">
</div>

<div class="col-md-4 mb-3 coffee-price" style="display:none;">
<input type="text" name="price_hot_display" class="form-control"
    placeholder="Harga Hot (Kopi)">
<input type="hidden" name="price_hot" value="{{ old('price_hot', $menu->price_hot ?? '') }}">
</div>

<div class="col-md-4 mb-3 coffee-price" style="display:none;">
<input type="text" name="price_cold_display" class="form-control"
    placeholder="Harga Cold (Kopi)">
<input type="hidden" name="price_cold" value="{{ old('price_cold', $menu->price_cold ?? '') }}">
</div>

<div class="col-md-4 mb-3">
<input type="file" name="image" class="form-control">
</div>

</div>

<div class="mb-3">
<textarea name="description" class="form-control"
    placeholder="Deskripsi Menu" required>{{ $menu->description ?? '' }}</textarea>
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
<img src="{{ asset('storage/'.$menuItem->image) }}"
style="width:80px;height:60px;object-fit:cover;border-radius:8px;">
</td>

<td>{{ $menuItem->name }}</td>

<td>
    @if($menuItem->category == 'makanan') Makanan
    @elseif($menuItem->category == 'coffee') Coffee
    @elseif($menuItem->category == 'non_coffee') Non Coffee
    @elseif($menuItem->category == 'snack') Snack
    @else -
    @endif
</td>

<td>Rp {{ number_format($menuItem->price) }}</td>

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
    const categorySelect = document.querySelector('select[name="category"]');
    const coffeePrices = document.querySelectorAll('.coffee-price');

    function toggleCoffeePrices() {
        if(categorySelect.value === 'coffee') {
            coffeePrices.forEach(el => el.style.display = 'block');
        } else {
            coffeePrices.forEach(el => {
                el.style.display = 'none';
            });
        }
    }

    categorySelect.addEventListener('change', toggleCoffeePrices);
    toggleCoffeePrices(); 

    // Format display dan sync ke hidden input secara real-time
    const priceNames = ['price', 'price_hot', 'price_cold'];

    function formatNumber(value) {
        let clean = value.toString().replace(/[^\d]/g, '');
        if (!clean) return '';
        return new Intl.NumberFormat('id-ID').format(clean);
    }

    priceNames.forEach(name => {
        const hiddenInput = document.querySelector(`input[name="${name}"]`);
        const displayInput = document.querySelector(`input[name="${name}_display"]`);
        
        if (hiddenInput && displayInput) {
            // Isi nilai awal ke input display jika ada value di hidden input
            if (hiddenInput.value) {
                displayInput.value = formatNumber(hiddenInput.value);
            }

            // Sync setiap kali user mengetik di input display
            displayInput.addEventListener('input', function() {
                let clean = this.value.replace(/[^\d]/g, '');
                hiddenInput.value = clean; // Update hidden input dengan angka bersih
                this.value = formatNumber(clean); // Format visual input display
            });
        }
    });
});
</script>

@endsection