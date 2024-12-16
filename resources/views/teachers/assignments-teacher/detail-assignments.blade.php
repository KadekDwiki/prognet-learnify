@extends('layouts.authenticated')

@section('content')
   <x-navbar-classes :lessonId="$classId"/>
   <div class="content-classes d-flex justify-content-center w-100">
      <div class="d-flex w-75 align-items-center flex-column gap-3">
         <div class="row w-100 mt-4 gap-4">
            
            <div class="description border rounded-3 p-4 shadow-sm" style="background-color: #FFFFFF">
               <h5 class="text-primary fw-bold">
                  <i class="bi bi-clipboard-check me-2"></i> <!-- Icon -->
                  {{ $topics->title }}
               </h5>
               <p class="text-muted small">
                  Nama guru • {{ $topics->created_at->format('d M Y') }}
               </p>
               <p class="fw-light small text-secondary mb-3">
                  100 poin • <span class="text-primary fw-semibold">tenggat: 20 Jan</span>
               </p>
               <p>{{ $topics->content }}</p>
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
                        </div>
                  </div>
            @endif
         </div>
      </div>
   </div>
@endsection