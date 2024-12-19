@extends('layouts.authenticated')

@section('content')
    <x-navbar-classes :lessonId="$classId" />
    <div class="content-classes d-flex justify-content-center w-100">
        <div class="d-flex w-75 align-items-center flex-column gap-3">
            <div class="row w-100 mt-4 gap-4">
                <!-- Form -->
                <div class="card">
                    <div class="card-header">
                        <h4>{{ isset($lesson) ? 'Edit Materi' : 'Unggah Materi Baru' }}</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST"
                            action="{{ isset($lesson) ? route('lessons.update', $lesson->id) : route('lessons.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @if (isset($lesson))
                                @method('PUT')
                            @endif
                            <input type="hidden" name="class_id" value="{{ $classId }}">

                            <!-- Judul -->
                            <div class="mb-3">
                                <label for="title" class="form-label">Judul</label>
                                <input type="text" id="title" name="title" class="form-control"
                                    value="{{ old('title', $lesson->title ?? '') }}" required>
                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Deskripsi -->
                            <div class="mb-3">
                                <label for="desc" class="form-label">Deskripsi</label>
                                <div contenteditable="true" class="form-control" id="editor">
                                    {{ old('description', $lesson->content ?? '') }}
                                </div>
                                <input type="hidden" name="description" id="deskripsi">
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- File -->
                            <div class="mb-3">
                                <label for="formFileMultiple" class="form-label">Tambahkan File</label>
                                <input class="form-control" type="file" id="formFileMultiple" name="files[]" multiple>
                                @if (isset($lesson) && $lesson->file_url)
                                    <small class="form-text">File saat ini:
                                        <a href="{{ asset('storage/' . $lesson->file_url) }}" target="_blank">Lihat File</a>
                                    </small>
                                @endif
                                @error('files.*')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">
                                    {{ isset($lesson) ? 'Perbarui Materi' : 'Unggah Materi' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Script untuk menangkap konten editor -->
    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            const editorContent = document.getElementById('editor').innerHTML;
            document.getElementById('deskripsi').value = editorContent;
        });
    </script>
@endsection
