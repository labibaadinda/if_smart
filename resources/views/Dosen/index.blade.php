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
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <a href="{{ route('listmahasiswa') }}">
                                {{ $mahasiswas->where('dosen_id',$dosen->id)->count() }}
                            </a>
                        </div>
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
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <a href="{{ route('listMahasiswa','aktif') }}">
                                {{-- {{ $mahasiswas->get()->count() }} --}}
                                {{ $mahasiswas->where('dosen_id',$dosen->id)->where('status','aktif')->count() }}</div>
                            </a>
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
        <div class="card mb-2">
            <div class="card-body">
                <div class="card m-0">
                    <div class="row no-gutters " >
                        <div class="text-center mx-auto py-2">
                            <h5 class="text-center ">Rekap Progress PKL Mahasiswa Informatika Fakultas Sains dan Matematika UNDIP Semarang</h5>
                        </div>
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
                                    @foreach ($angkatanArray as $angkatanItem => $jumlah)
                                        <td>
                                            <a href="{{ route('departemen.listMahasiswaAngkatan', ['angkatan' => $angkatanItem, 'status' => 'sudah']) }}">
                                                {{ $jumlah['sudah_pkl'] }}
                                            </a>
                                        </td>
                                        <td colspan="1">
                                            <a href="{{ route('departemen.listMahasiswaAngkatan', ['angkatan' => $angkatanItem, 'status' => 'belum']) }}">
                                                {{ $jumlah['belum_pkl'] }}
                                            </a>
                                        </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                        {{-- <div class="btn">
                            <a href="#">
                                Tombol Cetgak
                            </a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="card m-0">
                    <div class="row no-gutters " >
                        <div class="text-center mx-auto">
                            <h5 class="text-center ">Rekap Status Mahasiswa Informatika Fakultas Sains dan Matematika UNDIP Semarang</h5>
                        </div>
                        <table class="table text-center table-bordered">
                            <thead>
                                <tr class="align-items-center">
                                    <th rowspan="2" class="align-content-center align-items-center">Status</th>
                                    <th colspan="100%">
                                        <h5 ><strong>Angkatan</strong></h5>
                                    </th>
                                </tr>
                                <tr >
                                    @foreach (range($thnmin->angkatan, $thnmax->angkatan) as $item)
                                        <th colspan="">{{ $item }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <tr >
                                    <th class="col-md-2">Aktif</th>
                                    @foreach (range($thnmin->angkatan, $thnmax->angkatan) as $item)
                                        <th colspan="">
                                            <a href="{{ route('departemen.listStatusMahasiswa',['status' => 'aktif', 'angkatan' => $item]) }}">
                                                {{ $mahasiswas->where('dosen_id',$dosen->id)->where('status','aktif')->where('angkatan',$item)->count() }}
                                            </a>
                                        </th>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th class="col-md-2">Cuti</th>
                                    @foreach (range($thnmin->angkatan, $thnmax->angkatan) as $item)
                                        <th colspan="">
                                            <a href="{{ route('departemen.listStatusMahasiswa', ['status' => 'cuti', 'angkatan' => $item]) }}">
                                                {{ $mahasiswas->where('dosen_id',$dosen->id)->where('status','cuti')->where('angkatan',$item)->count() }}
                                            </a>
                                        </th>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th class="col-md-2">Mengundurkan Diri</th>
                                    @foreach (range($thnmin->angkatan, $thnmax->angkatan) as $item)
                                        <th colspan="">
                                            <a href="{{ route('departemen.listStatusMahasiswa', ['status' => 'mengundurkan_diri', 'angkatan' => $item]) }}">
                                                {{ $mahasiswas->where('dosen_id',$dosen->id)->where('status','mengundurkan_diri')->where('angkatan',$item)->count() }}
                                            </a>
                                        </th>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th class="col-md-2">Mangkir</th>
                                    @foreach (range($thnmin->angkatan, $thnmax->angkatan) as $item)
                                        <th colspan="">
                                            <a href="{{ route('departemen.listStatusMahasiswa', ['status' => 'mangkir', 'angkatan' => $item]) }}">
                                                {{ $mahasiswas->where('dosen_id',$dosen->id)->where('status','mangkir')->where('angkatan',$item)->count() }}
                                            </a>
                                        </th>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th class="col-md-2">Lulus</th>
                                    @foreach (range($thnmin->angkatan, $thnmax->angkatan) as $item)
                                        <th colspan="">
                                            <a href="{{ route('departemen.listStatusMahasiswa', ['status' => 'lulus', 'angkatan' => $item]) }}">
                                                {{ $mahasiswas->where('dosen_id',$dosen->id)->where('status','lulus')->where('angkatan',$item)->count() }}
                                            </a>
                                        </th>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th class="col-md-2">Do</th>
                                    @foreach (range($thnmin->angkatan, $thnmax->angkatan) as $item)
                                        <th colspan="">
                                            <a href="{{ route('departemen.listStatusMahasiswa', ['status' => 'do', 'angkatan' => $item]) }}">
                                                {{ $mahasiswas->where('dosen_id',$dosen->id)->where('status','do')->where('angkatan',$item)->count() }}
                                            </a>
                                        </th>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th class="col-md-2">Meninggal Dunia</th>
                                    @foreach (range($thnmin->angkatan, $thnmax->angkatan) as $item)
                                        <th colspan="">
                                            <a href="{{ route('departemen.listStatusMahasiswa', ['status' => 'meninggal_dunia', 'angkatan' => $item]) }}">
                                                {{ $mahasiswas->where('dosen_id',$dosen->id)->where('status','meninggal_dunia')->where('angkatan',$item)->count() }}
                                            </a>
                                        </th>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    {{-- <h5>max: {{ $thnmax->angkatan }}</h5>
                    <h5>min: {{ $thnmin }}</h5>
                    <h5>countBy: {{ $countby }}</h5>
                    <h5 class="text-danger">pkl joint: {{ $pkl->get() }}</h5>
                    <h5>pkls test: {{ $pkls }}</h5>
                    <h5>Test Text Commit</h5>
                    <h5>Test Text Commit</h5> --}}
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
