@extends('layout.backend.app', [
    'title' => 'Welcome',
    'pageTitle' => 'Dashboard ' . ucfirst(Auth::user()->role),
])
@section('content')
<hr>
<div class="row">
  <div class="col-lg-6">
      <div class="card">
          <div class="card-body">
              <div class="card mb-3" style="max-width: 540px;">
                  <div class="row no-gutters">
                      <div class="col-md-4">
                          <img src="{{ asset('images/backend/laravel.jpg') }}" class="card-img" alt="">
                      </div>
                      <div class="col-md-8">
                          <div class="card-body">
                            @foreach($mahasiswas as $mahasiswa)
                            <h5 class="card-title">{{ $mahasiswa->nama }}</h5>
                            <h5 class="card-title">{{ $mahasiswa->nim }}</h5>

                            @endforeach

                              <p class="card-text"><small class="text-muted">{{ 'updated at
                                      '.\Carbon\Carbon::parse(Auth::user()->updated_at)->diffForHumans() }}</small>
                              </p>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="col-lg-6">
      <div class="card">
          <div class="card-header">
              Edit Profile
          </div>
          <div class="card-body">
              <form method="POST" action="{{ route('profile.update',Auth::user()->id) }}">
                  @csrf
                  @method('PATCH')
                  <div class="form-group">
                      <label for="name">Name</label>
                      <input required="" value="{{ Auth::user()->name }}" class="form-control" type="" id="name"
                          name="name">
                  </div>
                  <div class="form-group">
                      <label for="password">Password</label>
                      <input required="" value="{{ Auth::user()->password }}" class="form-control" type="hidden"
                          id="old_password" name="old_password">
                      <input type="password" id="password" name="password" class="form-control">
                      <small class="text-secondary">kosongkan kolom password jika tidak ingin mengubah
                          password</small>
                  </div>
                  <div class="form-group">
                      <button class="btn btn-primary btn-sm">Update</button>
                  </div>
              </form>
          </div>
          <div class="card-footer"></div>
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