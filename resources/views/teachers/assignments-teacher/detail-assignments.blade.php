@extends('layouts.authenticated')

@section('content')
   <x-navbar-classes :lessonId="$classId"/>
   <div class="content-classes d-flex justify-content-center w-100">
      <div class="d-flex w-75 align-items-center flex-column gap-3">
         <div class="row w-100 mt-4 gap-4">
            <div class="description">
               <h3 class="text-primary">
                  {{ $topics->title }}
               </h3>
               <p class="fw-light small text-secondary mb-3">
                  100 poin • <span class="text-primary fw-semibold">tenggat: 20 Jan</span>
               </p>
               <p class="border-bottom pb-4">{{ $topics->created_at->diffForHumans() }}</p>
               <p>
                  {{ $topics->description }}
               </p>
            </div>

            @if (!empty($topics->file_url))
                  <div class="d-flex align-items-center bg-opacity-10 shadow-sm p-3 border rounded-3" style="background-color: #B2DAFF30">
                     <div class="card-icon me-3">
                        <img src="{{ asset('images/pdf-image.png') }}" alt="PDF Icon" class="me-3" style="width: 30px; height: auto;">
                     </div>
                        <div class="card-desc">
                           <a href="{{ $topics->file_url }}" class="text-dark text-decoration-none" target="_blank">
                              {{ Str::limit($topics->file_url, 70, '...') }}
                           </a>
                           <a data-fancybox data-type="iframe" href="{{ asset("storage/$topics->file_url") }}">
                              Lihat tugas
                           </a> 
                        </div>
                  </div>
            @endif
         </div>
      </div>
   </div>
@endsection