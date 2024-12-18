<!-- Act only according to that maxim whereby you can, at the same time, will that it should become a universal law. - Immanuel Kant -->
<div class="class-card d-flex gap-3 rounded-3 shadow-sm p-3 bg-my-light-blue">
    <div class="image">
        <img src="{{ asset('images/class-card-math.png') }}" alt="">
    </div>
    <div class="description d-flex gap-2 flex-column w-100">
        <a href="{{ auth()->user()->role == 'student' ? '/lessons/' . $classId : '/lessons-teachers/' . $classId }}"
            class="btn btn-primary btn-sm rounded-pill px-3" style="width: fit-content">
            {{ $name }}
        </a>
        <h6 class="break-word">{{ $teacher }}</h6>
        <p class="break-word">Kode Kelas: {{ $token }}</p>
    </div>
</div>
