@extends('layouts.app')

@section('content')

@include('admin.navbar_admin')

<div class="dash-page">

    {{-- Metric Cards --}}
    <div class="dash-metrics">
        <div class="dash-mc">
            <div class="dash-mc-lbl">Pendapatan hari ini</div>
            <div class="dash-mc-val">Rp {{ number_format($pendapatanHariIni ?? 0, 0, ',', '.') }}</div>
            <div class="dash-mc-sub" style="color:#5a8a3a">&#8593; vs kemarin</div>
        </div>
        <div class="dash-mc">
            <div class="dash-mc-lbl">Total pesanan</div>
            <div class="dash-mc-val">{{ $totalPesanan ?? 0 }}</div>
            <div class="dash-mc-sub">hari ini</div>
        </div>
        <div class="dash-mc dash-mc-warn">
            <div class="dash-mc-lbl">Belum dikonfirmasi</div>
            <div class="dash-mc-val">{{ $pesananBelumKonfirmasi ?? 0 }}</div>
            <div class="dash-mc-sub">&#9679; Perlu tindakan</div>
        </div>
        <div class="dash-mc">
            <div class="dash-mc-lbl">Reservasi aktif</div>
            <div class="dash-mc-val">{{ $reservasiAktif ?? 0 }}</div>
            <div class="dash-mc-sub">{{ $reservasiHariIni ?? 0 }} untuk hari ini</div>
        </div>
        <div class="dash-mc">
            <div class="dash-mc-lbl">Ulasan baru</div>
            <div class="dash-mc-val">{{ $ulasanBaru ?? 0 }}</div>
            <div class="dash-mc-sub">Belum dibalas</div>
        </div>
    </div>

    {{-- Chart Card --}}
    <div class="dash-chart-card">
        <div class="dash-chart-header">
            <div>
                <div class="dash-chart-title">Statistik penjualan</div>
                <div class="dash-chart-sub" id="chartRangeLabel">Harian</div>
            </div>
            <div class="dash-chart-controls">
                {{-- Period Tabs --}}
                <div class="dash-ptabs">
                    <span class="dash-pt active" data-value="day">Harian</span>
                    <span class="dash-pt" data-value="week">Mingguan</span>
                    <span class="dash-pt" data-value="month">Bulanan</span>
                    <span class="dash-pt" data-value="year">Tahunan</span>
                </div>
                {{-- Export --}}
                <a href="{{ route('admin.export') }}" class="dash-export-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                    </svg>
                    Export Excel
                </a>
            </div>
        </div>

        <div class="dash-chart-body">
            <canvas id="revenueChart" height="110"></canvas>
        </div>

        <div class="dash-chart-footer">
            <div>
                <div class="dash-cf-val" id="cf-peak">—</div>
                <div class="dash-cf-lbl">Tertinggi</div>
            </div>
            <div>
                <div class="dash-cf-val" id="cf-avg">—</div>
                <div class="dash-cf-lbl">Rata-rata</div>
            </div>
            <div>
                <div class="dash-cf-val" id="cf-total">—</div>
                <div class="dash-cf-lbl">Total periode</div>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('revenueChart').getContext('2d');

    const allData = {
        day:   { dates: {!! json_encode($chartDates ?? []) !!},   totals: {!! json_encode($chartTotals ?? []) !!},   label: 'Harian' },
        week:  { dates: {!! json_encode($chartDatesWeek ?? $chartDates ?? []) !!},  totals: {!! json_encode($chartTotalsWeek ?? $chartTotals ?? []) !!},  label: 'Mingguan' },
        month: { dates: {!! json_encode($chartDatesMonth ?? $chartDates ?? []) !!}, totals: {!! json_encode($chartTotalsMonth ?? $chartTotals ?? []) !!}, label: 'Bulanan' },
        year:  { dates: {!! json_encode($chartDatesYear ?? $chartDates ?? []) !!},  totals: {!! json_encode($chartTotalsYear ?? $chartTotals ?? []) !!},  label: 'Tahunan' },
    };

    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: allData.day.dates,
            datasets: [{
                label: 'Pendapatan',
                data: allData.day.totals,
                borderColor: '#5c2e14',
                borderWidth: 2,
                fill: true,
                backgroundColor: function(context) {
                    const g = context.chart.ctx.createLinearGradient(0, 0, 0, 220);
                    g.addColorStop(0, 'rgba(92,46,20,0.10)');
                    g.addColorStop(1, 'rgba(92,46,20,0)');
                    return g;
                },
                tension: 0.45,
                pointRadius: 0,
                pointHoverRadius: 5,
                pointBackgroundColor: '#e9e5e3',
                pointBorderColor: '#5c2e14',
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
                    titleColor: 'rgba(245,210,140,0.8)',
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
                    grid: { display: false },
                    ticks: { color: '#b09070', font: { size: 10 } },
                    border: { display: false }
                },
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(61,31,16,0.07)' },
                    ticks: {
                        color: '#b09070',
                        font: { size: 10 },
                        callback: v => 'Rp ' + Math.round(v / 1000) + 'rb'
                    },
                    border: { display: false }
                }
            }
        }
    });

    function updateFooter(totals) {
        if (!totals.length) return;
        const peak  = Math.max(...totals);
        const avg   = totals.reduce((a,b) => a+b, 0) / totals.length;
        const total = totals.reduce((a,b) => a+b, 0);
        const fmt   = n => 'Rp ' + Math.round(n).toLocaleString('id-ID');
        document.getElementById('cf-peak').textContent  = fmt(peak);
        document.getElementById('cf-avg').textContent   = fmt(avg);
        document.getElementById('cf-total').textContent = fmt(total);
    }

    updateFooter(allData.day.totals);

    document.querySelectorAll('.dash-pt').forEach(tab => {
        tab.addEventListener('click', () => {
            document.querySelectorAll('.dash-pt').forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            const key = tab.dataset.value;
            const d   = allData[key];
            chart.data.labels              = d.dates;
            chart.data.datasets[0].data   = d.totals;
            chart.update();
            document.getElementById('chartRangeLabel').textContent = d.label;
            updateFooter(d.totals);
        });
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
    gap: 20px;
}

/* ── Metric Cards ── */
.dash-metrics {
    display: grid;
    grid-template-columns: repeat(5, minmax(0, 1fr));
    gap: 8px;
    width: 100%;
    max-width: 780px;
}

.dash-mc {
    background: rgba(250,247,244,0.92);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(61,31,16,0.15);
    border-radius: 12px;
    padding: .75rem 1rem;
}

.dash-mc-warn {
    background: rgba(255,244,230,0.95);
    border-color: rgba(180,100,0,0.2);
}

.dash-mc-lbl {
    font-size: 10px;
    color: #b09070;
    margin-bottom: 4px;
    letter-spacing: .02em;
}

.dash-mc-val {
    font-size: 18px;
    font-weight: 600;
    color: #3d1f10;
    line-height: 1;
}

.dash-mc-warn .dash-mc-val { color: #7a4a00; }
.dash-mc-warn .dash-mc-lbl { color: rgba(122,74,0,0.75); }

.dash-mc-sub {
    font-size: 10px;
    color: #b09070;
    margin-top: 4px;
}

/* ── Chart Card ── */
.dash-chart-card {
    width: 100%;
    max-width: 780px;
    background: rgba(250,247,244,0.96);
    backdrop-filter: blur(8px);
    border-radius: 16px;
    border: 1px solid rgba(61,31,16,0.12);
    overflow: hidden;
}

.dash-chart-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1.1rem 1.5rem;
    border-bottom: 1px solid rgba(61,31,16,0.08);
    gap: 12px;
}

.dash-chart-title {
    font-family: 'Georgia', serif;
    font-size: 15px;
    font-weight: 600;
    color: #2a1508;
    margin: 0;
}

.dash-chart-sub {
    font-size: 11px;
    color: #b09070;
    margin-top: 2px;
}

.dash-chart-controls {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-shrink: 0;
}

.dash-ptabs {
    display: flex;
    background: #f0ebe4;
    border-radius: 7px;
    padding: 2px;
    gap: 2px;
    border: 1px solid rgba(61,31,16,0.12);
}

.dash-pt {
    font-size: 11px;
    color: #7a5c47;
    padding: 4px 10px;
    border-radius: 5px;
    cursor: pointer;
    white-space: nowrap;
    user-select: none;
    transition: background .15s, color .15s;
}

.dash-pt.active {
    background: #3d1f10;
    color: #c8a96e;
    font-weight: 600;
}

.dash-pt:not(.active):hover {
    background: #e8d9bc;
    color: #3d1f10;
}

.dash-export-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 11px;
    font-weight: 600;
    padding: 6px 13px;
    border-radius: 7px;
    background: #217346;
    color: #d4edbb;
    text-decoration: none;
    border: 1px solid #1e613b;
    white-space: nowrap;
    transition: opacity .2s;
}

.dash-export-btn:hover { opacity: .85; color: #d4edbb; text-decoration: none; }

.dash-chart-body {
    padding: 1.25rem 1.5rem .75rem;
}

.dash-chart-footer {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
    padding: .75rem 1.5rem 1.1rem;
    border-top: 1px solid rgba(61,31,16,0.08);
}

.dash-cf-val {
    font-size: 13px;
    font-weight: 600;
    color: #3d1f10;
}

.dash-cf-lbl {
    font-size: 10px;
    color: #b09070;
    margin-top: 2px;
}

/* ── Responsive ── */
@media (max-width: 640px) {
    .dash-metrics { grid-template-columns: repeat(2, 1fr); }
    .dash-chart-header { flex-direction: column; align-items: flex-start; }
    .dash-page { padding: 80px 16px 40px; }
}
</style>

@endsection