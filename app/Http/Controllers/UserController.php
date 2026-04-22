<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/dashboard')->with('error', 'No tienes permisos');
        }
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/dashboard')->with('error', 'No tienes permisos');
        }
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/dashboard')->with('error', 'No tienes permisos');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,user',
            'municipio' => 'nullable|string'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'municipio' => $request->municipio
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Usuario creado exitosamente');
    }

    public function edit($id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/dashboard')->with('error', 'No tienes permisos');
        }
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/dashboard')->with('error', 'No tienes permisos');
        }

        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role' => 'required|in:admin,user',
            'municipio' => 'nullable|string'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'municipio' => $request->municipio
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('admin.users.index')->with('success', 'Usuario actualizado exitosamente');
    }

    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/dashboard')->with('error', 'No tienes permisos');
        }

        $user = User::findOrFail($id);
        
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users.index')->with('error', 'No puedes eliminar tu propio usuario');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado exitosamente');
    }
}