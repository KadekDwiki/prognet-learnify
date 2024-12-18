@extends('layouts.authenticated')

@section('content')
    <x-navbar-classes :lessonId="$classId" />
    <div class="content-classes d-flex justify-content-center w-100">
        <div class="d-flex w-100 align-items-center flex-column gap-3">
            @if (session('success'))
                <div class="alert w-100 alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <h3 class="mt-4">Nilai Tugas Murid</h3>
            <table class="table table-hover shadow-sm">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">No.</th>
                        <th scope="col">Nama Siswa</th>
                        <th scope="col">File Tugas</th>
                        <th scope="col" width="100px">Nilai</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($studentsSubmissions as $index => $submission)
                    <form action="{{ route('submissions-teacher.update_grade') }}" method="POST">
                        @csrf
                        @method("PUT")
                        <tr>
                            <th scope="row" class="text-center">{{ ++$index }}</th>
                            <td>{{ $submission->name }}</td>
                            <td>
                                <a data-fancybox data-type="iframe" href="{{ asset("storage/$submission->file_url") }}">
                                    Lihat tugas
                                </a>                                
                            </td>
                            <td>
                                <input type="hidden" name="submission_id" value="{{ $submission->id }}">
                                <input type="number" name="grade" min="0" max="100" class="form-control" value="{{ $submission->grade }}" required>
                            </td>
                            <td class="text-center">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </td>
                        </tr>
                    </form>
                    @endforeach
                    </tbody>
                </table>
        </div>
    </div>
@endsection
