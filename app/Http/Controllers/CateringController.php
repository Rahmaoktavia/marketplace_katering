<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\MenuCategory;

class CateringController extends Controller
{
    public function index(Request $request)
    {
        $menus = Menu::query()
            ->with(['merchant', 'category'])
            ->where('tersedia', true)
            ->whereHas('merchant')
            ->whereHas('merchant.user', function ($query) {
                $query->where('role', 'merchant');
            })
            ->when($request->filled('q'), function ($query) use ($request) {
                $keyword = trim($request->q);

                $query->where(function ($query) use ($keyword) {
                    $query->where('nama_menu', 'like', "%{$keyword}%")
                        ->orWhereHas('merchant', function ($merchantQuery) use ($keyword) {
                            $merchantQuery->where('nama_perusahaan', 'like', "%{$keyword}%");
                        });
                });
            })
            ->when($request->filled('kota'), function ($query) use ($request) {
                $query->whereHas('merchant', function ($merchantQuery) use ($request) {
                    $merchantQuery->where('kota', 'like', '%' . trim($request->kota) . '%');
                });
            })
            ->when($request->filled('kategori'), function ($query) use ($request) {
                $query->where('menu_category_id', $request->kategori);
            })
            ->latest()
            ->paginate(9)
            ->withQueryString();

        $categories = MenuCategory::orderBy('nama_kategori')->get();

        $cities = Menu::query()
            ->where('tersedia', true)
            ->whereHas('merchant')
            ->with('merchant:id,kota')
            ->get()
            ->pluck('merchant.kota')
            ->filter()
            ->unique()
            ->sort()
            ->values();

        return view('customer.caterings.index', compact(
            'menus',
            'categories',
            'cities'
        ));
    }
}
