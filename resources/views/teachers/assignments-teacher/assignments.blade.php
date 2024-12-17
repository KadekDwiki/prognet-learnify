@extends('layouts.authenticated')

@section('content')
   <x-navbar-classes :lessonId="$classId"/>
   <div class="content-classes d-flex justify-content-center w-100">
      <div class="d-flex w-75 align-items-center flex-column gap-3">
         @if (session('success'))
            <div class="alert w-100 alert-success alert-dismissible fade show" role="alert">
               <strong>Berhasil!</strong> {{session('success')}}
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
         @endif
         <div class="progress w-100" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar" style="width: 25%">25%</div>
         </div>
         <div class="add-lesson w-100 d-flex justify-content-end">
            <a href="{{ "/assignments-create/$classId" }}" class="btn btn-primary">
               <x-icon class="" name="ic:round-plus" width="28" height="28" />
               Tambah Tugas
            </a>
         </div>

         <div class="row w-100 gap-4">
            @foreach ($assignments as $assignment) 
            <div class="card-lessons d-flex p-3 w-100 justify-content-between align-items-center rounded-2 shadow-sm" style="background-color: #B2DAFF30">
                  <div class="icon">
                     <x-icon class="me-3 text-primary" name="hugeicons:task-01" width="48" height="48" />
                  </div>
                  <div class="deadline w-75">
                     <h5>{{ Str::limit($assignment->title, 40, '...') }}</h5>
                     <p class="mb-0">{{ $assignment->created_at->diffForHumans() }}</p>
                  </div>
                  <div class="action">
                     <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#assignmentModal">
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

               <div class="modal fade" id="assignmentModal" tabindex="-1" aria-labelledby="assignmentModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <!-- Header -->
                      <div class="modal-header">
                        <h5 class="modal-title" id="assignmentModalLabel">{{ Str::limit($assignment->title, 40, '...') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <!-- Body -->
                      <div class="modal-body">
                        <p>Tenggat: {{ \Carbon\Carbon::parse($assignment->due_date)->format('j M Y, H.i') }}</p>
                        <div class="d-flex justify-content-around text-center border-top pt-3">
                          <div>
                            <h5 class="mb-0">0</h5>
                            <small>Diserahkan</small>
                          </div>
                          <div>
                            <h5 class="mb-0">1</h5>
                            <small>Belum Dinilai</small>
                          </div>
                          <div>
                            <h5 class="mb-0">0</h5>
                            <small>Sudah Dinilai</small>
                          </div>
                        </div>
                      </div>
                      <!-- Footer -->
                      <div class="modal-footer">
                        <a href="{{ url('/assignments/' . $classId . '/' . $assignment->id) }}"  class="btn btn-link">Lihat detail</a>
                        <button type="button" class="btn btn-primary">Tinjau Tugas</button>
                      </div>
                    </div>
                  </div>
                </div>
            @endforeach
         </div>
      </div>
   </div>
@endsection