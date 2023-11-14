@extends('layout.backend.app', ['title' => 'Verifikasi SKRIPSI'])

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="my-3 font-weight-bold text-primary">Verifikasi Skripsi</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-1" >
                <p><strong>Nama</strong> </p>
                <p><strong>NIM</strong> </p>
                <p><strong>Judul Skripsi</strong> </p>
                <p><strong>Progres Ke</strong> </p>
                <p><strong>Status</strong> </p>
                @if ( $skripsi->stat_skripsi === 'selesai' )
                    <p><strong>Tanggal Sidang</strong> </p>
                @endif
                <p style="display:inline-block"><strong>File PDF</strong>
                </p>
            </div>
            <div class="col-md-11">
                <p><strong>:</strong> {{ $mahasiswas->where('nim',$skripsi->nim)->first()->nama }}</p>
                <p><strong>:</strong> {{ $skripsi->nim }}</p>
                <p><strong>:</strong> {{ $skripsi->judul }}</p>
                <p><strong>:</strong> {{ $skripsi->progres }}</p>
                <p><strong>:</strong> {{ $skripsi->stat_skripsi }}</p>
                @if ( $skripsi->stat_skripsi === 'selesai' )
                    <p><strong>{{ $skripsi->tanggal_sidang }}</strong> </p>
                @endif
                <p ><strong>:</strong>
                    <a href="{{ asset('storage/skripsi/' . $skripsi->file) }}" target="_blank">Lihat PDF</a>
                </p>
            </div>
        </div>
        <div class="mt-3">
            <form action="{{ route('search.verifSkripsi', $skripsi->id) }}" method="POST">
                @csrf
                <button type="submit" name="action" value="verifikasi" class="btn btn-success">Verifikasi</button>
                <button type="submit" name="action" value="tolak" class="btn btn-danger">Tolak</button>
            </form>
        </div>
    </div>
</div>
@endsection
