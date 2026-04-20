@extends('layouts.app')

@section('content')

<style>
.container-kritik{
    max-width:1000px;
    margin:auto;
    padding:40px 20px;
    margin-top:80px;
}

.title{
    font-size:28px;
    font-weight:600;
    margin-bottom:20px;
}

/* FORM */
.form-box{
    background:#fff;
    padding:20px;
    border-radius:12px;
    box-shadow:0 4px 10px rgba(0,0,0,0.05);
    margin-bottom:30px;
}

.form-box input,
.form-box textarea{
    width:100%;
    padding:10px;
    margin-bottom:10px;
    border-radius:8px;
    border:1px solid #ddd;
}

.btn-kirim{
    background:#5c3b33;
    color:#fff;
    border:none;
    padding:10px 20px;
    border-radius:20px;
    cursor:pointer;
}

.btn-kirim:hover{
    background:#3e2723;
}

/* RATING INPUT */
.rating{
    margin:10px 0;
}

.star-input{
    font-size:28px;
    cursor:pointer;
    color:#ccc;
    transition:0.2s;
}

.star-input.active{
    color:gold;
}

/* CARD REVIEW */
.review-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit, minmax(250px,1fr));
    gap:20px;
}

.review-card{
    background:#fff;
    border-radius:15px;
    padding:15px;
    box-shadow:0 4px 10px rgba(0,0,0,0.05);
}

.review-name{
    font-weight:bold;
    margin-bottom:5px;
}

/* BINTANG DISPLAY */
.stars-display span{
    color:gold;
    font-size:18px;
}
</style>

@include('partials.navbar')

<div class="container-kritik">

    <div class="title">Kritik & Saran</div>

    @if(session('success'))
        <div style="color:green; margin-bottom:10px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="form-box">
        <form action="{{ route('reviews.store') }}" method="POST">
            @csrf

            <input type="text" name="name" placeholder="Nama kamu" required>

            <div class="rating">
                <input type="hidden" name="rating" id="rating" required>

                <span class="star-input" data-value="1">★</span>
                <span class="star-input" data-value="2">★</span>
                <span class="star-input" data-value="3">★</span>
                <span class="star-input" data-value="4">★</span>
                <span class="star-input" data-value="5">★</span>
            </div>

            <textarea name="comment" placeholder="Tulis komentar..." required></textarea>

            <button class="btn-kirim">Kirim</button>
        </form>
    </div>

    <div class="review-grid">
        @foreach($reviews as $review)
            <div class="review-card">
                <div class="review-name">{{ $review->name }}</div>

                <div class="stars-display">
                    @for($i = 0; $i < $review->rating; $i++)
                        <span>★</span>
                    @endfor
                </div>

                <p>{{ $review->comment }}</p>
            </div>
        @endforeach
    </div>

</div>

<script>
    const stars = document.querySelectorAll('.star-input');
    const ratingInput = document.getElementById('rating');

    stars.forEach((star, index) => {
        star.addEventListener('click', function () {
            let value = this.getAttribute('data-value');
            ratingInput.value = value;

            stars.forEach(s => s.classList.remove('active'));

            for (let i = 0; i < value; i++) {
                stars[i].classList.add('active');
            }
        });
    });
</script>

@include('partials.footer')

@endsection