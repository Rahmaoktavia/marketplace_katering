<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    /**
     * Konfigurasi Midtrans.
     */
    private function configureMidtrans(): void
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = (bool) config('midtrans.is_production', false);
        Config::$isSanitized = (bool) config('midtrans.is_sanitized', true);
        Config::$is3ds = (bool) config('midtrans.is_3ds', true);
    }

    /**
     * Membuat transaksi Midtrans dan mengarahkan customer
     * ke halaman pembayaran.
     */
    public function pay(Order $order)
    {
        $user = auth()->user();
        $customer = $user->customer;

        abort_if(!$customer, 403, 'Profil customer belum tersedia.');
        abort_unless($order->customer_id === $customer->id, 404);

        $order->load(['payment', 'items']);

        if (!$order->payment) {
            return back()->with(
                'error',
                'Data pembayaran belum tersedia.'
            );
        }

        $payment = $order->payment;

        if ($payment->status_pembayaran === 'berhasil') {
            return redirect()
                ->route('customer.orders.show', $order)
                ->with('success', 'Pesanan ini sudah dibayar.');
        }

        if (in_array($order->status_pesanan, ['selesai', 'dibatalkan'], true)) {
            return back()->with(
                'error',
                'Pesanan yang sudah selesai atau dibatalkan tidak dapat dibayar.'
            );
        }

        if (
            !config('midtrans.server_key') ||
            !config('midtrans.client_key')
        ) {
            return back()->with(
                'error',
                'Konfigurasi Midtrans belum lengkap. Periksa file konfigurasi dan .env.'
            );
        }

        try {
            $this->configureMidtrans();

            $newTokenNeeded = !$payment->snap_token
                || in_array(
                    $payment->status_pembayaran,
                    ['gagal', 'kedaluwarsa'],
                    true
                );

            if ($newTokenNeeded) {
                $midtransOrderId = $order->nomor_pesanan
                    . '-PAY-'
                    . Str::upper(Str::random(8));

                $itemDetails = $order->items->map(function ($item) {
                    return [
                        'id' => (string) $item->menu_id,
                        'price' => (int) round((float) $item->harga_satuan),
                        'quantity' => (int) $item->jumlah_porsi,
                        'name' => Str::limit($item->nama_menu, 50, ''),
                    ];
                })->values()->all();

                $customerName = $customer->nama_perusahaan
                    ?: ($user->name ?? 'Customer');

                $params = [
                    'transaction_details' => [
                        'order_id' => $midtransOrderId,
                        'gross_amount' => (int) round(
                            (float) $order->total_harga
                        ),
                    ],
                    'customer_details' => [
                        'first_name' => $customerName,
                        'email' => $user->email,
                    ],
                    'item_details' => $itemDetails,
                ];

                if (!empty($customer->kontak)) {
                    $params['customer_details']['phone'] = $customer->kontak;
                }

                $snapToken = Snap::getSnapToken($params);

                $payment->update([
                    'nomor_pesanan_midtrans' => $midtransOrderId,
                    'nomor_transaksi' => null,
                    'metode_pembayaran' => null,
                    'status_pembayaran' => 'menunggu_pembayaran',
                    'snap_token' => $snapToken,
                ]);
            }

            return redirect()->route('customer.payment.index', $order);
        } catch (\Throwable $exception) {
            Log::error('Gagal membuat transaksi Midtrans.', [
                'order_id' => $order->id,
                'message' => $exception->getMessage(),
            ]);

            return back()->with(
                'error',
                'Pembayaran belum dapat dibuka. Periksa konfigurasi Midtrans dan coba kembali.'
            );
        }
    }

    /**
     * Menampilkan halaman pembayaran dengan Snap.
     */
    public function checkout(Order $order)
    {
        $customer = auth()->user()->customer;

        abort_if(!$customer, 403, 'Profil customer belum tersedia.');
        abort_unless($order->customer_id === $customer->id, 404);

        $payment = $order->payment;

        abort_unless(
            $payment && $payment->snap_token,
            404,
            'Token pembayaran belum tersedia.'
        );

        if ($payment->status_pembayaran === 'berhasil') {
            return redirect()->route('customer.payment.success', $order);
        }

        return view('customer.payments.index', [
            'order' => $order,
            'snapToken' => $payment->snap_token,
            'clientKey' => config('midtrans.client_key'),
            'isProduction' => (bool) config('midtrans.is_production', false),
        ]);
    }

    /**
     * Menampilkan hasil/status pembayaran.
     * Status berhasil tetap harus diverifikasi dari database.
     */
    public function success(Order $order)
    {
        $customer = auth()->user()->customer;

        abort_if(!$customer, 403, 'Profil customer belum tersedia.');
        abort_unless($order->customer_id === $customer->id, 404);

        $order->load(['payment', 'invoice']);

        return view('customer.payments.success', [
            'order' => $order,
            'payment' => $order->payment,
        ]);
    }

    /**
     * Endpoint notifikasi Midtrans (webhook).
     */
    public function notification(Request $request)
    {
        $serverKey = config('midtrans.server_key');

        if (!$serverKey) {
            return response()->json([
                'message' => 'Midtrans is not configured.',
            ], 500);
        }

        $data = $request->all();

        $requiredFields = [
            'order_id',
            'status_code',
            'gross_amount',
            'signature_key',
            'transaction_status',
        ];

        foreach ($requiredFields as $field) {
            if (!isset($data[$field])) {
                return response()->json([
                    'message' => "Field {$field} is required.",
                ], 400);
            }
        }

        $expectedSignature = hash(
            'sha512',
            $data['order_id']
                . $data['status_code']
                . $data['gross_amount']
                . $serverKey
        );

        if (!hash_equals($expectedSignature, $data['signature_key'])) {
            return response()->json([
                'message' => 'Invalid signature.',
            ], 403);
        }

        $payment = Payment::where(
            'nomor_pesanan_midtrans',
            $data['order_id']
        )->first();

        if (!$payment) {
            return response()->json([
                'message' => 'Payment not found.',
            ], 404);
        }

        $order = Order::with('invoice')->find($payment->order_id);

        if (!$order) {
            return response()->json([
                'message' => 'Order not found.',
            ], 404);
        }

        $receivedAmount = (int) round((float) $data['gross_amount']);
        $expectedAmount = (int) round((float) $order->total_harga);

        if ($receivedAmount !== $expectedAmount) {
            Log::warning('Nominal notifikasi Midtrans tidak sesuai.', [
                'order_id' => $order->id,
                'received_amount' => $receivedAmount,
                'expected_amount' => $expectedAmount,
            ]);

            return response()->json([
                'message' => 'Transaction amount does not match.',
            ], 422);
        }

        $transactionStatus = $data['transaction_status'];
        $fraudStatus = $data['fraud_status'] ?? null;

        $paymentStatus = null;
        $invoiceStatus = null;

        if (
            $transactionStatus === 'settlement'
            || (
                $transactionStatus === 'capture'
                && $fraudStatus === 'accept'
            )
        ) {
            $paymentStatus = 'berhasil';
            $invoiceStatus = 'berhasil';
        } elseif ($transactionStatus === 'pending') {
            $paymentStatus = 'menunggu_pembayaran';
            $invoiceStatus = 'menunggu pembayaran';
        } elseif ($transactionStatus === 'expire') {
            $paymentStatus = 'kedaluwarsa';
            $invoiceStatus = 'kedaluwarsa';
        } elseif (
            in_array($transactionStatus, ['deny', 'cancel'], true)
        ) {
            $paymentStatus = 'gagal';
            $invoiceStatus = 'gagal';
        } else {
            // Status lain, seperti refund, tidak diubah otomatis.
            return response()->json([
                'message' => 'Notification received; no status change applied.',
            ]);
        }

        DB::transaction(function () use (
            $payment,
            $order,
            $data,
            $paymentStatus,
            $invoiceStatus
        ) {
            $lockedPayment = Payment::whereKey($payment->id)
                ->lockForUpdate()
                ->first();

            if (!$lockedPayment) {
                return;
            }

            // Pembayaran yang sudah berhasil tidak boleh diturunkan
            // kembali menjadi pending, gagal, atau kedaluwarsa.
            if ($lockedPayment->status_pembayaran === 'berhasil') {
                return;
            }

            $lockedPayment->update([
                'status_pembayaran' => $paymentStatus,
                'nomor_transaksi' => $data['transaction_id'] ?? null,
                'metode_pembayaran' => $data['payment_type'] ?? null,
            ]);

            $lockedOrder = Order::with('invoice')->find($order->id);

            if ($lockedOrder && $lockedOrder->invoice) {
                $lockedOrder->invoice->update([
                    'status_pembayaran' => $invoiceStatus,
                ]);
            }
        });

        return response()->json([
            'message' => 'Notification processed successfully.',
        ]);
    }
}
