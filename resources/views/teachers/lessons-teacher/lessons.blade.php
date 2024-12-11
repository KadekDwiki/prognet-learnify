@extends('layouts.authenticated')

@section('content')
   <x-navbar-classes :lessonId="$lessonId"/>
   <div class="content-classes d-flex justify-content-center w-100">
      <div class="d-flex w-75 align-items-center flex-column gap-3">
         <div class="progress w-100" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar" style="width: 25%">25%</div>
         </div>
         <div class="add-lesson w-100 d-flex justify-content-end">
            <a href="{{route('add-lessons', $lessonId)}}" class="btn btn-primary">
               <x-icon class="" name="ic:round-plus" width="20" height="20" />
               Tambah Materi
            </a>
         </div>
         
         <div class="row w-100 gap-4">
            @foreach ($lessons as $lesson) 
               <div class="card-lessons d-flex p-3 w-100 justify-content-between align-items-center bg-body-secondary rounded-2 shadow-sm">
                  <div class="icon">
                     <x-icon class="me-3 text-primary" name="solar:notebook-broken" width="48" height="48" />
                  </div>
                  <div class="desc w-75">
                     <h5>{{ Str::limit($lesson->title, 40, '...') }}</h5>
                     <p class="mb-0">{{ Str::limit($lesson->content, 40, '...') }}</p>
                  </div>
                  <div class="action">
                     <a href="/lessons-teachers/{{ $lesson->class_id }}/{{ $lesson->id }}" class="btn btn-sm btn-primary">
                        <x-icon class="" name="solar:eye-broken" width="28" height="28" />
                     </a>
                     <a href="" class="btn btn-sm btn-warning">
                        <x-icon class="text-white" name="solar:pen-broken" width="28" height="28" />
                     </a>
                     <a href="" class="btn btn-sm btn-danger">
                        <x-icon class="" name="solar:trash-bin-2-broken" width="28" height="28" />
                     </a>
                  </div>
               </div>
            @endforeach
         </div>
      </div>
   </div>
@endsection