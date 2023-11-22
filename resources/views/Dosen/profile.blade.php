@extends('layout.backend.app',[
'title' => 'Welcome',
'pageTitle' => 'Profile',
])
@section('content')
{{-- @include('layout.component.alert-dismissible') --}}
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
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
            
                Foto dan Password
            </div>
            <div class="card-body">
                <div class="card mb-3">
                    <div class="row no-gutters">
                        
                        <div class="col-md-2">
                            @if(empty($dosen->foto))
                                <img src="{{ asset('images/backend/ava.jpg') }}" class="card-img" alt="" width="107" height="150">
                            @else
                                <img src= "{{ asset('storage/foto/' . $dosen->foto) }}" class="card-img" alt="" width="207" height="250">
                            @endif
                            <div class="d-flex justify-content-center m-3">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#fotoModal">Pilih Foto</button>
                            </div>
                            
                        </div>
                        
                        <div class="col-md-10">
                            
                            <form id="createForm" method="post" action="{{ route('profiledosen.update', Auth::user()->id) }}" class="m-2">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label for="password">Password Baru</label>
                                    <input type="password" required id="password" name="password" class="form-control @error('password') is-invalid @enderror" value="">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Konfirmasi Password</label>
                                    <input type="password" required id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" value="">
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-md btn-primary">Simpan</button>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="fotoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Data Dosen</h5>
                    {{-- <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button> --}}
                </div>
                <div class="modal-body">
                    <form id="createForm" action="{{ route('profiledosen.updateFoto',$dosen->id) }}" method="POST" enctype="multipart/form-data" >
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="file">Masukan Foto</label>
                            <input required type="file" name="foto" id="foto" class="form-control">
            
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
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
{{-- <script>
    $(document).ready(function () {
        $('#provinsi_id').on('change', function () {
            var provinsiId = $(this).val();
            
            // Make an Ajax request to fetch Kota/Kabupaten based on the selected Provinsi
            $.ajax({
                url: 'profile/get-kota/' + provinsiId,
                type: 'GET',
                success: function (data) {
                    // Clear existing options
                    $('#kota_id').empty();

                    // Add new options based on the returned data
                    $.each(data, function (key, value) {
                        $('#kota_id').append('<option value="' + value.id + '">' + value.nama + '</option>');
                    });
                }
            });
        });
    });
</script> --}}
{{-- <script>
    $(document).ready(function() {
          $('#initialModal').modal('show');
      });
</script> --}}
@endsection
