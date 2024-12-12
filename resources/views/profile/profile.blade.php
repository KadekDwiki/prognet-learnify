@extends('layouts.authenticated')

@section('content')

<div class="d-flex flex-column px-5">
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show z-3" role="alert">
        <strong>Berhasil!</strong> {{session('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    <!-- Latar Biru -->
    <div class="shape-background"></div>
    <!-- Profile Form -->
    <div class="profile-form w-100 mt-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                    <!-- Avatar Section -->
                    <div class="text-center mb-4">
                        <div class="profile-avatar position-relative" style="display: inline-block;">
                            <!-- Tampilkan foto profil yang sudah ada -->
                            <img id="profileImage" src="{{ auth()->user()->profile_photo_path ? asset('storage/' . auth()->user()->profile_photo_path) : 'images/profile.png' }}" alt="Profile Picture" 
                                class="rounded-circle border border-secondary" 
                                style="width: 100px; height: 100px; object-fit: cover; overflow: hidden;"/>
                            
                            <!-- Input file tersembunyi untuk memilih foto -->
                            <input type="file" name="profile_photo" id="profile_photo" style="display: none;" accept="image/*" onchange="previewImage(event)">
                                
                            <!-- Tombol Edit Foto Profil (Hanya Ikon) -->
                            <label for="profile_photo" class="position-absolute" 
                                style="top: 90%; left: 100%; transform: translate(-50%, -50%); cursor: pointer;">
                                <x-icon class="text-primary" name="f7:pencil-circle" width="32" height="32"/>
                            </label>
                            @error('profile_photo')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <!-- Nama Lengkap -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" id="name" name="name" 
                            class="form-control" 
                            value="{{ old('name', $user->name) }}" 
                            required style="padding: 10px; font-size: 14px;">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" 
                            class="form-control" 
                            value="{{ old('email', $user->email) }}" 
                            required style="padding: 10px; font-size: 14px;">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Nomor Telepon -->
                    <div class="mb-3">
                        <label for="telp" class="form-label">Nomor Telepon</label>
                        <input type="text" id="telp" name="telp" 
                            class="form-control" 
                            value="{{ old('telp', $user->telp) }}" 
                            style="padding: 10px; font-size: 14px;">
                        @error('telp')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" 
                            class="btn btn-primary w-100" 
                            style="padding: 10px; font-size: 16px;">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const file = event.target.files[0];
        console.log(file); // Debugging: periksa file yang diupload
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Update tampilan foto profil pada halaman
                document.getElementById('profileImage').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
