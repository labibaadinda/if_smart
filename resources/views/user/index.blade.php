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
  <div class="col-lg-6">
    <div class="card">
      <div class="card-body">
        <div class="card m-0">
          <div class="row no-gutters">
            <div class="col-md-4">
              <img src="{{ asset('images/backend/profile.jpg') }}" class="card-img" alt="" width="207" height="207">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                @foreach($mahasiswas as $mahasiswa)
                <h5 class="card-title text-dark">{{ $mahasiswa->nama }}</h5>
                <h5 class="card-title text-dark">{{ $mahasiswa->nim }}</h5>
                <h5 class="card-title text-dark">S1 Informatika</h5>
                <h5 class="card-title text-dark">{{ $mahasiswa->angkatan }}</h5>
                <h5 class="card-title text-dark">Dosen Wali: {{ $mahasiswa->dosen->nama }} ({{ $mahasiswa->dosen->nip }})</h5>
                @endforeach
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
                <h5 class="card-title text-dark">IPK</h5>
                <p class="card-text">3.8</p>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="card mb-3">
              <div class="card-body text-center">
                <h5 class="card-title text-dark">Semester Studi</h5>
                <p class="card-text">5</p>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="card">
              <div class="card-body text-center">
                <h5 class="card-title text-dark">SKSk</h5>
                <p class="card-text">112</p>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="card ">
              <div class="card-body text-center">
                <h5 class="card-title text-dark">Status Akademik</h5>
                <p class="card-text">
                    <span class="badge badge-success">Aktif</span>
                </p>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row mt-4">
  <div class="col-md-3">
    <a href="{{ route('irs') }}" class="card-link">
      <div class="card ">
        <div class="card-body text-center">
          <h5 class="card-title">Entry IRS</h5>
        </div>
      </div>
    </a>
  </div>
  <div class="col-md-3">
    <a href="{{ route('khs') }}" class="card-link">
      <div class="card ">
        <div class="card-body text-center">
          <h5 class="card-title">Entry KHS</h5>
        </div>
      </div>
    </a>
  </div>
  <div class="col-md-3">
    <a href="{{ route('pkl') }}" class="card-link">
      <div class="card ">
        <div class="card-body text-center">
          <h5 class="card-title">Entry PKL</h5>
        </div>
      </div>
    </a>
  </div>
  <div class="col-md-3">
    <a href="{{ route('skripsi') }}" class="card-link">
      <div class="card">
        <div class="card-body text-center">
          <h5 class="card-title">Entry Skripsi</h5>
        </div>
      </div>
    </a>
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
<script>
  // Periksa apakah alamat kosong
  // var userAddress = '{{ Auth::user()->alamat }}'; // Gantilah ini dengan cara Anda mendapatkan alamat pengguna
  // var userKota = '{{ Auth::user()->kota }}'; // Gantilah ini dengan cara Anda mendapatkan alamat pengguna
  // var userProvinsi = '{{ Auth::user()->provinsi }}'; // Gantilah ini dengan cara Anda mendapatkan alamat pengguna
  // var userHandphone = '{{ Auth::user()->handphone }}'; // Gantilah ini dengan cara Anda mendapatkan alamat pengguna
  
  // $(document).ready(function() {
  //     if (userAddress === '' || userKota === '' || userProvinsi === '' || userHandphone === '' ) {
  //         // Jika alamat kosong, tampilkan modal secara otomatis
  //         $('#addressModal').modal('show');
  //         $('#addressModal').modal({
  //           backdrop: 'static', // Modal tidak akan ditutup saat mengklik latar belakang
  //           keyboard: false,   // Modal tidak akan ditutup dengan tombol keyboard
  //       });
  //     }
  // });
</script>
@endsection