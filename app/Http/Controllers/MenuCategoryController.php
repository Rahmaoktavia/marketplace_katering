<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuCategory;
use Illuminate\Validation\Rule;

class MenuCategoryController extends Controller
{
    public function index(Request $request)
    {
        $merchantId = $this->currentMerchantId();
        $search = $request->query('search');

        $categories = MenuCategory::query()
            ->where('merchant_id', $merchantId)
            ->withCount([
                'menus' => function ($query) use ($merchantId) {
                    $query->where('merchant_id', $merchantId);
                },
            ])
            ->when($search, function ($query, $search) {
                $query->where(
                    'nama_kategori',
                    'like',
                    "%{$search}%"
                );
            })
            ->orderBy('nama_kategori')
            ->paginate(10)
            ->withQueryString();

        return view('merchant.categories.index',compact('categories', 'search'));
    }

    public function create()
    {
        return view('merchant.categories.create');
    }

    public function store(Request $request)
    {
        $merchantId = $this->currentMerchantId();

        $validated = $request->validate([
            'nama_kategori' => [
                'required',
                'string',
                'max:100',
                Rule::unique('menu_categories', 'nama_kategori')
                    ->where(fn ($query) =>
                        $query->where('merchant_id', $merchantId)
                    ),
            ],
            'deskripsi' => ['nullable', 'string'],
        ]);

        $validated['merchant_id'] = $merchantId;

        MenuCategory::create($validated);

        return redirect()
            ->route('merchant.categories.index')
            ->with('success', 'Kategori menu berhasil ditambahkan.')
            ->with('success_type', 'create');
    }


    public function edit(MenuCategory $category)
    {
        $this->ensureOwnCategory($category);

        return view('merchant.categories.edit', compact('category'));
    }

   public function update(Request $request, MenuCategory $category)
    {
        $this->ensureOwnCategory($category);

        $merchantId = $this->currentMerchantId();

        $validated = $request->validate([
            'nama_kategori' => [
                'required',
                'string',
                'max:100',
                Rule::unique('menu_categories', 'nama_kategori')
                    ->where(fn ($query) =>
                        $query->where('merchant_id', $merchantId)
                    )
                    ->ignore($category->id),
            ],
            'deskripsi' => ['nullable', 'string'],
        ]);

        $category->update($validated);

        return redirect()
            ->route('merchant.categories.index')
            ->with('success', 'Kategori menu berhasil diperbarui.')
            ->with('success_type', 'edit');
    }
    public function destroy(MenuCategory $category)
    {
        $this->ensureOwnCategory($category);

        if ($category->menus()->exists()) {
            return redirect()
                ->route('merchant.categories.index')
                ->with('error', 'Kategori tidak dapat dihapus karena masih digunakan oleh menu.');
        }

        $category->delete();

        return redirect()
            ->route('merchant.categories.index')
            ->with('success', 'Kategori menu berhasil dihapus.')
            ->with('success_type', 'delete');
    }

    private function currentMerchantId(): int
    {
        $merchantId = auth()->user()->merchant?->id;

        abort_unless($merchantId, 403, 'Profil merchant tidak ditemukan.');

        return (int) $merchantId;
    }

    private function ensureOwnCategory(MenuCategory $category): void
    {
        abort_unless(
            (int) $category->merchant_id === $this->currentMerchantId(),
            404
        );
    }
}

