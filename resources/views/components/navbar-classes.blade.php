<nav class="header-classes mb-3 py-4 shadow-sm d-flex justify-content-center w-100 position-absolute top-0">
    <div class="nav-link p-2 ps-3 rounded-end-2 {{ request()->is('lessons*') ? 'active' : ''}}">
        <a href="/lessons/{{ $lessonId }}" class="text-decoration-none d-flex align-items-center text-dark">
            Materi
        </a>
    </div>
    <div class="nav-link p-2 ps-3 rounded-end-2 {{ request()->is('assignments*') ? 'active' : ''}}">
        <a href="/assignments/{{ $lessonId }}" class="text-decoration-none d-flex align-items-center text-dark">
            Tugas Kelas
        </a>
    </div>
    <div class="nav-link p-2 ps-3 rounded-end-2 {{ request()->is('class/*/members') ? 'active' : ''}}">
        <a href="/class/{{ $lessonId }}/members" class="text-decoration-none d-flex align-items-center text-dark">
            Anggota
        </a>
    </div>
</nav>