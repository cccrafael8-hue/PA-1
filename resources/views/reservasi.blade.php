@extends('layouts.app')

@section('content')

<style>
body {
    background: #f0ebe8;
    font-family: 'Poppins', sans-serif;
    color: #3e2c27;
}

.res-container {
    max-width: 480px;
    margin: 110px auto 60px;
    padding: 0 16px;
}

.page-title {
    text-align: center;
    font-size: 20px;
    font-weight: 600;
    color: #3d1f1a;
    margin-bottom: 6px;
}

.page-sub {
    text-align: center;
    font-size: 13px;
    color: #9a6e66;
    margin-bottom: 24px;
}

/* ── SUCCESS ALERT ── */
.alert-success {
    background: #eaf5ec;
    border: 0.5px solid rgba(60,130,70,0.2);
    color: #2e6b38;
    padding: 12px 16px;
    border-radius: 12px;
    margin-bottom: 16px;
    font-size: 14px;
}

/* ── CARD ── */
.res-card {
    background: #fff;
    border-radius: 20px;
    padding: 28px 24px;
    border: 0.5px solid rgba(91,58,52,0.12);
}

/* ── FIELDS ── */
.field-group {
    margin-bottom: 14px;
}

.field-label {
    display: block;
    font-size: 12px;
    font-weight: 600;
    color: #7a5248;
    margin-bottom: 5px;
    letter-spacing: 0.04em;
    text-transform: uppercase;
}

.field-input {
    width: 100%;
    padding: 11px 14px;
    border-radius: 12px;
    border: 1px solid rgba(91,58,52,0.18);
    font-size: 14px;
    color: #2c1410;
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

.field-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
}

/* ── DIVIDER ── */
.divider {
    border: none;
    border-top: 0.5px dashed rgba(91,58,52,0.18);
    margin: 20px 0;
}

/* ── INFO BOX ── */
.info-box {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    background: #fdf5f2;
    border-radius: 10px;
    padding: 10px 14px;
    margin-bottom: 16px;
    border: 0.5px solid rgba(91,58,52,0.1);
}

.info-icon {
    font-size: 16px;
    flex-shrink: 0;
    margin-top: 1px;
}

.info-text {
    font-size: 12px;
    color: #7a5248;
    line-height: 1.6;
}

/* ── BUTTON ── */
.btn-reservasi {
    width: 100%;
    padding: 14px;
    background: #5b3a34;
    color: #fff;
    border: none;
    border-radius: 30px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    letter-spacing: 0.02em;
    font-family: 'Poppins', sans-serif;
    transition: background 0.2s;
}

.btn-reservasi:hover:not(:disabled) {
    background: #4a2e29;
}

.btn-reservasi:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    background: #9a6e66;
}
</style>

@include('partials.navbar')

<div class="res-container">

    <p class="page-title">Reservasi Meja</p>
    <p class="page-sub">Isi data di bawah untuk memesan tempat duduk</p>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('reservasi.store') }}" method="POST" class="res-card" id="formReservasi">
        @csrf

        <div class="field-group">
            <label class="field-label">Nama lengkap</label>
            <input type="text" name="nama" id="nama" class="field-input" placeholder="Contoh: Budi Santoso" required>
        </div>

        <div class="field-row">
            <div class="field-group">
                <label class="field-label">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="field-input" min="{{ date('Y-m-d') }}" required>
            </div>
            <div class="field-group">
                <label class="field-label">Jam</label>
                <input type="time" name="waktu" id="waktu" class="field-input" required disabled title="Pilih tanggal terlebih dahulu">
            </div>
        </div>

        <div class="field-group">
            <label class="field-label">Jumlah orang</label>
            <input type="number" name="jumlah_orang" id="jumlah_orang" class="field-input" placeholder="Contoh: 4" min="1" required>
        </div>

        <hr class="divider">

        <div class="info-box">
            <span class="info-icon">💳</span>
            <span class="info-text">Pembayaran dilakukan saat konfirmasi reservasi di WhatsApp.</span>
        </div>

        <button type="button" onclick="kirimReservasi()" class="btn-reservasi">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                <path d="M17.498 14.382c-.301-.15-1.767-.867-2.04-.966-.273-.101-.473-.15-.673.15-.197.295-.771.964-.944 1.162-.175.195-.349.21-.646.075-.3-.15-1.263-.465-2.403-1.485-.888-.795-1.484-1.77-1.66-2.07-.174-.3-.019-.465.13-.615.136-.135.3-.345.45-.523.146-.181.194-.301.297-.496.1-.21.049-.375-.025-.524-.075-.15-.672-1.62-.922-2.206-.24-.584-.487-.51-.672-.51-.172-.015-.371-.015-.571-.015-.2 0-.523.074-.797.359-.273.3-1.045 1.02-1.045 2.475s1.07 2.865 1.219 3.075c.149.195 2.105 3.195 5.1 4.485.714.3 1.27.48 1.704.629.714.227 1.365.195 1.88.121.574-.091 1.767-.721 2.016-1.426.255-.705.255-1.29.18-1.425-.074-.135-.27-.21-.57-.345z"/>
                <path d="M20.52 3.449C12.831-3.984.106 1.407.101 11.893c0 2.096.549 4.14 1.595 5.945L0 24l6.335-1.652C8.079 23.354 9.99 23.805 11.889 23.805c9.88.016 16.68-10.54 11.836-18.228A11.908 11.908 0 0020.52 3.449zm-8.621 18.22a9.888 9.888 0 01-5.032-1.378l-.36-.214-3.742.975 1.005-3.645-.235-.375a9.869 9.869 0 01-1.516-5.29c.012-5.463 4.445-9.91 9.917-9.91a9.898 9.898 0 017.008 2.909 9.845 9.845 0 012.905 6.995c-.012 5.477-4.447 9.924-9.95 9.933z"/>
            </svg>
            Reservasi via WhatsApp
        </button>

    </form>

