@extends('layouts.authenticated')

@section('content')
   <div class="header mb-3">
      <h4 class="text-primary text-capitalize">Selamat {{ $greeting }}, {{ auth()->user()->name }}!</h4>
      <p class="text-light-emphasis">Ayo tambahkan tugas baru</p>
   </div>
   <div class="banner px-5 rounded-5 d-flex justify-content-between align-items-center mb-3 shadow-sm">
      <div class="banner-text">
         <h2 class="text-light">Sebarkan Ilmu Pengetahuan dengan Learnify</h2>
         <p class="text-light">Dilengkapi dengan pengingat dan progress tracker untuk mendukung proses mengajarmu.</p>
      </div>
      <div class="banner-image">
         <img src="{{ asset('images\dashboard-teachers.png') }}" alt="">
      </div>
   </div>

   <div class="classes">
      <div class="d-flex justify-content-between">
         <h5 class="text-primary mb-3">Kelasmu ({{ $classCount }})</h5>
         <a href="{{ route('classes-teachers') }}" class="link-offset-2">Lihat Semua</a>
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