<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class MerchantDashboardController extends Controller
{
    public function index()
    {
        $merchant = auth()->user()->merchant;

        abort_if(!$merchant, 404, 'Profil usaha tidak ditemukan.');

        // Ringkasan menu dan pesanan
        $totalMenu = $merchant->menus()->count();

        $menuTersedia = $merchant->menus()
            ->where('tersedia', true)
            ->count();

        $totalPesanan = $merchant->orders()->count();

        $pesananMenunggu = $merchant->orders()
            ->where('status_pesanan', 'menunggu_konfirmasi')
            ->count();

        // Tren pesanan selama 7 hari terakhir
        $awalPeriode = now()->subDays(6)->startOfDay();

        $dataPesanan = $merchant->orders()
            ->where('created_at', '>=', $awalPeriode)
            ->where('status_pesanan', '!=', 'dibatalkan')
            ->selectRaw('DATE(created_at) as tanggal, COUNT(*) as total')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->pluck('total', 'tanggal');

        $labelGrafikPesanan = [];
        $dataGrafikPesanan = [];

        for ($i = 6; $i >= 0; $i--) {
            $tanggal = now()->subDays($i)->toDateString();

            $labelGrafikPesanan[] = now()
                ->subDays($i)
                ->translatedFormat('d M');

            $dataGrafikPesanan[] = (int) ($dataPesanan[$tanggal] ?? 0);
        }

        // 5 menu terlaris berdasarkan total porsi pesanan
        $menuTerlaris = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.merchant_id', $merchant->id)
            ->where('orders.status_pesanan', '!=', 'dibatalkan')
            ->select('order_items.nama_menu')
            ->selectRaw('SUM(order_items.jumlah_porsi) as total_porsi')
            ->groupBy('order_items.nama_menu')
            ->orderByDesc('total_porsi')
            ->limit(5)
            ->get();

        // Pesanan terbaru
        $pesananTerbaru = $merchant->orders()
            ->with('customer')
            ->latest()
            ->limit(5)
            ->get();

        return view('merchant.dashboard', compact(
            'totalMenu',
            'menuTersedia',
            'totalPesanan',
            'pesananMenunggu',
            'labelGrafikPesanan',
            'dataGrafikPesanan',
            'menuTerlaris',
            'pesananTerbaru'
        ));
    }
}
