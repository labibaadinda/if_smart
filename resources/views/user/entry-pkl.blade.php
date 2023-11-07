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
                <label for="semester">Semester</label>
                <input  type="number" required id="semester" name="semester" class="form-control @error('semester') is-invalid @enderror" value="{{ old('semester') }}">

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
</div>
@endsection
