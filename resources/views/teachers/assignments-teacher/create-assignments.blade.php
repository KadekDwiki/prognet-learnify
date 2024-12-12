@extends('layouts.authenticated')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
        <h4>Tugas</h4>

        </div>
        <div class="card-body">
            <form method="POST" action="{{ isset($assignments) ? route('tcreate-assignments.store', $assignments->id) : route('create-assignments.update') }}">
                @csrf

                <div class="mt-4 mb-3">
                    <label for="desc" class="form-label">Deskripsi</label>
                    <div contenteditable="true" class="form-control" id="editor" style="min-height: 150px;">
                        {{-- Deskripsi --}}
                    </div>
                    <div class="toolbar mb-2">
                        <button type="button" class="btn btn-light" onclick="document.execCommand('bold', false, '')">
                            <b>B</b>
                        </button>
                        <button type="button" class="btn btn-light" onclick="document.execCommand('italic', false, '')">
                            <i>I</i>
                        </button>
                        <button type="button" class="btn btn-light" onclick="document.execCommand('underline', false, '')">
                            <u>U</u>
                        </button>
                        {{-- <button type="button" class="btn btn-light" onclick="document.execCommand('insertUnorderedList', false, '')">
                            <i class="fa fa-list-ul"></i>
                        </button> --}}
                    </div>
                </div>

                <div class="form-group mb-3 d-flex align-items-center">
                    <div class="me-3">
                        <button type="button" onclick="openGoogleDrive()">
                            <x-icon name="logos:google-drive" width="32" height="32" />
                        </button>
                    </div>
                    <div class="me-3">
                        <button type="button" onclick="openYouTube()">
                            <x-icon name="logos:youtube-icon" width="32" height="32" />
                        </button>
                    </div>
                    <div class="me-3">
                        <button type="button" onclick="addToClipboard()">
                            <x-icon name="solar:clipboard-add-broken" width="32" height="32" />
                        </button>
                    </div>
                    <div class="me-3">
                        <button type="button" onclick="uploadFile()">
                            <x-icon name="solar:upload-minimalistic-bold" width="32" height="32" />
                        </button>
                    </div>
                    <div class="me-3">
                        <button type="button" onclick="addLink()">
                            <x-icon name="material-symbols:link" width="32" height="32" />
                        </button>
                    </div>
                </div>


                <div class="form-group mb-3">
                    <label for="tugaskan_ke">Tugaskan ke</label>
                    <select class="form-control" id="tugaskan_ke" name="tugaskan_ke">
                        <option value="semua_siswa" {{ old('tugaskan_ke', $tugas->tugaskan_ke ?? '') === 'semua_siswa' ? 'selected' : '' }}>Semua siswa</option>
                        <!-- Tambahkan opsi lainnya jika perlu -->
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="poin">Poin</label>
                    <select class="form-control" id="poin" name="poin">
                        <option value="100" {{ old('poin', $tugas->poin ?? '') == '100' ? 'selected' : '' }}>100</option>
                        <!-- Tambahkan opsi lainnya jika perlu -->
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="tenggat">Tenggat</label>
                    <input type="date" class="form-control" id="tenggat" name="tenggat" value="{{ old('tenggat', $tugas->tenggat ?? '') }}">
                </div>

                <div class="form-group mb-3">
                    <label for="topik">Topik</label>
                    <select class="form-control" id="topik" name="topik">
                        <option value="" {{ old('topik', $tugas->topik ?? '') === '' ? 'selected' : '' }}>Tidak ada topik</option>
                    </select>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        {{ isset($tugas) ? 'Perbarui Tugas' : 'Buat Tugas' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
