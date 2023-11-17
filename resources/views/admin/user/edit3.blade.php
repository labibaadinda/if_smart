{{-- resources/views/user/edit.blade.php --}}

@extends('layout.backend.app', [
'title' => 'Edit Mahasiswa',
'pageTitle' => 'Edit Mahasiswa',
])

@push('css')
<link href="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.css"
    rel="stylesheet">
@endpush

@section('content')

@if(session()->get('message'))

@php
$status = session()->get('message')['status'];
$message = session()->get('message')['message'];
@endphp

@push('js')
<script>
    $(document).ready(function () {
      console.log()
      showToastr((`{{ $status }}` === 'true'), `{{ $message }}`)
    })
</script>
@endpush
@endif

<div class="card">
    <div class="card-body">
        <p>
            User: {{ $user }}
        </p>
        <form action="{{ route('user.update', $mahasiswa->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" value="{{ $mahasiswa->nama }}" required>
            </div>

            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="number" name="nim" id="nim" class="form-control" value="{{ $mahasiswa->nim }}" required>
            </div>

            <div class="form-group">
                <label for="angkatan">Angkatan</label>
                <input type="number" name="angkatan" id="angkatan" class="form-control"
                    value="{{ $mahasiswa->angkatan }}" required>
            </div>

            <div class="form-group">
                <label for="dosen_id">Dosen Pembimbing</label>
                <select name="dosen_id" id="dosen_id" class="form-control" required>
                    @foreach ($dosens as $dosen)
                    <option value="{{ $dosen->id }}" {{ $mahasiswa->dosen_id == $dosen->id ? 'selected' : '' }}>{{
                        $dosen->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select name="role" id="r" class="form-control">
                    <option disabled="">- PILIH ROLE -</option>
                    @php

                    $roles = [
                    ['value' => 'admin', 'name' => 'Admin'],
                    ['value' => 'dosen', 'name' => 'Dosen'],
                    ['value' => 'departemen', 'name' => 'Departemen'],
                    ['value' => 'mahasiswa', 'name' => 'Mahasiswa'],
                    ];

                    @endphp


                    @foreach($roles as $role)

                    <option {{ $user->role === $role['value'] ? 'selected' : '' }} value="{{ $role['value'] }}">{{
                        $role['name'] }}</option>

                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="s">Status</label>
                <select name="status" id="r" class="form-control">
                    <option disabled="">- PILIH Status -</option>
                    @php

                    $statuss = [
                        ['value' => 'aktif', 'name' => 'Aktif'],
                        ['value' => 'lulus', 'name' => 'Lulus'],
                        ['value' => 'do', 'name' => 'DO'],
                        ['value' => 'mangkir', 'name' => 'Mangkir'],
                        ['value' => 'mengundurkan_diri', 'name' => 'Mengundurkan Diri'],
                        ['value' => 'cuti', 'name' => 'Cuti'],
                        ['value' => 'meninggal_dunia', 'name' => 'Meninggal Dunia'],
                    ];

                    @endphp


                    @foreach($statuss as $status)

                    <option {{ $mahasiswa->status === $status['value'] ? 'selected' : '' }} value="{{ $status['value'] }}">{{
                        $status['name'] }}</option>

                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('user.reset-password', $mahasiswa->id) }}" class="btn btn-warning">Reset Password</a>
            <a href="{{ route('user.delete', $user->id) }}" class="btn btn-danger"
                onclick="return confirm('Apakah Anda yakin ingin menghapus mahasiswa ini?')">Delete</a>
        </form>
    </div>
</div>
@endsection
