<?php

namespace App\Http\Controllers;


use App\Models\Irs;
use App\Models\Khs;
use App\Models\Pkl;
use App\Models\Dosen;
use App\Models\Skripsi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoredosenRequest;
use App\Http\Requests\UpdatedosenRequest;


class DosenController extends Controller
{
    use WithPagination;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dosens = Dosen::with('mahasiswa')->where('nip', Auth::user()->nim_nip)->get();
		$mahasiswas = Mahasiswa::All();
		return view('dosen.index', compact('mahasiswas','dosens'));
    }

    public function viewIrs(){
        $irss = irs::where('status','0')->orderBy('id','ASC')->paginate(20);
		$mahasiswas = Mahasiswa::All();
		return view('dosen.irs.index', compact('irss','mahasiswas'));
    }

    public function showVerifikasi(Irs $irs)
    {
        return view('dosen.irs.verifIrs', compact('irs'));
    }

    public function verifIrs(Request $request, Irs $irs)
{
    // Lakukan verifikasi atau penolakan berdasarkan nilai $request->action

    if ($request->action === 'verifikasi') {
        // Lakukan verifikasi IRS
        $irs->update(['status' => 'verifikasi']);
    } elseif ($request->action === 'tolak') {
        // Lakukan penolakan IRS
        $irs->update(['status' => 'tolak']);
    }

    return redirect()->route('irs.index')->with('success', 'IRS berhasil diverifikasi atau ditolak.');
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
        Irs::create([
            'nim' => Auth::user()->nim_nip,
            'semester' => $request->semester,
            'jumlah_sks' => $request->jumlah_sks,
            'file' => $pdfFileName,
        ]);

        return redirect()->route('user')->with('success', 'File IRS berhasil diunggah.');
    }
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoredosenRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoredosenRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function show(dosen $dosen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function edit(dosen $dosen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatedosenRequest  $request
     * @param  \App\Models\dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatedosenRequest $request, dosen $dosen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function destroy(dosen $dosen)
    {
        //
    }
}
