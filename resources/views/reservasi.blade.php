@extends('layouts.app')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

body {
    font-family: 'Poppins', sans-serif;
    background: #f5ede8;
    color: #2d1e15;
}

.res-page {
    padding: 32px 16px 64px;
}

.res-shell {
    max-width: 520px;
    margin: 80px auto 0;
}

/* ── CARD ── */
.res-card {
    background: #fff;
    border-radius: 20px;
    border: 0.5px solid rgba(91, 58, 52, 0.12);
    padding: 28px 24px;
    margin-bottom: 14px;
}

/* ── SECTION HEAD ── */
.sec-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 18px;
    cursor: pointer;
    user-select: none;
}

.sec-head-left {
    display: flex;
    align-items: center;
    gap: 10px;
}

.sec-icon {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    background: #fdf0e8;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 16px;
    color: #5b3a34;
}

.sec-title {
    font-size: 13px;
    font-weight: 600;
    color: #2d1e15;
}

.sec-sub {
    font-size: 11px;
    color: #9a6e66;
    margin-top: 1px;
}

/* ── FIELDS ── */
.field-group {
    margin-bottom: 14px;
}

.field-label {
    display: block;
    font-size: 11px;
    font-weight: 600;
    color: #9a6e66;
    margin-bottom: 5px;
    letter-spacing: 0.05em;
    text-transform: uppercase;
}

.field-input {
    width: 100%;
    padding: 11px 14px;
    border-radius: 12px;
    border: 1px solid rgba(91, 58, 52, 0.15);
    font-size: 13px;
    color: #2d1e15;
    background: #fdf9f8;
    outline: none;
    font-family: 'Poppins', sans-serif;
    transition: border-color 0.2s, background 0.2s;
    box-sizing: border-box;
}

.field-input:focus {
    border-color: #5b3a34;
    background: #fff;
}

.field-input[readonly] {
    background: #f5ede8;
    color: #9a6e66;
    cursor: not-allowed;
}

.field-input:disabled {
    background: #f5ede8;
    color: #bfada8;
    cursor: not-allowed;
}

.field-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
}

/* ── TAGS ── */
.tag-row {
    display: flex;
    gap: 6px;
    flex-wrap: wrap;
    margin-top: 12px;
}

.tag {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 4px 10px;
    border-radius: 20px;
    background: #fdf0e8;
    border: 0.5px solid rgba(91, 58, 52, 0.15);
    font-size: 11px;
    color: #7a5248;
}

/* ── MENU LIST ── */
.menu-grid {
    display: flex;
    flex-direction: column;
    gap: 8px;
    margin-bottom: 16px;
}

.menu-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 14px;
    border-radius: 12px;
    border: 1px solid rgba(91, 58, 52, 0.1);
    background: #fdf9f8;
    transition: border-color 0.2s, background 0.2s;
}

.menu-item.has-qty {
    border-color: #5b3a34;
    background: #fff;
}

.menu-item-icon {
    width: 36px;
    height: 36px;
    border-radius: 9px;
    background: #f5ede8;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 17px;
    color: #5b3a34;
}

.menu-item-info {
    flex: 1;
    min-width: 0;
}

.menu-item-name {
    font-size: 12px;
    font-weight: 600;
    color: #2d1e15;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.menu-item-price {
    font-size: 11px;
    color: #9a6e66;
    margin-top: 2px;
}

.menu-item-controls {
    display: flex;
    align-items: center;
    gap: 7px;
    flex-shrink: 0;
}

.type-select {
    font-size: 11px;
    padding: 5px 7px;
    border-radius: 8px;
    border: 1px solid rgba(91, 58, 52, 0.18);
    background: #fff;
    color: #2d1e15;
    font-family: 'Poppins', sans-serif;
    outline: none;
}

/* ── QTY STEPPER ── */
.qty-wrap {
    display: flex;
    align-items: center;
    background: #f5ede8;
    border-radius: 30px;
    padding: 3px;
    gap: 2px;
    border: 1px solid rgba(91, 58, 52, 0.12);
}

.qty-btn {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    border: 1px solid rgba(91, 58, 52, 0.15);
    background: #fff;
    color: #2d1e15;
    font-size: 18px;
    line-height: 1;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Poppins', sans-serif;
    flex-shrink: 0;
    font-weight: 500;
    transition: background 0.15s, color 0.15s, border-color 0.15s;
}

