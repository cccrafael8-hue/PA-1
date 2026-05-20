@extends('layouts.app')

@section('content')

@include('admin.navbar_admin')

<div class="dash-page">

    {{-- Navigation Grid --}}
    <div class="dash-grid">
        <a href="{{ route('admin.menu') }}"        class="dash-btn"><span class="dash-btn-num">01</span>Menu</a>
        <a href="{{ route('gallery_admin') }}"     class="dash-btn"><span class="dash-btn-num">02</span>Gallery</a>
        <a href="{{ route('admin.reservasi') }}"   class="dash-btn"><span class="dash-btn-num">03</span>Reservasi</a>
        <a href="{{ route('admin.kontak') }}"      class="dash-btn"><span class="dash-btn-num">04</span>Kontak</a>
        <a href="{{ route('admin.order_admin') }}" class="dash-btn"><span class="dash-btn-num">05</span>Order</a>
        <a href="{{ route('admin.reviews') }}"     class="dash-btn"><span class="dash-btn-num">06</span>Ulasan</a>
    </div>

    {{-- Chart Card --}}
    <div class="dash-chart-card">
        <div class="dash-chart-header">
            <div>
                <span class="dash-chart-tag">Statistik Penjualan</span>
                <h3 class="dash-chart-title">Revenue <span>Overview</span></h3>
            </div>
            <div class="dash-chart-meta">30 hari terakhir</div>
        </div>
        <div class="dash-chart-body">
            <canvas id="revenueChart" height="110"></canvas>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('revenueChart').getContext('2d');

    const chartDates  = {!! json_encode($chartDates) !!};
    const chartTotals = {!! json_encode($chartTotals) !!};

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartDates,
            datasets: [{
                label: 'Pendapatan',
                data: chartTotals,
                borderColor: '#3e2723',
                borderWidth: 2,
                fill: true,
                backgroundColor: 'rgba(62,39,35,0.07)',
                tension: 0.45,
                pointRadius: 0,
                pointHoverRadius: 5,
                pointBackgroundColor: '#e9e5e3',
                pointBorderColor: '#3e2723',
                pointBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            interaction: { intersect: false, mode: 'index' },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(62,39,35,0.92)',
                    titleColor: 'rgba(245,210,140,0.7)',
                    bodyColor: '#f5d28c',
                    borderColor: 'rgba(255,255,255,0.08)',
                    borderWidth: 1,
                    padding: 12,
                    callbacks: {
                        label: c => 'Rp ' + Math.round(c.parsed.y).toLocaleString('id-ID')
                    }
                }
            },
            scales: {
                x: {
                    grid: { display: false, drawBorder: false },
                    ticks: { color: 'rgba(0,0,0,0.35)', font: { size: 10 } }
                },
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(0,0,0,0.06)', drawBorder: false },
                    ticks: {
                        color: 'rgba(0,0,0,0.35)',
                        font: { size: 10 },
                        callback: v => 'Rp ' + Math.round(v / 1000) + 'rb'
                    }
                }
            }
        }
    });
});
</script>

<style>
html, body { background: #1a1410 !important; }

.dash-page {
    min-height: 100vh;
    background:
        linear-gradient(rgba(0,0,0,0.62), rgba(0,0,0,0.62)),
        url('https://images.unsplash.com/photo-1509042239860-f550ce710b93');
    background-size: cover;
    background-position: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 100px 40px 60px;
    gap: 32px;
}

/* ── Nav Grid ── */
.dash-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 3px;
    width: 100%;
    max-width: 680px;
    border-radius: 20px;
    overflow: hidden;
}

.dash-btn {
    background: rgba(62,39,35,0.82);
    backdrop-filter: blur(8px);
    color: #f5d28c;
    padding: 36px 20px;
    text-align: center;
    font-family: 'Georgia', 'Times New Roman', serif;
    font-size: 17px;
    font-weight: 600;
    text-decoration: none;
    letter-spacing: .01em;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: background .3s ease, color .3s ease;
}

.dash-btn:hover {
    background: rgba(212,167,98,0.88);
    color: #2c1b10;
    text-decoration: none;
}

.dash-btn-num {
    display: block;
    font-family: sans-serif;
    font-size: 10px;
    font-weight: 400;
    letter-spacing: .2em;
    opacity: .45;
    transition: opacity .3s;
}

.dash-btn:hover .dash-btn-num { opacity: .6; }

/* ── Chart Card ── */
.dash-chart-card {
    width: 100%;
    max-width: 680px;
    background: #e9e5e3;
    border-radius: 20px;
    overflow: hidden;
}

.dash-chart-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    padding: 28px 32px 20px;
    border-bottom: 1px solid rgba(0,0,0,.08);
}

.dash-chart-tag {
    display: block;
    font-size: 10px;
    letter-spacing: .22em;
    text-transform: uppercase;
    color: rgba(0,0,0,.38);
    margin-bottom: 6px;
}

.dash-chart-title {
    font-family: 'Georgia', serif;
    font-size: 22px;
    font-weight: 600;
    color: #1a1a1a;
    letter-spacing: -.01em;
    margin: 0;
}

.dash-chart-title span {
    color: transparent;
    -webkit-text-stroke: 1px rgba(0,0,0,.2);
}

.dash-chart-meta {
    font-size: 11px;
    color: rgba(0,0,0,.35);
    letter-spacing: .05em;
    padding-bottom: 4px;
}

.dash-chart-body {
    padding: 24px 32px 28px;
    background: #e9e5e3;
}

/* ── Responsive ── */
@media (max-width: 600px) {
    .dash-grid { grid-template-columns: repeat(2, 1fr); }
    .dash-page { padding: 80px 20px 40px; gap: 20px; }
    .dash-chart-header { flex-direction: column; align-items: flex-start; gap: 8px; }
}
</style>

@endsection