@extends('layouts.authenticated')

@section('content')
   <x-navbar-classes :lessonId="$lessonId"/>
   <div class="content-classes d-flex justify-content-center w-100">
      <div class="d-flex w-75 align-items-center flex-column gap-3">
         <div class="progress w-100" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar" style="width: 25%">25%</div>
         </div>

         <div class="row w-100 mt-4 gap-4">
            @foreach ($assignments as $assignment) 
            <div class="card-lessons d-flex p-3 w-100 justify-content-between align-items-center bg-body-secondary rounded-2 shadow-sm">
                  <div class="icon">
                     <x-icon class="me-3 text-primary" name="solar:notebook-broken" width="48" height="48" />
                  </div>
                  <div class="deadline w-75">
                     <h5>{{ Str::limit($assignment->title, 40, '...') }}</h5>
                     {{-- <p class="mb-0">{{ Str::limit($assignment->content, 40, '...') }}</p> --}}
                     <p class="border-bottom mb-0">{{ $assignment->created_at->diffForHumans() }}</p>
                  </div>
                  <div class="action">
                    <a href="" class="btn btn-sm btn-primary">
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