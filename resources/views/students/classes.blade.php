@extends('layouts.authenticated')

@section('content')
   <div class="header mb-3">
      <h4 class="text-primary text-capitalize">Selamat datang di kelas</h4>
      <p class="text-light-emphasis">Ingin mengikuti kelas apa hari ini?</p>
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
@endsection