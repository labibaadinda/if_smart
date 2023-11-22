@extends('layout.backend.app', [
'title' => 'Welcome',
'pageTitle' => 'Dashboard ' . ucfirst(Auth::user()->role),
])
@section('content')
<hr>
@if(session()->has('success'))
<div class="notify">

    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
<script>
    setTimeout(function(){
      $('.alert').alert('close');
    }, 2000);
</script>
@endif
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            JUMLAH MAHASISWA</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $mahasiswas->get()->count() }} </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            MAHASISWA AKTIF</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{
                            $mahasiswas->get()->where('status','aktif')->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="card m-0">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            @if(empty($dosen->foto))
                                <img src="{{ asset('images/backend/ava.jpg') }}" class="card-img" alt="" width="107" height="150">
                            @else
                                <img src= "{{ asset('storage/foto/' . $dosen->foto) }}" class="card-img" alt="" width="207" height="250">
                            @endif
                        </div>

                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title text-dark">{{ $dosen->nama }}</h5>
                                <h5 class="card-title text-dark">{{ $dosen->nip }}</h5>
                                <h5 class="card-title text-dark">Dosen S1 Informatika</h5>
                                {{-- @foreach($dosens as $dosen)
                                @endforeach --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg">
        <div class="card">
            <div class="card-body">
                <div class="card m-0">
                    <div class="row no-gutters">
                        <table class="table text-center table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="100%">
                                        <h5 ><strong>Angkatan</strong></h5>
                                    </th>
                                </tr>
                                <tr >
                                    @foreach (range($thnmin->angkatan, $thnmax->angkatan) as $item)
                                        <th colspan="2">{{ $item }}</th>
                                        {{-- <th>SKS</th> --}}
                                    @endforeach
                                </tr>
                                <tr >
                                    @foreach (range($thnmin->angkatan, $thnmax->angkatan) as $item)
                                        <th >Sudah</th>
                                        <th>Belum</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach(range($thnmin->angkatan, $thnmax->angkatan) as $item)
                                    <td>
                                        {{ $pkls->where('konfirmasi','1')->count() }}
                                        {{-- @if ($khss->where('semester',$irs->semester)->first())
                                        {{ $khss->where('semester',$irs->semester)->firstOrFail()->ips }}
                                        @else
                                        Belum Mengupload KHS
                                        @endif --}}
                                    </td>
                                    <td colspan="1"> {{ $pkls->where('stat_pkl','progres')->count() }}</td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    {{-- <h5>max: {{ $thnmax->angkatan }}</h5>
                    <h5>min: {{ $thnmin->angkatan }}</h5>
                    <h5>countBy: {{ $countby }}</h5>
                    <h5>pkls test: {{ $pkls->where('konfirmasi','1')->count() }}</h5> --}}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="row mt-4">
    <div class="col-md-3">
        <a href="
    {{ route('irs.index') }}
    " class="card-link">
            <div class="card ">
                <div class="card-body text-center">
                    <h5 class="card-title">Verifikasi IRS</h5>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="
    {{ route('khs.index') }}
    " class="card-link">
            <div class="card ">
                <div class="card-body text-center">
                    <h5 class="card-title">Verifikasi KHS</h5>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="
    {{ route('pkl.index') }}
    " class="card-link">
            <div class="card ">
                <div class="card-body text-center">
                    <h5 class="card-title">Verifikasi PKL</h5>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="
    {{ route('skripsi.index') }}
    " class="card-link">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Verifikasi Skripsi</h5>
                </div>
            </div>
        </a>
    </div>
</div> --}}
<!-- resources/views/modal/address.blade.php -->
</div>


@endsection
