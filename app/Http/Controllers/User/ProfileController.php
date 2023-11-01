<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Hash;

use App\Models\User;

class ProfileController extends Controller
{
    public function updateInitialData(Request $request, User $user)
    {
        try {

            DB::beginTransaction();

            $isHandphoneExists = User::where('handphone', $request->handphone)->count() >= 1 ? true : false;

            if ($isHandphoneExists) {
                throw new Exception("No Handphone Already used", 400);
            }
            $user->handphone = $request->handphone;

            $user->update($request->all());

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

    public function index()
    {
    	return view('user.profile');
    }

    public function update(Request $request, User $user)
    {
    	if ($request->password) {
    		$password = Hash::make($request->password);
    	}else{
    		$password = $request->old_password;
    	}

    	$request->request->add(['password' => $password]);
    	$user->update($request->all());
    	return back()->with('success','Proflie updated successfully');
    }
}
