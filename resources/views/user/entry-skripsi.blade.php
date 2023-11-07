@extends('layout.backend.app',[
'title' => 'Entry Skripsi',
'pageTitle' =>'Entry Skripsi',
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
        <form id="createForm" method="post" action="{{ route('skripsi.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="judul">Judul Skripsi</label>
                <input  type="text" required id="judul" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}">

                @error('judul')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="stat_skripsi">Status Skripsi</label>
                <select name="stat_skripsi" id="stat_skripsi" class="form-control">
                    <option selected disabled="">----------Status Skripsi----------</option>
                    <option  value="progres">Sedang Berlangsung</option>
                    <option value="selesai">Selesai</option>
                </select>
            </div>
            <div class="form-group" id="progres-form" style="display: none">
                <label for="progres">Progres Ke-</label>
                <input type="number" id="progres" name="progres" class="form-control @error('progres') is-invalid @enderror" value="{{ $progresskripsi }}">
                @error('progres')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            
            <div class="form-group" id="tanggal-sidang-form" style="display: none">
                <label for="tanggal_sidang">Tanggal Sidang</label>
                <input type="date" id="tanggal_sidang" name="tanggal_sidang" class="form-control @error('tanggal_sidang') is-invalid @enderror" value="{{ old('tanggal_sidang') }}">
                @error('tanggal_sidang')
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
<script>
    const statSkripsiSelect = document.getElementById('stat_skripsi');
    const progresForm = document.getElementById('progres-form');
    const tanggalSidangForm = document.getElementById('tanggal-sidang-form');

    statSkripsiSelect.addEventListener('change', function () {
        if (statSkripsiSelect.value === 'progres') {
            progresForm.style.display = 'block';
            tanggalSidangForm.style.display = 'none';
        } else if (statSkripsiSelect.value === 'selesai') {
            progresForm.style.display = 'none';
            tanggalSidangForm.style.display = 'block';
        } else {
            progresForm.style.display = 'none';
            tanggalSidangForm.style.display = 'none';
        }
    });
</script>
@endsection
