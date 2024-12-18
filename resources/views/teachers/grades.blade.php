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
                        <th scope="col">Tugas 1</th>
                        <th scope="col">Tugas 2</th>
                        <th scope="col">Tugas 3</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $index => $student)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>57</td>
                            <td>87</td>
                            <td>56</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center grid gap-2 column-gap-3">
                {{ $students->links() }}
            </div>
        </div>
    </div>
@endsection
