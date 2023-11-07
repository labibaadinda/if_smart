<?php

namespace App\Http\Controllers\User;

use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Irs;
use App\Models\Khs;
use App\Models\Pkl;
use App\Models\Skripsi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
	{
		$mahasiswas = Mahasiswa::with('dosen')->where('nim', Auth::user()->nim_nip)->get();
		$dosens = Dosen::All();
		return view('user.index', compact('mahasiswas','dosens'));
	}

	public function irs()
	{
		return view('user.entry-irs');
	}

	public function khs()
	{
		return view('user.entry-khs');
	}

	public function pkl()
	{
		return view('user.entry-pkl');
	}
	public function skripsi()
	{
		return view('user.entry-skripsi');
	}

	public function storeIrs(Request $request)
{
    // Validasi input jika diperlukan
    $request->validate([
        'semester' => 'required',
        'jumlah_sks' => 'required',
        'pdf_file' => 'required|mimes:pdf|', // File PDF dengan maksimum 2 MB
    ]);

    if ($request->hasFile('pdf_file')) {
        $pdfFile = $request->file('pdf_file');
        $pdfFileName = time() . '.' . $pdfFile->getClientOriginalExtension();

        // Simpan file PDF ke direktori storage/app/public/irs
        $pdfFile->storeAs('public/irs', $pdfFileName);

        // Simpan data IRS ke dalam tabel IRS
        Irs::create([
            'nim' => Auth::user()->nim_nip,
            'semester' => $request->semester,
            'jumlah_sks' => $request->jumlah_sks,
            'file' => $pdfFileName,
        ]);

        return redirect()->route('user')->with('success', 'File IRS berhasil diunggah.');
    }
}
	public function storeKhs(Request $request)
{
    // Validasi input jika diperlukan
    $request->validate([
        'semester' => 'required',
        'ips' => 'required',
        'pdf_file' => 'required|mimes:pdf|', // File PDF dengan maksimum 2 MB
    ]);

    if ($request->hasFile('pdf_file')) {
        $pdfFile = $request->file('pdf_file');
        $pdfFileName = time() . '.' . $pdfFile->getClientOriginalExtension();

        // Simpan file PDF ke direktori storage/app/public/irs
        $pdfFile->storeAs('public/irs', $pdfFileName);

        // Simpan data IRS ke dalam tabel IRS
        Khs::create([
            'nim' => Auth::user()->nim_nip,
            'semester' => $request->semester,
            'ips' => $request->ips,
            'file' => $pdfFileName,
        ]);

        return redirect()->route('user')->with('success', 'File KHS berhasil diunggah.');
    }
}

	public function storePkl(Request $request)
{
    // Validasi input jika diperlukan
    $request->validate([
        'judul' => 'required',
        'stat_pkl' => 'required',
        'pdf_file' => 'required|mimes:pdf|', // File PDF dengan maksimum 2 MB
    ]);

	$existingData = Pkl::where('nim', Auth::user()->nim_nip)->get();

    if ($existingData->isEmpty()) {
        // Jika tidak ada data progres, maka hanya progres 1 yang diizinkan
        if ($request->progres != 1) {
            return redirect()->back()->with('error', 'Progres pertama harus dimulai dari 1.');
        }
    } else {
        $latestProgres = $existingData->max('progres');

        if ($request->progres != $latestProgres + 1) {
            return redirect()->back()->with('error', 'Progres yang dimasukkan harus berurutan');
        }
    }

    if ($request->hasFile('pdf_file')) {
        $pdfFile = $request->file('pdf_file');
        $pdfFileName = time() . '.' . $pdfFile->getClientOriginalExtension();

        // Simpan file PDF ke direktori storage/app/public/irs
        $pdfFile->storeAs('public/irs', $pdfFileName);

        // Simpan data IRS ke dalam tabel IRS
        Pkl::create([
            'nim' => Auth::user()->nim_nip,
            'judul' => $request->judul,
            'progres' => $request->progres,
            'stat_pkl' => $request->stat_pkl,
            'file' => $pdfFileName,
        ]);

        return redirect()->route('user')->with('success', 'Entry PKL berhasil.');
    }
}
	public function storeSkripsi(Request $request)
{
    // Validasi input jika diperlukan
    $request->validate([
        'judul' => 'required',
        'stat_skripsi' => 'required',
        'pdf_file' => 'required|mimes:pdf|', // File PDF dengan maksimum 2 MB
    ]);
	
    if ($request->hasFile('pdf_file')) {
        $pdfFile = $request->file('pdf_file');
        $pdfFileName = time() . '.' . $pdfFile->getClientOriginalExtension();

        // Simpan file PDF ke direktori storage/app/public/irs
        $pdfFile->storeAs('public/irs', $pdfFileName);

        // Simpan data IRS ke dalam tabel IRS
        Skripsi::create([
            'nim' => Auth::user()->nim_nip,
            'judul' => $request->judul,
            'progres' => $request->progres,
            'stat_skripsi' => $request->stat_skripsi,
            'tanggal_sidang' => $request->tanggal_sidang,
            'file' => $pdfFileName,
        ]);

        return redirect()->route('user')->with('success', 'Entry Skripsi berhasil.');
    }
}
}
