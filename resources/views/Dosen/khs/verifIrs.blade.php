@extends('layout.backend.app', ['title' => 'Verifikasi KHS'])

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="my-3 font-weight-bold text-primary">Verifikasi KHS</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-1" >
                <p><strong>NIM</strong> </p>
                <p><strong>Semester</strong> </p>
                <p><strong>IP Semester</strong> </p>
                <p style="display:inline-block"><strong>File PDF</strong>
                </p>
            </div>
            <div class="col-md-11">
                <p><strong>:</strong> {{ $khs->nim }}</p>
                <p><strong>:</strong> {{ $khs->semester }}</p>
                <p><strong>:</strong> {{ $khs->ips }}</p>
                <p style="display:inline-block"><strong>:</strong>
                    <a href="{{ asset('storage/khs/' . $khs->file) }}" target="_blank">Lihat PDF</a>
                </p>
            </div>
        </div>
        <div class="mt-3">
            <form action="{{ route('khs.verifKhs', $khs->id) }}" method="POST">
                @csrf
                <button type="submit" name="action" value="verifikasi" class="btn btn-success">Verifikasi</button>
                <button type="submit" name="action" value="tolak" class="btn btn-danger">Tolak</button>
            </form>
        </div>
    </div>
</div>
@endsection
