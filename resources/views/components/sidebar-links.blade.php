<!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->
<div class="side-links d-flex flex-column gap-2">
    <div class="side-link p-2 ps-3 rounded-end-2 {{ request()->is('dashboard') ? 'active' : ''}}">
        <a href="{{ route('dashboard') }}" class="text-decoration-none d-flex align-items-center text-dark">
            <x-icon class="me-3" name="solar:home-2-broken" width="28" height="28" />
            Beranda</a>
    </div>
    <div class="side-link p-2 ps-3 rounded-end-2 {{ Request::is('kelas*') ? 'active' : ''}}">
        <a href="{{ route('dashboard') }}" class="text-decoration-none d-flex align-items-center text-dark">
            <x-icon class="me-3" name="solar:notebook-bookmark-broken" width="28" height="28" />
            Kelas</a>
    </div>
    <div class="side-link p-2 ps-3 rounded-end-2 {{ Request::is('kelas*') ? 'active' : ''}}">
        <a href="{{ route('dashboard') }}" class="text-decoration-none d-flex align-items-center text-dark">
            <x-icon class="me-3" name="solar:bell-broken" width="28" height="28" />
            Pengingat</a>
    </div>
    <div class="side-link p-2 ps-3 rounded-end-2 {{ Request::is('kelas*') ? 'active' : ''}}">
        <a href="{{ route('dashboard') }}" class="text-decoration-none d-flex align-items-center text-dark">
            <x-icon class="me-3" name="solar:settings-broken" width="28" height="28" />
            Pengaturan</a>
    </div>
</div>