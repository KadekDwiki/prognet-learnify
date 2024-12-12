<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil pengguna.
     */
    public function index()
    {
        \Log::info('User ID: ' . auth()->id());
        $title = 'Profile';
        $user = auth()->user(); // Ambil data pengguna yang sedang login
        return view('profile.profile', compact('user', 'title')); // Pastikan file `profile.blade.php` ada di folder views/profile
    }

    /**
     * Mengupdate data profil pengguna.
     */
    public function update(Request $request)
    {
        $user = auth()->user(); // Ambil data pengguna yang sedang login

        // Validasi data yang dikirimkan dari form
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'telp' => 'nullable|string|max:20',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png,gif,bmp,tiff,webp|max:2048', // Menambahkan format gambar lainnya
        ]);

        // Update data pengguna (nama, email, phone)
        $user->update($validatedData);

        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada
            if ($user->profile_photo_path && Storage::exists($user->profile_photo_path)) {
                Storage::delete($user->profile_photo_path);
            }
    
            // Upload foto baru
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            \Log::info('Foto berhasil diupload ke path: ' . $path); // Logging untuk debug
            $validatedData['profile_photo_path'] = $path;
        }
    
        $user->update($validatedData);
    
        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui.');
    }
}
