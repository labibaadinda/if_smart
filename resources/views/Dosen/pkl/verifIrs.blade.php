@extends('layout.backend.app', ['title' => 'Verifikasi KHS'])

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="my-3 font-weight-bold text-primary">Verifikasi PKL</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-2" >
                <p><strong>Nama</strong> </p>
                <p><strong>NIM</strong> </p>
                <p><strong>Semester</strong> </p>
                <p><strong>Nilai</strong> </p>
                <p style="display:inline-block"><strong>Berita Acara</strong>
                </p>
            </div>
            <div class="col-md-10">
                <p><strong>:</strong> {{ $mahasiswas->where('nim',$pkl->nim)->first()->nama }}</p>
                <p><strong>:</strong> {{ $pkl->nim }}</p>
                <p><strong>:</strong> {{ $pkl->semester }}</p>
                <p><strong>:</strong> {{ $pkl->nilai }}</p>
                <p ><strong>:</strong>
                    <a href="{{ asset('storage/pkl/' . $pkl->file) }}" target="_blank">Lihat PDF</a>
                </p>
            </div>
        </div>
        <div class="mt-3">
            <form action="{{ route('pkl.verifPkl', $pkl->id) }}" method="POST">
                @csrf
                <button type="submit" name="action" value="verifikasi" class="btn btn-success">Verifikasi</button>
                <button type="submit" name="action" value="tolak" class="btn btn-danger">Tolak</button>
            </form>
        </div>
    </div>
</div>
@endsection
