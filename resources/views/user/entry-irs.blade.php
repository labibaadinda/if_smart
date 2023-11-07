@extends('layout.backend.app',[
'title' => 'Entry IRS',
'pageTitle' =>'Entry IRS ',
])

@push('css')
<link href="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content')
@if(session()->get('error'))
<div class="notify">

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session()->get('error') }}

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif


<div class="card">
    <div class="card-body">
        <form id="createForm" method="post" action="{{ route('irs.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="semester">Semester</label>
                <input  type="number" required id="semester" name="semester" class="form-control @error('semester') is-invalid @enderror" value="{{ $semesterirs }}">

                @error('semester')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="jumlah_jumlah_sks">Jumlah SKS</label>
                <input required type="number" id="jumlah_sks" name="jumlah_sks" class="form-control @error('jumlah_sks') is-invalid @enderror" value="{{ old('jumlah_sks') }}">

                @error('jumlah_sks')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="file">File</label>
                <input required type="file" name="pdf_file" id="pdf_file" class="form-control">

                @error('pdf_file')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-md btn-primary">Simpan</button>
            <a href="{{ route('user') }}" class="btn btn-md btn-secondary">Back</a>
        </form>

    </div>
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
    @foreach ($mahasiswas as $mahasiswa)
    @endforeach
</div>
<script>
    // Periksa apakah alamat, kota, provinsi, dan handphone kosong
    var mahasiswaAddress = '{{ $mahasiswa->alamat }}'; // Gantilah ini dengan cara Anda mendapatkan alamat mahasiswa
    var mahasiswaKota = '{{ $mahasiswa->kota }}'; // Gantilah ini dengan cara Anda mendapatkan kota mahasiswa
    var mahasiswaProvinsi = '{{ $mahasiswa->provinsi_id }}'; // Gantilah ini dengan cara Anda mendapatkan provinsi mahasiswa
    var mahasiswaHandphone = '{{ $mahasiswa->handphone }}'; // Gantilah ini dengan cara Anda mendapatkan handphone mahasiswa
  
    $(document).ready(function() {
        if (mahasiswaAddress === '' || mahasiswaKota === '' || mahasiswaProvinsi === '' || mahasiswaHandphone === '' ) {
            // Jika salah satu dari data kosong, tampilkan modal secara otomatis
            $('#addressModal').modal('show');
            $('#addressModal').modal({
              backdrop: 'static', // Modal tidak akan ditutup saat mengklik latar belakang
              keyboard: false,   // Modal tidak akan ditutup dengan tombol keyboard
          });
        }
    });
  </script>
@endsection
