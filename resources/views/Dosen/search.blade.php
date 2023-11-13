@extends('layout.backend.app', [
    'title' => 'Search Mahasiswa',
    'pageTitle' => 'Search Mahasiswa',
])

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('dosen.search') }}" method="GET">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="keyword" placeholder="Search by NIM or Name">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </div>
        </form>

        @if(count($mahasiswas) > 0)
            <h5>Search Results for '{{ $keyword }}'</h5>
            <ul class="list-group">
                @foreach($mahasiswas as $mahasiswa)
                    <li class="list-group-item">
                        <a href="{{ route('dosen.detailSearch', $mahasiswa->nim) }}">
                            {{ $mahasiswa->nama }} ({{ $mahasiswa->nim }})
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No results found.</p>
        @endif
    </div>
</div>
@endsection
