<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('email','!=',Auth::user()->email)->get()->toArray();

        return view('user.users')->with(compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email'
        ]);

        $add_user = User::create([
            'name' => $request->first_name.' '.$request->last_name,
            'email' => $request->email,
            'roles' => $request->roles
        ]);

        if ($add_user) {
            return redirect('users');
        } else {
            return redirect()->back()->withErrors($validated);
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email'
        ]);

        $edit_user = User::where('id', $id)->update([
            'name' => $request->first_name.' '.$request->last_name,
            'email' => $request->email,
            'roles' => $request->roles
        ]);

        if ($edit_user) {
            return redirect('users');
        } else {
            return redirect()->back()->withErrors($validated);
        }
    }

    public function destroy($id)
    {
        $delete_user = User::where('id', $id)->delete();

        if ($delete_user) {
            return redirect('users');
        }
    }

    public function edit_user($id)
    {
        $user = User::where('id', $id)->get()->toArray();

        return view('user.edit_user')->with(compact('user'));
    }
}
