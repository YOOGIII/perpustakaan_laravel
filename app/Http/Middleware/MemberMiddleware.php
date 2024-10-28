<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Member; // Sesuaikan dengan model Member yang digunakan

class MemberMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->has('user_id')) {
            $user = Member::find($request->session()->get('user_id'));

            if ($user && $user->role === 'admin') {
                // Mahasiswa diperbolehkan mengakses semua halaman kecuali admin.blade.php
                // if ($request->route()->getName() === 'member.index') {
                //     return redirect('/home')->with('error', 'Unauthorized access.');
                // }

                return $next($request);
            }
        }

        return redirect('/')->with('error', 'Anda harus login sebagai mahasiswa.');
    }
}