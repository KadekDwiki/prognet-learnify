@extends('layouts.authenticated')

@section('content')
    <x-navbar-classes :lessonId="$lessonId"/>
    <div class="content-classes d-flex justify-content-center w-100" >
        <div class="d-flex w-75 align-items-center flex-column gap-3">

        <button type="button" class="btn btn-outline-danger ms-auto" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Keluar</button>
            
            <table class="table border">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $index => $student)
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
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
