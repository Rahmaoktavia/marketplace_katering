<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    private function merchant()
    {
        $merchant = auth()->user()->merchant;

        abort_if(!$merchant, 404, 'Profil usaha tidak ditemukan.');

        return $merchant;
    }


    public function index(Request $request)
    {
        $merchant = $this->merchant();
        $search = $request->query('search');

        $menus = $merchant->menus()
            ->with('category')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_menu', 'like', "%{$search}%")
                        ->orWhereHas('category', function ($categoryQuery) use ($search) {
                            $categoryQuery->where(
                                'nama_kategori',
                                'like',
                                "%{$search}%"
                            );
                        });
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('merchant.menus.index', compact('menus', 'search'));
    }


    public function create()
    {
        $categories = MenuCategory::query()
            ->where('merchant_id', auth()->user()->merchant->id)
            ->orderBy('nama_kategori')
            ->get();

        return view('merchant.menus.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $merchant = $this->merchant();

        $validated = $request->validate([
            'menu_category_id' => [
                'required',
                Rule::exists('menu_categories', 'id'),
            ],
            'nama_menu' => ['required', 'string', 'max:150'],
            'deskripsi' => ['required', 'string'],
            'harga' => ['required', 'numeric', 'min:0', 'max:9999999999.99'],
            'foto' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'tersedia' => ['required', 'boolean'],
        ]);

        $validated['foto'] = $request->file('foto')->store('menus', 'public');

        $merchant->menus()->create($validated);

        return redirect()
            ->route('merchant.menus.index')
            ->with('success', 'Menu katering berhasil ditambahkan.')
            ->with('success_type', 'create');
    }

    public function edit(Menu $menu)
    {
        $merchant = $this->merchant();
        abort_unless($menu->merchant_id === $merchant->id, 404);

        $categories = MenuCategory::query()
            ->where('merchant_id', auth()->user()->merchant->id)
            ->orderBy('nama_kategori')
            ->get();

        return view('merchant.menus.edit', compact('menu', 'categories'));
    }

    public function update(Request $request, Menu $menu)
    {
        $merchant = $this->merchant();
        abort_unless($menu->merchant_id === $merchant->id, 404);

        $validated = $request->validate([
            'menu_category_id' => [
                'required',
                Rule::exists('menu_categories', 'id'),
            ],
            'nama_menu' => ['required', 'string', 'max:150'],
            'deskripsi' => ['required', 'string'],
            'harga' => ['required', 'numeric', 'min:0', 'max:9999999999.99'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'tersedia' => ['required', 'boolean'],
        ]);

        if ($request->hasFile('foto')) {
            if ($menu->foto && Storage::disk('public')->exists($menu->foto)) {
                Storage::disk('public')->delete($menu->foto);
            }

            $validated['foto'] = $request->file('foto')->store('menus', 'public');
        } else {
            unset($validated['foto']);
        }

        $menu->update($validated);

        return redirect()
            ->route('merchant.menus.index')
            ->with('success', 'Menu katering berhasil diperbarui.')
            ->with('success_type', 'edit');
    }

    public function destroy(Menu $menu)
    {
        $merchant = $this->merchant();
        abort_unless($menu->merchant_id === $merchant->id, 404);

        // Soft delete agar riwayat order_items tetap mengacu pada menu.
        $menu->delete();

        return redirect()
            ->route('merchant.menus.index')
            ->with('success', 'Menu katering berhasil dihapus.')
            ->with('success_type', 'delete');
    }
}
