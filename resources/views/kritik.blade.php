@extends('layouts.app')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">

<style>
:root {
    --bg:           #f0ebe8;
    --card:         #ffffff;
    --brown:        #2b1e16;
    --brown-mid:    #4a2e1e;
    --brown-soft:   #7a4a3a;
    --brown-muted:  #a07060;
    --brown-pale:   #d4bbb4;
    --brown-faint:  #efe7e3;
    --border:       rgba(43,30,22,0.08);
    --border-mid:   rgba(43,30,22,0.14);
    --text-primary: #2b1e16;
    --text-muted:   #8a6050;
    --text-faint:   #b89488;
}

* { box-sizing: border-box; margin: 0; padding: 0; }

body {
    background: var(--bg);
    font-family: 'DM Sans', sans-serif;
    color: var(--text-primary);
}

.page-wrap {
    max-width: 1100px;
    margin: 110px auto 80px;
    padding: 0 24px;
    display: grid;
    grid-template-columns: 340px 1fr;
    gap: 28px;
    align-items: start;
}

/* ── LEFT COLUMN — form ── */
.form-col { position: sticky; top: 100px; }

.col-heading {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 22px;
    font-weight: 600;
    color: var(--brown);
    margin-bottom: 4px;
}

.col-sub {
    font-size: 12.5px;
    color: var(--text-muted);
    margin-bottom: 20px;
    line-height: 1.5;
}

.form-box {
    background: var(--card);
    border-radius: 20px;
    border: 1px solid var(--border);
    padding: 24px;
    box-shadow: 0 4px 24px rgba(43,30,22,0.06);
}

.field-label {
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--text-faint);
    margin-bottom: 8px;
    display: block;
}

.field-name {
    width: 100%;
    padding: 10px 14px;
    border-radius: 10px;
    border: 1.5px solid var(--border-mid);
    background: var(--brown-faint);
    color: var(--brown-muted);
    font-family: 'DM Sans', sans-serif;
    font-size: 13.5px;
    font-weight: 500;
    cursor: not-allowed;
    margin-bottom: 18px;
}

/* star rating */
.rating-wrap { margin-bottom: 18px; }

.stars-input {
    display: flex;
    gap: 6px;
    margin-top: 8px;
}

.star-input {
    font-size: 26px;
    cursor: pointer;
    color: var(--brown-pale);
    transition: color 0.15s, transform 0.15s;
    line-height: 1;
    user-select: none;
}

.star-input:hover,
.star-input.active { color: #e8a230; }

.star-input:hover { transform: scale(1.15); }

/* textarea */
.field-textarea {
    width: 100%;
    padding: 11px 14px;
    border-radius: 10px;
    border: 1.5px solid var(--border-mid);
    background: #fff;
    font-family: 'DM Sans', sans-serif;
    font-size: 13.5px;
    color: var(--text-primary);
    resize: vertical;
    min-height: 90px;
    transition: border-color 0.2s;
    margin-bottom: 18px;
}

.field-textarea:focus {
    outline: none;
    border-color: var(--brown);
}

.field-textarea::placeholder { color: var(--text-faint); }

.btn-kirim {
    width: 100%;
    background: var(--brown);
    color: #fff;
    border: none;
    padding: 12px;
    border-radius: 50px;
    cursor: pointer;
    font-family: 'DM Sans', sans-serif;
    font-size: 14px;
    font-weight: 600;
    letter-spacing: 0.3px;
    transition: background 0.2s, transform 0.15s;
}

.btn-kirim:hover {
    background: var(--brown-mid);
    transform: translateY(-1px);
}

.btn-kirim:active { transform: scale(0.98); }

/* alert */
.alert-success {
    display: flex;
    align-items: center;
    gap: 10px;
    background: #edf7ef;
    border: 1px solid #b4d9bc;
    color: #2a6b38;
    padding: 12px 16px;
    border-radius: 12px;
    font-size: 13px;
    font-weight: 500;
    margin-bottom: 20px;
}

.alert-success::before {
    content: '\2713';
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 20px; height: 20px;
    background: #2a6b38;
    color: #fff;
    border-radius: 50%;
    font-size: 11px;
    font-weight: 700;
    flex-shrink: 0;
}

/* ── RIGHT COLUMN — reviews ── */
.reviews-col {}

.reviews-heading {
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    color: var(--text-faint);
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.reviews-heading::after {
    content: '';
    flex: 1;
    height: 1px;
    background: var(--border);
}

.review-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 14px;
}

.review-card {
    background: var(--card);
    border-radius: 16px;
    padding: 16px 18px;
    border: 1px solid var(--border);
    box-shadow: 0 2px 12px rgba(43,30,22,0.05);
    transition: transform 0.22s ease, box-shadow 0.22s ease;
    display: flex;
    flex-direction: column;
    gap: 8px;
    animation: fadeUp 0.4s ease both;
}

.review-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 28px rgba(43,30,22,0.10);
}

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(14px); }
    to   { opacity: 1; transform: translateY(0); }
}

.review-card:nth-child(1) { animation-delay: 0.04s; }
.review-card:nth-child(2) { animation-delay: 0.08s; }
.review-card:nth-child(3) { animation-delay: 0.12s; }
.review-card:nth-child(4) { animation-delay: 0.16s; }
.review-card:nth-child(5) { animation-delay: 0.20s; }
.review-card:nth-child(6) { animation-delay: 0.24s; }

