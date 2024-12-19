@extends('layouts.authenticated')

@section('content')
    @if (session('access'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Akses Ditolak</strong> {{ session('access') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="header mb-3">
        <h4 class="text-primary text-capitalize">Selamat {{ $greeting }}, {{ auth()->user()->name }}!</h4>

        @if (auth()->user()->role == 'student')
            <p class="text-light-emphasis">Ayo belajar hal baru hari ini</p>
        @endif

        @if (auth()->user()->role == 'teacher')
            <p class="text-light-emphasis">Ayo tambahkan tugas baru</p>
        @endif

    </div>

    @if (auth()->user()->role == 'student')
        <div
            class="banner banner-dashboard px-5 rounded-5 d-flex justify-content-between align-items-center mb-3 shadow-sm">
            <div class="banner-text">
                <h2 class="text-light">Jelajahi Dunia Ilmu Pengetahuan dengan Learnify.</h2>
                <p class="text-light">Dilengkapi dengan pengingat dan proses tracker untuk mendukung belajarmu.</p>
            </div>
            <div class="banner-image">
                <img src="{{ asset('images/dashboard-banner.png') }}" alt="">
            </div>
        </div>
        <div class="recaps mb-4">
            <h5 class="text-primary mb-3">Pekerjaanmu</h5>
            <div class="recap-cards d-flex gap-3">
                <div class="recap-card w-100 d-flex flex-column p-3 bg-my-light-blue rounded-3 shadow-sm">
                    <p class="text-light-emphasis">Tugas dalam Progress</p>
                    <h4 class=" h1 fw-bold text-primary">{{ $pendingAssignments }}</h4>
                </div>
                <div class="recap-card w-100 d-flex flex-column p-3 bg-my-light-blue rounded-3 shadow-sm">
                    <p class="text-light-emphasis">Tugas Selesai</p>
                    <h4 class=" h1 fw-bold text-primary">{{ $completedAssignments }}</h4>
                </div>
                <div class="recap-card w-100 d-flex flex-column p-3 bg-my-light-blue rounded-3 shadow-sm">
                    <p class="text-light-emphasis">Kelas</p>
                    <h4 class=" h1 fw-bold text-primary">{{ $classCount }}</h4>
                </div>
            </div>
        </div>
        <div class="classes">
            <div class="d-flex justify-content-between">
                <h5 class="text-primary mb-3">Kelasmu</h5>
                <a href="{{ route('classes') }}" class="link-offset-2">Lihat Semua</a>
            </div>

            @if (count($classes) > 0)
                <div class="class-cards gap-3">
                    @foreach ($classes as $class)
                        <x-card-class :classId="$class->class_id" :name="$class->class_name" :teacher="$class->teacher_name" :token="$class->token" />
                    @endforeach
                </div>
            @else
                <div class="empty-classes">
                    <div class="d-flex justify-content-center align-items-center flex-column">
                        <img src="{{ asset('images/rainy-face.png') }}" alt="">
                        <p>Yahh, kamu belom ada kelas</p>
                        <!-- Tombol ini juga membuka modal -->
                        <button type="button" class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal"
                            data-bs-target="#joinClassModal">
                            Gabung Kelas
                        </button>
                    </div>
                </div>
            @endif
        </div>

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

        <!-- JavaScript untuk Validasi Input Modal -->
        <script>
            document.getElementById('classCode').addEventListener('input', function() {
                const classCode = document.getElementById('classCode').value;
                const joinButton = document.getElementById('joinClassButton');
                joinButton.disabled = classCode.trim() === '';
            });
        </script>
    @endif

    {{-- teacher --}}
    @if (auth()->user()->role == 'teacher')
        <div class="banner px-5 rounded-5 d-flex justify-content-between align-items-center mb-3 shadow-sm">
            <div class="banner-text">
                <h2 class="text-light">Sebarkan Ilmu Pengetahuan dengan Learnify.</h2>
                <p class="text-light">Dilengkapi dengan pengingat dan progress tracker untuk mendukung proses mengajarmu.
                </p>
            </div>
            <div class="banner-image">
                <img src="{{ asset('images\dashboard-teachers.png') }}" alt="">
            </div>
        </div>

        <div class="classes">
            <div class="d-flex justify-content-between">
                <h5 class="text-primary mb-3">Kelasmu ({{ $classCountTeacher }})</h5>
                <a href="{{ route('classes-teachers') }}" class="link-offset-2">Lihat Semua</a>
            </div>

            @if (count($classesTeacher) > 0)
                <div class="class-cards gap-3">
                    @foreach ($classesTeacher as $class)
                        <x-card-class :classId="$class->class_id" :name="$class->class_name" :teacher="$class->teacher_name" :token="$class->token" />
                    @endforeach
                </div>
            @else
                <div class="empty-classes">
                    <div class="d-flex justify-content-center align-items-center flex-column">
                        <img src="{{ asset('images/rainy-face.png') }}" alt="">
                        <p>Yahh, kamu belum ada kelas</p>
                        <button type="button" class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal"
                            data-bs-target="#createClassModal">
                            Buat Kelas
                        </button>
                    </div>
                </div>
            @endif
        </div>
    @endif

    <!-- Modal untuk Buat Kelas -->
    <div class="modal fade" id="createClassModal" tabindex="-1" aria-labelledby="createClassModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createClassModalLabel">Buat Kelas Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createClassForm" method="POST" action="{{ route('classes.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="className" class="form-label">Nama Kelas</label>
                            <input type="text" class="form-control" id="className" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="classDescription" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="classDescription" name="description" rows="3" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Buat Kelas</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
