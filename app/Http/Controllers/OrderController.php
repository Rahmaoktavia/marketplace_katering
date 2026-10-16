<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Menu;
use App\Models\Invoice;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class OrderController extends Controller
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

        $orders = $merchant->orders()
            ->with(['customer', 'invoice', 'payment'])
            ->withCount('items')
            ->when($search, function ($query, $search) {
                $query->whereHas('customer', function ($customerQuery) use ($search) {
                    $customerQuery->where('nama_perusahaan', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('merchant.orders.index', compact('orders', 'search'));
    }

    public function show(Order $order)
    {
        $merchant = auth()->user()->merchant;

        abort_if(!$merchant, 404, 'Profil usaha tidak ditemukan.');

        abort_unless(
            $order->merchant_id === $merchant->id,
            403,
            'Kamu tidak memiliki akses ke pesanan ini.'
        );

        $order->load([
            'items',
            'invoice',
            'payment',
        ]);

        return view('merchant.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $merchant = $this->merchant();
        abort_unless($order->merchant_id === $merchant->id, 404);

        $validated = $request->validate([
            'status_pesanan' => [
                'required',
                Rule::in([
                    'menunggu_konfirmasi',
                    'dikonfirmasi',
                    'diproses',
                    'selesai',
                    'dibatalkan',
                ]),
            ],
        ]);

        // Pesanan yang sudah selesai atau dibatalkan tidak dibuka kembali.
        if (in_array($order->status_pesanan, ['selesai', 'dibatalkan'], true)) {
            return back()->with('error', 'Status pesanan yang sudah selesai atau dibatalkan tidak dapat diubah.');
        }

        $order->update($validated);

        return redirect()
            ->route('merchant.orders.show', $order)
            ->with('success', 'Status pesanan berhasil diperbarui.')
            ->with('success_type', 'edit');
    }

        private function getAuthenticatedCustomer(): Customer
    {
        $customer = auth()->user()->customer;

        abort_if(!$customer, 403, 'Profil customer belum tersedia.');

        return $customer;
    }

    public function customerCheckout(Menu $menu)
    {
        abort_unless($menu->tersedia, 404, 'Menu tidak tersedia.');

        $menu->load(['merchant', 'category']);

        abort_if(!$menu->merchant, 404);

        return view('customer.checkout.create', compact('menu'));
    }

    public function customerCheckoutStore(Request $request, Menu $menu)
    {
        $customer = $this->getAuthenticatedCustomer();

        $validated = $request->validate([
            'jumlah_porsi' => ['required', 'integer', 'min:1', 'max:10000'],
            'tanggal_pengiriman' => ['required', 'date', 'after_or_equal:today'],
            'alamat_pengiriman' => ['required', 'string', 'max:2000'],
            'catatan' => ['nullable', 'string', 'max:1000'],
        ]);

        $order = DB::transaction(function () use (
            $customer,
            $menu,
            $validated
        ) {
            $currentMenu = Menu::query()
                ->whereKey($menu->id)
                ->where('tersedia', true)
                ->lockForUpdate()
                ->firstOrFail();

            $total = (float) $currentMenu->harga
                * (int) $validated['jumlah_porsi'];

            $order = Order::create([
                'nomor_pesanan' => 'ORD-' . now()->format('YmdHis')
                    . '-' . Str::upper(Str::random(5)),
                'customer_id' => $customer->id,
                'merchant_id' => $currentMenu->merchant_id,
                'tanggal_pengiriman' => $validated['tanggal_pengiriman'],
                'alamat_pengiriman' => $validated['alamat_pengiriman'],
                'catatan' => $validated['catatan'] ?? null,
                'total_harga' => $total,
                'status_pesanan' => 'menunggu_konfirmasi',
            ]);

            $order->items()->create([
                'menu_id' => $currentMenu->id,
                'nama_menu' => $currentMenu->nama_menu,
                'jumlah_porsi' => (int) $validated['jumlah_porsi'],
                'harga_satuan' => $currentMenu->harga,
                'subtotal' => $total,
            ]);

            Invoice::create([
                'order_id' => $order->id,
                'nomor_invoice' => 'INV-' . now()->format('YmdHis')
                    . '-' . Str::upper(Str::random(5)),
                'tanggal_terbit' => now(),
                'tanggal_jatuh_tempo' => now()->addDay()->toDateString(),
                'status_pembayaran' => 'menunggu_pembayaran',
            ]);

            $order->payment()->create([
                'status_pembayaran' => 'menunggu_pembayaran',
            ]);

            return $order;
        });

        return redirect()
            ->route('customer.orders.show', $order)
            ->with('success', 'Pesanan berhasil dibuat. Silakan lanjutkan pembayaran.');
    }

    public function customerCheckoutIndex()
    {
        $orders = $this->getAuthenticatedCustomer()
            ->orders()
            ->with(['merchant', 'invoice', 'payment', 'items.menu'])
            ->latest()
            ->paginate(10);

        return view('customer.orders.index', compact('orders'));
    }

    public function customerCheckoutShow(Order $order)
    {
        $customer = $this->getAuthenticatedCustomer();

        abort_unless($order->customer_id === $customer->id, 404);

        $order->load(['merchant', 'items', 'invoice', 'payment']);

        $order->loadMissing(['merchant', 'payment', 'invoice', 'items.menu']);

        return view('customer.orders.show', compact('order'));
    }
}
