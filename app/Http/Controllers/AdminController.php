<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
      public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return response()->json([
            'token'=>$this->respondWithToken($token),
            'admin'=> Auth::user()
        ]);
    }

    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }
    public function register(Request $request)
    {
        $manager = new Manager();
        $manager->email = $request->input('email');
        $manager->password = bcrypt($request->input('password'));
        $manager->save();
        $token = auth()->attempt(['email'=>$manager->email,'password'=>$request->input('password')]);
        return $this->respondWithToken($token);
    }
    public function me(){
        return  Auth::user();

    }
     public function index()
    {
        return Admin::paginate(10);
    }
     public function sudos()
    {
        return Admin::where('role','sysmanage')->get();
    }

    public function show($user_id)
    {
        return Admin::findOrFail($user_id);
    }

    public function store(Request $request)
    {
        $admin = new Admin();
      if($request->input('username')) $admin->username = $request->input('username');
      if($request->input('email')) $admin->email = $request->input('email');
      if($request->input('role')) $admin->role = $request->input('role');
    
     
        $admin->save();
        return $admin;
    }

    public function update(Request $request,$user_id)
    {
        $admin = Admin::findOrFail($user_id);
          if($request->input('public_address')) $admin->public_address = $request->input('public_address');
      if($request->input('username')) $admin->username = $request->input('username');
      if($request->input('email')) $admin->email = $request->input('email');
      if($request->input('role')) $admin->role = $request->input('role'); 
        $admin->save();
        return $admin;
    }
    public function destroy($user_id)
    {
        $admin = Admin::findOrfail($user_id);
        if($admin->delete()) return  true;
        return "Error while deleting";
    }
}
