@extends('layout.backend.app', ['title' => 'Verifikasi IRS'])

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="my-3 font-weight-bold text-primary">Verifikasi IRS</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <!-- Sesuaikan dengan struktur IRS dan tabel mahasiswa di database -->
            <div class="col-md-1">
                <p><strong>Nama</strong> </p>
                <p><strong>NIM</strong> </p>
                <p><strong>Semester</strong> </p>
                <p><strong>Jumlah SKS</strong> </p>
                <p><strong>File PDF</strong></p>
            </div>
            <div class="col-md-11">
                <p><strong>:</strong> {{ $mahasiswas->where('nim', $data->nim)->first()->nama }}</p>
                <p><strong>:</strong> {{ $data->nim }}</p>
                <p><strong>:</strong> {{ $data->semester }}</p>
                <p><strong>:</strong> {{ $data->jumlah_sks }}</p>
                <p style="display:inline-block"><strong>:</strong>
                    <a href="{{ asset('storage/irs/' . $data->file) }}" target="_blank">Lihat PDF</a>
                </p>
            </div>
        </div>
        <div class="mt-3">
            <form action="{{ route('irs.verifIrs', $data->id) }}" method="POST">
                @csrf
                <button type="submit" name="action" value="verifikasi" class="btn btn-success">Verifikasi</button>
                <button type="submit" name="action" value="tolak" class="btn btn-danger">Tolak</button>
            </form>
        </div>
    </div>
</div>
@endsection
