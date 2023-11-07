@extends('layout.backend.app',[
'title' => 'Entry PKL',
'pageTitle' =>'Entry PKL',
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
        <form id="createForm" method="post" action="{{ route('pkl.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="judul">Judul PKL</label>
                <input  type="text" required id="judul" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}">

                @error('judul')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="stat_pkl">Status PKL</label>
                <select name="stat_pkl" id="stat_pkl" class="form-control">
                    <option selected disabled="">----------Status PKL----------</option>
                    <option  value="progres">Sedang Berlangsung</option>
                    <option value="selesai">Selesai</option>
                </select>
            </div>
            <div class="form-group" id="progres-form" style="display: none">
                <label for="progres">Progres Ke-</label>
                <input type="number" id="progres" name="progres" class="form-control @error('progres') is-invalid @enderror" value="{{ $progrespkl }}">
                @error('progres')
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
    @foreach ($mahasiswas as $mahasiswa)
    @endforeach
</div>
<script>
    const statPklSelect = document.getElementById('stat_pkl');
    const progresForm = document.getElementById('progres-form');

    statPklSelect.addEventListener('change', function () {
        if (statPklSelect.value === 'progres') {
            progresForm.style.display = 'block';
        } else {
            progresForm.style.display = 'none';
        }
    });
</script>
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
