<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class usersController extends Controller
{
    public function index()
    {
        $data = User::all();
        return view('dashboard.users.index', compact('data'));
    }
    public function createshow()
    {
        return view('dashboard.users.create');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'displayname' => $request->displayname,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('showUsers')->with('success', 'done!');
    }

    public function editshow($id)
    {
        $channel = User::find($id);
        return view('dashboard.users.edit', compact('channel'));
    }
    public function edit(Request $request, $id)
    {
        $channel = User::find($id);
        $channel->update($request->all());
        return redirect()->route('showUsers')
            ->with('success', 'successfully.');
    }

    public function delete($id)
    {
        $channel = User::find($id);
        $channel->delete();
        return redirect()->route('showUsers')
            ->with('success', 'successfully.');
    }
    public function ActiveAdmin(Request $request, $id)
    {
        $channel = User::find($id);
        $adminBoll = $channel->isAdmin;

        $channel->update(['isAdmin' => false]);
        return redirect()->route('showUsers')
            ->with('success', 'successfully.');
    }
}
