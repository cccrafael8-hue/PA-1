@extends('layouts.app')

@section('content')

@include('admin.navbar_admin')

<div class="container-fluid" style="padding-top: 100px;">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2" style="position: fixed; height: 100vh; background-color: #f8f9fa; padding-top: 20px;">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('admin.payment_settings') }}" style="color: #3d1f1a; font-weight: 500;">
                        <i class="fas fa-qrcode mr-2"></i> QR Code Pembayaran
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 offset-md-2" style="padding: 20px 40px;">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 style="color: #3d1f1a; font-weight: 600;">Pengaturan Pembayaran</h3>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 12px;">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card" style="border-radius: 16px; border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
                <div class="card-body" style="padding: 30px;">
                    <h5 class="card-title mb-4" style="font-weight: 600; color: #5b3a34;">Upload QR Code / QRIS</h5>
                    
                    <form action="{{ route('admin.payment_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-5">
                                <div style="text-align: center; padding: 20px; border: 2px dashed #ddd; border-radius: 12px; background: #fdf9f8;">
                                    <p style="font-size: 14px; color: #7a5248; margin-bottom: 10px;">QR Code Saat Ini</p>
                                    @if($qrCode && $qrCode->value)
                                        <img src="{{ asset('storage/'.$qrCode->value) }}" alt="QR Code" style="max-width: 100%; border-radius: 8px;">
                                    @else
                                        <div style="height: 200px; display: flex; align-items: center; justify-content: center; color: #999;">
                                            Belum ada QR Code
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-md-7" style="padding-top: 20px;">
                                <div class="mb-3">
                                    <label class="form-label" style="font-weight: 500; color: #3d1f1a;">Pilih File Gambar</label>
                                    <input class="form-control" type="file" name="qr_code" accept="image/png, image/jpeg, image/jpg" required>
                                    @error('qr_code')
                                        <div class="text-danger mt-1" style="font-size: 13px;">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text mt-2">Format yang didukung: JPG, JPEG, PNG. Maksimal 2MB.</div>
                                </div>
                                
                                <button type="submit" class="btn" style="background: #5b3a34; color: white; padding: 10px 24px; border-radius: 8px; font-weight: 500;">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
