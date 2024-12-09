<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil pengguna.
     */
    public function index()
    {
        $title = 'Profile';
        $user = auth()->user(); // Ambil data pengguna yang sedang login
        return view('profile.profile', compact('user', 'title')); // Pastikan file `profile.blade.php` ada di folder views/profile
    }

    /**
     * Mengupdate data profil pengguna.
     */
    public function update(Request $request)
    {
        $title = 'Profile';
        $user = auth()->user(); // Ambil data pengguna yang sedang login

        // Validasi data yang dikirimkan dari form
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
        ]);

        // Update data pengguna di database
        $user->update($validatedData);

        // Redirect kembali ke halaman profil dengan pesan sukses
        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui.');
    }
}
