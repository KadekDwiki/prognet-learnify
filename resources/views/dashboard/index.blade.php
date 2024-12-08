@extends('layouts.authenticated')

@section('content')
   <div class="header mb-3">
      <h4 class="text-primary text-capitalize">Selamat {{ $greeting }}, {{ auth()->user()->name }}!</h4>
      <p class="text-light-emphasis">Ayo belajar hal baru hari ini</p>
   </div>
   <div class="banner px-5 rounded-5 d-flex justify-content-between align-items-center mb-3 shadow-sm">
      <div class="banner-text">
         <h2 class="text-light">Jelajahi Dunia Ilmu Pengetahuan dengan Learnify.</h2>
         <p class="text-light">Dilengkapi dengan pengingat dan proses tracker untuk mendukung belajarmu.</p>
      </div>
      <div class="banner-image">
         <img src="{{ asset('images/dashboard-banner.png') }}" alt="">
      </div>
   </div>
   <div class="recaps mb-4">
      <h5 class="text-primary mb-3">Pekerjaanmu</h5>
      <div class="recap-cards d-flex gap-3">
         <div class="recap-card w-100 d-flex flex-column p-3 bg-my-light-blue rounded-3 shadow-sm">
            <p class="text-light-emphasis">Tugas dalam Progress</p>
            <h4 class=" h1 fw-bold text-primary">{{ $pendingAssignments }}</h4>
         </div>
         <div class="recap-card w-100 d-flex flex-column p-3 bg-my-light-blue rounded-3 shadow-sm">
            <p class="text-light-emphasis">Tugas Selesai</p>
            <h4 class=" h1 fw-bold text-primary">{{ $completedAssignments }}</h4>
         </div>
         <div class="recap-card w-100 d-flex flex-column p-3 bg-my-light-blue rounded-3 shadow-sm">
            <p class="text-light-emphasis">Kelas</p>
            <h4 class=" h1 fw-bold text-primary">{{ $classCount }}</h4>
         </div>
      </div>
   </div>
   <div class="classes">
      <div class="d-flex justify-content-between">
         <h5 class="text-primary mb-3">Kelasmu</h5>
         <a href="{{ route('classes') }}" class="link-offset-2">Lihat Semua</a>
      </div>
      
      @if(count($classes) > 0)
         <div class="class-cards gap-3">
            @foreach ($classes as $class)
               <x-card-class :classId="$class->class_id" :name="$class->class_name" :teacher="$class->teacher_name" task="10" progress="20" />
            @endforeach
         </div>
      @else
         <div class="empty-classes">
            <div class="d-flex justify-content-center align-items-center flex-column">
               <img src="{{ asset('images/rainy-face.png') }}" alt="">
               <p>Yahh, kamu belom ada kelas</p>
               <a href="" class="btn btn-primary rounded-pill px-4">Gabung Kelas</a>
            </div>
         </div>
      @endif
   </div>
@endsection