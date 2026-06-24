@extends('layouts.app')

@section('content')

<style>

body{
    background:#e9e5e3;
}

/* CONTAINER */
.container-admin{
    max-width:950px;
    margin:auto;
    margin-top:110px;
}

/* CARD */
.card-admin{
    background:white;
    padding:35px;
    border-radius:20px;
    box-shadow:0 2px 10px rgba(0,0,0,0.08);
}

/* TITLE */
h4{
    margin-bottom:25px;
    font-weight:600;
}

/* BUTTON */
.btn-main{
    background:#5b3a34;
    color:white;
    border-radius:25px;
    padding:10px 18px;
    border:none;
}

.btn-main:hover{
    background:#472c27;
}

/* FORM */
.form-control{
    padding:10px;
    border-radius:10px;
}

/* TABLE */
table{
    width:100%;
    border-collapse: collapse;
}

th{
    padding:12px 10px;
    font-weight:600;
    border-bottom:1px solid #eee;
}

td{
    padding:14px 10px;
    vertical-align: middle;
    border-bottom:1px solid #f2f2f2;
}

/* ROW HOVER */
tr:hover{
    background:#f5f3f2;
}

/* IMAGE */
img{
    border-radius:8px;
}

/* ACTION BUTTON */
.btn-sm{
    margin-right:5px;
}

</style>

@include('admin.navbar_admin')

<div class="container container-admin">

<div class="card-admin">

<h4>Manajemen Galeri</h4>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <ul class="mb-0">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- FORM ALBUM -->
<div class="row mb-4">
    <div class="col-md-12">
        <h5 style="font-weight: 600; margin-bottom: 15px;">Kelola Album</h5>
        <form method="POST" action="{{ route('gallery_admin.album.store') }}" style="display: flex; gap: 10px;">
            @csrf
            <input type="text" name="name" class="form-control" placeholder="Nama Album Baru" required style="max-width: 300px;">
            <button class="btn-main">Tambah Album</button>
        </form>
        <div style="margin-top: 15px; display: flex; flex-wrap: wrap; gap: 10px;">
            @foreach($albums as $album)
                <div style="background: #f5f3f2; padding: 5px 12px; border-radius: 15px; display: flex; align-items: center; gap: 10px; font-size: 14px; border: 1px solid #ddd;">
                    {{ $album->name }}
                    <form action="{{ route('gallery_admin.album.delete', $album->id) }}" method="POST" onsubmit="return confirm('Hapus album ini?')">
                        @csrf
                        @method('DELETE')
                        <button style="border: none; background: none; color: #e74c3c; cursor: pointer; padding: 0; font-weight: bold; font-size: 16px;">&times;</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</div>

<hr style="margin:30px 0;">

<h5 style="font-weight: 600; margin-bottom: 15px;">Tambah Foto Galeri</h5>

<!-- FORM GALERI -->
<form id="formGaleri" method="POST" action="{{ route('gallery_admin.store') }}" enctype="multipart/form-data">
@csrf
<input type="hidden" name="_method" id="methodField" value="POST">

<div class="row mb-2">

<div class="col-md-4 mb-3">
<input type="text" name="title" id="title" class="form-control" placeholder="Judul">
</div>

<div class="col-md-3 mb-3">
<select name="album_id" id="album_id" class="form-control" required>
    <option value="">Pilih Album</option>
    @foreach($albums as $album)
        <option value="{{ $album->id }}">{{ $album->name }}</option>
    @endforeach
</select>
</div>

<div class="col-md-3 mb-3">
<input type="file" name="image" class="form-control">
</div>

<div class="col-md-2 mb-3 d-flex align-items-end">
<button class="btn-main w-100" id="submitBtn">Tambah</button>
</div>

</div>

</form>

<hr style="margin:30px 0;">

<!-- TABLE -->
<table>

<thead>
<tr>
<th width="120">Gambar</th>
<th>Judul</th>
<th>Album</th>
<th width="160">Aksi</th>
</tr>
</thead>

<tbody>

@foreach($galleries as $item)

<tr>

<td>
<img src="{{ asset('storage/'.$item->image) }}"
style="width:90px;height:65px;object-fit:cover;">
</td>

<td>{{ $item->title }}</td>
<td>
    @if($item->album)
        <span style="background: #f0e6e4; padding: 4px 10px; border-radius: 12px; font-size: 13px; color: #4b2e2e;">{{ $item->album->name }}</span>
    @else
        <span style="color: #999; font-size: 13px;">Tanpa Album</span>
    @endif
</td>

<td>

<button class="btn btn-warning btn-sm"
onclick="editData('{{ $item->id }}','{{ $item->title }}','{{ $item->album_id }}')">
Edit
</button>

<form action="{{ route('gallery_admin.delete',$item->id) }}" method="POST" style="display:inline">
@csrf
@method('DELETE')
<button class="btn btn-danger btn-sm">Hapus</button>
</form>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

<script>
function editData(id, title, album_id) {
    document.getElementById('formGaleri').action = '/admin/gallery_admin/' + id;
    document.getElementById('methodField').value = 'PUT';
    document.getElementById('title').value = title;
    
    let selectAlbum = document.getElementById('album_id');
    if (album_id) {
        selectAlbum.value = album_id;
    } else {
        selectAlbum.value = '';
    }
    
    document.getElementById('submitBtn').innerText = 'Update';
}
</script>

@endsection