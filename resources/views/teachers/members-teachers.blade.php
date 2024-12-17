@extends('layouts.authenticated')

@section('content')
    <x-navbar-classes :lessonId="$lessonId" />
    <div class="content-classes d-flex justify-content-center w-100">
        <div class="d-flex w-75 align-items-center flex-column gap-3">
            <table class="table border rounded-5">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Telepon</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $index => $student)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->telp }}</td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="border-0 bg-transparent text-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $student->id }}">
                                    <x-icon class="" name="lsicon:minus-outline" width="20" height="20" />
                                </button>
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal{{ $student->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Penghapusan
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah anda yakin untuk menghapus siswa ini dari kelas?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Tutup</button>
                                        <form action="{{ route('members-teachers.destroy', $student->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center grid gap-2 column-gap-3">
                {{ $students->links() }}
            </div>
        </div>
    </div>
@endsection
