<nav class="header-classes mb-3 py-4 shadow-sm d-flex justify-content-center w-100 position-absolute top-0">
    @if (auth()->user()->role == 'student')
        <div class="nav-link p-2 ps-3 rounded-end-2 {{ request()->is('lessons*') ? 'active' : '' }}">
            <a href="/lessons/{{ $lessonId }}" class="text-decoration-none d-flex align-items-center text-dark">
                Materi
            </a>
        </div>
        <div class="nav-link p-2 ps-3 rounded-end-2 {{ request()->is('assignments*') ? 'active' : '' }}">
            <a href="/assignments/{{ $lessonId }}" class="text-decoration-none d-flex align-items-center text-dark">
                Tugas Kelas
            </a>
        </div>
        <div class="nav-link p-2 ps-3 rounded-end-2 {{ request()->is('members*') ? 'active' : '' }}">
            <a href="/members/{{ $lessonId }}" class="text-decoration-none d-flex align-items-center text-dark">
                Anggota
            </a>
        </div>
    @endif

    @if (auth()->user()->role == 'teacher')
        <div class="nav-link p-2 ps-3 rounded-end-2 {{ request()->is('lessons*') ? 'active' : '' }}">
            <a href="/lessons-teachers/{{ $lessonId }}"
                class="text-decoration-none d-flex align-items-center text-dark">
                Materi
            </a>
        </div>
        <div class="nav-link p-2 ps-3 rounded-end-2 {{ request()->is('assignments*') ? 'active' : '' }}">
            <a href="/assignments-teachers/{{ $lessonId }}"
                class="text-decoration-none d-flex align-items-center text-dark">
                Tugas Kelas
            </a>
        </div>
        <div class="nav-link p-2 ps-3 rounded-end-2 {{ request()->is('members*') ? 'active' : '' }}">
            <a href="/members-teachers/{{ $lessonId }}"
                class="text-decoration-none d-flex align-items-center text-dark">
                Anggota
            </a>
        </div>
        <div class="nav-link p-2 ps-3 rounded-end-2 {{ request()->is('assignments*') ? 'active' : '' }}">
            <a href="/assignments-teachers/{{ $lessonId }}"
                class="text-decoration-none d-flex align-items-center text-dark">
                Nilai
            </a>
        </div>
    @endif
</nav>
