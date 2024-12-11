@extends('layouts.authenticated')

@section('content')
   <div class="header mb-3">
      <h4 class="text-primary text-capitalize">Selamat datang di kelas</h4>
      <p class="text-light-emphasis">Ingin mengikuti kelas apa hari ini?</p>
      <div class="d-flex align-items-center flex-column gap-3">
         <div class="d-flex justify-content-center mt-2 mx-3 ms-auto">
            <button type="button" class="btn btn-outline-primary">Gabung Kelas</button>
         </div>
      </div>
      
         @if (session('success'))
            <div class="alert alert-success">
                  {{ session('success') }}
            </div>
         @endif
   </div>
   <div class="classes">
      <div class="class-cards gap-3">
         @foreach ($classes as $class)
            <x-card-class :classId="$class->class_id" :name="$class->class_name" :teacher="$class->teacher_name" task="10" progress="20" />
         @endforeach
      </div>
   </div>

   <!-- Modal untuk Gabung Kelas -->
   <div class="modal fade" id="joinClassModal" tabindex="-1" aria-labelledby="joinClassModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="joinClassModalLabel">Masukkan Kode Kelas</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form id="joinClassForm" action="{{ route('join.class') }}" method="POST">
                  @csrf
                  <div class="mb-3">
                     <label for="classCode" class="form-label">Kode Kelas</label>
                     <input type="text" class="form-control" id="classCode" name="classCode" required>
                     <div class="invalid-feedback">
                        Kode kelas harus diisi.
                     </div>
                  </div>
                  <div class="mb-3">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                     <button type="submit" class="btn btn-primary" id="joinClassButton" disabled>Gabung</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>

   <!-- Menambahkan JavaScript untuk Validasi Form -->
   <script>
      // Enable/Disable the "Gabung" button based on input
      document.getElementById('classCode').addEventListener('input', function () {
         const classCode = document.getElementById('classCode').value;
         const joinButton = document.getElementById('joinClassButton');
         joinButton.disabled = classCode.trim() === '';
      });
   </script>

@endsection