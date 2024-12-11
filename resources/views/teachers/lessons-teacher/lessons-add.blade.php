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
                <input type="text" id="title" name="title" placeholder="Judul"
                    class="form-control" 
                    value="{{ old('title') }}" 
                    required style="padding: 10px; font-size: 14px;">
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <textarea id="desc" name="desc"
                    class="form-control text-dark" rows="3" required style="padding: 10px; font-size: 14px;">
                </textarea>
                @error('desc')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" 
                    class="btn btn-primary w-100" 
                    style="padding: 10px; font-size: 16px;">
                    Update
                </button>
            </div>
        </form>
      </div>
   </div>
</div>
@endsection