@extends('layouts.authenticated')

@section('content')
    <x-navbar-classes :lessonId="$classId" />
    <div class="content-classes d-flex justify-content-center w-100">
        <div class="d-flex w-75 align-items-center flex-column gap-3">
            <table class="table border rounded-5">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th>Nama</th>
                        @foreach ($assignments as $assignment)
                            <th>{{ $assignment->title }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $index => $student)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $student->name }}</td>
                            @foreach ($assignments as $assignment)
                                @php
                                    $grade = $student->assignmentsSubmissions
                                        ->where('assignment_id', $assignment->id)
                                        ->first();
                                @endphp
                                <td>{{ $grade ? $grade->grade : 'N/A' }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>

            </table>

            <div class="d-flex justify-content-center mt-3">
                {{ $students->links() }}
            </div>

        </div>
    </div>
@endsection
