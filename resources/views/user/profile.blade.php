@extends('layout.backend.app',[
'title' => 'Welcome',
'pageTitle' => 'Profile',
])
@section('content')
@include('layout.component.alert-dismissible')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                Email : {{ Auth::user()->email }}
            </div>
            <div class="card-body">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="{{ asset('images/backend/laravel.jpg') }}" class="card-img" alt="">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ Auth::user()->name }}</h5>

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
                <form id="createForm" action="{{ route('profile.updateInitialData',Auth::user()->id) }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ Auth::user()->name }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="name">NIM</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ Auth::user()->nim }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input required id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}">

                        @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="handphone">No Handphone</label>
                        <input required id="handphone" name="handphone" class="form-control @error('handphone') is-invalid @enderror" value="{{ old('handphone') }}">

                        @error('handphone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="alamat">Kota/Kabupaten</label>
                        <input required id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}">

                        @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="provinsi">Provinsi</label>
                        <input required id="provinsi" name="provinsi" class="form-control @error('provinsi') is-invalid @enderror" value="{{ old('provinsi') }}">

                        @error('provinsi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    {{-- <div class="form-group">
                        <label for="p">Password</label>
                        <input type="password" required="" id="p" name="password" class="form-control">
                    </div> --}}
                    <div class="form-group">
                        <label for="j">Jalur Masuk</label>
                        <select name="jalus_masuk" id="j" class="form-control">
                            <option disabled="">- Pilih Jalur Masuk -</option>
                            <option value="snmptn">SNMPTN</option>
                            <option value="sbmptn">SBMPTN</option>
                            <option value="mandiri">Mandiri</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>


                    <button type="submit" class="btn btn-md btn-primary">Simpan</button>
                </form>
            </div>
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
