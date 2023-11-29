<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\irs;
use App\Models\khs;
use App\Models\pkl;

use App\Models\User;
use App\Models\dosen;
use App\Models\Skripsi;
use App\Models\mahasiswa;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;


// use Barryvdh\Snappy\Facades\SnappyPdf as PDF;

class DepartemenController extends Controller
{
    use WithPagination;



    public function index()
    {
        $mahasiswas = Mahasiswa::all();
        $countby = Mahasiswa::get()->countBy('angkatan');
        $thnmax = Mahasiswa::get('angkatan')->max();
        $thnmin = Mahasiswa::get('angkatan')->min();
        $pkls = Pkl::get();
        $aktif = Mahasiswa::where('status', 'aktif')->count();
        $allpkl = Pkl::count();
        $alldosen = Dosen::count();
        $allskripsi = Skripsi::count();
        $pkl = Pkl::join('mahasiswas','pkls.nim','=','mahasiswas.nim')->select('mahasiswas.nama','pkls.nim','pkls.semester','mahasiswas.angkatan');

        $statuss = Mahasiswa::get()->countBy('status');

        $angkatanArray = [];

        foreach (range($thnmin->angkatan, $thnmax->angkatan) as $angkatanItem) {
            $sudahPklCount = Pkl::join('mahasiswas', 'pkls.nim', '=', 'mahasiswas.nim')
                ->where('mahasiswas.angkatan', $angkatanItem)
                ->whereNotNull('pkls.id')
                ->count();

            $belumPklCount = Pkl::join('mahasiswas', 'pkls.nim', '=', 'mahasiswas.nim')
                ->where('mahasiswas.angkatan', $angkatanItem)
                ->whereNull('pkls.id')
                ->count();

            $angkatanArray[$angkatanItem] = [
                'sudah_pkl' => $sudahPklCount,
                'belum_pkl' => $belumPklCount,
            ];
        }

        return view('departemen.index',compact('mahasiswas','countby','thnmax','thnmin','pkls','pkl','aktif','allpkl','alldosen','allskripsi','statuss','angkatanArray'));
    }

    public function listMahasiswa(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*')->orderBy('created_at', 'DESC');
            // $data = mahasiswa::select('*')->orderBy('created_at', 'DESC');


            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="row"><a href="' . route('user.edit', $row->id)  . '" id="' . $row->id . '" class="btn btn-primary btn-sm ml-2 btn-edit">Edit</a>';
                    $btn .= '<a href="javascript:void(0)" id="' . $row->id . '" class="btn btn-danger btn-sm ml-2 btn-delete">Delete</a></div>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

            $data = mahasiswa::orderBy('nama','ASC')->paginate(20);
            $dosens = dosen::All();
            // $datas = DataTables::of($data);

        return view('departemen.listMahasiswa',[
            // 'test' => 'masuk',
            'datas' => $data,
            'dosens' => $dosens
        ]);
    }

    public function listMahasiswaAngkatan(Request $request, $thn)
    {
        if ($request->ajax()) {
            $data = User::select('*')->orderBy('created_at', 'DESC');
            // $data = mahasiswa::select('*')->orderBy('created_at', 'DESC');


            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="row"><a href="' . route('user.edit', $row->id)  . '" id="' . $row->id . '" class="btn btn-primary btn-sm ml-2 btn-edit">Edit</a>';
                    $btn .= '<a href="javascript:void(0)" id="' . $row->id . '" class="btn btn-danger btn-sm ml-2 btn-delete">Delete</a></div>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

            $data = Pkl::join('mahasiswas','pkls.nim','=','mahasiswas.nim')->where('angkatan',$thn)->orderBy('nama','ASC')->paginate(20);
            $dosens = dosen::All();
            // $datas = DataTables::of($data);

        return view('departemen.listMahasiswa',[
            // 'test' => 'masuk',
            'datas' => $data,
            'dosens' => $dosens
        ]);
    }

    // Search Mahasiswa
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        // Sesuaikan dengan model Mahasiswa dan struktur tabel di database
        $mahasiswas = Mahasiswa::where('nim', 'LIKE', "%$keyword%")
            ->orWhere('nama', 'LIKE', "%$keyword%")
            ->get();

        return view('departemen.search', compact('mahasiswas', 'keyword'));
    }

    public function showDetail($nim)
    {
        $mahasiswa = Mahasiswa::where('nim', $nim)->firstOrFail();
        // Sesuaikan dengan model dan struktur tabel semester di database
        // $semesters = $mahasiswa->select('semesters');
        $irss = irs::where('nim',$nim)->orderBy('semester', 'ASC')->get();
        $khss = khs::where('nim',$nim)->orderBy('semester', 'ASC')->get();

        // $skripsis = Skripsi::where('nim',$nim)->orderBy('progres', 'ASC')->get();
        $skripsis = Skripsi::where('nim',$nim)->get();
        $sidang = Skripsi::where('nim',$nim)->get()->last();
        // $pkls = Pkl::where('nim',$nim)->orderBy('progres', 'ASC')->get();

        $skripsis = Skripsi::where('nim',$nim)->get();
        // $sidang = Skripsi::where('nim',$nim)->get('stat_skripsi')->last();
        $pkls = Pkl::where('nim',$nim)->get();


        return view('departemen.detailSearch', compact(
            'mahasiswa',
            'skripsis',
            'irss',
            'khss',
            'pkls'
        ));
    }

