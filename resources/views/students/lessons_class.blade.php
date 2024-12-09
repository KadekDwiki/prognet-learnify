@extends('layouts.authenticated')

@section('content')
   <x-navbar-classes :lessonId="$lessonId"/>
   <div class="content-classes d-flex justify-content-center w-100">
      <div class="d-flex w-50 align-items-center flex-column gap-3">
         <div class="progress w-100" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar" style="width: 25%">25%</div>
         </div>

         <div class="row w-100 mt-4 gap-4">
            @foreach ($lessons as $lesson) 
               <div class="card-lessons d-flex p-3 w-100 justify-content-between align-items-center bg-body-secondary rounded-2 shadow-sm">
                  <div class="icon">
                     <x-icon class="me-3 text-primary" name="solar:notebook-broken" width="48" height="48" />
                  </div>
                  <div class="desc w-75">
                     <h4>{{ $lesson->title }}</h4>
                     <p class="mb-0">{{ Str::limit($lesson->title, 40, '...') }}</p>
                     <a href="/lessons/{{ $lesson->class_id }}/{{ $lesson->id }}">lihat kelas</a>
                  </div>
                  <div class="action">
                     <span class="btn btn-primary">
                        <x-icon class="" name="ic:round-check" width="28" height="28" />
                     </span>
                  </div>
               </div>
            @endforeach
         </div>
      </div>
   </div>
@endsection