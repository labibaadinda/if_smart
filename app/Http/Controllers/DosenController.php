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
        $dosen = Dosen::with('mahasiswa')->where('nip', Auth::user()->nim_nip)->first();
		$mahasiswas = Mahasiswa::where('dosen_id',$dosen->id);
        $countby = Mahasiswa::get()->countBy('angkatan');
        $thnmax = Mahasiswa::get('angkatan')->max();
        $thnmin = Mahasiswa::get('angkatan')->min();
        $pkls = Pkl::all();
        // $tahuns =
        $angkatan = '';
        // $angkatan = $countby;
		return view('dosen.index', compact('mahasiswas','dosen','countby','thnmax','thnmin','angkatan','pkls'));
    }
    public function ListMhs()
    {
        $dosen = Dosen::with('mahasiswa')->where('nip', Auth::user()->nim_nip)->first();
		$mahasiswas = Mahasiswa::where('dosen_id',$dosen->id)->get();
		return view('dosen.listmahasiswa', compact('mahasiswas','dosen'));
    }

    // Search Mahasiswa
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        // Sesuaikan dengan model Mahasiswa dan struktur tabel di database
        $mahasiswas = Mahasiswa::where('nim', 'LIKE', "%$keyword%")
            ->orWhere('nama', 'LIKE', "%$keyword%")
            ->get();

        return view('dosen.search', compact('mahasiswas', 'keyword'));
    }

    public function showDetail($nim)
    {
        $mahasiswa = Mahasiswa::where('nim', $nim)->firstOrFail();
        // Sesuaikan dengan model dan struktur tabel semester di database
        // $semesters = $mahasiswa->select('semesters');
        $irss = Irs::where('nim',$nim)->orderBy('semester', 'ASC')->get();
        $khss = Khs::where('nim',$nim)->orderBy('semester', 'ASC')->get();

        // $skripsis = Skripsi::where('nim',$nim)->orderBy('progres', 'ASC')->get();
        $skripsis = Skripsi::where('nim',$nim)->get();
        $sidang = Skripsi::where('nim',$nim)->get()->last();
        // $pkls = Pkl::where('nim',$nim)->orderBy('progres', 'ASC')->get();

        $skripsis = Skripsi::where('nim',$nim)->get();
        // $sidang = Skripsi::where('nim',$nim)->get('stat_skripsi')->last();
        $pkls = Pkl::where('nim',$nim)->get();


        return view('dosen.detailSearch', compact(
            'mahasiswa',
            'skripsis',
            'irss',
            'khss',
            'pkls'
        ));
    }

    public function showSemesterDetail($nim, $semester)
    {
    $mahasiswa = Mahasiswa::where('nim', $nim)->firstOrFail();
    // Sesuaikan dengan model dan struktur tabel semester di database
    $semesterDetail = $mahasiswa->semesters->where('semester', $semester)->first();

    return view('mahasiswa.semester_detail', compact('mahasiswa', 'semesterDetail'));
    }

    public function searchVerifikasiIrs(Irs $irs)
    {
		$mahasiswas = Mahasiswa::All();
        return view('dosen.search.verifIrs', compact('irs','mahasiswas'));
    }

    public function searchVerifIrs(Request $request, Irs $irs)
    {
        if ($request->action === 'verifikasi') {
            $irs->update(['status' => '1']);
            $message = 'IRS berhasil diverifikasi.';
        } elseif ($request->action === 'tolak') {
            $irs->update(['status' => 'tolak']);
            $message = 'IRS berhasil ditolak.';
        }

        return redirect()->route('dosen.detailSearch', $irs->nim)->with('message', [
            'status' => 'true',
            'message' => $message,
        ]);
    }

    public function searchVerifikasiKhs(Khs $khs)
    {
		$mahasiswas = Mahasiswa::All();
        return view('dosen.search.verifKhs', compact('khs','mahasiswas'));
    }

    public function searchVerifKhs(Request $request, Khs $khs)
    {
        if ($request->action === 'verifikasi') {
            $khs->update(['status' => '1']);
            $message = 'KHS berhasil diverifikasi.';
        } elseif ($request->action === 'tolak') {
            $khs->update(['status' => 'tolak']);
            $message = 'KHS berhasil ditolak.';
        }

        return redirect()->route('dosen.detailSearch', $khs->nim)->with('message', [
            'status' => 'true',
            'message' => $message,
        ]);
    }

    public function searchVerifikasiPkl(Pkl $pkl)
    {
        $mahasiswas = Mahasiswa::All();
        return view('dosen.search.verifPkl', compact('pkl','mahasiswas'));
    }

    public function searchVerifPkl(Request $request, Pkl $pkl)
    {
        if ($request->action === 'verifikasi') {
            $pkl->update(['konfirmasi' => '1']);
            $message = 'PKL berhasil diverifikasi.';
        } elseif ($request->action === 'tolak') {
            $pkl->update(['konfirmasi' => 'tolak']);
            $message = 'PKL berhasil ditolak.';
        }

        return redirect()->route('dosen.detailSearch', $pkl->nim)->with('message', [
            'status' => 'true',
            'message' => $message,
        ]);
    }

    public function searchVerifikasiSkripsi(Skripsi $skripsi)
    {
        $mahasiswas = Mahasiswa::All();
        return view('dosen.search.verifSkripsi', compact('skripsi','mahasiswas'));
    }

    public function searchVerifSkripsi(Request $request, Skripsi $skripsi)
    {
        if ($request->action === 'verifikasi') {
            $skripsi->update(['status' => '1']);
            $message = 'Skripsi berhasil diverifikasi.';
        } elseif ($request->action === 'tolak') {
            $skripsi->update(['status' => 'tolak']);
            $message = 'Skripsi berhasil ditolak.';
        }

        return redirect()->route('dosen.detailSearch', $skripsi->nim)->with('message', [
            'status' => 'true',
            'message' => $message,
        ]);
    }



    // IRS function
    public function viewIrs(){
        $irss = irs::where('status','0')->orderBy('id','ASC')->paginate(20);
		$mahasiswas = Mahasiswa::All();
		return view('dosen.irs.index', compact('irss','mahasiswas'));
    }

    public function showVerifikasiIrs(Irs $irs)
    {
		$mahasiswas = Mahasiswa::All();
        return view('dosen.irs.verifIrs', compact('irs','mahasiswas'));
    }

    public function verifIrs(Request $request, Irs $irs)
    {
        if ($request->action === 'verifikasi') {
            $irs->update(['status' => '1']);
            $message = 'IRS berhasil diverifikasi.';
        } elseif ($request->action === 'tolak') {
            $irs->update(['status' => 'tolak']);
            $message = 'IRS berhasil ditolak.';
        }

        return redirect()->route('irs.index', $irs->id)->with('message', [
            'status' => 'true',
            'message' => $message,
        ]);
    }

    // public function storeIrs(Request $request)
    // {
    //     // Validasi input jika diperlukan
    //     $request->validate([
    //         'semester' => 'required',
    //         'jumlah_sks' => 'required',
    //         'pdf_file' => 'required|mimes:pdf|', // File PDF dengan maksimum 2 MB
    //     ]);

    //     $existingData = Irs::where('nim', Auth::user()->nim_nip)->get();

    //     if ($existingData->isEmpty()) {
    //         // Jika tidak ada data progres, maka hanya progres 1 yang diizinkan
    //         if ($request->semester != 1) {
    //             return redirect()->back()->with('error', 'Semester harus dimulai dari 1.');
    //         }
    //     } else {
    //         $latestProgres = $existingData->max('semester');

    //         if ($request->semester != $latestProgres + 1) {
    //             return redirect()->back()->with('error', 'Semester yang dimasukkan harus berurutan');
    //         }
    //     }
    //     if ($request->hasFile('pdf_file')) {
    //         $pdfFile = $request->file('pdf_file');
    //         $pdfFileName = time() . '.' . $pdfFile->getClientOriginalExtension();

    //         // Simpan file PDF ke direktori storage/app/public/irs
    //         $pdfFile->storeAs('public/irs', $pdfFileName);

    //         // Simpan data IRS ke dalam tabel IRS
    //         Irs::create([
    //             'nim' => Auth::user()->nim_nip,
    //             'semester' => $request->semester,
    //             'jumlah_sks' => $request->jumlah_sks,
    //             'file' => $pdfFileName,
    //         ]);

    //         return redirect()->route('user')->with('success', 'File IRS berhasil diunggah.');
    //     }
    // }

    // KHS function
    public function viewKhs(){
        $datas = khs::where('status','0')->orderBy('id','ASC')->paginate(20);
		$mahasiswas = Mahasiswa::All();
		return view('dosen.khs.index', compact('datas','mahasiswas'));
    }

    public function showVerifikasiKhs(Khs $khs)
    {
		$mahasiswas = Mahasiswa::All();
        return view('dosen.khs.verifIrs', compact('khs','mahasiswas'));
    }

    public function verifKhs(Request $request, Khs $khs)
    {
        if ($request->action === 'verifikasi') {
            $khs->update(['status' => '1']);
            $message = 'KHS berhasil diverifikasi.';
        } elseif ($request->action === 'tolak') {
            $khs->update(['status' => 'tolak']);
            $message = 'KHS berhasil ditolak.';
        }

        return redirect()->route('khs.index', $khs->id)->with('message', [
            'status' => 'true',
            'message' => $message,
        ]);
    }

    // PKL function
    public function viewPkl(){
        $datas = pkl::where('konfirmasi','0')->orderBy('id','ASC')->paginate(20);
		$mahasiswas = Mahasiswa::All();
		return view('dosen.pkl.index', compact('datas','mahasiswas'));
    }

    public function showVerifikasiPkl(Pkl $pkl)
    {
        $mahasiswas = Mahasiswa::All();
        return view('dosen.pkl.verifIrs', compact('pkl','mahasiswas'));
    }

    public function verifPkl(Request $request, Pkl $pkl)
    {
        if ($request->action === 'verifikasi') {
            $pkl->update(['konfirmasi' => '1']);
            $message = 'PKL berhasil diverifikasi.';
        } elseif ($request->action === 'tolak') {
            $pkl->update(['konfirmasi' => 'tolak']);
            $message = 'PKL berhasil ditolak.';
        }

        return redirect()->route('pkl.index', $pkl->id)->with('message', [
            'status' => 'true',
            'message' => $message,
        ]);
    }

    // Skripsi function
    public function viewSkripsi(){
        $datas = skripsi::where('status','0')->orderBy('id','ASC')->paginate(20);
		$mahasiswas = Mahasiswa::All();
		return view('dosen.skripsi.index', compact('datas','mahasiswas'));
    }

    public function showVerifikasiSkripsi(Skripsi $skripsi)
    {
        $mahasiswas = Mahasiswa::All();
        return view('dosen.skripsi.verifIrs', compact('skripsi','mahasiswas'));
    }

    public function verifSkripsi(Request $request, Skripsi $skripsi)
    {
        if ($request->action === 'verifikasi') {
            $skripsi->update(['status' => '1']);
            $message = 'Skripsi berhasil diverifikasi.';
        } elseif ($request->action === 'tolak') {
            $skripsi->update(['status' => 'tolak']);
            $message = 'Skripsi berhasil ditolak.';
        }

        return redirect()->route('skripsi.index', $skripsi->id)->with('message', [
            'status' => 'true',
            'message' => $message,
        ]);
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