</div>

@include('partials.footer')

<script>
function checkValidations() {
    let nama = document.getElementById("nama").value.trim();
    let tanggal = document.getElementById("tanggal").value;
    let waktu = document.getElementById("waktu").value;
    let orang = parseInt(document.getElementById("jumlah_orang").value);
    let btn = document.querySelector('.btn-reservasi');

    let isValid = true;

    if (!nama || !tanggal || !waktu || !orang || isNaN(orang)) {
        isValid = false;
    }

    if (orang < 1) {
        isValid = false;
    }

    if (tanggal) {
        let today = new Date();
        today.setHours(0,0,0,0);
        let selectedDate = new Date(tanggal);
        if (selectedDate < today) isValid = false;
    }

    if (tanggal && waktu) {
        let selectedDate = new Date(tanggal);
        let day = selectedDate.getDay(); 
        let timeParts = waktu.split(':');
        let hours = parseInt(timeParts[0]);
        let minutes = parseInt(timeParts[1]);
        let timeInMinutes = hours * 60 + minutes;

        if (day >= 1 && day <= 5) {
            if (timeInMinutes <= 659 || timeInMinutes >= 1319) isValid = false;
        } else {
            if (timeInMinutes <= 659 || timeInMinutes >= 1379) isValid = false;
        }
    }

    btn.disabled = !isValid;
}

document.addEventListener('DOMContentLoaded', function() {
    let elTanggal = document.getElementById("tanggal");
    let elWaktu = document.getElementById("waktu");
    let elNama = document.getElementById("nama");
    let elOrang = document.getElementById("jumlah_orang");

    elTanggal.addEventListener('change', function() {
        if (this.value) {
            elWaktu.disabled = false;
            let selectedDate = new Date(this.value);
            let day = selectedDate.getDay(); 

            if (day >= 1 && day <= 5) {
                elWaktu.min = "11:00";
                elWaktu.max = "21:58";
            } else {
                elWaktu.min = "11:00";
                elWaktu.max = "22:58";
            }
        } else {
            elWaktu.disabled = true;
            elWaktu.value = '';
        }
        checkValidations();
    });

    elWaktu.addEventListener('change', function() {
        if (this.value && this.min && this.max) {
            if (this.value < this.min || this.value > this.max) {
                // Hapus nilai jika diluar jam tanpa memunculkan alert
                this.value = '';
            }
        }
        checkValidations();
    });

    elNama.addEventListener('input', checkValidations);
    elWaktu.addEventListener('input', checkValidations);
    elOrang.addEventListener('input', checkValidations);
    checkValidations();
});

function kirimReservasi() {
    let form = document.getElementById("formReservasi");
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    let nama    = document.getElementById("nama").value;
    let tanggal = document.getElementById("tanggal").value;
    let waktu   = document.getElementById("waktu").value;
    let orang   = document.getElementById("jumlah_orang").value;

    let pesan = `Halo Kakk, Saya ingin melakukan reservasi meja atas nama ${nama}\nTanggal      : ${tanggal}\nJam          : ${waktu}\nJumlah Orang : ${orang}\n\nSaya juga akan melakukan pembayaran melalui QRIS.\n\nTerima kasih Kakk.`;

    let nomorAdmin = "62895346041061";
    let url = "https://wa.me/" + nomorAdmin + "?text=" + encodeURIComponent(pesan);

    window.open(url, '_blank');

    form.submit();
}
</script>

@endsection