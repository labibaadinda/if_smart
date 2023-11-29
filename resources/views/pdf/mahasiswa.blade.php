<!-- resources/views/pdf/mahasiswa.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Mahasiswa PKL</title>
</head>
<body>
    <h1>Rekap Mahasiswa PKL - Angkatan {{ $angkatan }}</h1>

    <h2>Mahasiswa Sudah PKL</h2>
    <ul>
        @foreach ($mahasiswasSudahPkl as $mahasiswa)
            <li>{{ $mahasiswa->nama }} (NIM: {{ $mahasiswa->nim }})</li>
        @endforeach
    </ul>

    <h2>Mahasiswa Belum PKL</h2>
    <ul>
        @foreach ($mahasiswasBelumPkl as $mahasiswa)
            <li>{{ $mahasiswa->nama }} (NIM: {{ $mahasiswa->nim }})</li>
        @endforeach
    </ul>
</body>
</html>