.qty-btn:hover {
    background: #5b3a34;
    color: #fff;
    border-color: #5b3a34;
}

.qty-btn:active {
    background: #2d1e15;
    border-color: #2d1e15;
}

.qty-num {
    min-width: 28px;
    text-align: center;
    font-size: 13px;
    font-weight: 600;
    color: #2d1e15;
}

/* hidden real input for form submission */
.qty-hidden {
    display: none;
}

/* ── TOTAL ── */
.total-card {
    background: #2d1e15;
    border-radius: 14px;
    padding: 16px 18px;
}

.total-card-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 10px;
}

.total-label {
    font-size: 11px;
    font-weight: 600;
    color: rgba(232, 201, 154, 0.6);
    text-transform: uppercase;
    letter-spacing: 0.06em;
}

.total-amount {
    font-size: 22px;
    font-weight: 700;
    color: #e8c99a;
    margin-top: 2px;
}

.total-count {
    font-size: 11px;
    color: rgba(232, 201, 154, 0.5);
    text-align: right;
}

.total-note {
    font-size: 11px;
    color: rgba(255, 255, 255, 0.35);
    border-top: 0.5px solid rgba(255, 255, 255, 0.08);
    padding-top: 10px;
    display: flex;
    align-items: center;
    gap: 6px;
}

/* ── ALERT ── */
.alert-success {
    background: #eaf5ec;
    border: 0.5px solid rgba(60, 130, 70, 0.2);
    color: #2e6b38;
    padding: 12px 16px;
    border-radius: 12px;
    margin-bottom: 16px;
    font-size: 13px;
}

.error-msg {
    color: #c0392b;
    font-size: 11px;
    margin-top: 4px;
}

/* ── BUTTON ── */
.btn-wa {
    width: 100%;
    padding: 15px;
    background: #5b3a34;
    color: #fff;
    border: none;
    border-radius: 14px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    font-family: 'Poppins', sans-serif;
    transition: background 0.2s;
    letter-spacing: 0.02em;
}

.btn-wa:hover:not(:disabled) {
    background: #3d1f1a;
}

.btn-wa:disabled {
    opacity: 0.4;
    cursor: not-allowed;
}
</style>

@include('partials.navbar')

