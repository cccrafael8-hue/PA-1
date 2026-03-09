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

thead tr{
    display: table-row;
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

<form action="/admin/menu/store" method="POST" enctype="multipart/form-data">
@csrf

<div class="row">

<div class="col-md-4 mb-3">
<input type="text" name="nama_menu" class="form-control" placeholder="Nama Menu">
</div>

<div class="col-md-4 mb-3">
<input type="number" name="harga" class="form-control" placeholder="Harga">
</div>

<div class="col-md-4 mb-3">
<input type="file" name="gambar" class="form-control">
</div>

</div>

<div class="mb-3">
<textarea name="deskripsi" class="form-control" placeholder="Deskripsi Menu"></textarea>
</div>

<button class="btn-main">
Tambah Menu
</button>

</form>

<hr class="my-4">

<table class="table">

<thead>

<tr>
<th>Gambar</th>
<th>Nama</th>
<th>Harga</th>
<th>Aksi</th>
</tr>

</thead>

<tbody>

@foreach($menus as $menu)

<tr>

<td width="120">

<img src="{{ asset('storage/'.$menu->gambar) }}"
style="width:80px;height:60px;object-fit:cover;border-radius:8px;">

</td>

<td>{{ $menu->nama_menu }}</td>

<td>
Rp {{ number_format($menu->harga) }}
</td>

<td>

<a href="#" class="btn btn-warning btn-sm">
Edit
</a>

<a href="#" class="btn btn-danger btn-sm">
Hapus
</a>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

@endsection