    public function profile()
    {
        return view('departemen.profile');
    }

    public function updateFoto(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi input jika diperlukan
        $request->validate([
            'foto' => 'nullable|mimes:jpg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $pdfFile = $request->file('foto');
            $pdfFileName = time() . '.' . $pdfFile->getClientOriginalExtension();

            // Simpan file ke direktori storage/app/public/foto
            $pdfFile->storeAs('public/foto', $pdfFileName);

            // Update data Mahasiswa dengan 'foto' baru
            $user->update(['foto' => $pdfFileName]);

            return redirect()->route('profiledept')->with('success', 'Foto berhasil diperbaharui.');
        } else {
            // Handle kasus tanpa file (opsional)
            // Jika tidak ada 'foto' yang diunggah, 'foto' tidak akan diubah
            // $mahasiswa->update($validatedData);

            return redirect()->route('user')->with('error', 'Data gagal diupdate.');
        }
    }

    public function update(Request $request, $id) {
        $user = User::findOrFail($id);

        // Validasi input jika diperlukan
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        // Verifikasi password lama
        // if (!Hash::check($request->input('current_password'), $user->password)) {
        //     return redirect()->back()->withErrors(['current_password' => 'Password lama tidak cocok.'])->withInput();
        // }

        // Update password
        $user->update([
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect()->route('profiledept')->with('success', 'Password berhasil diperbaharui.');
    }

    //Mahasiswa Aktif
    public function listMahasiswaStatus(Request $request, $status, $thn)
    {
        if ($request->ajax()) {
            $data = User::select('*')->orderBy('created_at', 'DESC');
            // $data = mahasiswa::select('*')->orderBy('created_at', 'DESC');


            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="row"><a href="' . route('user.edit', $row->id)  . '" id="' . $row->id . '" class="btn btn-primary btn-sm ml-2 btn-edit">Edit</a>';
                    $btn .= '<a href="javascript:void(0)" id="' . $row->id . '" class="btn btn-danger btn-sm ml-2 btn-delete">Delete</a></div>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

            // $data = Pkl::join('mahasiswas','pkls.nim','=','mahasiswas.nim')->where('angkatan',$thn)->orderBy('nama','ASC')->paginate(20);
            $data = Mahasiswa::where('status',$status)->where('angkatan',$thn)->orderBy('nama','ASC')->paginate(20);
            $dosens = dosen::All();
            // $datas = DataTables::of($data);

        return view('departemen.listMahasiswa',[
            // 'test' => 'masuk',
            'datas' => $data,
            'dosens' => $dosens,
            // 'status' => $status,
        ]);
    }

    //Mahasiswa Cuti
    public function mahasiswaCuti(Request $request, $thn)
    {
        if ($request->ajax()) {
            $data = User::select('*')->orderBy('created_at', 'DESC');
            // $data = mahasiswa::select('*')->orderBy('created_at', 'DESC');


            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="row"><a href="' . route('user.edit', $row->id)  . '" id="' . $row->id . '" class="btn btn-primary btn-sm ml-2 btn-edit">Edit</a>';
                    $btn .= '<a href="javascript:void(0)" id="' . $row->id . '" class="btn btn-danger btn-sm ml-2 btn-delete">Delete</a></div>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

            // $data = Pkl::join('mahasiswas','pkls.nim','=','mahasiswas.nim')->where('angkatan',$thn)->orderBy('nama','ASC')->paginate(20);
            $data = Mahasiswa::where('status','cuti')->where('angkatan',$thn)->orderBy('nama','ASC')->paginate(20);
            $dosens = dosen::All();
            // $datas = DataTables::of($data);

        return view('departemen.listMahasiswa',[
            // 'test' => 'masuk',
            'datas' => $data,
            'dosens' => $dosens
        ]);
    }

    // public function cetakPdf($angkatan)
    // {
    //     $mahasiswasSudahPkl = Mahasiswa::where('angkatan', $angkatan)
    //         ->join('pkls', 'mahasiswas.nim', '=', 'pkls.nim')
    //         ->whereNotNull('pkls.id')
    //         ->get();

    //     $mahasiswasBelumPkl = Mahasiswa::where('angkatan', $angkatan)
    //         ->leftJoin('pkls', 'mahasiswas.nim', '=', 'pkls.nim')
    //         ->whereNull('pkls.id')
    //         ->get();

    //     $pdf = PDF::loadView('pdf.mahasiswa', compact('mahasiswasSudahPkl', 'mahasiswasBelumPkl', 'angkatan'));
    //     return $pdf->download('rekap_mahasiswa_pkl.pdf');
    // }
}
