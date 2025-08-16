<?php

namespace App\Http\Controllers;

use App\Models\DanaDesa;
use App\Models\Keuangan;
use App\Models\StaffProfile;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Tampilkan dashboard admin dengan statistik dan data chart.
     */
    public function index()
    {
        // Total dana desa
        $totalDanaDesa = DanaDesa::sum('jumlah');

        // Total pengeluaran keuangan
        $totalPengeluaran = Keuangan::sum('jumlah');

        // Jumlah staff
        $jumlahStaff = StaffProfile::count();

        // Data untuk chart: Dana Desa per tahun
        $danaDesaPerTahun = DanaDesa::select('tahun')
            ->selectRaw('SUM(jumlah) as total')
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->get();

        $chartLabels = $danaDesaPerTahun->pluck('tahun');
        $chartData = $danaDesaPerTahun->pluck('total');

        return view('admin.dashboard', [
            'totalDanaDesa' => $totalDanaDesa,
            'totalPengeluaran' => $totalPengeluaran,
            'tahun' => $danaDesaPerTahun->pluck('tahun'),
            'jumlahDana' => $danaDesaPerTahun->pluck('total'),
            'jumlahStaff' => $jumlahStaff,
            'chartLabels' => $chartLabels,
            'chartData' => $chartData,
        ]);
    }
}
