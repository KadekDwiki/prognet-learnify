@extends('layouts.authenticated')

@section('content')
   <div class="header d-flex w-90 justify-content-between mb-3">
      <div> 
         <h4 class="text-primary text-capitalize">Selamat datang di kelas</h4>
         <p class="text-light-emphasis">Ingin mengajar kelas apa hari ini?</p>
      </div>
      <div class="d-flex align-items-center">
         <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#createClassModal">
            Buat Kelas
         </button>
      </div>
   </div>

      
   @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
         <strong>Berhasil</strong> {{ session('success') }}
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
   @endif
   
   @if (session('error'))
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
         <strong>Gagal</strong> {{ session('error') }}
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
   @endif

   <div class="classes">
      <div class="class-cards gap-3">
         @foreach ($classes as $class)
            <x-card-class :classId="$class->class_id" :name="$class->class_name" :teacher="$class->teacher_name" task="10" progress="20" />
         @endforeach
      </div>
   </div>

   <!-- Modal untuk Buat Kelas -->
   <div class="modal fade" id="createClassModal" tabindex="-1" aria-labelledby="createClassModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="createClassModalLabel">Buat Kelas Baru</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form id="createClassForm" method="POST" action="{{ route('classes.store') }}">
                  @csrf
                  <div class="mb-3">
                     <label for="className" class="form-label">Nama Kelas</label>
                     <input type="text" class="form-control" id="className" name="name" required>
                  </div>
                  <div class="mb-3">
                     <label for="classDescription" class="form-label">Deskripsi</label>
                     <textarea class="form-control" id="classDescription" name="description" rows="3" required></textarea>
                  </div>
                  <div class="mb-3">
                     <label for="classSubject" class="form-label">Mata Pelajaran</label>
                     <select class="form-select" id="classSubject" name="subject" required>
                        <option value="">Pilih Mata Pelajaran</option>
                        <option value="Matematika">Matematika</option>
                        <option value="IPA">IPA</option>
                        <option value="IPS">IPS</option>
                        <option value="Bahasa Inggris">Bahasa Inggris</option>
                        <option value="Bahasa Indonesia">Bahasa Indonesia</option>
                        <option value="Fisika">Fisika</option>
                        <option value="Kimia">Kimia</option>
                        <option value="Biologi">Biologi</option>
                     </select>
                  </div>                             
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                     <button type="submit" class="btn btn-primary">Buat Kelas</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>

   <!-- Menambahkan JavaScript untuk Validasi Form -->
   <script>
      // Validasi input Nama Kelas
      document.getElementById('createClassForm').addEventListener('submit', function (event) {
         const className = document.getElementById('className').value;
         const classDescription = document.getElementById('classDescription').value;
         const classSubject = document.getElementById('classSubject').value;

         // Cek apakah Nama Kelas kosong
         if (className.trim() === '') {
            alert('Nama Kelas tidak boleh kosong.');
            event.preventDefault();
            return;
         }

         // Cek apakah Deskripsi kosong
         if (classDescription.trim() === '') {
            alert('Deskripsi tidak boleh kosong.');
            event.preventDefault();
            return;
         }

         // Cek apakah Mata Pelajaran dipilih
         if (classSubject === '') {
            alert('Silakan pilih Mata Pelajaran.');
            event.preventDefault();
            return;
         }
      });
   </script>

@endsection