<div class="res-page">
<div class="res-shell">

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    {{-- FORM --}}
    <form action="{{ route('reservation.store') }}" method="POST" id="formReservasi" enctype="multipart/form-data">
        @csrf

        {{-- CARD: DATA PEMESAN --}}
        <div class="res-card">
            <div class="field-group">
                <label class="field-label">Nama lengkap</label>
                <input type="text" name="name" class="field-input" value="{{ Auth::user()->name }}" readonly required>
            </div>

            <div class="field-row">
                <div class="field-group">
                    <label class="field-label">Tanggal</label>
                    <input type="date" name="date" id="inDate" class="field-input" value="{{ date('Y-m-d') }}" readonly required>
                </div>
                <div class="field-group">
                    <label class="field-label">Jam</label>
                    <input type="time" name="time" id="inTime" class="field-input" required disabled title="Pilih tanggal terlebih dahulu">
                </div>
            </div>

            <div class="field-group" style="margin-bottom:0">
                <label class="field-label">Jumlah tamu</label>
                <input type="number" name="guest_count" id="inGuest" class="field-input" placeholder="Contoh: 4" min="1" required>
            </div>

            <div class="tag-row">
                <span class="tag">🕐 Senin–Jumat 11:00–21:59</span>
                <span class="tag">🕐 Sabtu–Minggu 11:00–22:59</span>
            </div>
        </div>

        {{-- CARD: MENU --}}
        <div class="res-card">
            <div class="sec-head" onclick="toggleMenu()">
                <div class="sec-head-left">
                    <div class="sec-icon">☰</div>
                    <div>
                        <div class="sec-title">Pilih menu</div>
                        <div class="sec-sub">Minimal 1 item untuk melanjutkan</div>
                    </div>
                </div>
                <div class="sec-arrow" id="menuArrow" style="transition: transform 0.3s; color: #9a6e66;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"></polyline></svg>
                </div>
            </div>

            <div class="menu-grid" id="menuGrid">
                @foreach($menus as $menu)
                <div class="menu-item"
                    data-id="{{ $menu->id }}"
                    data-cat="{{ $menu->category }}"
                    data-price="{{ $menu->price }}"
                    data-price-hot="{{ $menu->price_hot }}"
                    data-price-cold="{{ $menu->price_cold }}"
                    data-name="{{ $menu->name }}">

                    <div class="menu-item-icon">
                        @if($menu->category == 'coffee') ☕
                        @elseif($menu->category == 'food') 🍞
                        @else 🍵
                        @endif
                    </div>

                    <div class="menu-item-info">
                        <div class="menu-item-name">{{ $menu->name }}</div>
                        <div class="menu-item-price">
                            @if($menu->category == 'coffee' && ($menu->price_hot > 0 || $menu->price_cold > 0))
                                Hot Rp {{ number_format($menu->price_hot, 0, ',', '.') }} · Cold Rp {{ number_format($menu->price_cold, 0, ',', '.') }}
                            @else
                                Rp {{ number_format($menu->price, 0, ',', '.') }}
                            @endif
                        </div>
                    </div>

                    <div class="menu-item-controls">
                        @if($menu->category == 'coffee' && ($menu->price_hot > 0 || $menu->price_cold > 0))
                            <select name="menus[{{ $menu->id }}][type]" class="type-select type-input">
                                <option value="hot">Hot</option>
                                <option value="cold">Cold</option>
                            </select>
                        @endif

                        <input type="hidden" name="menus[{{ $menu->id }}][qty]" class="qty-hidden" value="0">

                        <div class="qty-wrap">
                            <button type="button" class="qty-btn qminus" aria-label="Kurangi">−</button>
                            <span class="qty-num">0</span>
                            <button type="button" class="qty-btn qplus" aria-label="Tambah">+</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            @error('menus')
                <div class="error-msg">{{ $message }}</div>
            @enderror

            <div class="total-card">
                <div class="total-card-top">
                    <div>
                        <div class="total-label">Total tagihan</div>
                        <div class="total-amount" id="totalDisplay">Rp 0</div>
                    </div>
                    <div class="total-count" id="itemCount">0 item</div>
                </div>
            </div>
            
            <div class="field-group" style="margin-top: 15px;">
                <label class="field-label">Catatan Pesanan (Opsional)</label>
                <textarea name="note" class="field-input" rows="2" placeholder="Contoh: kopi less sugar, makanan jangan pedas"></textarea>
            </div>
        </div>

        <div class="res-card" style="margin-top: 14px;">
            <div class="sec-head" style="margin-bottom: 10px;">
                <div class="sec-head-left">
                    <div class="sec-icon">💳</div>
                    <div>
                        <div class="sec-title">Pembayaran</div>
                        <div class="sec-sub">Selesaikan pembayaran & upload bukti</div>
                    </div>
                </div>
            </div>

            <div style="text-align: center; margin: 15px 0;">
                @php
                    $qrCode = \App\Models\Setting::where('key', 'qr_code_payment')->first();
                @endphp
                @if($qrCode && $qrCode->value)
                    <img src="{{ asset('storage/' . $qrCode->value) }}" alt="QRIS" style="max-width: 220px; border-radius: 12px; border: 1px solid rgba(91,58,52,0.2);">
                @else
                    <div style="color: #a84040; font-size: 13px;">QRIS Belum Tersedia.</div>
                @endif
            </div>

            <div class="field-group" style="margin-bottom:0">
                <label class="field-label">Upload Bukti Transfer (Wajib)</label>
                <input type="file" name="payment_proof" class="field-input" accept="image/png, image/jpeg, image/jpg" required style="background: #fff; padding: 10px;">
                @error('payment_proof')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- TOMBOL --}}
        <button type="button" id="btnWa" class="btn-wa" disabled onclick="kirimReservasi()">
            Kirim Reservasi
        </button>

    </form>
</div>
</div>

@include('partials.footer')

