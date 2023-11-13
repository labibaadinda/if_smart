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
                {{-- <img src="{{ asset('path-to-mahasiswa-photo/' . $mahasiswa->foto) }}" alt="Mahasiswa Photo" class="img-fluid"> --}}
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
                                        <a href="{{ asset('storage/irs/' . $irs->file) }}" target="_blank" class="btn btn-primary">IRS</a>
                                    @else
                                        <a href="{{ asset('storage/irs/' . $irs->file) }}" target="_blank" class="btn btn-danger">Verifikasi IRS</a>

                                    <!-- KHS -->
                                    @endif
                                    @if ($khss->where('semester',$irs->semester)->firstOrFail()->status === '1')
                                        <a href="{{ asset('storage/khs/' . $khss->where('semester',$irs->semester)->firstOrFail()->file) }}" target="_blank" class="btn btn-primary" >KHS</a>
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
                        @foreach($irss as $irs)
                            <tr>
                                <td>{{ $irs->semester }}</td>
                                <td>{{ $irs->jumlah_sks }}</td>
                                <td>{{ $khss->where('semester',$irs->semester)->firstOrFail()->ips }}</td>
                                <!-- Tambahkan kolom lain sesuai kebutuhan -->
                                <td>
                                    <!-- IRS -->
                                    {{-- <a href="{{ route('semester.detail', [$mahasiswa->nim, $semester->semester]) }}" class="btn btn-primary">Detail</a> --}}
                                    <!-- KHS -->
                                    {{-- <a href="{{ route('semester.detail', [$mahasiswa->nim, $semester->semester]) }}" class="btn btn-primary">Detail</a> --}}
                                    <!-- SKRIPSI -->
                                    {{-- @if ()

                                    @endif --}}
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
                        @foreach($irss as $irs)
                            <tr class='text-center'>
                                <td>{{ $irs->semester }}</td>
                                <td>{{ $irs->jumlah_sks }}</td>
                                <td>{{ $khss->where('semester',$irs->semester)->firstOrFail()->ips }}</td>
                                <!-- Tambahkan kolom lain sesuai kebutuhan -->
                                <td>
                                    <!-- IRS -->
                                    {{-- <a href="{{ route('semester.detail', [$mahasiswa->nim, $semester->semester]) }}" class="btn btn-primary">Detail</a> --}}
                                    <!-- KHS -->
                                    {{-- <a href="{{ route('semester.detail', [$mahasiswa->nim, $semester->semester]) }}" class="btn btn-primary">Detail</a> --}}
                                    <!-- SKRIPSI -->
                                    {{-- @if ()

                                    @endif --}}
                                </td>
                            </tr>
                        @endforeach
                        @if ( $irs) <!-- $skripsi->stat_skripsi === 'selesai' -->
                            <tr>
                                <td colspan="3" style="text-align: center;"><strong>Tanggal Sidang: &ensp;10 Januari, 2023 </strong>
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
