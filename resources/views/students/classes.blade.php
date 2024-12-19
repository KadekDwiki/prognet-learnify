@extends('layouts.authenticated')

@section('content')
    <div class="header d-flex w-100 justify-content-between mb-3">
        <div>
            <h4 class="text-primary text-capitalize">Selamat datang di kelas</h4>
            <p class="text-light-emphasis">Ingin mengikuti kelas apa hari ini?</p>
        </div>
        <div class="d-flex align-items-center flex-column gap-3">
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                data-bs-target="#joinClassModal">Gabung Kelas</button>
        </div>
    </div>

    <!-- Pemberitahuan (alert) dipindahkan ke atas -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Gagal</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Menampilkan semua kelas dengan 2 kolom per baris -->
    @if (count($classes) > 0)
        <div class="container">
            <div class="row g-4"> <!-- Menggunakan Bootstrap Grid System -->
                @foreach ($classes as $class)
                    <div class="col-md-6"> <!-- Membagi dalam 2 kolom per baris -->
                        <x-card-class :classId="$class->class_id" :name="$class->class_name" :teacher="$class->teacher_name" :token="$class->token" />
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="empty-classes">
            <div class="d-flex justify-content-center align-items-center flex-column">
                <img src="{{ asset('images/tanjuk-atas.png') }}" alt="" width="300" class="mb-2">
                <p>Yahh, kamu belom ada kelas, <b>Yukk Gabung Kelas...</b></p>
            </div>
        </div>
    @endif

    <!-- Modal untuk Gabung Kelas -->
    <div class="modal fade" id="joinClassModal" tabindex="-1" aria-labelledby="joinClassModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="joinClassModalLabel">Masukkan Kode Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="joinClassForm" action="{{ route('join.class') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="classCode" class="form-label">Kode Kelas</label>
                            <input type="text" class="form-control" id="classCode" name="classCode" required>
                            <div class="invalid-feedback">
                                Kode kelas harus diisi.
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary" id="joinClassButton" disabled>Gabung</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Menambahkan JavaScript untuk Validasi Form -->
    <script>
        // Enable/Disable the "Gabung" button based on input
        document.getElementById('classCode').addEventListener('input', function() {
            const classCode = document.getElementById('classCode').value;
            const joinButton = document.getElementById('joinClassButton');
            joinButton.disabled = classCode.trim() === '';
        });
    </script>
@endsection
