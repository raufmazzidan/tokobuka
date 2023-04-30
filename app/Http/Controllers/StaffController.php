<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('staff', [
            'page' => 'Staff',
            'data' => User::where('role', 'staff')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('staff-create', [
            'page' => 'Staff',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $payload = $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'role' => 'required',
            'username' => 'required|unique:users',
            'password' => Password::min(8)->mixedCase()->numbers(),
        ]);

        $payload['dob'] = '-';
        $payload['address'] = '-';
        $payload['ktp'] = '-';
        $payload['password'] = Hash::make($payload['password']);

        User::create($payload);

        return redirect('/staff');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('staff-edit', [
            'page' => 'Staff',
            'data' => User::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $rule = [
            'name' => 'required',
            'gender' => 'required',
            'role' => 'required',
            'username' => 'required',
        ];

        if ($request['password']) {
            $rule['password'] = Password::min(8)->mixedCase()->numbers();
        }

        if ($request['username'] != $user->username) {
            $rule['username'] = 'required|unique:users';
        }

        $payload = $request->validate($rule);

        if ($request['password']) {
            $payload['password'] = Hash::make($payload['password']);
        }

        User::where('id', $id)->update($payload);

        return redirect('/staff');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $d = User::find($id);
        $d->delete();
        return redirect('/staff');
    }
}