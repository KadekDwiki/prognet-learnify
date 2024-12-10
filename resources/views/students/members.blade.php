@extends('layouts.authenticated')

@section('content')
    <x-navbar-classes :lessonId="$lessonId"/>
    <div class="content-classes d-flex justify-content-center w-100" >
        <div class="d-flex w-75 align-items-center flex-column gap-3">

        <button type="button" class="btn btn-outline-danger ms-auto">Keluar</button>
            
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
        </div>        
    </div>

@endsection
