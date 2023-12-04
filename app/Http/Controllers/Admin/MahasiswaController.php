<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\dosen;

use App\Models\mahasiswa;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use App\Imports\MahasiswaImport;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreUserRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;

class MahasiswaController extends Controller
{
    use WithPagination;

    public function index(Request $request)
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

        return view('admin.user.index',[
            // 'test' => 'masuk',
            'datas' => $data,
            'dosens' => $dosens
        ]);
    }

    public function create()
    {
		// $mahasiswas = mahasiswa::with('dosen')->where('nim', Auth::user()->nim_nip)->get();
        $dosens = dosen::All();

        return view('admin.user.create',compact('dosens'));
    }

    public function storeExcel(Request $request)
    {
		$request->validate([
            'file' => 'required|mimes:xlsx|max:10240',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('excel_files', $fileName, 'public');

            // Use Maatwebsite\Excel to import data from Excel file
            $import = new MahasiswaImport();
            Excel::import($import, public_path('storage/excel_files/' . $fileName));

            return redirect()->back()->with('success', 'File uploaded and data imported successfully.');
        }

        return redirect()->back()->with('error', 'File upload failed.');
    }

    public function store(StoreUserRequest $request)
    {
        try {

            DB::beginTransaction();

            $user = new User();
            $mahasiswa = new mahasiswa();

            $mahasiswa->nama = $request->name;
            $isNimExists = User::where('nim_nip', $request->nip)->count() >= 1 ? true : false;
            if ($isNimExists) {
                throw new Exception("NIM Already exists", 400);
            }
            $user->nim_nip = $request->nim;
            $mahasiswa->nim = $request->nim;
            $mahasiswa->angkatan = $request->angkatan;
            $mahasiswa->dosen_id = $request->dosenWali;

            // $user->status = $request->status;




            // $isEmailExists = User::where('email', $request->email)->count() >= 1 ? true : false;

            // if ($isEmailExists) {
            //     throw new Exception("Email Already used", 400);
            // }
            // $user->email = $request->email;




            $password = Hash::make($request->password);
            $user->password = $password;
            $user->role = 'mahasiswa';

            $user->save();

            DB::commit();

            return redirect()->to('/admin/user')->with('message', [
                'status' => 'true',
                'message' => 'Successfully Created User'
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return back()->with('error', $e->getCode() == 500 ? 'Failed to create user' : $e->getMessage());
        }
    }

    public function storeMahasiswa(Request $request)
    {
        // Validasi input jika diperlukan
        $request->validate([
            'name' => 'required',
            'nim' => 'required',
            'angkatan' => 'required',
            'dosen_wali' => 'required',
            'status' => 'required',
            // 'pdf_file' => 'required|mimes:pdf|', // File PDF dengan maksimum 2 MB
        ]);


        $existingData = User::where('nim_nip', $request->nim)->get();

        if ($existingData->isNotEmpty()) {
            // Jika tidak ada data progres, maka hanya progres 1 yang diizinkan
            return redirect()->back()->with('error', 'NIM mahasiswa telah digunakan');
        }

        $password = Hash::make('password');

        User::create([
            'nim_nip' => $request->nim,
            'role' => 'mahasiswa',
            'password' => $password,
        ]);

        mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->name,
            'angkatan' => $request->angkatan,
            'dosen_id' => $request->dosen_wali,
            'status' => $request->status,
        ]);
            return redirect()->to('/operator/user')->with('success', 'Mahasiswa berhasil ditambahkan');


        // if ($request->hasFile('pdf_file')) {
        //     $pdfFile = $request->file('pdf_file');
        //     $pdfFileName = time() . '.' . $pdfFile->getClientOriginalExtension();

        //     // Simpan file PDF ke direktori storage/app/public/irs
        //     $pdfFile->storeAs('public/khs', $pdfFileName);

            // Simpan data IRS ke dalam tabel IRS
        //     Khs::create([
        //         'nim' => Auth::user()->nim_nip,
        //         'semester' => $request->semester,
        //         'ips' => $request->ips,
        //         'file' => $pdfFileName,
        //     ]);

        //     return redirect()->route('user')->with('success', 'File KHS berhasil diunggah.');
        // }
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        // $user = User::findOrFail($id);
        $mahasiswa = Mahasiswa::where('id',$id)->firstOrFail();
        $user = User::where('nim_nip',$mahasiswa->nim)->firstOrFail();
        $dosens = Dosen::all(); // Anda mungkin perlu menyesuaikan ini sesuai kebutuhan
        // $user = User::where('nim_nip',$mahasiswa->nim)->firstOrFail();

        return view('admin.user.edit3', compact('user', 'dosens','mahasiswa'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'nama' => 'required',
        'nim' => 'required|numeric',
        'angkatan' => 'required|numeric',
        'dosen_id' => 'required|exists:dosens,id',
        'status' => 'required',
    ]);

    $mahasiswa = Mahasiswa::findOrFail($id);
    $mahasiswa->update([
        'nama' => $request->input('nama'),
        'nim' => $request->input('nim'),
        'angkatan' => $request->input('angkatan'),
        'dosen_id' => $request->input('dosen_id'),
        'status' => $request->input('status'),

    ]);

    $user = User::where('nim_nip',$mahasiswa->nim)->firstOrFail();
    $user->update([
        'role' => $request->input('role'),
    ]);

    // Reset password menjadi default 'password'                                                            sini disini
    // $mahasiswa->update(['password' => bcrypt('password')]);

    return redirect()->route('user.index')->with([
        'message' => [
            'status' => 'true',
            'message' => 'Data berhasil diupdate.'
        ]
    ]);
}

    // public function update(Request $request, $id)
    // {
    //     \Log::info('Data yang diterima:', $request->all());
    //     // Validasi request jika diperlukan
    //     $request->validate([
    //         'nama' => 'required|string',
    //             'nim' => 'required|string',
    //             'angkatan' => 'required|string',
    //             'status' => 'required|in:aktif,nonaktif',
    //             'dosen_id' => 'required|exists:dosens,id',
    //     ]);

    //     $user = User::findOrFail($id);

    //     // Update data mahasiswa
    //     $user->update([
    //         'nama' => $request->input('nama'),
    //         'nim' => $request->input('nim'),
    //         'angkatan' => $request->input('angkatan'),
    //         'status' => $request->input('status'),
    //         'dosen_id' => $request->input('dosen_id'),
    //     ]);

    //     return redirect()->route('user.edit', $id)->with('success', 'Mahasiswa berhasil diperbarui.');
    // }

    public function resetPassword($id)
    {
        $mahasiswa = Mahasiswa::where('id',$id)->firstOrFail();
        $user = User::where('nim_nip',$mahasiswa->nim)->firstOrFail();


        // Reset password ke default "password"
        $user->update([
            'password' => bcrypt('password'),
        ]);

        return redirect()->route('user.edit', $mahasiswa->id)->with('message', [
            'status' => 'true',
            'message' => 'Password mahasiswa berhasil direset',
        ]);
    }

    public function delete($id)
    {
        // $mahasiswa = Mahasiswa::where('id',$id)->firstOrFail();
        // $user = User::where('nim_nip',$mahasiswa->nim)->firstOrFail();
        $user = User::findOrFail($id);
        $mahasiswa = Mahasiswa::where('nim',$user->nim_nip);

        // Hapus mahasiswa dan user terkait
        // $user->delete();
        try {
            $user->delete();
            $mahasiswa->delete();
        } catch (Exception $e) {
            return back()->with('error', $e->getCode() == 500 ? 'Failed to delete user' : $e->getMessage());
        }

        return redirect()->route('user.index')->with('success', 'Mahasiswa berhasil dihapus.');
    }

    // public function edit(User $user)
    // {
    //     return view('admin.user.edit', compact('user'));
    // }

    // public function update(Request $request, User $user)
    // {

    //     try {

    //         DB::beginTransaction();

    //         if ($request->password) {
    //             $password = Hash::make($request->password);
    //             $user->password = $password;
    //         }

    //         $user->update($request->all());

    //         DB::commit();

    //         return redirect()->to('/admin/user')->with('message', [
    //             'status' => 'true',
    //             'message' => 'Successfully Updated User'
    //         ]);

    //     } catch (Exception $e) {
    //         DB::rollBack();
    //         return back()->with('error', $e->getCode() == 500 ? 'Failed to update user' : $e->getMessage());
    //     }
    // }

    public function destroy(User $user)
    {
        try {
            $user->delete();
        } catch (Exception $e) {
            return back()->with('error', $e->getCode() == 500 ? 'Failed to delete user' : $e->getMessage());
        }
        // return redirect()->to('/admin/user')->with('message', [
        //     'status' => 'true',
        //     'message' => 'Successfully Delete User'
        // ]);
    }
}
