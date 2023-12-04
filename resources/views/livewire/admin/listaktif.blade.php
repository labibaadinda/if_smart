@extends('layout.backend.app',[
'title' => 'List Mahasiswa Aktif',
'pageTitle' =>'List Mahasiswa Aktif',
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
                        <h6 class="font-weight-semibold text-lg">Data Mahasiswa Aktif</h6>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 py-0">
                <div class="table-responsive p-0" id="items-table">
                    <table class="table align-items-center mb-0">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="text-secondary text-xs font-weight-semibold opacity-7 text-center">No</th>
                                <th class="text-secondary text-xs font-weight-semibold opacity-7 text-center">Nama</th>
                                <th class="text-secondary text-xs font-weight-semibold opacity-7 text-center">NIM</th>
                                <th class="text-secondary text-xs font-weight-semibold opacity-7 text-center">Angkatan</th>
                                <th class="text-secondary text-xs font-weight-semibold opacity-7 text-center ps-2">Status</th>
                                <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Dosen Wali</th>
                            </tr>
                        </thead>
                        <tbody id="alatTableBody">
                            @foreach ($mahasiswaaktifs as $mahasiswaaktif)
                                <tr>
                                    <td class="text-sm align-middle text-center">
                                        {{ 1 + $loop->index }}
                                    </td>
                                    <td class="text-sm align-middle text-center">
                                        {{ $mahasiswaaktif->nama }}
                                    </td>
                                    <td class="text-sm align-middle text-center">
                                        {{ $mahasiswaaktif->nim }}
                                    </td>
                                    <td class="text-sm align-middle text-center">
                                        {{ $mahasiswaaktif->angkatan }}
                                    </td>
                                    <td class="text-sm align-middle text-center">
                                        @if ($mahasiswaaktif->status === 'aktif')
                                            Aktif
                                       
                                        @endif
                                    </td>
                                    <td class="text-sm align-middle text-center">
                                        {{ $mahasiswaaktif->dosen->nama }}
                                    </td>
                                
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
               
            </div>
            
        </div>
        <a href="{{ route('admin') }}" class="btn btn-md btn-secondary">Back</a>
    </div>
</div>
</div>
@endsection
