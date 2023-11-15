@extends('layout.backend.app', [
    'title' => 'Edit Mahasiswa',
    'pageTitle' => 'Edit Mahasiswa',
])

@section('content')
<div class="card">
    <div class="card-body px-5">
        <form action="{{ route('user.update', $user->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $mahasiswa->nama }}">
            </div>
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" class="form-control" id="nim" name="nim" value="{{ $user->nim }}">
            </div>
            <div class="mb-3">
                <label for="angkatan" class="form-label">Angkatan</label>
                <input type="text" class="form-control" id="angkatan" name="angkatan" value="{{ $user->angkatan }}">
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="text" class="form-control" id="status" name="status" value="{{ $user->status }}">
            </div>
            <div class="mb-3">
                <label for="dosen_id" class="form-label">Dosen Wali</label>
                <select class="form-select" id="dosen_id" name="dosen_id">
                    @foreach($dosens as $dosen)
                        <option value="{{ $dosen->id }}" {{ $user->dosen_id == $dosen->id ? 'selected' : '' }}>
                            {{ $dosen->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('user.reset-password', $user->id) }}" class="btn btn-warning">Reset Password</a>
            <a href="{{ route('user.delete', $user->id) }}" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus mahasiswa ini?')">Delete</a>
        </form>
    </div>
</div>
@endsection