.review-header {
    display: flex;
    align-items: center;
    gap: 10px;
}

.review-avatar {
    width: 34px; height: 34px;
    border-radius: 50%;
    background: var(--brown);
    color: #fff;
    font-size: 13px;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-family: 'Playfair Display', serif;
}

.review-name {
    font-size: 13.5px;
    font-weight: 600;
    color: var(--brown);
}

.stars-display {
    display: flex;
    gap: 2px;
}

.stars-display span {
    color: #e8a230;
    font-size: 14px;
}

.review-comment {
    font-size: 12.5px;
    color: var(--text-muted);
    line-height: 1.65;
    flex: 1;
}

/* admin reply */
.admin-reply {
    background: var(--brown-faint);
    border-left: 3px solid var(--brown);
    border-radius: 0 8px 8px 0;
    padding: 10px 12px;
}

.admin-reply-label {
    font-size: 9.5px;
    font-weight: 700;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: var(--brown);
    margin-bottom: 4px;
}

.admin-reply-text {
    font-size: 12px;
    color: var(--text-muted);
    line-height: 1.55;
}

/* delete btn */
.btn-hapus {
    align-self: flex-end;
    background: transparent;
    color: #c0392b;
    border: 1px solid rgba(192,57,43,0.25);
    padding: 4px 12px;
    border-radius: 20px;
    cursor: pointer;
    font-size: 11.5px;
    font-weight: 500;
    font-family: 'DM Sans', sans-serif;
    transition: background 0.18s, color 0.18s;
}

.btn-hapus:hover {
    background: #c0392b;
    color: #fff;
}

/* ── RESPONSIVE ── */
@media (max-width: 760px) {
    .page-wrap {
        grid-template-columns: 1fr;
        margin-top: 80px;
    }

    .form-col { position: static; }
}
</style>

@include('partials.navbar')

<div class="page-wrap">

    {{-- LEFT: Form --}}
    <div class="form-col">
        <div class="col-heading">Kritik & Saran</div>
        <div class="col-sub">Bantu kami berkembang dengan cerita pengalamanmu.</div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <div class="form-box">
            <form action="{{ route('kritik.store') }}" method="POST">
                @csrf

                <label class="field-label">Nama</label>
                <input type="text" name="name" class="field-name"
                       value="{{ Auth::user()->name }}" readonly required>

                <div class="rating-wrap">
                    <label class="field-label">Rating</label>
                    <div class="stars-input">
                        <input type="hidden" name="rating" id="rating" required>
                        <span class="star-input" data-value="1">★</span>
                        <span class="star-input" data-value="2">★</span>
                        <span class="star-input" data-value="3">★</span>
                        <span class="star-input" data-value="4">★</span>
                        <span class="star-input" data-value="5">★</span>
                    </div>
                </div>

                <label class="field-label">Komentar</label>
                <textarea name="comment" class="field-textarea"
                          rows="4" placeholder="Tulis pengalamanmu di sini..." required></textarea>

                <button type="submit" class="btn-kirim">Kirim Ulasan</button>
            </form>
        </div>
    </div>

    {{-- RIGHT: Reviews --}}
    <div class="reviews-col">
        <div class="reviews-heading">
            <span>{{ count($reviews) }} Ulasan</span>
        </div>

        <div class="review-grid">
            @foreach($reviews as $review)
            <div class="review-card">

                <div class="review-header">
                    <div class="review-avatar">
                        {{ strtoupper(substr($review->name, 0, 1)) }}
                    </div>
                    <div class="review-name">{{ $review->name }}</div>
                </div>

                <div class="stars-display">
                    @for($i = 0; $i < $review->rating; $i++)
                        <span>★</span>
                    @endfor
                    @for($i = $review->rating; $i < 5; $i++)
                        <span style="color: #ddd;">★</span>
                    @endfor
                </div>

                <p class="review-comment">{{ $review->comment }}</p>

                @if($review->admin_reply)
                    <div class="admin-reply">
                        <div class="admin-reply-label">Balasan Admin</div>
                        <div class="admin-reply-text">{{ $review->admin_reply }}</div>
                    </div>
                @endif

                @if(Auth::check() && Auth::user()->name == $review->name)
                    <form action="{{ route('kritik.destroy', $review->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-hapus"
                                onclick="return confirm('Hapus komentar ini?')">Hapus</button>
                    </form>
                @endif

            </div>
            @endforeach
        </div>
    </div>

</div>

<script>
const stars = document.querySelectorAll('.star-input');
const ratingInput = document.getElementById('rating');

stars.forEach(star => {
    star.addEventListener('click', function () {
        const value = this.getAttribute('data-value');
        ratingInput.value = value;
        stars.forEach((s, i) => {
            s.classList.toggle('active', i < value);
        });
    });

    star.addEventListener('mouseover', function () {
        const value = this.getAttribute('data-value');
        stars.forEach((s, i) => {
            s.style.color = i < value ? '#e8a230' : '';
        });
    });

    star.addEventListener('mouseout', function () {
        stars.forEach((s, i) => {
            s.style.color = '';
        });
    });
});
</script>

@include('partials.footer')

@endsection