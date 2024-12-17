@extends('layouts.authenticated')

@section('content')
<x-navbar-classes :lessonId="$classId"/>
<div class="content-classes d-flex justify-content-center w-100">
   <div class="d-flex w-75 align-items-center flex-column gap-3">
      <div class="row w-100 mt-4 gap-4">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                    <h4>Tugas Baru</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" id="formAssignment" action="{{ route('assignments.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="class_id" value="{{ $classId }}" hidden>
                            <div class="mt-3 mb-3 mx-3">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul</label>
                                    <input type="text" id="title" name="title"
                                        class="form-control" 
                                        value="{{ old('title', $tugas->title ?? '') }}" 
                                        required style="padding: 10px; font-size: 14px;">
                                    @error('title')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mt-3">
                                <label for="desc" class="form-label">Deskripsi</label>
                                <div contenteditable="true" class="form-control" id="editor" style="min-height: 150px;">
                                    {{-- Deskripsi --}}
                                </div>
                                <div class="toolbar mt-1 mb-2">
                                    <button type="button" class="btn btn-light" onclick="document.execCommand('bold', false, '')">
                                        <b>B</b>
                                    </button>
                                    <button type="button" class="btn btn-light" onclick="document.execCommand('italic', false, '')">
                                        <i>I</i>
                                    </button>
                                    <button type="button" class="btn btn-light" onclick="document.execCommand('underline', false, '')">
                                        <u>U</u>
                                    </button>
                                </div>
                                <input type="hidden" name="description" id="deskripsi">
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                                <div class="mt-3 mb-3">
                                    <label for="formFileMultiple" class="form-label">Tambahkan File</label>
                                    <input class="form-control" type="file" id="formFileMultiple" name="file" multiple>
                                </div>
                                @error('file')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror    
                            <div class="form-group mb-3">
                                <label for="tenggat">Tenggat</label>
                                <input type="date" class="form-control" id="tenggat" name="due_date" value="{{ old('due_date', $tugas->tenggat ?? '') }}">
                            </div>
                                @error('due_date')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            <div class="form-group mb-3">
                                <label for="topik">Topik</label>
                                <select class="form-control" id="topik" name="topic">
                                    <option value="" {{ old('topic', $tugas->topic ?? '') === '' ? 'selected' : '' }}>Tidak ada topik</option>
                                
                                    @foreach($topic as $t)
                                        <option value="{{ $t->topic}}" {{old('topic') === $t->topic ? 'selected' : ''}}>
                                            {{ $t->topic}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('topic')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">
                                    {{ isset($tugas) ? 'Perbarui Tugas' : 'Buat Tugas' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
      </div>
   </div>
</div>
<script>
document.getElementById('formAssignment').addEventListener('submit', function(event) {
    const editorContent = document.getElementById('editor').innerHTML;
    document.getElementById('deskripsi').value = editorContent;
});
</script>
@endsection
