@extends('layouts.authenticated')

@section('content')
   <x-navbar-classes :lessonId="$classId"/>
   <div class="content-classes d-flex justify-content-center w-100">
      <div class="d-flex w-75 align-items-center flex-column gap-3">
         <div class="row w-100 mt-4 gap-4">

               <div class="description">
                  <h3>{{ $topics->title }}</h3>
                  <p class="border-bottom pb-4">{{ $topics->created_at->diffForHumans() }}</p>
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

               <div class="container mt-3">
                  <ul class="list-group">
                      <li class="list-group-item d-flex align-items-center">
                          <img src="{{ asset('images/pdf-image.png') }}" alt="PDF Icon" class="me-3" style="width: 30px; height: auto;">
                          <div>
                              <strong>Materi.pdf</strong>
                              <p class="mb-0 text-muted">10 Halaman</p>
                          </div>
                      </li>
              
                      <li class="list-group-item d-flex align-items-center mt-3">
                          <img src="{{ asset('images/file-image.png') }}" alt="DOC Icon" class="me-3" style="width: 30px; height: auto;">
                          <div>
                              <strong>Materi 2.docs</strong>
                              <p class="mb-0 text-muted">3 Halaman</p>
                          </div>
                      </li>
                  </ul>
              </div>
              
         </div>
      </div>
   </div>
@endsection