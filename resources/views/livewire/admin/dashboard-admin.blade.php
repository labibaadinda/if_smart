@extends('layout.backend.app',[
    'title' => 'Dashboard Operator',
    'pageTitle' => 'Dashboard Operator'
])
{{-- @section('content') --}}
<!-- Content Row -->
@push('css')
<link href="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.css"
    rel="stylesheet">
@endpush

@section('content')

@if(session()->get('message'))

@php
$status = session()->get('message')['status'];
$message = session()->get('message')['message'];
@endphp

@push('js')
<script>
    $(document).ready(function () {
      console.log()
      showToastr((`{{ $status }}` === 'true'), `{{ $message }}`)
    })
</script>
@endpush
@endif
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

@if(session()->has('error'))
<div class="notify">

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-circle-check"></i> {{ session('error') }}

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
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $sumMahasiswa }}</div>
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
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $mahasiswaAktif }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">ANGKATAN TERTUA
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $mahasiswas->max('angkatan') }}</div>
                            </div>
                            {{-- <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-info" role="progressbar"
                                        style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            ANGKATAN TERMUDA </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $mahasiswas->min('angkatan') }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    {{-- <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">ANGKATAN TERTUA
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $mahasiswas->max('angkatan') }}</div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-info" role="progressbar"
                                        style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Pending Requests Card Example -->
    {{-- <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            ANGKATAN TERMUDA </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $mahasiswas->min('angkatan') }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</div>

<!-- Content Row -->

<div class="row">

    <!-- Pie Chart -->
    <div class="col-xl-6 col-lg-7">
        <div class="card">
            <div class="card-body">
                <div class="card m-0">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="{{ asset('images/backend/profile.jpg') }}" class="card-img" alt="" width="207"
                                height="207">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title text-dark">{{ $user->nama }}</h5>
                                <h5 class="card-title text-dark">{{ $user->nim_nip }}</h5>
                                <h5 class="card-title text-dark">Operator S1 Informatika</h5>
                                {{-- @foreach($dosens as $dosen)
                                @endforeach --}}
                                <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#initialModal">edit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-primary"></i> Direct
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Social
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-info"></i> Referral
                    </span>
                </div>
            </div>
        </div> --}}
    </div>



</div>


<!-- Update Data Pribadi Modal-->
<div class="modal fade" id="initialModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Data</h5>
                {{-- <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button> --}}
            </div>
            <div class="modal-body">
                <form id="createForm" action="{{ route('updateOperator', Auth::user()->id) }}" method="POST" >
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" name="nama" class="form-control" value="{{ Auth::user()->nama }}" >
                    </div>
                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="text" id="nim_nip" name="nim_nip" class="form-control" value="{{ Auth::user()->nim_nip }}" >
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input required id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ Auth::user()->email }}">

                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    {{-- <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input required id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ $mahasiswa->alamat }}">

                        @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="handphone">No Handphone</label>
                        <input required id="handphone" name="handphone" class="form-control @error('handphone') is-invalid @enderror" value="{{ $mahasiswa->handphone }}">

                        @error('handphone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="kota">Kota/Kabupaten</label>
                        <input required id="kota" name="kota" class="form-control @error('alamat') is-invalid @enderror" value="{{ $mahasiswa->kota }}">

                        @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div> --}}
                    {{-- <div class="form-group">
                        <label for="provinsi">Provinsi</label>
                        <input required id="provinsi" name="provinsi" class="form-control @error('provinsi') is-invalid @enderror" value="{{ old('provinsi') }}">

                        @error('provinsi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div> --}}
                    {{-- <div class="form-group">
                        <label for="provinsi">Provinsi</label>
                        <select class="form-select" name="provinsi" aria-label="Default select example">
                          <option value="">-------- Pilih Provinsi --------</option>
                          @foreach($provinsis->unique('nama') as $provinsi)
                          <option value="{{ $provinsi->id}}">{{ $provinsi->nama }}</option>
                          @endforeach
                        </select>
                    </div> --}}
                    {{-- <div class="form-group">
                        <label for="p">Password</label>
                        <input type="password" required="" id="p" name="password" class="form-control">
                    </div> --}}
                    {{-- <div class="form-group">
                        <label for="provinsi">Provinsi</label>
                        <select name="provinsi_id" id="provinsi_id" class="form-control">
                            <option disabled="">- Pilih Provinsi -</option>
                            @foreach($provinsis->unique('nama') as $provinsi)
                            <option value="{{ $provinsi->id}}">{{ $provinsi->nama }}</option>
                            @endforeach
                        </select>
                    </div> --}}


                    <button type="submit" class="btn btn-md btn-primary">Simpan</button>
                </form>
            </div>
            {{-- @endforeach --}}
            <div class="modal-footer">
                {{-- <a href="{{ route('user.index') }}" class="btn btn-md btn-secondary">Back</a> --}}
                {{-- <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">Logout</button>
                </form> --}}
            </div>
        </div>
    </div>
</div>
@stop
