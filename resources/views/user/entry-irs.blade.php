@extends('layout.backend.app',[
'title' => 'Entry IRS',
'pageTitle' =>'Entry IRS ',
])

@push('css')
<link href="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content')
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

<div class="row mt-2">
    <div class="col-12">
        <div class="card border shadow-xs mb-4">
            <div class="card-header border-bottom pb-0">
                <div class="d-sm-flex align-items-center">
                    <div>
                        <h6 class="font-weight-semibold text-lg">List Data Entry IRS</h6>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 py-0">
                <div class="border-bottom pt-3 px-3">
                    <!-- New Button Added Here -->
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#initialModal">
                        <i class="fa-solid fa-plus pr-2"></i>Entry Data Baru
                    </button>
                </div>
                <div class="table-responsive p-0" id="items-table">
                    <table class="table align-items-center mb-0">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="text-secondary text-xs font-weight-semibold opacity-7 text-center">Semester</th>
                                <th class="text-secondary text-xs font-weight-semibold opacity-7 text-center">SKS</th>
                                <th class="text-secondary text-xs font-weight-semibold opacity-7 text-center ps-2">Status Entry</th>
                                <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Berkas</th>
                            </tr>
                        </thead>
                        <tbody id="alatTableBody">
                            @foreach ($irss as $irs)
                                <tr>
                                    <td class="text-sm align-middle text-center">
                                        {{ $irs->semester }}
                                    </td>
                                    <td class="text-sm align-middle text-center">
                                        {{ $irs->jumlah_sks }}
                                    </td>
                                    <td class="text-sm align-middle text-center">
                                        @if($irs->status == '1')
                                            <span class="badge bg-success text-white">
                                                Sudah Diverifikasi
                                            </span>
                                        @else
                                            <span class="badge bg-danger text-white">
                                                Belum Diverifikasi
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-sm align-middle text-center">
                                        <a href="{{ asset('storage/irs/' . $irs->file) }}" target="_blank"
                                            class="btn btn-primary btn-sm ml-2">IRS</a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="initialModal" tabindex="-1" role="dialog" aria-labelledby="initialModal" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="iniitialModal">Entry Data IRS</h5>
                                                {{-- <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button> --}}
                                            </div>
                                            <div class="modal-body">
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
                                                    <a href="{{ route('irs') }}" class="btn btn-md btn-secondary">Back</a>
                                                </form>
                                            </div>
                                            @endforeach
                                            <div class="modal-footer">
                                            </div>
                                        </div>
                                    </div>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


    @foreach ($mahasiswas as $mahasiswa)
    @endforeach
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


<script>
    // Periksa apakah alamat, kota, provinsi, dan handphone kosong
  var mahasiswaAddress = '{{ $mahasiswa->alamat }}'; // Gantilah ini dengan cara Anda mendapatkan alamat mahasiswa
  var mahasiswaKota = '{{ $mahasiswa->kota }}'; // Gantilah ini dengan cara Anda mendapatkan kota mahasiswa
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
</script>
@endsection
