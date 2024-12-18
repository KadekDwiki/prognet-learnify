@extends('layouts.authenticated')

@section('content')
   <x-navbar-classes :lessonId="$classId"/>
   <div class="content-classes d-flex justify-content-center w-100">
      <div class="d-flex w-75 align-items-center flex-column gap-3">
         <div class="row w-100 mt-4 gap-2">
            @if (session('success'))
               <div class="alert alert-success">
                     {{ session('success') }}
               </div>
            @endif
               <div class="description px-0">
                  <h3>{{ $assignment->title }}</h3>
                  <p class="border-bottom text-secondary pb-4">Dibuat: {{ $assignment->created_at->diffForHumans() }}</p>
                  <p>
                     {{$assignment->description }}
                  </p>
               </div>

               @if (!empty($assignment->file_url))
                  <div class="d-flex align-items-center bg-body-secondary bg-opacity-50 shadow-sm p-3 rounded-3">
                     <div class="card-icon me-3">
                        <x-icon class="text-primary" name="akar-icons:file" height="44" width="44" />
                     </div>
                        <div class="card-desc">
                           <a href="{{ $assignment->file_url }}" class="text-dark text-decoration-none" target="_blank">
                              {{ Str::limit($assignment->file_url, 70, '...') }}
                           </a>
                        </div>
                  </div>
               @endif
               @if (empty($submission))
                  <form action="{{ route('classes.upload_submission') }}" method="POST" enctype="multipart/form-data" class="pt-5 border-top border-secondary">
                     @csrf
                     <input type="text" name="assignment_id" value="{{ $assignmentId }}" hidden>
                     <label for="images" class="drop-container @error('file') is-invalid border-danger @enderror" id="dropcontainer">
                        <span class="drop-title">Upload file tugasmu</span>
                        or
                        <div class="input-group w-50">
                           <input type="file" name="file" class="form-control border-primary" id="input-file" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                        </div>
                     </label>
                     @error('file')
                     <div class="invalid-feedback">
                        {{ $message }}
                     </div>
                     @enderror
                     <button type="submit" class="btn btn-primary mt-4 w-100">Kirim</button>
                  </form>
               @else
                  <div class="pt-4 mt-4 px-0 border-top">
                     <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">Well done!</h4>
                        <p>Aww yeah, kamu berhasil mengumpulkan tugasmu itu sangat keren mantap keren aseli keren banget, tunggu tugasmu akan dinilai ya dan nikmati hasil dari kerja kerasmu</p>
                        <hr>
                        <p class="mb-0"> Pratinjau tugasmu: 
                           <a data-fancybox data-type="iframe" href="{{ asset("storage/$submission->file_url") }}">
                              Lihat tugas
                           </a>  
                        </a></p>
                     </div>  
                  </div>
               @endif
         </div>
      </div>
   </div>
@endsection