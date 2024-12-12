@extends('layouts.authenticated')

@section('content')
   <x-navbar-classes :lessonId="$classId"/>
   <div class="content-classes d-flex justify-content-center w-100">
      <div class="d-flex w-75 align-items-center flex-column gap-3">
         <div class="row w-100 mt-4 gap-4">
               <div class="description">
                  <h3>{{ $topics->title }}</h3>
                  <p class="border-bottom pb-4">{{ $topics->created_at }}</p>
                  <p>
                     {{ $topics->content }}
                  </p>
               </div>
               @if (!empty($topics->file_url))
                  <div class="d-flex align-items-center bg-body-secondary bg-opacity-50 shadow-sm p-3 rounded-3">
                     <div class="card-icon me-3">
                        <x-icon class="text-primary" name="akar-icons:file" height="44" width="44" />
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