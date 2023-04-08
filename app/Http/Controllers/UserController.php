<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //
    public function index(){

        $users = User::paginate(10);
        return response()->json([
            'data' => $users
        ]);
        return view('halaman/admin/form_tambah_pengguna');

    }

    public function store(Request $request)
    {
        $datavalid = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required',
            'role_id' => 'required'
        ]);

        $datavalid['password'] = bcrypt($datavalid['password']);

        $users = User::create($datavalid);

        return response()->json([
            'message' => 'User created successfully',
            'user' => $users
        ], 201);
    }

    public function show($id)
    {
        $users = User::find($id);

        if (!$users) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        return response()->json([
            'data' => $users
        ], 200);
    }

    public function update(Request $request, User $user)
    {
        $datavalid = $request->validate([
            'name' => 'max:255',
            'email' => 'email:dns|unique:users,email,'.$user->id,
            'password' => 'sometimes'
        ]);

        if (isset($datavalid['password'])) {
            $datavalid['password'] = bcrypt($datavalid['password']);
        }

        $user->name = $datavalid['name'];
        $user->email = $datavalid['email'];
        $user->password = $datavalid['password'];

        $user->save();

        return response()->json([
            'data' => $user
        ]);
    }

    public function destroy(User $users){
        $users->delete();
        return response()->json([
            'message' => 'user deleted'
        ], 204);
    }   
}