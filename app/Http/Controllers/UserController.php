<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\UnitKerja;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('dashboard.admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        $unitKerjas = UnitKerja::all();
        return view('dashboard.admin.users.create', compact('roles', 'unitKerjas'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.admin.users.show', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
            'unit_kerja_id' => 'required|exists:unit_kerjas,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'unit_kerja_id' => $request->unit_kerja_id,
        ]);

        $role = Role::find($request->role_id);
        $user->assignRole($role->name);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $unitKerjas = UnitKerja::all();
        return view('dashboard.admin.users.edit', compact('user', 'unitKerjas'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'unit_kerja_id' => 'required|exists:unit_kerjas,id',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->unit_kerja_id = $request->unit_kerja_id;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
