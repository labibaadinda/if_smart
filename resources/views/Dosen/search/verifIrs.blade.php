@extends('layout.backend.app', ['title' => 'Verifikasi IRS'])

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="my-3 font-weight-bold text-primary">Verifikasi IRS</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-1">
                <p><strong>Nama</strong> </p>
                <p><strong>NIM</strong> </p>
                <p><strong>Semester</strong> </p>
                <p><strong>Jumlah SKS</strong> </p>
                <p><strong>File PDF</strong></p>
            </div>
            <div class="col-md-11">
                <p><strong>:</strong> {{ $mahasiswas->where('nim',$irs->nim)->first()->nama }}</p>
                <p><strong>:</strong> {{ $irs->nim }}</p>
                <p><strong>:</strong> {{ $irs->semester }}</p>
                <p><strong>:</strong> {{ $irs->jumlah_sks }}</p>
                <p style="display:inline-block"><strong>:</strong>
                    <a href="{{ asset('storage/irs/' . $irs->file) }}" target="_blank">Lihat PDF</a>
                </p>
            </div>
        </div>
        <div class="mt-3">
            <form action="{{ route('search.verifIrs', $irs->id) }}" method="POST">
                @csrf
                <button type="submit" name="action" value="verifikasi" class="btn btn-success">Verifikasi</button>
                <button type="submit" name="action" value="tolak" class="btn btn-danger">Tolak</button>
            </form>
        </div>
    </div>
</div>
@endsection
