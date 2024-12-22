@extends('layouts.guest')

@section('form')
    <div class="form-wrapper shadow border border-1 border-secondary-subtle rounded-2 py-4 px-3 mt-4 bg-light-subtle">
        <form action="{{ route('register.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="name" name="name"
                    class="form-control border-primary @error('name') is-invalid border-danger @enderror" id="name"
                    placeholder="bu megawati" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email"
                    class="form-control border-primary @error('email') is-invalid border-danger @enderror" id="email"
                    placeholder="name@example.com" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="telp" class="form-label">Telepon</label>
                <input type="text" name="telp"
                    class="form-control border-primary @error('telp') is-invalid border-danger @enderror" id="telp"
                    value="{{ old('telp') }}" placeholder="masukkan nomor telp" required>
                @error('telp')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Daftar Sebagai</label>
                <select id="role" name="role"
                    class="form-select border-primary @error('role') is-invalid border-danger @enderror"
                    aria-label="Default select example">
                    <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
                    <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>Teacher</option>
                </select>
                @error('role')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Alamat</label>
                <input type="text" name="address"
                    class="form-control border-primary @error('address') is-invalid border-danger @enderror" id="address"
                    value="{{ old('telp') }}" placeholder="masukkan alamat" required>
                @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Kata Sandi</label>
                <input type="password" name="password"
                    class="form-control border-primary @error('password') is-invalid border-danger @enderror" id="password"
                    placeholder="masukkan kata sandi" required>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <small class="d-block text-primary text-center mb-3">Dengan mengklik daftar, Anda menyetujui Ketentuan Layanan
                dan Kebijakan Privasi kami</small>
            <button type="submit" class="w-full d-block btn btn-primary py-2 w-100 rounded-5 mb-3">Daftar</button>
            <small class="d-block text-center mb-3"> atau </small>
            <button
                class="w-full d-block btn btn-light border border-1 border-dark py-2 font-sm w-100 rounded-5 mb-3">Lanjutkan
                dengan Google</button>
            <small class="d-block text-center">Sudah memiliki akun?
                <a href="{{ route('login') }}" class="fw-bold">Masuk sekarang</a>
            </small>
        </form>
    </div>
@endsection
