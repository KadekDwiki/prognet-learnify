@extends('layouts.guest')

@section('form')
   <div class="form-wrapper mt-4 w-100">
      <p class="text-center">Masuk menggunakan akunmu</p>
      <form action="{{ route('login.authenticate') }}" method="POST" class="w-100">
         @csrf
         <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control border-primary @error('email') is-invalid border-danger @enderror" id="email" placeholder="name@example.com" required>
            @error('email')
            <div class="invalid-feedback">
               {{ $message }}
            </div>
            @enderror
         </div>
         <div class="mb-3">
            <label for="password" class="form-label">Kata Sandi</label>
            <input type="password" name="password" class="form-control border-primary @error('password') is-invalid border-danger @enderror" id="password" placeholder="masukkan kata sandi" required>
            @error('password')
            <div class="invalid-feedback">
               {{ $message }}
            </div>
            @enderror
         </div>
         <button type="submit" class="w-full d-block btn btn-primary py-2 w-100 rounded-5">Masuk</button>
      </form>
      <small class="d-block text-center">Belum punya akun?
         <a href="{{ route("register") }}" class="fw-bold text-primary">Daftar sekarang</a>
      </small>
   </div>
@endsection
