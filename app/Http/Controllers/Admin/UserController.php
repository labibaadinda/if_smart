<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\mahasiswa;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserController extends Controller
{
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

            // $data = User::select('*')->orderBy('created_at', 'DESC');
            // $datas = DataTables::of($data);

        return view('admin.user.index',[
            // 'test' => 'masuk',
            // 'datas' => $datas,
        ]);
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(StoreUserRequest $request)
    {
        try {

            DB::beginTransaction();

            $user = new User();

            $user->name = $request->name;

            $isEmailExists = User::where('email', $request->email)->count() >= 1 ? true : false;

            if ($isEmailExists) {
                throw new Exception("Email Already used", 400);
            }
            $user->email = $request->email;

            $isNimExists = User::where('nim_nip', $request->nip)->count() >= 1 ? true : false;
            if ($isNimExists) {
                throw new Exception("NIM Already exists", 400);
            }
            $user->nim_nip = $request->nim;

            $user->angkatan = $request->angkatan;

            $user->status = $request->status;


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

    public function show($id)
    {
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {

        try {

            DB::beginTransaction();

            if ($request->password) {
                $password = Hash::make($request->password);
                $user->password = $password;
            }

            $user->update($request->all());

            DB::commit();

            return redirect()->to('/admin/user')->with('message', [
                'status' => 'true',
                'message' => 'Successfully Updated User'
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getCode() == 500 ? 'Failed to update user' : $e->getMessage());
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
        } catch (Exception $e) {
            return back()->with('error', $e->getCode() == 500 ? 'Failed to delete user' : $e->getMessage());
        }
    }
}
