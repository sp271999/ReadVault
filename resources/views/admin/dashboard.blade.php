@extends('layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen px-6 py-6">

    <!-- HEADER -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Dashboard Analytics</h2>
        <p class="text-sm text-gray-500">Library overview</p>
    </div>

    <!-- FULL WIDTH DASHBOARD -->
    <div class="flex gap-8 w-full min-h-[500px]">

    <!-- PIE CHART -->
    <div class="bg-white rounded-xl shadow p-6 flex-1 flex flex-col">
        <h3 class="text-lg font-semibold mb-4 text-center">
            Books by Category
        </h3>
        <div class="flex-1">
            <canvas id="categoryPie"></canvas>
        </div>
    </div>

    <!-- BAR CHART -->
    <div class="bg-white rounded-xl shadow p-6 flex-1 flex flex-col">
        <h3 class="text-lg font-semibold mb-4 text-center">
            Month-wise Borrowed Books
        </h3>
        <div class="flex-1">
            <canvas id="borrowBarChart"></canvas>
        </div>
    </div>

</div>

{{-- 📊 Stats Cards --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

    {{-- Total Users --}}
    <div class="bg-white rounded-xl shadow p-6 text-center">
        <h3 class="text-gray-500 text-sm uppercase mb-2">Total Users</h3>
        <p class="text-3xl font-bold text-blue-600">
            {{ $totalUsers }}
        </p>
    </div>

    {{-- You can add more cards later --}}
</div>



<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    /* =========================
       PIE CHART
    ========================== */
    new Chart(document.getElementById('categoryPie'), {
        type: 'pie',
        data: {
            labels: @json($labels),
            datasets: [{
                data: @json($values),
                backgroundColor: [
                    '#4F46E5',
                    '#22C55E',
                    '#F97316',
                    '#EF4444',
                    '#06B6D4',
                    '#A855F7'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' },
                datalabels: {
                    color: '#fff',
                    font: { weight: 'bold', size: 18 },
                    formatter: value => value
                }
            }
        },
        plugins: [ChartDataLabels]
    });

    /* =========================
       BAR CHART
    ========================== */
    new Chart(document.getElementById('borrowBarChart'), {
        type: 'bar',
        data: {
            labels: @json($monthLabels),
            datasets: [{
                label: 'Books Borrowed',
                data: @json($monthValues),
                backgroundColor: '#4F46E5',
                borderRadius: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });

});
</script>
@endsection
