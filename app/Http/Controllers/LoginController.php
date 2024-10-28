<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request): RedirectResponse
    {
        $email = $request->input('email');
        $password = $request->input('password');

        // Cari pengguna berdasarkan email
        $user = Member::where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->withInput()->with('error', 'Login failed. Invalid credentials.');
        }

        if ($password == $user->password) {
            $request->session()->put('user_id', $user->id);
            $request->session()->put('role', $user->role);

            return redirect()->route('bukus.index')->with('success', 'Logged in successfully.');
        }

        return redirect()->back()->withInput()->with('error', 'Login failed. Invalid credentials.');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user_id');
        $request->session()->forget('role');

        return redirect()->route('transaksi.index')->with('success', 'Logged out successfully.');
    }
}