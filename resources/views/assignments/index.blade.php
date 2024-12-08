@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Daftar Tugas Kelas</h1>

        <!-- Card Container -->
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($assignments as $assignment)
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h5 class="card-title">{{ $assignment->title }}</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ Str::limit($assignment->description, 100) }}</p>
                            <p class="card-text"><strong>Batas Waktu:</strong> {{ $assignment->due_date->format('d-m-Y H:i') }}</p>
                        </div>
                        <div class="card-footer text-center">
                            <a href="{{ route('assignments.show', $assignment->id) }}" class="btn btn-info btn-sm">Lihat</a>
                            <a href="{{ route('assignments.edit', $assignment->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('assignments.destroy', $assignment->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
