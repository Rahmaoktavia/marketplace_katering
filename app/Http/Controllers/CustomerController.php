<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        $customer = $user->customer()->firstOrNew();

        return view('customer.profile.index', compact(
            'user',
            'customer'
        ));
    }

    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'nama_perusahaan' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'kontak' => [
                'nullable',
                'string',
                'max:20',
            ],
            'kota' => [
                'nullable',
                'string',
                'max:100',
            ],
            'alamat' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ], [
            'nama_perusahaan.required' => 'Nama perusahaan wajib diisi.',
            'nama_perusahaan.max' => 'Nama perusahaan maksimal 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan akun lain.',
            'kontak.max' => 'Kontak maksimal 20 karakter.',
            'kota.max' => 'Nama kota maksimal 100 karakter.',
            'alamat.max' => 'Alamat maksimal 1000 karakter.',
        ]);

        DB::transaction(function () use ($user, $validated) {
            // Perbarui email pada akun pengguna.
            $user->email = $validated['email'];
            $user->save();

            // Ambil profil milik user yang sedang login.
            // Jika belum ada, buat profil baru.
            $customer = $user->customer()->firstOrNew();

            $customer->user_id = $user->id;
            $customer->nama_perusahaan = $validated['nama_perusahaan'];
            $customer->kontak = $validated['kontak'] ?? null;
            $customer->kota = $validated['kota'] ?? null;
            $customer->alamat = $validated['alamat'] ?? null;

            $customer->save();
        });

        return redirect()
            ->route('customer.profile.index')
            ->with('success', 'Profil usaha berhasil diperbarui.')
            ->with('success_type', 'edit');
    }
}