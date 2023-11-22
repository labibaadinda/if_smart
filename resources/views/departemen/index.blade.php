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
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="card m-0">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            @if(empty(Auth::user()->foto))
                                <img src="{{ asset('images/backend/ava.jpg') }}" class="card-img" alt="" width="107" height="150">
                            @else
                                <img src= "{{ asset('storage/foto/' . Auth::user()->foto) }}" class="card-img" alt="" width="207" height="250">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title text-dark">Departemen</h5>
                                <h5 class="card-title text-dark">S1 Informatika</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title text-dark">Mahasiswa Aktif</h5>
                                <p class="card-text">{{ $aktif }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card mb-3">
                            <div class="card-body text-center">
                                <h5 class="card-title text-dark">Mahasiswa Lulus PKL</h5>
                                <p class="card-text">{{ $allpkl }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title text-dark">Mahasiswa Lulus Skripsi</h5>
                                <p class="card-text">{{ $allskripsi }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card ">
                            <div class="card-body text-center">
                                <h5 class="card-title text-dark">Jumlah Dosen</h5>
                                <p class="card-text">
                                    {{ $alldosen }}
                                    {{-- <span class="badge badge-success">Aktif</span> --}}
                                </p>
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
                    <div class="row no-gutters " >
                        <div class="text-center mx-auto">
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
                                        <a href="{{ route('departemen.listMahasiswaAngkatan', $item) }}">
                                            {{-- {{ $mahasiswa->nama }} ({{ $mahasiswa->nim }}) --}}
                                            {{ $pkl->count() }}
                                        </a>
                                        {{-- @if ($khss->where('semester',$irs->semester)->first())
                                        {{ $khss->where('semester',$irs->semester)->firstOrFail()->ips }}
                                        @else
                                        Belum Mengupload KHS
                                        @endif --}}
                                    </td>
                                    <td colspan="1">
                                        <a href="{{ route('departemen.listMahasiswaAngkatan', $item) }}">
                                            {{-- {{ $mahasiswa->nama }} ({{ $mahasiswa->nim }}) --}}
                                            {{-- {{ $pkl->where('angkatan','=',$item)->count() }} --}}
                                            {{ $pkl->count() }}
                                        </a>
                                    </td>
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
<!-- resources/views/modal/address.blade.php -->
<div class="modal fade" id="addressModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Tidak lengkap<i class="fa-solid fa-triangle-exclamation"></i></h5>
            </div>
            <div class="modal-body">
                <p>Silakan Lengkapi Data Anda Terlebih Dahulu!!</p>
            </div>
            <div class="modal-footer">
                <a href="{{ route('profile') }}" class="btn btn-primary">Lihat Profil</a>
            </div>
        </div>
    </div>
</div>
</div>
{{-- <script>
    // Periksa apakah alamat, kota, provinsi, dan handphone kosong
  var mahasiswaAddress = '{{ $mahasiswa->alamat }}'; // Gantilah ini dengan cara Anda mendapatkan alamat mahasiswa
  var mahasiswaKota = '{{ $mahasiswa->kota_id }}'; // Gantilah ini dengan cara Anda mendapatkan kota mahasiswa
  var mahasiswaProvinsi = '{{ $mahasiswa->provinsi_id }}'; // Gantilah ini dengan cara Anda mendapatkan provinsi mahasiswa
  var mahasiswaHandphone = '{{ $mahasiswa->handphone }}'; // Gantilah ini dengan cara Anda mendapatkan handphone mahasiswa
  var mahasiswaFoto = '{{ $mahasiswa->foto }}'; // Gantilah ini dengan cara Anda mendapatkan handphone mahasiswa

  $(document).ready(function() {
      if (mahasiswaAddress === '' || mahasiswaKota === '' || mahasiswaProvinsi === '' || mahasiswaHandphone === '' || mahasiswaFoto === '' ) {
        $('#addressModal').modal({
            backdrop: 'static', // Modal tidak akan ditutup saat mengklik latar belakang
            keyboard: false,   // Modal tidak akan ditutup dengan tombol keyboard
        });
          // Jika salah satu dari data kosong, tampilkan modal secara otomatis
          $('#addressModal').modal('show');

      }

  });
</script> --}}
@endsection
