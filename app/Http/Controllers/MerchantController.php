<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MerchantController extends Controller
{
        public function index()
    {
        $merchant = auth()->user()->merchant;

        abort_if(!$merchant, 404, 'Profil usaha tidak ditemukan.');

        return view('merchant.profile.index', compact('merchant'));
    }

    public function edit()
    {
        $merchant = auth()->user()->merchant;

        abort_if(!$merchant, 404, 'Profil usaha tidak ditemukan.');

        return view('merchant.profile.edit', compact('merchant'));
    }

    public function update(Request $request)
    {
        $merchant = auth()->user()->merchant;

        abort_if(!$merchant, 404, 'Profil usaha tidak ditemukan.');

        $validated = $request->validate([
            'nama_perusahaan' => ['required', 'string', 'max:150'],
            'alamat' => ['nullable', 'string'],
            'kota' => ['nullable', 'string', 'max:100'],
            'kontak' => ['nullable', 'string', 'max:20'],
            'deskripsi' => ['nullable', 'string'],
        ]);

        $merchant->update($validated);

        return redirect()
            ->route('merchant.profile.index')
            ->with('success', 'Profil usaha berhasil diperbarui.')
            ->with('success_type', 'edit')  ;
    }
}
