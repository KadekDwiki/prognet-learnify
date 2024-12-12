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

        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada
            if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }
        
            // Upload foto baru
            $file = $request->file('profile_photo');
            $originalFileName = $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/profiles', $originalFileName, 'public');
            $validatedData['profile_photo_path'] = $filePath;
        }
        $user->update($validatedData);
    
        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui.');
    }
}
