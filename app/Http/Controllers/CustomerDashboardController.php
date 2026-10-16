<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\View\View;

class CustomerDashboardController extends Controller
{
    public function index(): View
    {
        // Tiga menu terbaru yang tersedia.
        $menus = Menu::query()
            ->with(['merchant', 'category'])
            ->where('tersedia', true)
            ->whereHas('merchant')
            ->latest()
            ->take(3)
            ->get();

        // Kategori yang mempunyai menu tersedia.
        $categories = MenuCategory::query()
            ->whereHas('menus', function ($query) {
                $query->where('tersedia', true)
                    ->whereHas('merchant');
            })
            ->withCount([
                'menus' => function ($query) {
                    $query->where('tersedia', true)
                        ->whereHas('merchant');
                },
            ])
            ->orderBy('nama_kategori')
            ->take(6)
            ->get();

        return view('customer.dashboard', compact(
            'menus',
            'categories'
        ));
    }
}
