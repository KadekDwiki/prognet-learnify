@extends('layouts.authenticated')

@section('content')
<x-navbar-classes :lessonId="$classId"/>
<div class="content-classes d-flex justify-content-center w-100">
   <div class="d-flex w-75 align-items-center flex-column gap-3">
      <div class="row w-100 mt-4 gap-4">
        <!-- Form -->
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Judul</label>
                <input type="text" id="title" name="title"
                    class="form-control" 
                    value="{{ old('title') }}" 
                    required style="padding: 10px; font-size: 14px;">
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- <div class="mb-3">
                <textarea id="desc" name="desc"
                    class="form-control text-dark" rows="3" required style="padding: 10px; font-size: 14px;">
                </textarea>
                @error('desc')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div> --}}

            <div class="mt-4 mb-3">
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
                    {{-- <button type="button" class="btn btn-light" onclick="document.execCommand('insertUnorderedList', false, '')">
                        <i class="fa fa-list-ul"></i>
                    </button> --}}
                </div>
            </div>
            {{-- <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data"></form> --}}
                {{-- @csrf --}}
                <div class="mb-3">
                    <label for="formFileMultiple" class="form-label">Tambahkan File</label>
                    <input class="form-control" type="file" id="formFileMultiple" multiple>
                </div>
            {{-- </form> --}}

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" 
                    class="btn btn-primary w-100" 
                    style="padding: 10px; font-size: 16px;">
                    Unggah
                </button>
            </div>
        </form>
      </div>
   </div>
</div>
@endsection