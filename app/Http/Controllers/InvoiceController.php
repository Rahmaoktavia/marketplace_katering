<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    private function merchant()
    {
        $merchant = auth()->user()->merchant;

        abort_if(!$merchant, 404, 'Profil usaha tidak ditemukan.');

        return $merchant;
    }

    public function show(Invoice $invoice)
    {
        $merchant = $this->merchant();

        // Pastikan invoice milik pesanan merchant yang sedang login.
        abort_unless(
            $invoice->order()
                ->where('merchant_id', $merchant->id)
                ->exists(),
            404
        );

        $invoice->load([
            'order.items',
            'order.payment',
        ]);

        return view('merchant.invoices.show', compact('invoice'));
    }

    public function customerShow(Invoice $invoice)
    {
        $customer = auth()->user()->customer;

        abort_if(!$customer, 403, 'Profil customer belum tersedia.');

        abort_unless(
            $invoice->order()
                ->where('customer_id', $customer->id)
                ->exists(),
            404
        );

        $invoice->load([
            'order.merchant',
            'order.items',
            'order.payment',
        ]);

        return view('customer.invoices.show', compact('invoice'));
    }
}