<script>
document.addEventListener('DOMContentLoaded', function () {

    var items = [];
    document.querySelectorAll('.menu-item').forEach(function (el) {
        items.push({ el: el, qty: 0 });
    });

    function getPrice(item) {
        var cat = item.el.dataset.cat;
        if (cat === 'coffee') {
            var sel = item.el.querySelector('.type-input');
            var type = sel ? sel.value : 'hot';
            return parseInt(type === 'cold' ? item.el.dataset.priceCold : item.el.dataset.priceHot) || 0;
        }
        return parseInt(item.el.dataset.price) || 0;
    }

    function recalc() {
        var total = 0, count = 0, menuLines = [];
        items.forEach(function (item) {
            var q = item.qty;
            item.el.querySelector('.qty-num').textContent = q;
            item.el.querySelector('.qty-hidden').value = q;
            item.el.classList.toggle('has-qty', q > 0);
            if (q > 0) {
                var p = getPrice(item);
                total += p * q;
                count += q;
                var typeLabel = '';
                if (item.el.dataset.cat === 'coffee') {
                    var sel = item.el.querySelector('.type-input');
                    typeLabel = sel ? ' (' + (sel.value === 'cold' ? 'Cold' : 'Hot') + ')' : '';
                }
                menuLines.push(item.el.dataset.name + typeLabel + ' x' + q);
            }
        });

        document.getElementById('totalDisplay').textContent = 'Rp ' + total.toLocaleString('id-ID');
        document.getElementById('itemCount').textContent = count + ' item';

        validate(total, menuLines);
        return { total: total, menuLines: menuLines };
    }

    function validate(total, menuLines) {
        var d = document.getElementById('inDate').value;
        var t = document.getElementById('inTime').value;
        var g = parseInt(document.getElementById('inGuest').value);
        var ok = d && t && g >= 1 && !isNaN(g) && total > 0;
        document.getElementById('btnWa').disabled = !ok;
    }

    items.forEach(function (item) {
        item.el.querySelector('.qplus').addEventListener('click', function () {
            item.qty++;
            recalc();
        });
        item.el.querySelector('.qminus').addEventListener('click', function () {
            if (item.qty > 0) { item.qty--; recalc(); }
        });
        var sel = item.el.querySelector('.type-input');
        if (sel) sel.addEventListener('change', recalc);
    });

    var elDate  = document.getElementById('inDate');
    var elTime  = document.getElementById('inTime');
    var elGuest = document.getElementById('inGuest');

    elDate.addEventListener('change', function () {
        if (this.value) {
            elTime.disabled = false;
            var day = new Date(this.value).getDay();
            elTime.min = '11:00';
            elTime.max = (day >= 1 && day <= 5) ? '21:59' : '22:59';
            
            // Validate if today, time must be >= now + 30 mins
            var today = new Date();
            var selectedDate = new Date(this.value);
            if (today.toDateString() === selectedDate.toDateString()) {
                var minTimeObj = new Date(today.getTime() + 30 * 60000);
                var minHours = String(minTimeObj.getHours()).padStart(2, '0');
                var minMinutes = String(minTimeObj.getMinutes()).padStart(2, '0');
                var minTimeStr = minHours + ':' + minMinutes;
                
                if (minTimeStr > elTime.min) {
                    elTime.min = minTimeStr;
                }
            }
        } else {
            elTime.disabled = true;
            elTime.value = '';
        }
        recalc();
    });

    elTime.addEventListener('change', function () {
        if (this.value && this.min && this.max) {
            if (this.value < this.min || this.value > this.max) {
                alert('Waktu tidak valid! Pastikan memilih di jam operasional dan minimal 30 menit dari sekarang jika reservasi hari ini.');
                this.value = '';
            }
        }
        recalc();
    });

    elGuest.addEventListener('input', recalc);

    // Initialize time limits for today
    var event = new Event('change');
    elDate.dispatchEvent(event);
    
    recalc();

    window.toggleMenu = function() {
        var grid = document.getElementById('menuGrid');
        var arrow = document.getElementById('menuArrow');
        if (grid.style.display === 'none') {
            grid.style.display = 'flex';
            arrow.style.transform = 'rotate(0deg)';
        } else {
            grid.style.display = 'none';
            arrow.style.transform = 'rotate(180deg)';
        }
    };

    window.kirimReservasi = function () {
        var form = document.getElementById('formReservasi');
        if (!form.checkValidity()) { form.reportValidity(); return; }

        form.submit();
    };
});
</script>

@endsection