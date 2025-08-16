{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard Admin</h1>

    {{-- Statistik Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white shadow rounded-xl p-6">
            <h2 class="text-lg font-semibold text-gray-600">Total Dana Desa</h2>
            <p class="text-2xl font-bold text-indigo-600 mt-2">
                Rp {{ number_format($totalDanaDesa,0,',','.') }}
            </p>
        </div>

        <div class="bg-white shadow rounded-xl p-6">
            <h2 class="text-lg font-semibold text-gray-600">Total Pengeluaran</h2>
            <p class="text-2xl font-bold text-red-500 mt-2">
                Rp {{ number_format($totalPengeluaran,0,',','.') }}
            </p>
        </div>

        <div class="bg-white shadow rounded-xl p-6">
            <h2 class="text-lg font-semibold text-gray-600">Jumlah Staff</h2>
            <p class="text-2xl font-bold text-green-600 mt-2">{{ $jumlahStaff }}</p>
        </div>
    </div>

    {{-- Chart Section --}}
    <div class="bg-white shadow rounded-xl p-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Grafik Dana Desa per Tahun</h2>
        <canvas id="danaChart" class="w-full h-64"></canvas>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('danaChart');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($tahun),
                datasets: [{
                    label: 'Dana Desa',
                    data: @json($jumlahDana),
                    backgroundColor: 'rgba(99, 102, 241, 0.7)',
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
@endpush
