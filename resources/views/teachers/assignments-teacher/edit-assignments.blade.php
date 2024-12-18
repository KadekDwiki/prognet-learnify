@extends('layouts.authenticated')

@section('content')
<x-navbar-classes :lessonId="$classId"/>
<div class="content-classes d-flex justify-content-center w-100">
   <div class="d-flex w-75 align-items-center flex-column gap-3">
      <div class="row w-100 mt-4 gap-4">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Tugas</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('assignments.update', $assignments->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="class_id" value="{{ $classId }}">
                            <div class="form-group mb-3">
                                <label for="title">Judul</label>
                                <input type="text" id="title" name="title" class="form-control" value="{{ $assignments->title }}" required>
                            </div>
                            @error('title')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                            <div class="form-group mb-3">
                                <label for="desc">Deskripsi</label>
                                <textarea id="desc" name="description" class="form-control" rows="5" required>{{ $assignments->description }}</textarea>
                            </div>
                            @error('description')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                            <div class="form-group mb-3">
                                <label for="formFileMultiple">Tambahkan File</label>
                                <input class="form-control" type="file" id="formFileMultiple" name="file" multiple>
                            </div>
                            @error('file')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                            <div class="form-group mb-3">
                                <label for="tenggat">Tenggat</label>
                                <input type="date" class="form-control" id="tenggat" name="due_date" value="{{ $assignments->due_date }}">
                            </div>
                            @error('due_date')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                            <div class="form-group mb-3">
                                <label for="topik">Topik</label>
                                <select class="form-control" id="topik" name="topic">
                                    <option value="" {{ $assignments->topic === '' ? 'selected' : '' }}>Tidak ada topik</option>
                                    @foreach($topic as $t)
                                        <option value="{{ $t->topic }}" {{ $t->topic === $assignments->topic ? 'selected' : '' }}>
                                            {{ $t->topic }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('topic')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Perbarui Tugas</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
      </div>
   </div>
</div>
@endsection
