@extends('layouts.authenticated')

@section('content')
    <x-navbar-classes :lessonId="$lessonId" />
    <div class="content-classes d-flex justify-content-center w-100">
        <div class="d-flex w-75 align-items-center flex-column gap-3">
            <div class="card p-3 shadow-sm rounded-4 d-flex align-items-center"
                style="min-width: 400px; background-color:#EFF4FF; border: 2px solid rgba(178, 218, 255, 0.9); box-shadow: 0px 4px 6px 0px rgba(0, 0, 0, 1);">
                <div class="d-flex align-items-center" style="width: 100%; justify-content: flex-start;">
                    <!-- Gambar dengan styling bulat dan kecil -->
                    <img src="{{ $teacher->profile_photo_path ? asset('storage/' . $teacher->profile_photo_path) : asset('images/profile.png') }}"
                        alt="Profile" class="rounded-circle me-3"
                        style="width: 50px; height: 50px; object-fit: cover; border: 2px solid #B2DAFF;">
                    <!-- Teks berada di sebelah kanan gambar -->
                    <div>
                        <p class="mb-0"><b>Guru :</b></p>
                        <p class="mb-0">{{ $teacher->name }}</p>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-outline-danger ms-auto" data-bs-toggle="modal"
                data-bs-target="#staticBackdrop">Keluar</button>

            <table class="table border">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $index => $student)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center grid gap-2 column-gap-3">
                {{ $students->links() }}
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tinggalkan Kelas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin untuk tinggalkan kelas?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <form action="{{ route('classes.leave', $lessonId) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Keluar</button>
                    </form>
                </div>
            </div>
        </div>
    @endsection
