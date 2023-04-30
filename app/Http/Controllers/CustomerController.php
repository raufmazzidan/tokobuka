<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('customer', [
            'page' => 'Customer',
            'data' => User::where('role', 'customer')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer-create', [
            'page' => 'Customer',
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
            'dob' => 'required',
            'address' => 'required',
            'ktp' => 'required',
            'role' => 'required',
            'username' => 'required|unique:users',
            'password' => Password::min(8)->mixedCase()->numbers(),
        ]);

        $image_path = $request->file('ktp')->store('image', 'public');

        User::create([
            'ktp' => $image_path,
            'name' => $request['name'],
            'gender' => $request['gender'],
            'dob' => $request['dob'],
            'address' => $request['address'],
            'role' => $request['role'],
            'username' => $request['username'],
            'password' => Hash::make($payload['password']),
        ]);

        return redirect('/customer');
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

        return view('customer-edit', [
            'page' => 'Customer',
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
            'dob' => 'required',
            'address' => 'required',
            'role' => 'required',
            'username' => 'required',
        ];

        if ($request['password']) {
            $rule['password'] = Password::min(8)->mixedCase()->numbers();
        }

        if ($request['username'] != $user->username) {
            $rule['username'] = 'required|unique:users';
        }

        if ($request['ktp']) {
            $rule['ktp'] = 'required';
        }

        $payload = $request->validate($rule);

        $image = "";

        if ($request['ktp']) {
            if (gettype($request['ktp']) == 'string') {
                $image = $request['ktp'];
            } else {
                $image = $request->file('ktp')->store('image', 'public');
            }
        } else {
            $image = $user->image;
        }


        $p = [
            'name' => $request['name'],
            'gender' => $request['gender'],
            'dob' => $request['dob'],
            'address' => $request['address'],
            'role' => $request['role'],
            'username' => $request['username'],
        ];

        if ($image) {
            $p['ktp'] = $image;
        }

        if ($request['password']) {
            $p['password'] = Hash::make($payload['password']);
        }

        User::where('id', $id)->update($p);

        return redirect('/customer');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $d = User::find($id);
        $d->delete();
        return redirect('/customer');
    }
}