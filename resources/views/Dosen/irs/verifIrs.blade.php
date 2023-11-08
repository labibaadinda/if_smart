@extends('layout.backend.app', ['title' => 'Verifikasi IRS'])

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="my-3 font-weight-bold text-primary">Verifikasi IRS</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>NIM:</strong> {{ $irs->nim }}</p>
                <p><strong>Semester:</strong> {{ $irs->semester }}</p>
                <p><strong>Jumlah SKS:</strong> {{ $irs->jumlah_sks }}</p>
                <p><strong>File PDF:</strong></p>
                <a href="{{ asset('storage/irs/' . $irs->file) }}" target="_blank">Lihat PDF</a>
            </div>
        </div>
        <div class="mt-3">
            <form action="{{ route('irs.verifIrs', $irs->id) }}" method="POST">
                @csrf
                <button type="submit" name="action" value="verifikasi" class="btn btn-success">Verifikasi</button>
                <button type="submit" name="action" value="tolak" class="btn btn-danger">Tolak</button>
            </form>
        </div>
    </div>
</div>
@endsection
