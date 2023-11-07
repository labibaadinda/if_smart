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
            <div class="form-group">
                <label for="progres">Progres Ke-</label>
                <input required type="number" id="progres" name="progres" class="form-control @error('progres') is-invalid @enderror" value="{{ old('progres') }}">

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
</div>
@endsection
