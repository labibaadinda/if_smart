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

		$IPK = Khs::selectRaw('AVG(CAST(ips AS DECIMAL(10, 2)))')->where('nim', Auth::user()->nim_nip)->where('status', 1)->first();
		$semester = Irs::where('nim', Auth::user()->nim_nip)->max('semester');
		$sksk = Irs::where('nim', Auth::user()->nim_nip)->where('status', 1)->sum('jumlah_sks');
		// $sksk = number_format($sks, 2);
		return view('user.index', compact('mahasiswas','dosens', 'IPK', 'semester', 'sksk'));
	}

	public function irs()
	{
        $khss = Khs::where('nim',Auth::user()->nim_nip)->orderBy('semester', 'ASC')->get();
        $irss = Irs::where('nim',Auth::user()->nim_nip)->orderBy('semester', 'ASC')->get();
		$mahasiswas = Mahasiswa::where('nim', Auth::user()->nim_nip)->get();
		$latestProgres = Irs::where('nim', Auth::user()->nim_nip)->max('semester');
		$semesterirs = $latestProgres + 1;
		return view('user.entry-irs',compact('semesterirs','mahasiswas', 'khss', 'irss'));
	}

	public function khs()
	{
		$mahasiswas = Mahasiswa::with('dosen')->where('nim', Auth::user()->nim_nip)->get();
		$latestProgres = Khs::where('nim', Auth::user()->nim_nip)->max('semester');
		$semesterkhs = $latestProgres + 1;
        $khss = Khs::where('nim',Auth::user()->nim_nip)->orderBy('semester', 'ASC')->get();
		return view('user.entry-khs',compact('semesterkhs','mahasiswas', 'khss'));
	}

	public function pkl()
	{
		$mahasiswas = Mahasiswa::with('dosen')->where('nim', Auth::user()->nim_nip)->get();
        $pkls = Pkl::where('nim',Auth::user()->nim_nip)->get();
		return view('user.entry-pkl', compact('mahasiswas','pkls'));
	}
	public function skripsi()
	{
		$mahasiswas = Mahasiswa::where('nim', Auth::user()->nim_nip)->get();
        $skripsis = Skripsi::where('nim',Auth::user()->nim_nip)->get();
		return view('user.entry-skripsi',compact('mahasiswas','skripsis'));
	}

	public function storeIrs(Request $request)
{
    // Validasi input jika diperlukan
    $request->validate([
        'semester' => 'required',
        'jumlah_sks' => 'required',
        'pdf_file' => 'required|mimes:pdf|', // File PDF dengan maksimum 2 MB
    ]);

	$existingData = Irs::where('nim', Auth::user()->nim_nip)->get();

    if ($existingData->isEmpty()) {
        // Jika tidak ada data progres, maka hanya progres 1 yang diizinkan
        if ($request->semester != 1) {
            return redirect()->back()->with('error', 'Semester harus dimulai dari 1.');
        }
    } else {
        $latestProgres = $existingData->max('semester');

        if ($request->semester != $latestProgres + 1) {
            return redirect()->back()->with('error', 'Semester yang dimasukkan harus berurutan');
        }
    }
    if ($request->hasFile('pdf_file')) {
        $pdfFile = $request->file('pdf_file');
        $pdfFileName = time() . '.' . $pdfFile->getClientOriginalExtension();

        // Simpan file PDF ke direktori storage/app/public/irs
        $pdfFile->storeAs('public/irs', $pdfFileName);

        // Simpan data IRS ke dalam tabel IRS
        $result = Irs::create([
            'nim' => Auth::user()->nim_nip,
            'semester' => $request->semester,
            'jumlah_sks' => $request->jumlah_sks,
            'file' => $pdfFileName,
            'status' => '0'
        ]);
        if($result){
            return redirect()->route('irs')->with('success', 'File IRS berhasil diunggah.');
        }
        else{
            return redirect()->route('irs')->with('error', 'Format yang dimasukkan');
        }
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


	$existingData = Khs::where('nim', Auth::user()->nim_nip)->get();

    if ($existingData->isEmpty()) {
        // Jika tidak ada data progres, maka hanya progres 1 yang diizinkan
        if ($request->semester != 1) {
            return redirect()->back()->with('error', 'Semester harus dimulai dari 1.');
        }
    } else {
        $latestProgres = $existingData->max('semester');

        if ($request->semester != $latestProgres + 1) {
            return redirect()->back()->with('error', 'Semester yang dimasukkan harus berurutan');
        }
    }
    if ($request->hasFile('pdf_file')) {
        $pdfFile = $request->file('pdf_file');
        $pdfFileName = time() . '.' . $pdfFile->getClientOriginalExtension();

        // Simpan file PDF ke direktori storage/app/public/irs
        $pdfFile->storeAs('public/khs', $pdfFileName);

        // Simpan data IRS ke dalam tabel IRS
        Khs::create([
            'nim' => Auth::user()->nim_nip,
            'semester' => $request->semester,
            'ips' => $request->ips,
            'file' => $pdfFileName,
        ]);

        return redirect()->route('khs')->with('success', 'File KHS berhasil diunggah.');
    }
}

public function updateFile(Request $request, $id)
{ 
    $khs = Khs::findOrFail($id);

    // Validasi input jika diperlukan
    $request->validate([
        'semester' => 'required',
        'ips' => 'required',
    ]);

    if ($request->hasFile('file')) {
        $pdfFile = $request->file('file');
        $pdfFileName = time() . '.' . $pdfFile->getClientOriginalExtension();

        // Simpan file ke direktori storage/app/public/foto
        $pdfFile->storeAs('public/khs', $pdfFileName);

        // Update data Mahasiswa dengan 'foto' baru
        $khs->update(['file' => $pdfFileName,
                        'semester' => $request->semester,
                        'ips' => $request->ips,
                    ]);

        return redirect()->route('khs')->with('success', 'Berkas berhasil diperbaharui.');
    } else {
        // Handle kasus tanpa file (opsional)
        // Jika tidak ada 'foto' yang diunggah, 'foto' tidak akan diubah
        // $mahasiswa->update($validatedData);
        $khs->update([
                        'semester' => $request->semester,
                        'ips' => $request->ips,
                    ]);
        return redirect()->route('khs')->with('success', 'Data berhasil diupdate.');
    }
}


public function updatePkl(Request $request, $id)
{ 
    $pkl = Pkl::findOrFail($id);

    // Validasi input jika diperlukan
    $request->validate([
        'semester' => 'required',
        'nilai' => 'required',
    ]);

    if ($request->hasFile('file')) {
        $pdfFile = $request->file('file');
        $pdfFileName = time() . '.' . $pdfFile->getClientOriginalExtension();

        // Simpan file ke direktori storage/app/public/foto
        $pdfFile->storeAs('public/pkl', $pdfFileName);

        // Update data Mahasiswa dengan 'foto' baru
        $pkl->update(['file' => $pdfFileName,
                        'semester' => $request->semester,
                        'nilai' => $request->nilai,
                    ]);

        return redirect()->route('pkl')->with('success', 'Berkas berhasil diperbaharui.');
    } else {
        // Handle kasus tanpa file (opsional)
        // Jika tidak ada 'foto' yang diunggah, 'foto' tidak akan diubah
        // $mahasiswa->update($validatedData);
        $pkl->update([
                        'semester' => $request->semester,
                        'nilai' => $request->nilai,
                    ]);
        return redirect()->route('pkl')->with('success', 'Data berhasil diupdate.');
    }
}

	public function storePkl(Request $request)
{
    // Validasi input jika diperlukan
    $request->validate([
        'semester' => 'required',
        'nilai' => 'required',
        'pdf_file' => 'required|mimes:pdf|', // File PDF dengan maksimum 2 MB
    ]);

	$existingData = Pkl::where('nim', Auth::user()->nim_nip)->first();
    if($existingData){
        return redirect()->route('pkl')->with('error', 'Hanya dapat melakukan entry PKL sebanyak satu kali!!');
    }
    if ($request->hasFile('pdf_file')) {
        $pdfFile = $request->file('pdf_file');
        $pdfFileName = time() . '.' . $pdfFile->getClientOriginalExtension();

        // Simpan file PDF ke direktori storage/app/public/irs
        $pdfFile->storeAs('public/pkl', $pdfFileName);

        // Simpan data IRS ke dalam tabel IRS
        Pkl::create([
            'nim' => Auth::user()->nim_nip,
            'semester' => $request->semester,
            'nilai' => $request->nilai,
            'file' => $pdfFileName,
        ]);

        return redirect()->route('pkl')->with('success', 'Entry PKL berhasil.');
    }
}


    //ENTRYYYYYYYY SKRIPSIII
	public function storeSkripsi(Request $request)
{
    // Validasi input jika diperlukan
    $request->validate([
        'semester' => 'required',
        'nilai' => 'required',
        'tanggal_sidang' => 'required',
        'lama_studi' => 'required',
        'pdf_file' => 'required|mimes:pdf|', // File PDF dengan maksimum 2 MB
    ]);
	$existingData = Skripsi::where('nim', Auth::user()->nim_nip)->first();
    if($existingData){
        return redirect()->route('skripsi')->with('error', 'Hanya dapat melakukan entry Skripsi sebanyak satu kali!!');
    }

    
    if ($request->hasFile('pdf_file')) {
        $pdfFile = $request->file('pdf_file');
        $pdfFileName = time() . '.' . $pdfFile->getClientOriginalExtension();

        // Simpan file PDF ke direktori storage/app/public/irs
        $pdfFile->storeAs('public/skripsi', $pdfFileName);

        // Simpan data IRS ke dalam tabel IRS
        Skripsi::create([
            'nim' => Auth::user()->nim_nip,
            'semester' => $request->semester,
            'nilai' => $request->nilai,
            'tanggal_sidang' => $request->tanggal_sidang,
            'lama_studi' => $request->lama_studi,
            'file' => $pdfFileName,
        ]);

        return redirect()->route('skripsi')->with('success', 'Entry Skripsi berhasil.');
    }
}

public function updateSkripsi(Request $request, $id)
{ 
    $skripsi = Skripsi::findOrFail($id);

    // Validasi input jika diperlukan
    $request->validate([
        'semester' => 'required',
        'nilai' => 'required',
    ]);

    if ($request->hasFile('file')) {
        $pdfFile = $request->file('file');
        $pdfFileName = time() . '.' . $pdfFile->getClientOriginalExtension();

        // Simpan file ke direktori storage/app/public/foto
        $pdfFile->storeAs('public/skripsi', $pdfFileName);

        // Update data Mahasiswa dengan 'foto' baru
        $skripsi->update(['file' => $pdfFileName,
                        'semester' => $request->semester,
                        'nilai' => $request->nilai,
                        'tanggal_sidang' => $request->tanggal_sidang,
                        'lama_studi' => $request->lama_studi,
                    ]);

        return redirect()->route('skripsi')->with('success', 'Berkas berhasil diperbaharui.');
    } else {
        // Handle kasus tanpa file (opsional)
        // Jika tidak ada 'foto' yang diunggah, 'foto' tidak akan diubah
        // $mahasiswa->update($validatedData);
        $skripsi->update([
                        'semester' => $request->semester,
                        'nilai' => $request->nilai,
                        'tanggal_sidang' => $request->tanggal_sidang,
                        'lama_studi' => $request->lama_studi,
                    ]);
        return redirect()->route('skripsi')->with('success', 'Data berhasil diupdate.');
    }
}

}
