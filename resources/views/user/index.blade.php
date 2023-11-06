@extends('layout.backend.app',[
	'title' => 'Welcome',
	'pageTitle' => 'Dashboard',
])
@section('content')
<div class="jumbotron">
  <h1 class="display-4">Hello, {{ Auth::user()->name }}</h1>
  <p class="lead">Ini adalah halaman simple dashboard.</p>
  <hr class="my-4">
  <p>Anda login sebagai {{ Auth::user()->role }}.</p>
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