@extends('layouts.authenticated')

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="d-flex">
    <!-- Latar Biru -->
    <div class="shape-background"></div>
    <!-- Profile Form -->
    <div class="profile-form w-100 p-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <!-- Avatar Section -->
                <div class="text-center mb-4">
                    <div class="profile-avatar position-relative" style="display: inline-block;">
                        <img src="https://via.placeholder.com/100" alt="Profile Picture" 
                            class="rounded-circle border border-secondary" 
                            style="width: 100px; height: 100px; object-fit: cover;">
                        <button class="btn btn-light border rounded-circle position-absolute" 
                            style="top: 70%; left: 70%; transform: translate(-50%, -50%);">
                            <i class="bi bi-pencil"></i>
                        </button>
                    </div>
                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')

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
                        <label for="phone" class="form-label">Nomor Telepon</label>
                        <input type="text" id="phone" name="phone" 
                            class="form-control" 
                            value="{{ old('phone', $user->phone) }}" 
                            style="padding: 10px; font-size: 14px;">
                        @error('phone')
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
@endsection
