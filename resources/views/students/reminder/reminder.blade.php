@extends('layouts.authenticated')

@section('content')

      <div class="banner px-5 py-1 rounded-5 d-flex justify-content-start align-items-center mb-3 shadow-sm banner-reminder">  
         <div class="banner-text">
            <h3 class="text-light m-0 me-3">Langkah kecil hari ini, hasil besar di masa depan. Yuk belajar!</h3>
         </div>
         <div class="banner-image">
            <img src="{{ asset('images\api-reminder-aka-streak.png') }}" alt="" height='96' weight='74'>
         </div>
      </div>

      <div class="d-flex flex-column p-5 shadow-sm">
          <!-- Form untuk filter berdasarkan tanggal -->
         <form method="GET" action="{{ route('reminder') }}">
             <input type="date" name="date" class="form-control mb-3 w-25" id="reminder" value="{{ request('date') }}">
             <button type="submit" class="btn btn-primary mb-3">Filter</button>
         </form>
            <div class="class-cards gap-3">
             @forelse ($assignments as $assignment)
             <div class="class-card d-flex flex-column gap-3 rounded-3 shadow-sm p-3 bg-my-light-blue">
                 <div class="image d-flex justify-content-between">
                     <div class="d-flex align-items-center"> 
                         <img src="{{ $assignment->classes->profile_photo_path ? asset('storage/' . $assignment->classes->profile_photo_path) : asset('images/profile.png') }}" class="rounded-circle me-3" height="92" width="86" alt="">
                            <div>
                             <h5 class="text-dark">{{ $assignment->classes->name }}</h5> <!-- Menampilkan nama kelas -->
                             <p class="text-secondary">{{ $assignment->due_date }}</p>
                         </div>
                     </div>   
                     <a href="/assignments/{{ $assignment->class_id }}/{{ $assignment->id }}">
                         <x-icon class="text-danger" name="lets-icons:size-right-up" height="26" width="26" />
                     </a>
                 </div>
                 <div class="description d-flex gap-2 flex-column w-100">
                     <p class="px-3" style="width: fit-content">
                         {{ $assignment->title }}
                     </p>
                     <div class="d-flex align-items-center bg-white bg-opacity-50 shadow-sm p-3 rounded-3">
                         <div class="card-icon me-3">
                             <x-icon class="text-primary" name="akar-icons:file" height="44" width="44" />
                         </div>
                         <div class="card-desc">
                             <a href="" class="text-dark text-decoration-none" target="_blank">
                                 {{ $assignment->assignment_file }}
                             </a>
                         </div>
                     </div>
                 </div>
             </div>
             @empty
                        
             @endforelse
         </div>
         <div class="banner-image d-flex flex-column justify-content-center align-items-center text-center">
            <img src="{{ asset('images/rainy-smile.png') }}" alt="" height="120" width="120" class="mb-2">
            <p class="text-muted">Tidak ada tugas yang tersedia untuk tanggal ini.</p>
         </div>
      </div>

@endsection
