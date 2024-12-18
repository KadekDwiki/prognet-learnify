@extends('layouts.authenticated')

@section('content')
   <x-navbar-classes :lessonId="$lessonId"/>
   <div class="content-classes d-flex justify-content-center w-100">
      <div class="d-flex w-50 align-items-center flex-column gap-3">
         <div class="row w-100 mt-4 gap-4">
            @foreach ($lessons as $lesson) 
               <div class="card-lessons d-flex p-3 w-100 justify-content-between align-items-center bg-body-secondary rounded-2 shadow-sm">
                  <div class="icon">
                     <x-icon class="me-3 text-primary" name="solar:notebook-broken" width="48" height="48" />
                  </div>
                  <div class="desc w-75">
                     <h5>{{ Str::limit($lesson->title, 40, '...') }}</h5>
                     <p class="mb-0">{{ Str::limit($lesson->content, 40, '...') }}</p>
                     <a href="/lessons/{{ $lesson->class_id }}/{{ $lesson->id }}">Lihat Materi</a>
                  </div>
                  <div class="action">
                     <span class="btn btn-primary">
                        <x-icon class="" name="ic:round-check" width="28" height="28" />
                     </span>
                  </div>
               </div>
            @endforeach
         </div>

         @if ($lessons->isEmpty())
            <div class="banner-image d-flex flex-column justify-content-center align-items-center text-center" style="height: 500px;">
               <img src="{{ asset('images/rainy-smile.png') }}" alt="" height="120" width="120" class="mb-2">
               <p class="text-muted">Belum Ada Materi Nihh...</p>
            </div>
         @endif
      </div>
   </div>
@endsection