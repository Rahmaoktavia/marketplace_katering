<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    // Halaman untuk memilih jenis akun.
    public function showRegisterChoice()
    {
        return view('auth.register-choice');
    }

    // Form pendaftaran Merchant.
    public function showRegisterMerchant()
    {
        return view('auth.register-merchant');
    }

    // Form pendaftaran Customer.
    public function showRegisterCustomer()
    {
        return view('auth.register-customer');
    }

    // Memproses pendaftaran kedua jenis akun.
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama_perusahaan' => 'required|string|max:150',
            'email' => 'required|email|max:150|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => [
                'required',
                Rule::in(['merchant', 'customer']),
            ],
        ]);

        $user = DB::transaction(function () use ($validated) {
            $user = User::create([
                'nama' => $validated['nama_perusahaan'],
                'email' => $validated['email'],
                'password' => $validated['password'],
                'role' => $validated['role'],
            ]);

            $profile = [
                'nama_perusahaan' => $validated['nama_perusahaan'],
                'alamat' => null,
                'kota' => null,
                'kontak' => null,
            ];

            if ($user->role === 'merchant') {
                $user->merchant()->create($profile);
            } else {
                $user->customer()->create($profile);
            }

            return $user;
        });

        Auth::login($user);
        $request->session()->regenerate();

        return $this->redirectByRole($user)
            ->with('success', 'Registrasi berhasil.');
    }

    // Menampilkan form login.
    public function showLogin()
    {
        return view('auth.login');
    }

    // Memproses login.
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return $this->redirectByRole(Auth::user());
        }

        return back()
            ->withErrors([
                'email' => 'Email atau password tidak sesuai.',
            ])
            ->onlyInput('email');
    }

    // Logout dan mengakhiri sesi pengguna.
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Logout berhasil.');
    }

    // Mengarahkan pengguna berdasarkan role.
    private function redirectByRole(User $user)
    {
        if ($user->role === 'merchant') {
            return redirect()->route('merchant.dashboard');
        }

        return redirect()->route('customer.dashboard');
    }
}
