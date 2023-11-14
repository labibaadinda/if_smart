@extends('layout.backend.app', [
    'title' => 'Detail Mahasiswa',
    'pageTitle' => 'Detail Mahasiswa',
])

@section('content')
<div class="card">
    <div class="card-body px-5">
        <div class="row mb-4">
            <div class="col-md-3">
                <p>
                    ini foto
                </p>
                {{-- <img src="{{ asset('storage/foto/' . $mahasiswa->foto) }}" class="card-img" alt="" width="207" height="207"> --}}
                <img src="{{ asset('storage/foto/' . $mahasiswa->foto) }}" alt="Mahasiswa Photo" class="img-fluid">
            </div>
            <div class="col-md-8">
                <h5>{{ $mahasiswa->nama }}</h5>
                <p>NIM: {{ $mahasiswa->nim }}</p>
                <!-- Tambahan informasi mahasiswa lainnya -->

                <h5>Detail Semester</h5>
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th class='col-2'>Semester</th>
                            <th>SKS</th>
                            <th>IPK</th>
                            <!-- Tambahkan kolom lain sesuai kebutuhan -->
                            <th>Detail</th>
                            {{-- <th>Status</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($irss as $irs)
                            <tr>
                                <td>{{ $irs->semester }}</td>
                                <td>{{ $irs->jumlah_sks }}</td>
                                <td>{{ $khss->where('semester',$irs->semester)->firstOrFail()->ips }}</td>
                                <!-- Tambahkan kolom lain sesuai kebutuhan -->
                                <td>
                                    <!-- IRS -->
                                    @if ($irs->status === '1')
                                        <a href="{{ asset('storage/irs/' . $irs->file) }}" target="_blank" class="btn btn-primary btn-sm ml-2">IRS</a>
                                    @elseif ($irs->status === '0')
                                        <a href="{{ route('search.showVerifikasiIrs', $irs->id) }}" id="{{ $irs->id }}" class="btn btn-danger btn-sm ml-2 btn-edit">Verifikasi IRS</a>
                                    @endif
                                    <!-- KHS -->
                                    @if ($khss->where('semester',$irs->semester)->firstOrFail()->status === '1')
                                        <a href="{{ asset('storage/khs/' . $khss->where('semester',$irs->semester)->firstOrFail()->file) }}" target="_blank" class="btn btn-primary btn-sm ml-2 " >KHS</a>
                                    @elseif ($khss->where('semester',$irs->semester)->firstOrFail()->status === '0')
                                        <a href="{{ route('search.showVerifikasiKhs', $khss->where('semester',$irs->semester)->firstOrFail()->id) }}" id="{{ $khss->where('semester',$irs->semester)->firstOrFail()->id }}" class="btn btn-danger btn-sm ml-2 btn-edit">Verifikasi KHS</a>
                                    @endif

                                    {{-- <a href="{{ route('semester.detail', [$mahasiswa->nim, $semester->semester]) }}" class="btn btn-primary">Detail</a> --}}

                                    <!-- SKRIPSI -->
                                </td>
                                {{-- <td>
                                    a
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mb-4 gx-5">
            <div class="col-md-5 mr-5">
                <h5>Detail PKL</h5>
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>Progres</th>
                            <th>Judul PKL</th>
                            <th>Status</th>
                            <!-- Tambahkan kolom lain sesuai kebutuhan -->
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pkls as $pkl)
                            <tr>
                                <td>{{ $pkl->progres }}</td>
                                <td>{{ $pkl->judul }}</td>
                                <td>{{ $pkl->stat_pkl }}</td>
                                <!-- Tambahkan kolom lain sesuai kebutuhan -->
                                <td>
                                    @if ($pkl->konfirmasi === '1')
                                        <a href="{{ asset('storage/pkl/' . $pkl->file) }}" target="_blank" class="btn btn-primary btn-sm ml-2">PDF</a>
                                    @elseif ($pkl->konfirmasi === '0')
                                        <a href="{{ route('search.showVerifikasiPkl', $pkl->id) }}" id="{{ $pkl->id }}" class="btn btn-danger btn-sm ml-2 btn-edit">Verifikasi PKL</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-5">
                <h5>Detail Skripsi</h5>
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th >Progres</th>
                            <th>Judul Skripsi</th>
                            <th>Status</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($skripsis as $skripsi)
                            <tr class='text-center'>
                                <td>{{ $skripsi->progres }}</td>
                                <td>{{ $skripsi->judul }}</td>
                                <td>{{ $skripsi->stat_skripsi }}</td>
                                <td>
                                    @if ($skripsi->konfirmasi === '1')
                                        <a href="{{ asset('storage/skripsi/' . $skripsi->file) }}" target="_blank" class="btn btn-primary btn-sm ml-2">PDF</a>
                                    @elseif ($skripsi->konfirmasi === '0')
                                        <a href="{{ route('search.showVerifikasiSkripsi', $skripsi->id) }}" id="{{ $skripsi->id }}" class="btn btn-danger btn-sm ml-2 btn-edit">Verifikasi Skripsi</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        @if ( $skripsi->stat_skripsi === 'selesai') <!-- $skripsi->stat_skripsi === 'selesai' -->
                            <tr>
                                <td colspan="3" style="text-align: center;"><strong>Tanggal Sidang: &ensp;{{ $tanggal_sidang }} </strong>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
