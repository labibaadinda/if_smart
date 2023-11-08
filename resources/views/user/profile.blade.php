@extends('layout.backend.app',[
'title' => 'Welcome',
'pageTitle' => 'Profile',
])
@section('content')
@include('layout.component.alert-dismissible')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
        @foreach($mahasiswas as $mahasiswa)
            <div class="card-header">
                Email : {{ Auth::user()->email }}
            </div>
            <div class="card-body">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="{{ asset('images/backend/profile.jpg') }}" class="card-img" alt="" width="207" height="207">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $mahasiswa->nama }}</h5>

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
                <form method="POST" action="{{ route('profile.update',$mahasiswa->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        
                        <label for="nama">Name</label>
                        <input required="" value="{{ $mahasiswa->nama }}" class="form-control" type="" id="nama"
                            name="nama" disabled>
                    </div>
                    {{-- <div class="form-group">
                        <label for="old_password">Password Lama</label>
                        <input type="password" class="form-control" 
                            id="old_password" name="old_password">

                        <small class="text-secondary">masukkan password lama</small>
                    </div> --}}
                    {{-- <div class="form-group">
                        <label for="password">Password Baru</label>

                        <input type="password" id="password" name="password" class="form-control">

                    </div> --}}
                    {{-- <div class="form-group">
                        <button class="btn btn-primary btn-sm">Update</button>
                    </div> --}}
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#initialModal">
                        Update
                      </button>
                </form>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>
</div>

<!-- Update Data Pribadi Modal-->
<div class="modal fade" id="initialModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Data Mahasiswa</h5>
                {{-- <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button> --}}
            </div>
            <div class="modal-body">
                <form id="createForm" action="{{ route('profile.updateInitialData',$mahasiswa->id) }}" method="POST" >
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" name="nama" class="form-control" value="{{ $mahasiswa->nama }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="text" id="nim" name="nim" class="form-control" value="{{ $mahasiswa->nim }}" disabled>
                    </div>
                    <div class="form-group">
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
                    </div>
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
                    <div class="form-group">
                        <label for="provinsi">Provinsi</label>
                        <select name="provinsi_id" id="provinsi_id" class="form-control">
                            <option disabled="">- Pilih Provinsi -</option>
                            @foreach($provinsis->unique('nama') as $provinsi)
                            <option value="{{ $provinsi->id}}">{{ $provinsi->nama }}</option>
                            @endforeach
                        </select>
                    </div>


                    <button type="submit" class="btn btn-md btn-primary">Simpan</button>
                </form>
            </div>
            @endforeach
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
<script>
    $(document).ready(function() {
          $('#initialModal').modal('show');
      });
</script>
@endsection
