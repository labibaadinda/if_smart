@extends('layout.backend.app',[
'title' => 'Entry PKL',
'pageTitle' =>'Entry PKL',
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
<script>
    setTimeout(function(){
      $('.alert').alert('close');
    }, 2000);
</script>
@endif

<div class="row mt-2">
    <div class="col-12">
        <div class="card border shadow-xs mb-4">
            <div class="card-header border-bottom pb-0">
                <div class="d-sm-flex align-items-center">
                    <div>
                        <h6 class="font-weight-semibold text-lg">List Data Entry PKL</h6>
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
                                <th class="text-secondary text-xs font-weight-semibold opacity-7 text-center">Nilai</th>
                                <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Status Konfirmasi</th>
                                <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Berita Acara</th>
                                <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Action</th>
                            </tr>
                        </thead>
                        <tbody id="alatTableBody">
                            @foreach ($pkls as $pkl)
                                <tr>
                                    <td class="text-sm align-middle text-center">
                                        {{ $pkl->semester }}
                                    </td>
                                    <td class="text-sm align-middle text-center">
                                        {{ $pkl->nilai }}
                                    </td>
                                    <td class="text-sm align-middle text-center">
                                        @if($pkl->konfirmasi == '1')
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
                                        <a href="{{ asset('storage/pkl/' . $pkl->file) }}" target="_blank"
                                            class="btn btn-primary btn-sm ml-2">Berita Acara</a>
                                    </td>
                                    @if($pkl->konfirmasi==0)
                                    <td class="text-sm align-middle text-center">
                                        <button type="button" class="btn btn-warning btn-icon my-0 px-2 py-2" data-bs-toggle="modal" data-bs-target="#ModalUpdate{{ $pkl->id }}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                    </td>
                                    @else
                                    <td class="text-sm align-middle text-center">
                                        <p>TIDAK BISA EDIT</p>
                                    </td>
                                    @endif
                                </tr>
                                
                                <div class="modal fade" id="ModalUpdate{{ $pkl->id }}" tabindex="-1" role="dialog" aria-labelledby="ModalUpdate{{ $pkl->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="iniitialModal">Edit Berkas PKL</h5>
                                                {{-- <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button> --}}
                                            </div>
                                            <div class="modal-body">
                                                <form id="createForm" action="{{ route('pkl.updatePkl',$pkl->id) }}" method="POST" enctype="multipart/form-data" >
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="semester">Semester</label>
                                                        <input  type="number" required id="semester" name="semester" class="form-control @error('semester') is-invalid @enderror" value="{{ $pkl->semester }}">
    
                                                        @error('semester')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nilai">Nilai</label>
                                                        <input required type="text" id="nilai" name="nilai" class="form-control @error('ips') is-invalid @enderror" value="{{ $pkl->nilai }}">
    
                                                        @error('ips')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="file">Masukan Berita Acara Baru (*pdf)</label>
                                                        <input type="file" name="file" id="file" class="form-control">
                                        
                                                        @error('pdf_file')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    
                                
                                
                                                    <button type="submit" class="btn btn-md btn-primary">Simpan</button>
                                                </form>
                                            </div>
                                            
                                            <div class="modal-footer">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="modal fade" id="initialModal" tabindex="-1" role="dialog" aria-labelledby="initialModal" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="iniitialModal">Entry Data pkl</h5>
                                                {{-- <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button> --}}
                                            </div>
                                            <div class="modal-body">
                                                <form id="createForm" method="post" action="{{ route('pkl.store') }}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="judul">Semester PKL</label>
                                                        <input  type="text" required id="semester" name="semester" class="form-control @error('judul') is-invalid @enderror" value="{{ old('semester') }}">
                                                
                                                        @error('judul')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group" id="progres-form" >
                                                        <label for="nilai">Nilai</label>
                                                        <input type="string" id="nilai" name="nilai" class="form-control @error('nilai') is-invalid @enderror">
                                                        @error('nilai')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="file">Scan Berita Acara</label>
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
</script>

@endsection

